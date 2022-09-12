<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\HomeController;
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
Route::get('/home', 'HomeController@index')->name('home');
// Route::post('image', [HomeController::class, 'upload']);
Route::get('/dashboard', function () {
     return view('dashboard');

    Route::resource('company',CompanyController::class->name('company'));
    Route::resource('employee',EmployeesController::class)->name('employee');

})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';




// ye wla route h

    // Route::post('image-upload', [ CompanyController::class, 'upload' ]);

    // // Route::resource('employees', 'EmployeesController');
    // Route::group(['middleware' => ['auth']], function() {
    //    Route::resource('company',CompanyController::class) ;
    //     Route::resource('users', UserController::class);
    //     Route::resource('employee',EmployeesController::class);
    // });

