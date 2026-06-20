<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Client\StockController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Client\PaymentController;

// ============================================
// HALAMAN UTAMA
// ============================================
Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        return redirect()->route($user->role . '.dashboard');
    }
    return view('welcome');
});

// ============================================
// ROUTE LOGIN & REGISTER (OTOMATIS DARI JETSTREAM)
// ============================================

// ============================================
// SEMUA ROUTE DI BAWAH INI HARUS LOGIN
// ============================================
Route::middleware(['auth'])->group(function () {

    // ============================================
    // REDIRECT DASHBOARD
    // ============================================
    Route::get('/dashboard', function () {
        $user = Auth::user();
        return redirect()->route($user->role . '.dashboard');
    })->name('dashboard');

            // ============================================
        // ADMIN DASHBOARD & CRUD
        // ============================================
        Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/dashboard', function () {
            if (Auth::user()->role !== 'admin') {
                abort(403);
            }
            return view('role-dashboards.admin');
        })->name('admin.dashboard');

        // CRUD USERS
        Route::get('/admin/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
        Route::get('/admin/users/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('admin.users.create');
        Route::post('/admin/users', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('admin.users.store');
        Route::get('/admin/users/{id}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/admin/users/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/admin/users/{id}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('admin.users.destroy');

        // CRUD PRODUCTS
        Route::get('/admin/products', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.products.index');
        Route::get('/admin/products/create', [App\Http\Controllers\Admin\ProductController::class, 'create'])->name('admin.products.create');
        Route::post('/admin/products', [App\Http\Controllers\Admin\ProductController::class, 'store'])->name('admin.products.store');
        Route::get('/admin/products/{id}/edit', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('/admin/products/{id}', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('admin.products.update');
        Route::delete('/admin/products/{id}', [App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('admin.products.destroy');

        // CRUD ORDERS
        Route::get('/admin/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.orders.index');
        Route::get('/admin/orders/create', [App\Http\Controllers\Admin\OrderController::class, 'create'])->name('admin.orders.create');
        Route::post('/admin/orders', [App\Http\Controllers\Admin\OrderController::class, 'store'])->name('admin.orders.store');
        Route::get('/admin/orders/{id}/edit', [App\Http\Controllers\Admin\OrderController::class, 'edit'])->name('admin.orders.edit');
        Route::put('/admin/orders/{id}', [App\Http\Controllers\Admin\OrderController::class, 'update'])->name('admin.orders.update');
        Route::delete('/admin/orders/{id}', [App\Http\Controllers\Admin\OrderController::class, 'destroy'])->name('admin.orders.destroy');

    // ============================================
    // KURIR
    // ============================================
    Route::get('/kurir/ratings', [App\Http\Controllers\Kurir\RatingController::class, 'index'])->name('kurir.ratings.index');
    Route::get('/kurir/dashboard', function () {
        if (Auth::user()->role !== 'kurir') {
            abort(403);
        }
        return view('role-dashboards.kurir');
    })->name('kurir.dashboard');

    Route::get('/kurir/deliveries', function () {
    if (Auth::user()->role !== 'kurir') {
        abort(403);
    }
            return view('kurir.deliveries.index');
        })->name('kurir.deliveries.index');
        Route::get('/kurir/deliveries', [App\Http\Controllers\Kurir\DeliveryController::class, 'index'])->name('kurir.deliveries.index');
        Route::get('/kurir/deliveries/create', [App\Http\Controllers\Kurir\DeliveryController::class, 'create'])->name('kurir.deliveries.create');
        Route::post('/kurir/deliveries', [App\Http\Controllers\Kurir\DeliveryController::class, 'store'])->name('kurir.deliveries.store');
        Route::get('/kurir/deliveries/{id}', [App\Http\Controllers\Kurir\DeliveryController::class, 'show'])->name('kurir.deliveries.show');
        Route::get('/kurir/deliveries/{id}/edit', [App\Http\Controllers\Kurir\DeliveryController::class, 'edit'])->name('kurir.deliveries.edit');
        Route::put('/kurir/deliveries/{id}', [App\Http\Controllers\Kurir\DeliveryController::class, 'update'])->name('kurir.deliveries.update');
        Route::delete('/kurir/deliveries/{id}', [App\Http\Controllers\Kurir\DeliveryController::class, 'destroy'])->name('kurir.deliveries.destroy');

                // ============================================
        // CLIENT ROUTES
        // ============================================
       Route::get('/client/dashboard', function () {
        if (Auth::user()->role !== 'client') {
            abort(403);
        }
        return view('role-dashboards.client');
    })->name('client.dashboard');

    Route::get('/client/stock', [StockController::class, 'index'])->name('client.stock.index');
    Route::get('/client/stock/create', [StockController::class, 'create'])->name('client.stock.create');
    Route::post('/client/stock', [StockController::class, 'store'])->name('client.stock.store');
    Route::get('/client/stock/{id}/edit', [StockController::class, 'edit'])->name('client.stock.edit');
    Route::put('/client/stock/{id}', [StockController::class, 'update'])->name('client.stock.update');
    Route::delete('/client/stock/{id}', [StockController::class, 'destroy'])->name('client.stock.destroy');

    Route::get('/client/profile', [ProfileController::class, 'index'])->name('client.profile');
    Route::put('/client/profile', [ProfileController::class, 'update'])->name('client.profile.update');

    Route::get('/client/payment', [PaymentController::class, 'index'])->name('client.payment.index');
    Route::get('/client/payment/create', [PaymentController::class, 'create'])->name('client.payment.create');
    Route::post('/client/payment', [PaymentController::class, 'store'])->name('client.payment.store');
    Route::put('/client/payment/{id}', [PaymentController::class, 'updateStatus'])->name('client.payment.update');
    Route::delete('/client/payment/{id}', [PaymentController::class, 'destroy'])->name('client.payment.destroy');
});


// ============================================
// LOGOUT
// ============================================
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');