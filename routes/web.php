<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PoemsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\UserController;

Route::get('/', [HomeController::class, 'index'])->name('pages.home');



Route::post('/login', [UserController::class, 'login'])
    ->name('login.post');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');



// Route::get('dashboard/getAllProject', [DashboardController::class, 'getAllProject'])->name('dashboard.getAllProject');


// 1. مسار لعرض صفحة إدارة المشاريع

// 2. مسارات الأكشنز (تعديل وحذف)
Route::PUT('/projects/update/{id}', [ProjectsController::class, 'UpdateProject'])->name('dashboard.projects.update');
Route::delete('/projects/delete/{id}', [ProjectsController::class, 'DeleteProject'])->name('dashboard.projects.delete');
Route::PUT('/services/update/{id}', [ServicesController::class, 'update_services'])->name('dashboard.services.update');
Route::delete('/services/delete/{id}', [ServicesController::class, 'DeleteService'])->name('dashboard.services.delete');
Route::PUT('/poems/update/{id}', [PoemsController::class, 'UpdatePoem']);
Route::delete('/poems/delete/{id}', [PoemsController::class, 'destroy']);
Route::PUT('/profiles/update', [ProfileController::class, 'update'])->name('profiles.update');
// Route::get('/', [ProjectsController::class, 'showAllProjects']);

Route::middleware(['auth'])->prefix('dashboard')->group(function () {

    // الآن هذا المسار يشير إلى صفحة البروفايل بشكل سليم ويجلب البيانات عبر getUser
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::post('/projects', [DashboardController::class, 'createProject'])->name('dashboard.projects.store');
    Route::post('/services', [DashboardController::class, 'create_service'])->name('dashboard.services.store');

    Route::get('/projects', [DashboardController::class, 'projects'])->name('dashboard.projects');

    Route::get('/services', [DashboardController::class, 'services'])->name('dashboard.services');

    Route::get('/poems', [DashboardController::class, 'poems'])->name('dashboard.poems');
    Route::post('/poems', [DashboardController::class, 'storePoem'])->name('dashboard.poems.store');

    Route::get('/contacts', [DashboardController::class, 'contacts'])->name('dashboard.contacts');
    Route::get('/getUser', [DashboardController::class, 'getUser'])->name('sidebar.getUser');
});
// Route::get('dashboard/hi.index/{id}', function ($id) {

//     return view('dashboard.modals.service-modal',compact('id'));
// });
Route::get('poems', [PoemsController::class, 'show'])->name('co.poems');
Route::fallback(function () {

    return ('hahahhahhha');
});

Route::post('/contact/store', [DashboardController::class, 'StoreContact'])->name('contact.store');
Route::get('components/hero', [UserController::class, 'showAll'])->name('user.profile');
Route::get('components/poems', [PoemsController::class, 'show'])->name('poem.show');
Route::get('home/projects', [HomeController::class, 'projects'])->name('projects.show');
Route::get('home/services', [HomeController::class, 'services'])->name('services.show');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Route::get('components/projects', function () {

//     return view('components.projects');
// });
