<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

use Livewire\Attributes\Reactive;

class AnalyticsStatsOverview extends StatsOverviewWidget
{
    protected static bool $isDiscovered = false;
    #[Reactive]
    public ?array $filters = null;
    
    #[Reactive]
    public string $activeTab = 'all';

    protected function getStats(): array
    {
        $startDateStr = $this->filters['date_range']['startDate'] ?? null;
        $endDateStr = $this->filters['date_range']['endDate'] ?? null;
        $startDate = $startDateStr ? \Carbon\Carbon::parse($startDateStr) : null;
        $endDate = $endDateStr ? \Carbon\Carbon::parse($endDateStr) : null;

        $orderQuery = \App\Models\Order::query()->where('delivery_status', '!=', 'cancelled');
        if ($startDate) $orderQuery->whereDate('created_at', '>=', $startDate);
        if ($endDate) $orderQuery->whereDate('created_at', '<=', $endDate);

        $totalSales = (clone $orderQuery)->sum('total_amount');
        $totalOrders = (clone $orderQuery)->count();
        $averageOrderValue = $totalOrders > 0 ? $totalSales / $totalOrders : 0;
        
        $viewsQuery = \App\Models\PageVisit::query();
        if ($startDate) $viewsQuery->whereDate('visited_date', '>=', $startDate);
        if ($endDate) $viewsQuery->whereDate('visited_date', '<=', $endDate);
        
        $channelViews = $viewsQuery->count();

        $label = $this->filters['date_range']['label'] ?? 'Last 28 days';

        if ($this->activeTab === 'sales') {
            return [
                Stat::make("$label Sales", '৳' . number_format($totalSales, 2))
                    ->color('success'),
            ];
        }

        if ($this->activeTab === 'orders') {
            return [
                Stat::make("$label Orders", number_format($totalOrders))
                    ->color('primary'),
            ];
        }
        
        if ($this->activeTab === 'channel_views') {
            return [
                Stat::make("$label Views", number_format($channelViews))
                    ->color('warning'),
            ];
        }

        // 'all' tab
        return [
            Stat::make("$label Sales", '৳' . number_format($totalSales, 2))
                ->color('success'),
            Stat::make("$label Orders", number_format($totalOrders))
                ->color('primary'),
            Stat::make("$label Views", number_format($channelViews))
                ->color('warning'),
        ];
    }
}
