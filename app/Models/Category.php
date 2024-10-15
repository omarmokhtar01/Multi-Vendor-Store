<?php

namespace App\Models;

use App\Rules\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes;
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

    // Eloquent Model Local Scopes
    public function scopeActive(Builder $builder){
        return $builder->where('status','=','active');
    }
    public function scopeStatus(Builder $builder,$status){
        return $builder->where('status','=',$status);
    }


    public function scopeFilter(Builder $builder,$filters){
        // if ($filter['name'] ?? false) {
        //     $builder->where('name', 'like', "%{$filters['name']}%");
        // }
        // if ($filter['status'] ?? false) {
        //     $builder->where('status', 'like', '=' . $filters['status'] . '%');
        // }
         $builder->when($filters['name'] ?? false, function ($builder, $value) {
        $builder->where('name', 'like', "%{$value}%");
    });

    $builder->when($filters['status'] ?? false, function ($builder, $value) {
        $builder->where('status', '=', $value);
    });
    }

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
    public function subcategories()
    {
        return $this->hasMany(Subcategories::class); // ربط الفئات الفرعية مع الفئة
    }
}
