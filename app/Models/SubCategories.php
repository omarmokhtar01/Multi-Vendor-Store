<?php

namespace App\Models;

use App\Http\Controllers\Dashboard\CategoriesController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategories extends Model
{
    use HasFactory;
    public function  categories()
    {
        return $this->belongsTo(CategoriesController::class,'category_id');
    }
}
