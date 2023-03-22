<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\CityController;
use App\Http\Controllers\Dashboard\OwnerController;
use App\Http\Controllers\Dashboard\StoreController;
use App\Http\Controllers\Dashboard\SubCategoryController;
use App\Http\Controllers\Dashboard\ProductController;

Route::get('/', function () {
    return view('dashboard.parent');
});
// ->middleware(['auth:admin,owner', 'verified'])
Route::prefix('dashboard/admin/')->group(function () {

    Route::view('parent' ,'dashboard.parent')->name('parent');
    // Route::view('test-temp' ,'dashboard.parent');

    Route::resource('cities' , CityController::class);
    Route::post('cities_update/{id}', [CityController::class, 'update'])->name('cities_update');

    Route::resource('admins', AdminController::class);
    Route::post('admins_update/{id}', [AdminController::class, 'update'])->name('admins_update');


    Route::resource('owners', OwnerController::class);
    Route::post('owners_update/{id}', [OwnerController::class, 'update'])->name('owners_update');


    Route::resource('stores', StoreController::class);
    Route::post('stores_update/{id}', [StoreController::class, 'update'])->name('stores_update');

    Route::resource('categories' , CategoryController::class);
    Route::post('categories_update/{id}', [CategoryController::class, 'update'])->name('categories_update');

    Route::resource('sub_categories' , SubCategoryController::class);
    Route::post('sub_categories_update/{id}', [SubCategoryController::class, 'update'])->name('sub_categories_update');

    Route::resource('products' , ProductController::class);
    Route::post('products_update/{id}', [ProductController::class, 'update'])->name('products_update');

});

// Route::get('/dashboard', function () {
//     return view('dashboard.parent');
// })->middleware(['auth'])->name('dashboard');

