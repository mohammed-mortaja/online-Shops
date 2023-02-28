<?php

use App\Http\Controllers\CityController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/' , function (){
//     return view('parent');
// });
Route::prefix('dashboard/admin/')->group(function(){
    Route::view('parent' ,'dashboard.parent')->name('parent');
    Route::view('test-temp' ,'dashboard.parent');
    Route::resource('cities' , CityController::class);

});

