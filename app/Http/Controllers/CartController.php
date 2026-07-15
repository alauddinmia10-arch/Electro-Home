<?php

namespace App\Http\Controllers;

use App\Services\CartService;

class CartController extends Controller
{
    public function index(CartService $cart)
    {
        $items = $cart->getItems();
        $subtotal = $cart->getSubtotal();
        $freeDeliveryRemaining = $cart->getFreeDeliveryRemaining();

        return view('cart', compact('items', 'subtotal', 'freeDeliveryRemaining'));
    }
}
