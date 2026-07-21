<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class ChannelViewsChart extends ChartWidget
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
    
    protected ?string $heading = 'Website Views';

    protected function getData(): array
    {
        $startDateStr = $this->filters['date_range']['startDate'] ?? null;
        $endDateStr = $this->filters['date_range']['endDate'] ?? null;
        
        $start = $startDateStr ? \Carbon\Carbon::parse($startDateStr)->startOfDay() : (\App\Models\PageVisit::min('visited_date') ? \Carbon\Carbon::parse(\App\Models\PageVisit::min('visited_date'))->startOfDay() : now()->subYear()->startOfDay());
        $end = $endDateStr ? \Carbon\Carbon::parse($endDateStr)->endOfDay() : now()->endOfDay();

        $diffInDays = $start && $end ? $start->diffInDays($end) : null;
        $trendMode = ($diffInDays !== null && $diffInDays <= 60) ? 'perDay' : 'perMonth';

        $viewsTrend = \Flowframe\Trend\Trend::model(\App\Models\PageVisit::class)
            ->dateColumn('visited_date')
            ->between(start: $start, end: $end)
            ->$trendMode()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Website Views',
                    'data' => $viewsTrend->map(fn (\Flowframe\Trend\TrendValue $value) => $value->aggregate)->toArray(),
                    'borderColor' => '#8b5cf6', // purple
                    'fill' => true,
                ],
            ],
            'labels' => $viewsTrend->map(fn (\Flowframe\Trend\TrendValue $value) => $value->date)->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // Since we are comparing discrete categories
    }
}
