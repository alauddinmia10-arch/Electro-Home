<?php

namespace App\Filament\Widgets;

use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Order;
use Filament\Tables\Columns\TextColumn;

class RecentOrdersWidget extends BaseWidget
{
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 'full';
    protected static ?string $heading = 'Recent Orders';
    protected static bool $isLazy = false;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Order::query()->latest()->limit(5)
            )
            ->columns([
                TextColumn::make('invoice_number')
                    ->color('primary')
                    ->url(fn (\App\Models\Order $record): string => route('invoice.print', $record))
                    ->openUrlInNewTab(),
                TextColumn::make('customer_name'),
                TextColumn::make('total_amount')->money('bdt', true),
                TextColumn::make('payment_status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'paid' => 'success',
                        'unpaid' => 'warning',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')->dateTime()->sortable(),
            ])->paginated(false);
    }
}