<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SalesOverviewStats extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $todayOrders = \App\Models\Order::whereDate('created_at', today())->count();
        $totalSales = \App\Models\Order::paid()->sum('total_amount');
        $customers = \App\Models\User::customers()->count();

        return [
            Stat::make('Today\'s Orders', $todayOrders)
                ->description('Orders placed today')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('success'),
                
            Stat::make('Total Sales', '৳' . number_format($totalSales))
                ->description('Total revenue from paid orders')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('primary'),
                
            Stat::make('Total Customers', $customers)
                ->description('Registered customers')
                ->descriptionIcon('heroicon-m-users')
                ->color('warning'),
        ];
    }
}
