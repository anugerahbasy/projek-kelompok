<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\RoleMiddleware;

// Halaman Utama - BISA DIAKSES TANPA LOGIN
Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        return redirect()->route($user->role . '.dashboard');
    }
    return view('welcome');
});

// ============================================
// SEMUA ROUTE DI BAWAH INI HARUS LOGIN!
// ============================================
Route::middleware(['auth'])->group(function () {
    
    // Redirect Dashboard
    Route::get('/dashboard', function () {
        $user = Auth::user();
        return redirect()->route($user->role . '.dashboard');
    })->name('dashboard');

    // ============================================
    // ADMIN DASHBOARD - HANYA ADMIN
    // ============================================
    Route::middleware([RoleMiddleware::class . ':admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('role-dashboards.admin');
        })->name('dashboard');
    });

    // ============================================
    // MANAGER DASHBOARD - HANYA MANAGER
    // ============================================
    Route::middleware([RoleMiddleware::class . ':manager'])->prefix('manager')->name('manager.')->group(function () {
        Route::get('/dashboard', function () {
            return view('role-dashboards.manager');
        })->name('dashboard');
    });

    // ============================================
    // STAFF DASHBOARD - HANYA STAFF
    // ============================================
    Route::middleware([RoleMiddleware::class . ':staff'])->prefix('staff')->name('staff.')->group(function () {
        Route::get('/dashboard', function () {
            return view('role-dashboards.staff');
        })->name('dashboard');
    });

    // ============================================
    // PEGAWAI DASHBOARD - HANYA PEGAWAI
    // ============================================
    Route::middleware([RoleMiddleware::class . ':pegawai'])->prefix('pegawai')->name('pegawai.')->group(function () {
        Route::get('/dashboard', function () {
            return view('role-dashboards.pegawai');
        })->name('dashboard');
    });

    // ============================================
    // KURIR DASHBOARD - HANYA KURIR
    // ============================================
    Route::middleware([RoleMiddleware::class . ':kurir'])->prefix('kurir')->name('kurir.')->group(function () {
        Route::get('/dashboard', function () {
            return view('role-dashboards.kurir');
        })->name('dashboard');
    });

    // ============================================
    // CLIENT DASHBOARD - HANYA CLIENT
    // ============================================
    Route::middleware([RoleMiddleware::class . ':client'])->prefix('client')->name('client.')->group(function () {
        Route::get('/dashboard', function () {
            return view('role-dashboards.client');
        })->name('dashboard');
    });
});

// ============================================
// LOGOUT
// ============================================
Route::post('/logout', function () {
    Auth::logout();
    session()->flush(); // Hapus semua session
    return redirect('/');
})->name('logout');