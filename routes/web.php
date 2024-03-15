<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\DisplayController;

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
Route::middleware("auth")->group(function(){
    
    Route::get('/admindashboard', [DisplayController::class, 'show'])->name("admindashboard");

    Route::get('/admindashboard/{id}/edit', [ItemController::class, 'edit'])->name("edit");
    Route::put('/admindashboard/{id}/edit', [ItemController::class, 'update'])->name("update");

    Route::get('/createuser', [AuthController::class, "createuser"])->name("createuser");
    Route::post('/createuser', [AuthController::class, "createuserPost"])->name("createuser.post");

    Route::get('admindashboard/{id}/delete', [ItemController::class, 'delete'])->name("delete");;
});

Route::get("/", [AuthController::class, "home"])->name("home");

Route::get('/login', [AuthController::class, "login"])->name("login");
Route::post('/login', [AuthController::class, "loginPost"])->name("login.post");

Route::get('/register', [AuthController::class, "register"])->name("register");
Route::post('/register', [AuthController::class, "registerPost"])->name("register.post");

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

