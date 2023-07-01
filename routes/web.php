<?php

use App\Http\Controllers\Admin\EmailController;
use App\Http\Controllers\Admin\ExcelController;
use App\Http\Controllers\Admin\FaqsController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});
// Auth::routes();
Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('faqs',FaqsController::class);
    Route::get('sendemail/{payment_id}', [EmailController::class,"sendEmail"])->name('sendmail');
    Route::get('change_status/{payment}', [EmailController::class,"ChangeStatus"])->name('changestatus')->middleware('signed');
    Route::post('status/{payment}',[EmailController::class,'status'])->name('status');
    Route::get('export',[ExcelController::class,'export'])->name('export');
    Route::any('search',[PaymentController::class,'search'])->name('search');
    Route::get('shownotification/{payment}',[PaymentController::class,'shownotification'])->name('notification');
    // Route::get('back',[PaymentController::class,'back'])->name('back');
});
