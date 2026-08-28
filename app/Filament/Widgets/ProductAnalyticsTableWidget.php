<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductAnalyticsTableWidget extends BaseWidget
{
    protected static ?int $sort = 10;
    protected int | string | array $columnSpan = 'full';
    protected static bool $isLazy = false;
    
    public ?array $filters = null;

    protected function getTableHeading(): string
    {
        return 'Product Performance';
    }

    public function table(Table $table): Table
    {
        $startDateStr = $this->filters['date_range']['startDate'] ?? null;
        $endDateStr = $this->filters['date_range']['endDate'] ?? null;
        
        $startDate = $startDateStr ? Carbon::parse($startDateStr)->startOfDay() : null;
        $endDate = $endDateStr ? Carbon::parse($endDateStr)->endOfDay() : null;

        return $table
            ->query(
                Product::query()
                    ->select('products.*')
                    ->withCount([
                        'orderItems as total_orders' => function (Builder $query) use ($startDate, $endDate) {
                            $query->whereHas('order', function (Builder $q) use ($startDate, $endDate) {
                                $q->where('delivery_status', '!=', 'cancelled');
                                if ($startDate) $q->where('created_at', '>=', $startDate);
                                if ($endDate) $q->where('created_at', '<=', $endDate);
                            });
                        }
                    ])
                    ->addSelect([
                        'total_sales' => \App\Models\OrderItem::selectRaw('COALESCE(SUM(unit_price * quantity), 0)')
                            ->whereColumn('product_id', 'products.id')
                            ->whereHas('order', function (Builder $q) use ($startDate, $endDate) {
                                $q->where('delivery_status', '!=', 'cancelled');
                                if ($startDate) $q->where('created_at', '>=', $startDate);
                                if ($endDate) $q->where('created_at', '<=', $endDate);
                            })
                    ])
            )
            ->columns([
                \Awcodes\Curator\Components\Tables\CuratorColumn::make('coverMedia')
                    ->label('Image')
                    ->size(40),
                Tables\Columns\TextColumn::make('name')
                    ->label('Product Name')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('total_views')
                    ->label('Total Views')
                    ->state(function (Product $record) use ($startDate, $endDate) {
                        return \App\Models\PageVisit::where(function($query) use ($record) {
                                $query->where('url', 'LIKE', '%/product/' . $record->slug)
                                      ->orWhere('url', 'LIKE', '%/product/' . $record->slug . '/%');
                            })
                            ->when($startDate, fn($q) => $q->where('visited_date', '>=', $startDate->format('Y-m-d')))
                            ->when($endDate, fn($q) => $q->where('visited_date', '<=', $endDate->format('Y-m-d')))
                            ->count();
                    })
                    ->sortable(query: function (Builder $query, string $direction) use ($startDate, $endDate) {
                        return $query->orderBy(
                            \App\Models\PageVisit::selectRaw('COUNT(*)')
                                ->whereRaw("(url LIKE '%/product/' || products.slug OR url LIKE '%/product/' || products.slug || '/%')")
                                ->when($startDate, fn($q) => $q->where('visited_date', '>=', $startDate->format('Y-m-d')))
                                ->when($endDate, fn($q) => $q->where('visited_date', '<=', $endDate->format('Y-m-d'))),
                            $direction
                        );
                    })
                    ->numeric(),
                Tables\Columns\TextColumn::make('total_orders')
                    ->label('Total Orders')
                    ->sortable()
                    ->numeric(),
                Tables\Columns\TextColumn::make('total_sales')
                    ->label('Total Sales')
                    ->money('bdt')
                    ->sortable(),
            ])
            ->defaultSort('total_sales', 'desc')
            ->paginated([5, 10, 25, 50])
            ->defaultPaginationPageOption(5);
    }
}
