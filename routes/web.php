<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\OwnerController;
use Illuminate\Support\Facades\Auth;



Route::get('/', function () {
    if(auth()->user())
        return redirect('/'.auth()->user()->role);
    else
        return view('index');
});

Auth::routes();


Route::middleware(['auth', 'checkrole:owner'])->group(function () {
    Route::get('owner/profile', [OwnerController::class,'viewProfile']);
    Route::get('owner',[OwnerController::class,'index']);
    Route::get('owner/systems/{id}', [OwnerController::class,'systemDetails']);
    Route::get('owner/create-request',[OwnerController::class,'createRequest']);
    Route::post('owner/store-request',[OwnerController::class,'storeRequest']);
    Route::get('owner/enhance-request/{id}',[OwnerController::class,'enhanceRequest']);
    Route::post('owner/store-enhance-request/{id}',[OwnerController::class,'storeEnhanceRequest']);
    Route::get('owner/delete-request/{id}',[OwnerController::class,'deleteRequest']);
    Route::get('owner/view-requests',[OwnerController::class,'viewRequests']);
});

Route::middleware(['auth', 'checkrole:manager'])->group(function () {
    Route::get('manager/profile', [ManagerController::class,'viewProfile']);
    Route::get('manager',[ManagerController::class,'index']);
    Route::get('manager/view-request/{id}',[ManagerController::class,'viewRequest']);
    Route::get('manager/projects', [ManagerController::class,'viewProjects']);
    Route::get('manager/projects/{id}', [ManagerController::class,'projectDetails']);
    Route::get('manager/projects/{id}/progress', [ManagerController::class,'viewProgress']);
    Route::get('manager/create-project/{id}',[ManagerController::class,'createProject']);
    Route::post('manager/store-project/{id}', [ManagerController::class,'storeProject']);
    Route::get('manager/approve-project/{id}', [ManagerController::class,'approveProject']);
    Route::get('manager/projects/{id}/edit', [ManagerController::class,'editProject']);
    Route::post('manager/update-project/{id}', [ManagerController::class,'updateProject']);
});

Route::middleware(['auth', 'checkrole:developer'])->group(function () {
    Route::get('developer/profile', [DeveloperController::class,'viewProfile']);
    Route::get('developer',[DeveloperController::class,'index']);
    Route::get('developer/projects/{id}',[DeveloperController::class,'projectDetails']);
    Route::get('developer/projects/{id}/progress',[DeveloperController::class,'viewProgress']);
    Route::get('developer/projects/{id}/progress/create',[DeveloperController::class,'createProgress']);
    Route::post('developer/projects/{id}/progress/store',[DeveloperController::class,'storeProgress']);
});