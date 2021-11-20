<?php

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

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/user', [App\Http\Controllers\ControllerUser::class, 'index']);

Route::get('/login', [App\Http\Controllers\LoginpageController::class, 'index']);

Route::get('/register-component', [App\Http\Controllers\RegisterController::class, 'index']);


// //POST, GET, PUT, DELETE
// Route::get('/bjmp', function(){
//     //statement
// });

Route::get('/bjmp-user', [App\Http\Controllers\Bjmpuser\BjmpUser::class, 'index'])->name('home');
