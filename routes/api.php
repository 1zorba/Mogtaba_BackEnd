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

/*
|--------------------------------------------------------------------------
| Public Routes (الروابط العامة المتاحة للزوار والـ Hero بدون توكن)
|--------------------------------------------------------------------------
*/

Route::get('login', [UserController::class, 'login']);
Route::post('createUser', [UserController::class, 'createUser']);
Route::get('getMyInfo', [UserController::class, 'getMyInfo']);
Route::get('showAllProjects', [ProjectsController::class, 'showAllProjects']);
Route::get('showPoems', [PoemsController::class, 'show']); // مسار الهيرو العام للقصائد
Route::post('sendMessage', [ContactController::class, 'sendMessage']);

/*
|--------------------------------------------------------------------------
| Protected Routes (الروابط المحمية الخاصة بالـ Dashboard ولوحة التحكم)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {

    // إدارة بيانات المستخدم والداشبورد الرئيسي
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('getUserByResource', [UserController::class, 'getUserByResource']);

    // إدارة المشاريع (Projects)
    Route::post('createProject', [ProjectsController::class, 'createProject']);
    Route::put('UpdateProject/{id}', [ProjectsController::class, 'UpdateProject']);
    Route::delete('DeleteProject/{id}', [ProjectsController::class, 'DeleteProject']);
    Route::get('getAllProject', [UserController::class, 'getAllProject']);

    // إدارة الملف الشخصي (Profile)
    Route::put('UpdateProfile', [ProfileController::class, 'update']);
    Route::post('storeProfile', [ProfileController::class, 'store']);
    Route::post('store', [ProfileController::class, 'store']);

    // إدارة الخدمات (Services)
    Route::post('create_service', [ServicesController::class, 'create_service']);
    Route::put('update_services/{id}', [ServicesController::class, 'update_services']);
    Route::get('getAllServices', [ServicesController::class, 'getAllServices']);
    Route::delete('DeleteService/{id}', [ServicesController::class, 'DeleteService']);

    // إدارة القصائد (Poems) - تم تصحيح الدالة هنا لـ store 
    Route::get('get_poems', [PoemsController::class, 'index']);      // جلب قصائد الداشبورد
    Route::post('add_poem', [PoemsController::class, 'store']);       // ✅ تصحيح: استدعاء دالة الإدخال وليس التحديث
    Route::put('UpdatePoem/{id}', [PoemsController::class, 'UpdatePoem']); // تحديث قصيدة
    Route::delete('delete_poem/{id}', [PoemsController::class, 'destroy']); // حذف قصيدة

    // إدارة الرسائل القادمة من التواصل
    Route::get('getMessages', [ContactController::class, 'getMessages']);
    Route::delete('Delete/{id}', [ContactController::class, 'Delete']);
});

/*
|--------------------------------------------------------------------------
| Admin Initialization Tool
|--------------------------------------------------------------------------
*/
Route::get('/create-admin', function () {
    $user = \App\Models\User::updateOrCreate(
        ['email' => 'mohamedelmojtabaatta@gmail.com'],
        [
            'name' => 'Mujtaba Manan',
            'password' => Hash::make('603121')
        ]
    );
    return response()->json(['status' => 'success', 'user' => $user]);
});
