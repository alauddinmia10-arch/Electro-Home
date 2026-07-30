<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Cache::remember('home.banners', 3600, function () {
            return Banner::active()->get();
        });

        $categories = Cache::remember('home.categories', 3600, function () {
            return Category::parents()
                ->active()
                ->withSum('products', 'total_sold')
                ->orderByDesc('products_sum_total_sold')
                ->take(12)
                ->get();
        });

        $brands = Cache::remember('home.brands', 3600, function () {
            return Brand::where('is_active', true)->get();
        });

        $flashSaleProducts = Cache::remember('home.flash_sale', 3600, function () {
            return Product::flashSale()
                ->inStock()
                ->with('category')
                ->take(8)
                ->get();
        });

        $newArrivals = Cache::remember('home.new_arrivals', 3600, function () {
            return Product::inStock()
                ->with('category')
                ->latest()
                ->take(8)
                ->get();
        });

        $bestSellers = Cache::remember('home.best_sellers', 3600, function () {
            return Product::inStock()
                ->with('category')
                ->bestSellers()
                ->take(8)
                ->get();
        });

        $featuredProducts = Cache::remember('home.featured', 3600, function () {
            return Product::featured()
                ->inStock()
                ->with('category')
                ->take(8)
                ->get();
        });

        return view('home', compact(
            'banners',
            'categories',
            'brands',
            'flashSaleProducts',
            'newArrivals',
            'bestSellers',
            'featuredProducts',
        ));
    }
}
