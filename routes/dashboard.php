<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\StoreController;

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

});

// Route::get('/dashboard', function () {
//     return view('dashboard.parent');
// })->middleware(['auth'])->name('dashboard');

