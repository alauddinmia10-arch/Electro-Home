<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class OrdersAnalyticsChart extends ChartWidget
{
    protected static bool $isDiscovered = false;
    protected static ?int $sort = 2;
    protected static bool $isLazy = false;
    
    public ?array $filters = null;
    
    protected int | string | array $columnSpan = [
        'default' => 1,
        'md' => 1,
        'lg' => 2,
        'xl' => 2,
        '2xl' => 2,
    ];
    
    protected ?string $maxHeight = '300px';
    
    protected ?string $heading = 'Orders Analytics';

    protected function getData(): array
    {
        $startDate = !empty($this->filters['startDate']) ? \Carbon\Carbon::parse($this->filters['startDate']) : null;
        $endDate = !empty($this->filters['endDate']) ? \Carbon\Carbon::parse($this->filters['endDate']) : null;

        $query = \App\Models\Order::query();

        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        $diffInDays = $startDate && $endDate ? $startDate->diffInDays($endDate) : null;
        
        $start = $startDate ?? \App\Models\Order::min('created_at') ?? now()->subYear();
        if (is_string($start)) $start = \Carbon\Carbon::parse($start);
        $end = $endDate ?? now();

        if ($diffInDays !== null && $diffInDays <= 60) {
            $trend = \Flowframe\Trend\Trend::query($query)
                ->between(start: $start, end: $end)
                ->perDay()
                ->count();
        } else {
            $trend = \Flowframe\Trend\Trend::query($query)
                ->between(start: $start, end: $end)
                ->perMonth()
                ->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total Orders',
                    'data' => $trend->map(fn (\Flowframe\Trend\TrendValue $value) => $value->aggregate)->toArray(),
                    'borderColor' => '#3b82f6', // blue
                    'fill' => true,
                ],
            ],
            'labels' => $trend->map(fn (\Flowframe\Trend\TrendValue $value) => $value->date)->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
