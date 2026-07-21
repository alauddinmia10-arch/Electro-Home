<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SalesOverviewStats extends StatsOverviewWidget
{
    protected static ?int $sort = 0;

    protected static bool $isLazy = false;

    protected int | string | array $columnSpan = 'full';

    protected function getColumns(): int
    {
        return 5;
    }

    protected function getStats(): array
    {
        $todayOrders = \App\Models\Order::whereDate('created_at', today())->count();
        $todaySales = \App\Models\Order::where('delivery_status', '!=', 'cancelled')
            ->whereDate('created_at', today())
            ->sum('total_amount');
        $totalSales = \App\Models\Order::where('delivery_status', '!=', 'cancelled')
            ->sum('total_amount');
        $customers = \App\Models\User::customers()->count();
        $products = \App\Models\Product::count();

        return [
            Stat::make('Today\'s Orders', $todayOrders)
                ->description('Orders placed today')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('primary'),
                
            Stat::make('Today\'s Sales', '৳' . number_format($todaySales))
                ->description('Revenue from today\'s orders')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('stat_orange'),
                
            Stat::make('Total Sales', '৳' . number_format($totalSales))
                ->description('Total revenue from orders')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('stat_green'),
                
            Stat::make('Total Products', $products)
                ->description('Available items')
                ->descriptionIcon('heroicon-m-archive-box')
                ->color('stat_purple'),
                
            Stat::make('Total Customers', $customers)
                ->description('Registered customers')
                ->descriptionIcon('heroicon-m-users')
                ->color('stat_pink'),
        ];
    }
}
