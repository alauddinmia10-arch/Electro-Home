<?php

namespace App\Filament\Widgets;

use Filament\Actions\BulkActionGroup;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Order;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class PendingOrdersWidget extends TableWidget
{
    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 5;
    protected static bool $isLazy = false;

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Order::query()->where('delivery_status', 'pending')->latest())
            ->columns([
                TextColumn::make('invoice_number')
                    ->searchable()
                    ->color('primary')
                    ->url(fn (\App\Models\Order $record): string => route('invoice.print', $record))
                    ->openUrlInNewTab(),
                TextColumn::make('customer_name')->searchable(),
                TextColumn::make('total_amount')->money('bdt', true),
                TextColumn::make('payment_status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'paid' => 'success',
                        'unpaid' => 'warning',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')->dateTime()->sortable(),
            ]);
    }
}
