<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// ──── Public Routes ────

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/product/{product:slug}', [ProductController::class, 'show'])->name('product.show');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');

// API endpoints for districts/thanas
Route::get('/api/districts', function () {
    return \App\Models\District::orderBy('name')->get(['id', 'name', 'bn_name', 'delivery_charge']);
})->name('api.districts');

Route::get('/api/thanas/{district}', function (\App\Models\District $district) {
    return $district->thanas()->orderBy('name')->get(['id', 'name', 'bn_name']);
})->name('api.thanas');

Route::post('/api/checkout/abandon', function (\Illuminate\Http\Request $request) {
    \Log::info('Abandoned cart API hit', $request->all());
    
    $data = json_decode($request->getContent(), true);
    if (!$data) $data = $request->all(); // Fallback if parsed as form/JSON
    
    if (empty($data['session_id'])) {
        return response()->json(['status' => 'invalid']);
    }

    $filledCount = 0;
    foreach(['name', 'phone', 'district', 'thana', 'address', 'altPhone'] as $field) {
        if (!empty(trim($data[$field] ?? ''))) $filledCount++;
    }
    
    if ($filledCount < 3) {
        \Log::info('Abandoned cart ignored: less than 3 fields');
        return response()->json(['status' => 'ignored']);
    }

    if (!empty($data['phone'])) {
        $recentOrder = \App\Models\Order::where('customer_phone', $data['phone'])
            ->where('created_at', '>=', now()->subMinutes(10))
            ->first();
            
        if ($recentOrder) {
            \Log::info('Abandoned cart ignored: Real order recently placed', ['phone' => $data['phone']]);
            return response()->json(['status' => 'ignored_recent_order']);
        }
    }

    $order = \App\Models\IncompleteOrder::updateOrCreate(
        ['session_id' => $data['session_id']],
        [
            'customer_name' => $data['name'] ?? '',
            'customer_phone' => $data['phone'] ?? '',
            'district' => $data['district'] ?? '',
            'thana' => $data['thana'] ?? '',
            'full_address' => $data['address'] ?? '',
            'customer_alt_phone' => $data['altPhone'] ?? '',
            'cart_data' => $data['cart_data'] ?? [],
            'ip_address' => $request->ip(),
            'last_active_step' => 'checkout_form',
        ]
    );

    \Log::info('Abandoned cart saved', ['id' => $order->id, 'was_recently_created' => $order->wasRecentlyCreated]);

    return response()->json(['status' => 'saved']);
})->withoutMiddleware([\App\Foundation\Http\Middleware\VerifyCsrfToken::class, \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

// ──── Auth Routes ────

use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
    Volt::route('/login', 'auth.login')->name('login');
    Volt::route('/register', 'auth.register')->name('register');
});

Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// ──── Authenticated Routes ────

Route::middleware('auth')->group(function () {
    Volt::route('/dashboard', 'dashboard')->name('dashboard');
    Volt::route('/wishlist', 'wishlist')->name('wishlist');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});

// Wishlist accessible for logged-in users; redirect guests to login
use App\Http\Controllers\InvoiceController;

// Admin Invoice Route (protected by auth and maybe a gate later, for now just auth)
Route::middleware('auth')->group(function () {
    Route::get('/admin/orders/bulk-print', [InvoiceController::class, 'printBulk'])->name('invoice.print_bulk');
    Route::get('/admin/orders/print-all', [InvoiceController::class, 'printAll'])->name('invoice.print_all');
    Route::get('/admin/orders/{order}/invoice', [InvoiceController::class, 'download'])->name('invoice.download');
    Route::get('/admin/orders/{order}/print', [InvoiceController::class, 'print'])->name('invoice.print');
});

// SSLCommerz Payment Routes
use App\Http\Controllers\PaymentController;

Route::post('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::post('/payment/fail', [PaymentController::class, 'fail'])->name('payment.fail');
Route::post('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
Route::post('/payment/ipn', [PaymentController::class, 'ipn'])->name('payment.ipn');
Route::get('/payment/mock-gateway', [PaymentController::class, 'mockGateway'])->name('payment.mock-gateway');
