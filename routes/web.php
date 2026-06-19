<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

// ============================================
// HALAMAN WELCOME - BISA DI AKSES
// ============================================
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// ============================================
// HALAMAN UTAMA - REDIRECT KE /welcome
// ============================================
Route::get('/', function () {
    return redirect()->route('welcome');
})->name('home');

// ============================================
// DASHBOARD ROUTES
// ============================================
Route::middleware(['auth'])->group(function () {
    
    Route::get('/dashboard', function () {
        $user = Auth::user();
        return redirect()->route($user->role . '.dashboard');
    })->name('dashboard');

    // ============================================
    // ADMIN DASHBOARD & CRUD
    // ============================================
    Route::middleware([RoleMiddleware::class . ':admin'])->prefix('admin')->name('admin.')->group(function () {
        
        Route::get('/dashboard', function () {
            return view('role-dashboards.admin');
        })->name('dashboard');

        Route::resource('users', UserController::class);
        Route::resource('products', ProductController::class);
        Route::resource('orders', OrderController::class);
    });

    // ============================================
    // MANAGER DASHBOARD
    // ============================================
    Route::middleware([RoleMiddleware::class . ':manager'])->prefix('manager')->name('manager.')->group(function () {
        Route::get('/dashboard', function () {
            return view('role-dashboards.manager');
        })->name('dashboard');
    });

    // ============================================
    // STAFF DASHBOARD
    // ============================================
    Route::middleware([RoleMiddleware::class . ':staff'])->prefix('staff')->name('staff.')->group(function () {
        Route::get('/dashboard', function () {
            return view('role-dashboards.staff');
        })->name('dashboard');
    });

    // ============================================
    // PEGAWAI DASHBOARD
    // ============================================
    Route::middleware([RoleMiddleware::class . ':pegawai'])->prefix('pegawai')->name('pegawai.')->group(function () {
        Route::get('/dashboard', function () {
            return view('role-dashboards.pegawai');
        })->name('dashboard');
    });

    // ============================================
    // KURIR DASHBOARD
    // ============================================
    Route::middleware([RoleMiddleware::class . ':kurir'])->prefix('kurir')->name('kurir.')->group(function () {
        Route::get('/dashboard', function () {
            return view('role-dashboards.kurir');
        })->name('dashboard');
    });

            // ============================================
        // CLIENT DASHBOARD
        // ============================================
        Route::middleware([RoleMiddleware::class . ':client'])->prefix('client')->name('client.')->group(function () {
            
            Route::get('/dashboard', function () {
                return view('role-dashboards.client');
            })->name('dashboard');

            // ============================================
            // CRUD STOCK
            // ============================================
            Route::resource('stock', App\Http\Controllers\Client\StockController::class);

            // ============================================
            // PROFILE - PAKAI Auth::user()
            // ============================================
            Route::get('/profile', function () {
                $user = Auth::user();  // <-- PAKAI Auth::user()
                return view('client.profile', compact('user'));
            })->name('profile');

            Route::put('/profile', function (Request $request) {
                $user = Auth::user();  // <-- PAKAI Auth::user()
                $userId = $user->id;   // <-- AMBIL ID DARI USER
                
                $request->validate([
                    'first_name' => 'required|string|max:255',
                    'last_name' => 'required|string|max:255',
                    'email' => 'required|email|unique:users,email,' . $userId,
                ]);

                DB::table('users')
                    ->where('id', $userId)
                    ->update([
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                        'name' => $request->first_name . ' ' . $request->last_name,
                        'email' => $request->email,
                    ]);

                if ($request->filled('password')) {
                    $request->validate(['password' => 'min:8|confirmed']);
                    DB::table('users')
                        ->where('id', $userId)
                        ->update(['password' => Hash::make($request->password)]);
                }

                return back()->with('success', 'Profile updated successfully!');
            })->name('profile.update');

            // ============================================
            // PAYMENT - PAKAI Auth::id()
            // ============================================
            Route::get('/payment', function () {
                $userId = Auth::id();  // <-- PAKAI Auth::id()
                
                $orders = \App\Models\Order::where('user_id', $userId)
                    ->whereIn('status', ['pending', 'completed'])
                    ->latest()
                    ->paginate(10);
                    
                $totalSpent = \App\Models\Order::where('user_id', $userId)
                    ->where('status', 'completed')
                    ->sum('total');
                    
                $pendingTotal = \App\Models\Order::where('user_id', $userId)
                    ->where('status', 'pending')
                    ->sum('total');

                return view('client.payment', compact('orders', 'totalSpent', 'pendingTotal'));
            })->name('payment');
        });
});
// ============================================
// LOGOUT
// ============================================
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');