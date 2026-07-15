<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Review;
use Livewire\Component;
use Livewire\WithPagination;

class ProductReviews extends Component
{
    use WithPagination;

    public Product $product;
    
    public $rating = 5;
    public $comment = '';
    public $sort = 'recent';

    protected $rules = [
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|string|min:10',
    ];

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function setRating($value)
    {
        $this->rating = $value;
    }

    public function submitReview()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $this->validate();

        // Check if user already reviewed
        $existingReview = Review::where('product_id', $this->product->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existingReview) {
            session()->flash('error', 'You have already reviewed this product.');
            return;
        }

        Review::create([
            'product_id' => $this->product->id,
            'user_id' => auth()->id(),
            'rating' => $this->rating,
            'comment' => $this->comment,
            'is_approved' => true,
        ]);

        $this->reset(['rating', 'comment']);
        session()->flash('message', 'Review submitted successfully!');
    }

    public function render()
    {
        $query = Review::where('product_id', $this->product->id)
            ->where('is_approved', true)
            ->with('user');

        if ($this->sort === 'highest') {
            $query->orderByDesc('rating')->latest();
        } elseif ($this->sort === 'lowest') {
            $query->orderBy('rating')->latest();
        } else {
            $query->latest();
        }

        $reviews = $query->paginate(5, ['*'], 'reviewsPage');

        $totalReviews = Review::where('product_id', $this->product->id)->where('is_approved', true)->count();
        $averageRating = $totalReviews > 0 ? Review::where('product_id', $this->product->id)->where('is_approved', true)->avg('rating') : 0;
        
        $distribution = [
            5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0
        ];
        
        if ($totalReviews > 0) {
            $ratings = Review::selectRaw('rating, count(*) as count')
                ->where('product_id', $this->product->id)
                ->where('is_approved', true)
                ->groupBy('rating')
                ->pluck('count', 'rating')
                ->toArray();
                
            foreach ($ratings as $star => $count) {
                $distribution[$star] = round(($count / $totalReviews) * 100, 2);
            }
        }

        return view('livewire.product-reviews', [
            'reviews' => $reviews,
            'totalReviews' => $totalReviews,
            'averageRating' => number_format($averageRating, 2),
            'distribution' => $distribution,
        ]);
    }
}
