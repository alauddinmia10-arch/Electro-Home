<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

// ──── Public Routes ────

Route::get('/fix-settings', function () {
    \App\Models\Setting::updateOrCreate(['key' => 'support_phone'], ['value' => '+8801880223099']);
    \App\Models\Setting::updateOrCreate(['key' => 'whatsapp_number'], ['value' => '8801880223099']);
    return 'Settings fixed! Please check the live site footer and WhatsApp links now.';
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/product/{product:slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/offer/{slug}', \App\Livewire\LandingPage::class)->name('landing.page');
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

    $cartData = $data['cart_data'] ?? [];
    $sessionCart = session()->get('cart', []);
    if (empty($sessionCart) && auth()->check()) {
        $sessionCart = auth()->user()->cartItems->map(function ($item) {
            return ['product_id' => $item->product_id, 'quantity' => $item->quantity];
        })->toArray();
    }
    if (!empty($sessionCart)) {
        $productIds = collect($sessionCart)->pluck('product_id')->filter()->unique();
        $products = \App\Models\Product::whereIn('id', $productIds)->get()->keyBy('id');
        $enrichedItems = [];
        foreach ($sessionCart as $item) {
            if (isset($item['product_id']) && $product = $products->get($item['product_id'])) {
                $price = $product->discount_price ?? $product->regular_price;
                $enrichedItems[] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'price' => $price,
                    'quantity' => $item['quantity'],
                ];
            }
        }
        $cartData['items'] = $enrichedItems;
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
            'cart_data' => $cartData,
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
    Route::get('/orders', function() { return redirect()->route('dashboard'); })->name('orders.index');
    Route::get('/orders/{order}', function() { return redirect()->route('dashboard'); })->name('orders.show');
});

// Wishlist accessible for logged-in users; redirect guests to login
use App\Http\Controllers\InvoiceController;

// Admin Invoice Route (protected by auth and maybe a gate later, for now just auth)
Route::middleware('auth')->group(function () {
    Route::get('/admin/orders/bulk-print', [InvoiceController::class, 'printBulk'])->name('invoice.print_bulk');
    Route::get('/admin/orders/print-all', [InvoiceController::class, 'printAll'])->name('invoice.print_all');
    Route::get('/admin/orders/{order}/invoice', [InvoiceController::class, 'download'])->name('invoice.download');
    Route::get('/admin/orders/{order}/print', [InvoiceController::class, 'print'])->name('invoice.print');
    
    // Incomplete Order PDF
    Route::get('/admin/incomplete-orders/{order}/invoice', [InvoiceController::class, 'incompleteDownload'])->name('admin.incomplete-orders.invoice');
});

// SSLCommerz Payment Routes
use App\Http\Controllers\PaymentController;

Route::post('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::post('/payment/fail', [PaymentController::class, 'fail'])->name('payment.fail');
Route::post('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
Route::post('/payment/ipn', [PaymentController::class, 'ipn'])->name('payment.ipn');
Route::get('/payment/mock-gateway', [PaymentController::class, 'mockGateway'])->name('payment.mock-gateway');

Route::get('/debug-error', function() {
    $file = storage_path('logs/laravel.log');
    if(file_exists($file)) {
        return response()->file($file);
    }
    return 'No log';
});
Route::get('/import-local-db', function () {
    try {
        $path = base_path('database/export.json');
        if (!file_exists($path)) {
            return 'export.json not found.';
        }
        
        $data = json_decode(file_get_contents($path), true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            return 'JSON Error: ' . json_last_error_msg();
        }

        // Clear existing tables in reverse order
        $modelsToSync = array_keys($data);
        foreach (array_reverse($modelsToSync) as $modelClass) {
            \Illuminate\Support\Facades\DB::table((new $modelClass)->getTable())->delete();
        }
        
        // Insert new data
        $count = 0;
        foreach ($modelsToSync as $modelClass) {
            $records = $data[$modelClass];
            $tableName = (new $modelClass)->getTable();
            
            $batch = [];
            foreach ($records as $record) {
                // Fix booleans for postgres
                $instance = new $modelClass;
                foreach ($instance->getCasts() as $key => $type) {
                    if (str_contains($type, 'boolean') || str_contains($type, 'bool')) {
                        if (array_key_exists($key, $record)) {
                            $record[$key] = $record[$key] ? true : false;
                        }
                    }
                }
                $batch[] = $record;
                $count++;
            }
            
            if (count($batch) > 0) {
                foreach (array_chunk($batch, 100) as $chunk) {
                    \Illuminate\Support\Facades\DB::table($tableName)->insert($chunk);
                }
            }
            
            // Fix Postgres Sequence
            try {
                $maxId = \Illuminate\Support\Facades\DB::table($tableName)->max('id');
                if ($maxId) {
                    \Illuminate\Support\Facades\DB::statement("SELECT setval('{$tableName}_id_seq', {$maxId})");
                }
            } catch (\Exception $e) {
                // Ignore sequence errors
            }
        }
        
        return 'Successfully imported ' . $count . ' records into PostgreSQL!';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine();
    }
});

Route::get('/run-seed', function () { \Illuminate\Support\Facades\Artisan::call('db:seed', ['--force' => true]); return 'Seeding complete! You can now login.'; });