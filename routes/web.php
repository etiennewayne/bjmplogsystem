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

Auth::routes([
    'login' => false
]);
Route::get('/login', [App\Http\Controllers\Auth\CustomLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\CustomLoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\CustomLoginController::class, 'logout']);




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/register-page', App\Http\Controllers\RegisterPageController::class);

//Route::get('/login-page', [App\Http\Controllers\LoginpageController::class, 'index']);

Route::get('/about-page', [App\Http\Controllers\AboutPageController::class, 'index']);

Route::get('/fetch-address-provinces', [App\Http\Controllers\AddressController::class, 'getProvinces']);





/*  ADMINISTRATOR CONTROLLER AND ROUTES */
Route::resource('/dashboard', App\Http\Controllers\Administrator\AdminDashboardController::class);

Route::resource('/users', App\Http\Controllers\Administrator\UserController::class);
Route::get('/get-user-appointments/{userid}', [App\Http\Controllers\Administrator\UserController::class, 'getUserAppointments']);

Route::get('/get-users', [App\Http\Controllers\Administrator\UserController::class, 'getUsers']);
Route::post('/user-reset-password/{id}', [App\Http\Controllers\Administrator\UserController::class, 'resetPassword']);

Route::resource('/admin-appointments', App\Http\Controllers\Administrator\AdminAppointmentController::class);
Route::get('/get-all-appointments', [App\Http\Controllers\Administrator\AdminAppointmentController::class, 'getAllAppointments']);
Route::post('/admin-appointment-cancel/{id}', [App\Http\Controllers\Administrator\AdminAppointmentController::class, 'cancelAppointment']);
Route::post('/admin-appointment-approve/{id}', [App\Http\Controllers\Administrator\AdminAppointmentController::class, 'approveAppointment']);

/*  END ADMINISTRATOR CONTROLLER AND ROUTES */



//ADDRESS
Route::get('/load-provinces', [App\Http\Controllers\AddressController::class, 'loadProvinces']);
Route::get('/load-cities', [App\Http\Controllers\AddressController::class, 'loadCities']);
Route::get('/load-barangays', [App\Http\Controllers\AddressController::class, 'loadBarangays']);


//INMATE RELATIONSHIP
Route::get('/get-inmate-relationships', function(){
    return App\Models\InmateRelationship::orderBy('inmate_relationship', 'asc')->get();
});




//BJMP Side
Route::get('/bjmp-dashboard', [App\Http\Controllers\BJMP\BJMPController::class, 'index']);

Route::get('/qr-scanner', [App\Http\Controllers\BJMP\QRScannerController::class, 'index']);
Route::get('/validate-qr/{qrcode}', [App\Http\Controllers\BJMP\QRScannerController::class, 'validateQR']);
Route::post('/bjmp-change-password', [App\Http\Controllers\BJMP\BjmpChangePasswordController::class, 'update']);
Route::post('/save-frisk-item/{user_id}', [App\Http\Controllers\BJMP\QRScannerController::class, 'saveFriskItem']);




// //POST, GET, PUT, DELETE
// Route::get('/bjmp', function(){
//     //statement
// });

//Route::get('/bjmp-user', [App\Http\Controllers\Bjmpuser\BjmpUser::class, 'index'])->name('home');


//APPOINTMENT
Route::resource('/appointments', App\Http\Controllers\AppointmentController::class);

//Route::resource('/appointments', App\Http\Controllers\AppointmentController::class);
//Route::resource('/appointments', App\Http\Controllers\AppointmentController::class);





//CLIENT SIDE
Route::resource('/my-dashboard', App\Http\Controllers\Client\MyDashboardController::class);
Route::get('/get-user', [App\Http\Controllers\Client\MyDashboardController::class, 'getUserInfo']);

Route::put('/my-dashboard-profile/{id}', [App\Http\Controllers\Client\MyDashboardController::class, 'update']);


Route::resource('/my-appointment', App\Http\Controllers\Client\MyAppointmentController::class);
Route::get('/get-appointments', [App\Http\Controllers\Client\MyAppointmentController::class, 'getAppointments']);
Route::post('/my-appointment-cancel/{id}', [App\Http\Controllers\Client\MyAppointmentController::class, 'cancelAppointment']);

//CLIENT CHANGE PASSWORD
Route::post('/client-change-password', [App\Http\Controllers\Client\MyChangePassword::class, 'update']);




//REPORT //REPORT //REPORT
//REPORT //REPORT //REPORT
Route::get('/log-report', [App\Http\Controllers\Report\LogReportController::class, 'index']);
Route::get('/get-log-report', [App\Http\Controllers\Report\LogReportController::class, 'getLogReport']);
Route::get('/log-frisk-item-report', [App\Http\Controllers\Report\FriskItemReportController::class, 'index']);
Route::get('/get-log-frisk-item-report', [App\Http\Controllers\Report\FriskItemReportController::class, 'getLogFriskItemReport']);



//REPORT //REPORT //REPORT
//REPORT //REPORT //REPORT

Route::get('/session', function(){
    return Session::all();
});

Route::get('/logout', function(Request $request){
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
});

Route::middleware('auth')->get('/user', function(){
    return Auth::user();
});


Route::get('/date-test', function(){
    $mytime = Carbon\Carbon::now();

    return date('Y-m-d A');
    //return $mytime->toDateTimeString();
});
