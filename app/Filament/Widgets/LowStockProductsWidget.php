<?php

namespace App\Filament\Widgets;

use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Product;
use Filament\Tables\Columns\TextColumn;

class LowStockProductsWidget extends BaseWidget
{
    protected static ?int $sort = 3;
    protected static bool $isLazy = false;
    protected int | string | array $columnSpan = [
        'default' => 1,
        'md' => 1,
        'lg' => 1,
        'xl' => 1,
        '2xl' => 1,
    ];
    protected static ?string $heading = 'Low Stock Products';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Product::query()->where('stock_quantity', '<=', 10)->orderBy('stock_quantity', 'asc')->limit(20)
            )
            ->extraAttributes([
                'class' => 'custom-low-stock-table',
            ])
            ->columns([
                TextColumn::make('name')
                    ->label('Product')
                    ->description(fn (Product $record): string => 'SKU: ' . $record->sku)
                    ->limit(70)
                    ->wrap(),
                TextColumn::make('stock_quantity')
                    ->label('Stock')
                    ->formatStateUsing(fn ($state) => $state . ' Left')
                    ->badge()
                    ->alignEnd()
                    ->color(fn (int $state): string => match (true) {
                        $state <= 2 => 'danger',
                        $state <= 5 => 'warning',
                        default => 'warning',
                    }),
            ])->paginated(false);
    }
}