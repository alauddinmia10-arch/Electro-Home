<x-filament-panels::page>
    <style>
        .fb-tab {
            padding: 8px 16px;
            margin-right: 4px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.2s;
            cursor: pointer;
        }
        .fb-tab-active {
            background-color: #e0f2fe !important; /* Light blue */
            color: #0284c7 !important; /* Blue text */
        }
        .fb-tab-active:hover {
            background-color: #bae6fd !important; /* Deeper blue on hover */
        }
        .fb-tab-inactive {
            color: #000000; /* Deep black text */
            background-color: transparent;
        }
        .fb-tab-inactive:hover {
            background-color: #f3f4f6;
        }
    </style>

    <div class="flex items-center mb-6 px-2">
        <button
            type="button"
            wire:click="$set('activeTab', 'all')"
            class="fb-tab {{ $activeTab === 'all' ? 'fb-tab-active' : 'fb-tab-inactive' }}"
        >
            All
        </button>

        <button
            type="button"
            wire:click="$set('activeTab', 'orders')"
            class="fb-tab {{ $activeTab === 'orders' ? 'fb-tab-active' : 'fb-tab-inactive' }}"
        >
            Orders
        </button>

        <button
            type="button"
            wire:click="$set('activeTab', 'sales')"
            class="fb-tab {{ $activeTab === 'sales' ? 'fb-tab-active' : 'fb-tab-inactive' }}"
        >
            Sales
        </button>
        
        <button
            type="button"
            wire:click="$set('activeTab', 'channel_views')"
            class="fb-tab {{ $activeTab === 'channel_views' ? 'fb-tab-active' : 'fb-tab-inactive' }}"
            style="margin-right: 0;"
        >
            Website Views
        </button>
    </div>

    <div class="mb-6">
        @livewire(\App\Filament\Widgets\AnalyticsStatsOverview::class, ['filters' => $filters, 'activeTab' => $activeTab])
    </div>

    <div class="mb-6">
        @if ($activeTab === 'all')
            @livewire(\App\Filament\Widgets\AllAnalyticsChart::class, ['filters' => $filters], key('all-analytics-chart'))
            
            <div style="padding-top: 24px;" wire:key="table-wrapper">
                @livewire(\App\Filament\Widgets\ProductAnalyticsTableWidget::class, ['filters' => $filters], key('product-analytics-table'))
            </div>
        @elseif ($activeTab === 'orders')
            @livewire(\App\Filament\Widgets\OrdersAnalyticsChart::class, ['filters' => $filters])
        @elseif ($activeTab === 'sales')
            @livewire(\App\Filament\Widgets\SalesAnalyticsChart::class, ['filters' => $filters])
        @elseif ($activeTab === 'channel_views')
            @livewire(\App\Filament\Widgets\ChannelViewsChart::class, ['filters' => $filters])
        @endif
    </div>
</x-filament-panels::page>
