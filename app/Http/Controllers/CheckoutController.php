<?php

namespace App\Http\Controllers;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout');
    }

    public function store()
    {
        // Handled by Livewire checkout component
        return redirect()->route('checkout');
    }

    public function success(\App\Models\Order $order)
    {
        return view('checkout-success', compact('order'));
    }
}
