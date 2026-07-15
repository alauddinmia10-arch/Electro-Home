<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->filled('search')) {
            // Using Scout database engine for search
            $productIds = Product::search($request->search)->keys();
            $query->whereIn('id', $productIds);
        }

        // Category filter
        if ($request->filled('category')) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                // Include subcategory products too
                $categoryIds = collect([$category->id]);
                $categoryIds = $categoryIds->merge($category->children->pluck('id'));
                $query->whereIn('category_id', $categoryIds);
            }
        }

        // Price range filter
        if ($request->filled('min_price')) {
            $query->where('regular_price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('regular_price', '<=', $request->max_price);
        }

        // Stock filter
        if ($request->boolean('in_stock')) {
            $query->inStock();
        }

        // Flash sale filter
        if ($request->boolean('flash_sale')) {
            $query->flashSale();
        }

        // Featured filter
        if ($request->boolean('featured')) {
            $query->featured();
        }

        // Sort
        $sort = $request->get('sort', 'newest');
        $query = match ($sort) {
            'price_low' => $query->orderBy('regular_price', 'asc'),
            'price_high' => $query->orderBy('regular_price', 'desc'),
            'best_selling' => $query->orderBy('total_sold', 'desc'),
            'name_asc' => $query->orderBy('name', 'asc'),
            default => $query->latest(),
        };

        $products = $query->paginate(24)->withQueryString();

        $categories = Cache::remember('shop.categories', 3600, function () {
            return Category::parents()
                ->active()
                ->ordered()
                ->withCount('products')
                ->with('children')
                ->get();
        });

        $currentCategory = $request->filled('category')
            ? Category::where('slug', $request->category)->first()
            : null;

        return view('shop', compact('products', 'categories', 'currentCategory'));
    }
}
