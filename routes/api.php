<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PoemsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ServicesController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {

    Route::post('createProject', [ProjectsController::class, 'createProject']);
    Route::put('UpdateProject/{id}', [ProjectsController::class, 'UpdateProject']);
    Route::put('UpdateProfile', [ProfileController::class, 'update']);
    Route::post('storeProfile', [ProfileController::class, 'store']);
    Route::delete('DeleteProject/{id}', [ProjectsController::class, 'DeleteProject']);
    Route::post('store', [ProfileController::class, 'store']);
    Route::get('getAllProject', [UserController::class, 'getAllProject']);
    Route::get('getUserByResource', [UserController::class, 'getUserByResource']);
    Route::post('create_service', [ServicesController::class, 'create_service']);
    Route::put('update_services/{id}', [ServicesController::class, 'update_services']);
    Route::get('getAllServices', [ServicesController::class, 'getAllServices']);
    Route::delete('DeleteService/{id}', [ServicesController::class, 'DeleteService']);



    Route::get('get_poems', [PoemsController::class, 'index']);
    Route::post('add_poem', [PoemsController::class, 'UpdatePoem']);
    Route::put('UpdatePoem/{id}', [PoemsController::class, 'UpdatePoem']);
    Route::delete('delete_poem/{id}', [PoemsController::class, 'destroy']);
});
Route::get('login', [UserController::class, 'login']);
Route::post('createUser', [UserController::class, 'createUser']);
Route::get('getMyInfo', [UserController::class, 'getMyInfo']);
Route::get('showAllProjects', [ProjectsController::class, 'showAllProjects']);
Route::get('showPoems', [PoemsController::class, 'show']);
Route::post('sendMessage', [ContactController::class, 'sendMessage']);
Route::get('getMessages', [ContactController::class, 'getMessages']);
Route::delete('Delete/{id}', [ContactController::class, 'Delete']);
Route::get('/create-admin', function() {
    $user = \App\Models\User::updateOrCreate(
        ['email' => 'mohamedelmojtabaatta@gmail.com'],
        [
            'name' => 'Mujtaba Manan',
            'password' => Hash::make('603121')
        ]
    );
    return response()->json(['status' => 'success', 'user' => $user]);
});