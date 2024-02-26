<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/',function(){
    return redirect()->route('login');
})->name('login');


//  <<==============================Admin Route=========================================>>

Route::prefix('admin')->group(function () {

    Route::get('/login',function(){ 
        return view('admin.auth.login');
    })->name('login');

    Route::post('/login',[LoginController::class,'login'])->name('login');
    
    Route::get('/register',function(){
        return view('admin.auth.register');
    })->name('register');

    Route::post('/register',[LoginController::class,'register'])->name('register');

    Route::get('/dashboard',[AdminController::class,'showAllDataForDataTable'])->name('dashboard');
    Route::any('/load',[AdminController::class,'loadMoney'])->name('load');
    Route::any('/response',[AdminController::class,'phonepe_notify'])->name('response');

});



// Route::get('/send-mail',[LoginController::class,'sendMail'])->name('sendMail');


