<?php

namespace App\Services;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartService
{
    /**
     * Get the current cart items.
     */
    public function getItems(): Collection
    {
        if (Auth::check()) {
            return Auth::user()->cartItems()->with('product')->get();
        }

        return collect(Session::get('cart', []))->map(function ($item) {
            $product = Product::find($item['product_id']);
            return (object) [
                'id' => 'session_' . $item['product_id'],
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'product' => $product,
            ];
        })->filter(fn($item) => $item->product !== null)->values();
    }

    /**
     * Get cart count.
     */
    public function getCount(): int
    {
        if (Auth::check()) {
            return Auth::user()->cartItems()->sum('quantity');
        }

        return collect(Session::get('cart', []))->sum('quantity');
    }

    /**
     * Add a product to the cart.
     */
    public function add(int $productId, int $quantity = 1): void
    {
        if (Auth::check()) {
            $cartItem = Auth::user()->cartItems()->where('product_id', $productId)->first();
            if ($cartItem) {
                $cartItem->increment('quantity', $quantity);
            } else {
                Auth::user()->cartItems()->create([
                    'product_id' => $productId,
                    'quantity' => $quantity,
                ]);
            }
        } else {
            $cart = Session::get('cart', []);
            $found = false;
            foreach ($cart as &$item) {
                if ($item['product_id'] == $productId) {
                    $item['quantity'] += $quantity;
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $cart[] = [
                    'product_id' => $productId,
                    'quantity' => $quantity,
                ];
            }
            Session::put('cart', $cart);
        }
    }

    /**
     * Update quantity of a cart item.
     */
    public function updateQuantity(int $productId, int $quantity): void
    {
        if ($quantity <= 0) {
            $this->remove($productId);
            return;
        }

        if (Auth::check()) {
            Auth::user()->cartItems()->where('product_id', $productId)->update(['quantity' => $quantity]);
        } else {
            $cart = Session::get('cart', []);
            foreach ($cart as &$item) {
                if ($item['product_id'] == $productId) {
                    $item['quantity'] = $quantity;
                    break;
                }
            }
            Session::put('cart', $cart);
        }
    }

    /**
     * Remove an item from the cart.
     */
    public function remove(int $productId): void
    {
        if (Auth::check()) {
            Auth::user()->cartItems()->where('product_id', $productId)->delete();
        } else {
            $cart = Session::get('cart', []);
            $cart = array_filter($cart, fn($item) => $item['product_id'] != $productId);
            Session::put('cart', array_values($cart));
        }
    }

    /**
     * Clear the entire cart.
     */
    public function clear(): void
    {
        if (Auth::check()) {
            Auth::user()->cartItems()->delete();
        } else {
            Session::forget('cart');
        }
    }

    /**
     * Get the subtotal of the cart.
     */
    public function getSubtotal(): float
    {
        return $this->getItems()->sum(function ($item) {
            $price = $item->product->discount_price ?? $item->product->regular_price;
            return $price * $item->quantity;
        });
    }

    /**
     * Sync session cart to database upon login.
     */
    public function syncSessionToDatabase(): void
    {
        if (!Auth::check()) return;

        $sessionCart = Session::get('cart', []);
        foreach ($sessionCart as $item) {
            $this->add($item['product_id'], $item['quantity']);
        }

        Session::forget('cart');
    }

    /**
     * Get the remaining amount needed for free delivery.
     */
    public function getFreeDeliveryRemaining(): float
    {
        $threshold = 5000; // Can be fetched from Settings DB in the future
        return max(0, $threshold - $this->getSubtotal());
    }

    /**
     * Calculate delivery charge based on district.
     */
    public function calculateDeliveryCharge(string $districtName): float
    {
        if ($this->getFreeDeliveryRemaining() == 0 && $this->getSubtotal() > 0) {
            return 0; // Free delivery milestone reached
        }

        $district = \App\Models\District::where('name', $districtName)->first();
        return $district ? (float) $district->delivery_charge : 120.0; // Default to 120 if not found
    }
}
