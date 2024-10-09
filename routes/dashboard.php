<?php
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\Dashboard\CategoriesController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware'=>['auth'],
    'prefix'=>'dashboard',
    // بتعوض ال names بتخليها تبدأ ب الي مكتوب جواها
    // 'as'=>'dashboard.',
],function(){


    Route::get('/',
// function () {
//     return view('dashboard');
// }
[DashboardController::class,'index']
// verified عشان تفحص الايميل ده متفعل ولا لا
)->name('dashboard');


Route::resource('/categories',CategoriesController::class)
// ->names([
//     'index'=>'dashboard.categories.index',
//     'create'=>'dashboard.categories.create',
//     'store'=>'dashboard.categories.store',
//     'edit'=>'dashboard.categories.edit',
//     'update'=>'dashboard.categories.update',
//     'show'=>'dashboard.categories.show',
//     'destroy'=>'dashboard.categories.destroy'
// ])
;
});
