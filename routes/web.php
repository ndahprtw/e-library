<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('pages.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('user', UserController::class);
    Route::resource('role', RoleController::class);
    Route::resource('permissions', PermissionController::class)->names('akses');
    Route::resource('role-permissions', RolePermissionController::class)    
        ->parameters([
            'role-permissions' => 'role',
        ])
        ->names('role-permissions');
    Route::resource('categories', CategoryController::class)->names('kategori');
    Route::get('/buku/export/pdf', [BookController::class, 'exportPdf'])->name('buku.export.pdf');
    Route::get('/buku/export/excel', [BookController::class, 'exportExcel'])->name('buku.export.excel');
    Route::resource('books', BookController::class)->names('buku');
    Route::resource('borrowings', BorrowingController::class)->names('peminjaman');
});

require __DIR__.'/auth.php';