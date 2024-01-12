<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\OwnerController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::middleware(['auth', 'checkrole:owner'])->group(function () {
    Route::resource('owner',OwnerController::class);
});

Route::middleware(['auth', 'checkrole:manager'])->group(function () {
    Route::get('manager',[ManagerController::class,'index']);
    Route::get('manager/view-request',[ManagerController::class,'viewRequest']);
    Route::get('manager/projects', [ManagerController::class,'viewProjects']);
    Route::get('manager/create-project',[ManagerController::class,'createProject']);
    Route::post('manager/store-project', [ManagerController::class,'storeProject']);
});

Route::middleware(['auth', 'checkrole:developer'])->group(function () {
    Route::resource('developer',DeveloperController::class);
});