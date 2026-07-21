<?php

use App\Models\Product;
use Livewire\Volt\Component;

new class extends Component {
    public string $query = '';
    public array $results = [];

    public function updatedQuery()
    {
        if (strlen($this->query) >= 2) {
            $this->results = Product::search($this->query)
                ->where('status', 'in_stock')
                ->take(5)
                ->get()
                ->toArray();
        } else {
            $this->results = [];
        }
    }
};
?>
<div class="relative w-full" x-data="{ show: true }" @click.outside="show = false">
    <div class="relative">
        <input 
            type="text" 
            wire:model.live.debounce.300ms="query" 
            @focus="show = true"
            placeholder="Search for components, tools, kits..." 
            class="form-input h-10 py-2 pl-4 pr-10 rounded w-full bg-gray-50 border-gray-200 focus:bg-white text-[14px]"
        >
        <div class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
            <svg wire:loading.remove class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <svg wire:loading class="w-5 h-5 animate-spin text-[var(--color-trust-blue)]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
    </div>

    @if(count($results) > 0)
        <div x-show="show" x-transition class="search-dropdown">
            @foreach($results as $product)
                <a href="/product/{{ $product['slug'] }}" class="search-dropdown-item border-b border-gray-50 last:border-b-0">
                    <div class="w-12 h-12 bg-gray-100 rounded overflow-hidden shrink-0">
                        @if($product['cover_image'])
                            <img src="{{ Storage::url($product['cover_image']) }}" alt="{{ $product['name'] }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-sm font-semibold text-gray-800 truncate">{{ $product['name'] }}</div>
                        <div class="text-price text-sm">৳{{ number_format($product['discount_price'] ?? $product['regular_price'], 0) }}</div>
                    </div>
                </a>
            @endforeach
            <a href="{{ route('shop') }}?search={{ $query }}" class="block text-center py-3 text-sm font-semibold text-[var(--color-trust-blue)] hover:bg-blue-50 transition-colors">
                View all results for "{{ $query }}" &rarr;
            </a>
        </div>
    @elseif(strlen($query) >= 2)
        <div x-show="show" class="search-dropdown p-4 text-center text-sm text-gray-500">
            No products found for "{{ $query }}"
        </div>
    @endif
</div>
