<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //  Request بيتجاب من service container
    public function index()
    {
        $request = request();
        $query =  Category::query();
        if ($name = $request->query('name')) {
            // $query->where('name', 'like', '%' . $name . '%');
            $query->where('name', 'like', "%{$name}%");
        }
        if ($status = $request->query('status')) {
            // $query->where('status', 'like', '=' . $status . '%');
            $query->whereStatus( $status);
        }

        // $categories = Category::all();
        // $categories = Category::paginate(1);
        $categories = $query->paginate(1);


        return view('dashboard/categories/index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dashboard/categories/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|min:3|max:255|unique:categories,name',
            'description' =>'required|string|min:3|max:255',
            // 'slug' => 'required|string|min:3|max:255|unique:categories',
            'status' =>'required|in:active,archived',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],[
            // عشان اتحكم فالماسدج بتاعتي
            'name.required' => 'The name field is required',
            'name.string' => 'The name must be a string',
            'name.min' => 'The name must be at least 3 characters',
            'name.max' => 'The name must not exceed 255 characters',
            'name.unique' => 'The name is already exist',

            // عشان يبعتلي اسم الحقل
            'required'=>'This (:attribute) is required'

        ]
    );
        $data = $request->except('image');

        // التحقق إذا كان هناك صورة مرفقة
        // if ($request->hasFile('image')) {
        // حفظ الصورة في مجلد 'categories' داخل storage/app/public
        // $path = $request->file('image')->store('categories', ['disk' => 'public']);

        // عامل مسار خاص
        // حفظ الصورة في مجلد 'categories' داخل storage/app/public

        // $path = $request->file('image')->store('categories', ['disk' => 'uploads']);

        // تخزين مسار الصورة
        // $data['image'] = $path;
        // }

        $data['image'] = $this->uploadFile($request, 'category');

        //  بدمج القيمة جوا الطلب
        // $request->merge([
        //     'slug' =>
        //     Str::slug($request->post('name'))
        // ]);
        $data['slug']=Str::slug($request->post('name'));
        $category = Category::create($data);

        return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $category = Category::findOrFail($id);
        return view('dashboard/categories/show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $category = Category::findOrFail($id);
        return view('dashboard/categories/edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        //
        // $request->validate(Category::rules($id));

        $category = Category::findOrFail($id);
        $old_image = $category->image;

        $data = $request->except('image');


            $new_image = $this->uploadFile($request, 'category');
            if ($new_image) {
                $data['image'] = $new_image;

            }


                $data['slug']=Str::slug($request->post('name'));


        $category->update($data);
        // isset بتفصح اذا كان موجود المتغير و قيمته مش null
        if ($old_image && $new_image) {
            Storage::disk('uploads')->delete($old_image);
        }
        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $category = Category::findOrFail($id);
        $category->delete();

        if ($category->image) {
            // حذف الصورة القديمة
            Storage::disk('uploads')->delete($category->image);
        }
        return redirect()->route('categories.index')->with('delete', 'Category deleted successfully');
    }

    protected function uploadFile(Request $request, $fileName)
    {
        if (!$request->hasFile('image')) {
            return null;
        }
        $path = $request->file('image')->store($fileName, ['disk' => 'uploads']);
        return $path;
    }
}
