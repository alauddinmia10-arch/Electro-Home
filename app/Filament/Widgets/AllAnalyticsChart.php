<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;

class AllAnalyticsChart extends ChartWidget implements HasForms
{
    use InteractsWithForms;

    protected static ?int $sort = 2;
    protected static bool $isLazy = false;
    protected static ?string $pollingInterval = null;
    protected string $view = 'filament.widgets.all-analytics-chart';
    
    public ?array $filters = null;
    public ?array $date_range = null;
    
    protected int | string | array $columnSpan = [
        'default' => 1,
        'md' => 1,
        'lg' => 2,
        'xl' => 2,
        '2xl' => 2,
    ];
    
    protected ?string $maxHeight = null;
    
    protected ?string $heading = 'All Analytics (Orders, Sales & Website Views)';

    public function form(\Filament\Schemas\Schema $schema): \Filament\Schemas\Schema
    {
        if ($this->filters !== null) {
            return $schema->components([]);
        }

        return $schema
            ->components([
                \App\Filament\Forms\Components\FacebookDateRangePicker::make('date_range')
                    ->borderless()
                    ->hiddenLabel()
                    ->live(),
            ])
            ->statePath('');
    }

    protected function getData(): array
    {
        if ($this->filters === null) {
            $startDateStr = $this->date_range['startDate'] ?? null;
            $endDateStr = $this->date_range['endDate'] ?? null;
        } else {
            $startDateStr = $this->filters['date_range']['startDate'] ?? null;
            $endDateStr = $this->filters['date_range']['endDate'] ?? null;
        }
        $startDate = $startDateStr ? \Carbon\Carbon::parse($startDateStr) : null;
        $endDate = $endDateStr ? \Carbon\Carbon::parse($endDateStr) : null;

        $query = \App\Models\Order::query()->where('delivery_status', '!=', 'cancelled');

        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        $diffInDays = $startDate && $endDate ? $startDate->diffInDays($endDate) : null;
        
        $start = $startDate ? $startDate->copy()->startOfDay() : (\App\Models\Order::min('created_at') ? \Carbon\Carbon::parse(\App\Models\Order::min('created_at'))->startOfDay() : now()->subYear()->startOfDay());
        $end = $endDate ? $endDate->copy()->endOfDay() : now()->endOfDay();

        $trendMode = ($diffInDays !== null && $diffInDays <= 60) ? 'perDay' : 'perMonth';

        $salesTrend = \Flowframe\Trend\Trend::query(clone $query)
            ->between(start: $start, end: $end)
            ->$trendMode()
            ->sum('total_amount');
            
        $ordersTrend = \Flowframe\Trend\Trend::query(clone $query)
            ->between(start: $start, end: $end)
            ->$trendMode()
            ->count();

        $viewsTrend = \Flowframe\Trend\Trend::query(\App\Models\PageVisit::query())
            ->dateColumn('visited_date')
            ->between(start: $start, end: $end)
            ->$trendMode()
            ->count();

        $viewsData = $viewsTrend->map(fn (\Flowframe\Trend\TrendValue $value) => $value->aggregate)->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Total Sales (৳)',
                    'data' => $salesTrend->map(fn (\Flowframe\Trend\TrendValue $value) => $value->aggregate)->toArray(),
                    'borderColor' => '#10b981', // green
                    'fill' => false,
                    'yAxisID' => 'y',
                ],
                [
                    'label' => 'Orders',
                    'data' => $ordersTrend->map(fn (\Flowframe\Trend\TrendValue $value) => $value->aggregate)->toArray(),
                    'borderColor' => '#3b82f6', // blue
                    'fill' => false,
                    'yAxisID' => 'y1',
                ],
                [
                    'label' => 'Website Views',
                    'data' => $viewsData,
                    'borderColor' => '#8b5cf6', // purple
                    'fill' => false,
                    'yAxisID' => 'y',
                ],
            ],
            'labels' => $salesTrend->map(fn (\Flowframe\Trend\TrendValue $value) => $value->date)->toArray(),
        ];
    }

    protected function getOptions(): array
    {
        return [
            'maintainAspectRatio' => false,
            'scales' => [
                'y' => [
                    'type' => 'linear',
                    'display' => true,
                    'position' => 'left',
                ],
                'y1' => [
                    'type' => 'linear',
                    'display' => true,
                    'position' => 'right',
                    'grid' => [
                        'drawOnChartArea' => false, // only want the grid lines for one axis to show up
                    ],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    public function logHeights($canvasHeight, $containerHeight, $sectionHeight, $headerHeight, $contentCtnHeight, $pollDivHeight)
    {
        \Log::info('Chart DOM Heights Detailed:', [
            'canvas' => $canvasHeight,
            'container' => $containerHeight,
            'section' => $sectionHeight,
            'header' => $headerHeight,
            'contentCtn' => $contentCtnHeight,
            'pollDiv' => $pollDivHeight,
        ]);
    }
}
