<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\DtiCategoryController;
use App\Http\Controllers\Admin\DtiIndicatorController;
use App\Http\Controllers\Admin\DtiDataEntryController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    // Routes for User Management
    Route::resource('users', UserController::class);

    // Routes for Role Management
    Route::resource('roles', RoleController::class);

    // Routes for DTI Categories Management
    Route::resource('dti-categories', DtiCategoryController::class);
    // Thêm route cho chức năng sắp xếp
    Route::post('dti-categories/update-order', [DtiCategoryController::class, 'updateOrder'])->name('dti-categories.update-order');


    // Routes for DTI Indicators Management
    Route::resource('dti-indicators', DtiIndicatorController::class);

    // Routes for DTI Data Entries Management
    Route::resource('dti-data-entries', DtiDataEntryController::class);
});


require __DIR__.'/auth.php';