<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        $product->load(['category', 'images']);

        $relatedProducts = Cache::remember('product.related.' . $product->id, 3600, function () use ($product) {
            return Product::where('category_id', $product->category_id)
                ->where('id', '!=', $product->id)
                ->inStock()
                ->take(10)
                ->get();
        });

        return view('product.show', compact('product', 'relatedProducts'));
    }
}
