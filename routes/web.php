<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    
    // Ini Gerbang Utama setelah tombol Continue login diklik
    Route::get('/dashboard', function () {
        $role = Auth::user()->role;

        // Cek role di database, lalu lempar ke halaman masing-masing
        switch ($role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'manager':
                return redirect()->route('manager.dashboard');
            case 'staff':
                return redirect()->route('staff.dashboard');
            case 'pegawai':
                return redirect()->route('pegawai.dashboard');
            case 'kurir':
                return redirect()->route('kurir.dashboard');
            default:
                return redirect()->route('user.dashboard');
        }
    })->name('dashboard');

});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    // 1. Halaman Khusus Admin
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('role-dashboards.admin'); // Mengarah ke file admin.blade.php
        })->name('admin.dashboard');
    });

    // 2. Halaman Khusus Manager
    Route::middleware(['role:manager'])->group(function () {
        Route::get('/manager/dashboard', function () {
            return view('role-dashboards.manager');
        })->name('manager.dashboard');
    });

    // 3. Halaman Khusus Staff
    Route::middleware(['role:staff'])->group(function () {
        Route::get('/staff/dashboard', function () {
            return view('role-dashboards.staff');
        })->name('staff.dashboard');
    });

    // 4. Halaman Khusus Pegawai
    Route::middleware(['role:pegawai'])->group(function () {
        Route::get('/pegawai/dashboard', function () {
            return view('role-dashboards.pegawai');
        })->name('pegawai.dashboard');
    });

    // 5. Halaman Khusus Kurir
    Route::middleware(['role:kurir'])->group(function () {
        Route::get('/kurir/dashboard', function () {
            return view('role-dashboards.kurir');
        })->name('kurir.dashboard');
    });

    // 6. Halaman Khusus User 
    Route::middleware(['role:user'])->group(function () {
        Route::get('/user/dashboard', function () {
            return view('role-dashboards.user');
        })->name('user.dashboard');
    });

});