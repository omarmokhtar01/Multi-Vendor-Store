<?php

namespace App\Models;

use App\Rules\Filter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    // protected $fillable = [
    //     'name',
    //     'description',
    //     'image',
    //     'status',
    //     'slug',
    //     'parent_id',
    //     'id'

    // ];
    // public $timestamps=false;

    // يعنل ممنوع تتغير
    // protected $guarded =[
    //     'id'
    // ];


    // بدل ما انا المفروض اكتب كل الخانات فال fillable
    // ممكن اعمل guarded فاضيه وخلاص
    // معناها ان كله مسموح
    protected $guarded = [];
    public static function rules($id = 0){
         return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                "unique:categories,name,$id",
                new Filter('laravel'),
            ],
            'description' => 'required|string|min:3|max:255',
            'status' => 'required|in:active,archived',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
