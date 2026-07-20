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

        // Brand filter
        if ($request->filled('brand')) {
            $brandId = $request->brand;
            if (is_numeric($brandId)) {
                $query->where('brand_id', $brandId);
            } else {
                $brand = \App\Models\Brand::where('slug', $brandId)->first();
                if ($brand) {
                    $query->where('brand_id', $brand->id);
                }
            }
        }

        // On sale filter
        if ($request->boolean('on_sale')) {
            $query->whereNotNull('discount_price')->where('discount_price', '>', 0);
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
        $sortBy = $request->get('sort_by', 'newest');
        $sortOrder = $request->get('sort_order', 'desc');
        
        if ($sortBy === 'price') {
            $query->orderBy('regular_price', $sortOrder);
        } elseif ($sortBy === 'name') {
            $query->orderBy('name', $sortOrder);
        } else {
            // Newest
            $query->orderBy('created_at', $sortOrder);
        }

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

        $pageTitle = 'All Products';
        if ($request->boolean('flash_sale')) {
            $pageTitle = 'Flash Sale';
        } elseif ($request->boolean('featured')) {
            $pageTitle = 'Featured';
        } elseif ($request->boolean('new_arrivals')) {
            $pageTitle = 'New Arrivals';
        } elseif ($currentCategory) {
            $pageTitle = $currentCategory->name;
        }

        $brands = \App\Models\Brand::where('is_active', true)->orderBy('name')->get();

        return view('shop', compact('products', 'categories', 'brands', 'currentCategory', 'pageTitle'));
    }
}
