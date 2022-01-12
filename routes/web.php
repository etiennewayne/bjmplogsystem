<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/register-page', [App\Http\Controllers\RegisterPageController::class, 'index']);

//Route::get('/login-page', [App\Http\Controllers\LoginpageController::class, 'index']);

Route::get('/about-page', [App\Http\Controllers\AboutPageController::class, 'index']);



Route::get('/fetch-address-provinces', [App\Http\Controllers\AddressController::class, 'getProvinces']);





//ADMINISTRATOR
Route::resource('/dashboard', App\Http\Controllers\Administrator\AdminDashboardController::class);

Route::resource('/user', App\Http\Controllers\Administrator\UserController::class);
Route::get('/fetch-users', [App\Http\Controllers\Administrator\UserController::class, 'fetchUsers']);



// //POST, GET, PUT, DELETE
// Route::get('/bjmp', function(){
//     //statement
// });

//Route::get('/bjmp-user', [App\Http\Controllers\Bjmpuser\BjmpUser::class, 'index'])->name('home');

Route::get('/session', function(){
    return Session::all();
});

Route::get('/logout', function(Request $request){
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
});
