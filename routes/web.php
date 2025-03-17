<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\doctordashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('/permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::post('/permissions/{id}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('/permissions', [PermissionController::class, 'destroy'])->name('permissions.destroy');
    

    // for roles
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');

    Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles', [RoleController::class, 'destroy'])->name('roles.destroy');


    Route::get('/Home', [doctordashboardController::class, 'home'])->name('doctor.home');
    Route::get('/doctordashboard', [doctordashboardController::class, 'doctordashboard'])->name('doctordashboard');
    // Route::get('/display', [RoleController::class, 'edit'])->name('doctor.display');
    Route::POST('/storedoctor', [doctordashboardController::class, 'storedoctor'])->name('doctor.storedoctor');
    Route::get('/doctorlist', [doctordashboardController::class, 'display'])->name('doctorlist');
    Route::get('/doctor/{doctors}/edit', [doctordashboardController::class, 'edit'])->name('doctor.edit');
    Route::PUT('/doctor/{doctors}', [doctordashboardController::class, 'update'])->name('doctor.update');
    Route::delete('/doctor/{doctors}', [doctordashboardController::class, 'destroy'])->name('doctor.destroy');


    Route::get('/userdashboard', [CustomerController::class, 'showcustomerDashboard'])->name('userdashboard');
    Route::get('/add-patient', [CustomerController::class, 'addPatient'])->name('add-patient');
    
});

require __DIR__.'/auth.php';
