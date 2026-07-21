<?php

namespace App\Filament\Resources\IncompleteOrders;

use App\Filament\Resources\IncompleteOrders\Pages\ManageIncompleteOrders;
use App\Models\IncompleteOrder;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\Action;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class IncompleteOrderResource extends Resource
{
    public static function getNavigationBadge(): ?string
    {
        $count = auth()->user()->unreadNotifications()->where('data', 'like', '%"title":"New Incomplete Order"%')->count();
        return $count > 0 ? (string) $count : null;
    }

    protected static ?string $model = IncompleteOrder::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShoppingCart;

    public static function getNavigationGroup(): ?string
    {
        return 'MANAGEMENT';
    }

    public static function getNavigationLabel(): string
    {
        return 'Incomplete Orders';
    }

    public static function getNavigationSort(): ?int
    {
        return 8;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('invoice_number')
                    ->label('Invoice No')
                    ->getStateUsing(fn ($record) => 'INC-' . str_pad($record->id, 4, '0', STR_PAD_LEFT))
                    ->url(fn ($record) => route('admin.incomplete-orders.invoice', $record))
                    ->openUrlInNewTab()
                    ->color('primary')
                    ->extraAttributes(['class' => 'transition-all duration-300 hover:text-blue-600 hover:scale-105 inline-block'])
                    ->sortable(['id'])
                    ->searchable(['id']),
                \Filament\Tables\Columns\TextColumn::make('created_at')
                    ->label('Time')
                    ->dateTime('d M Y, h:i A')
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('customer_name')
                    ->label('Name')
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('customer_phone')
                    ->label('Phone')
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('district')
                    ->label('District')
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('cart_data.total')
                    ->label('Cart Total')
                    ->money('BDT')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->recordActions([
                \Filament\Actions\Action::make('convert')
                    ->label('Convert to Order')
                    ->icon('heroicon-o-check-circle')
                    ->color('convert_action')
                    ->button()
                    ->action(function (\App\Models\IncompleteOrder $record) {
                        $cartService = app(\App\Services\CartService::class);
                        $cartService->clear();
                        
                        if (isset($record->cart_data['items']) && is_array($record->cart_data['items'])) {
                            foreach ($record->cart_data['items'] as $item) {
                                $productId = $item['product_id'] ?? $item['id'] ?? null;
                                if ($productId) {
                                    $cartService->add($productId, $item['quantity'] ?? 1);
                                }
                            }
                        }
                        return redirect()->to(route('checkout') . '?incomplete_order=' . $record->id);
                    }),
                \Filament\Actions\Action::make('view_cart')
                    ->label('View Cart')
                    ->icon('heroicon-o-eye')
                    ->modalContent(fn ($record) => view('filament.pages.incomplete-order-cart', ['cartData' => $record->cart_data])),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageIncompleteOrders::route('/'),
        ];
    }
}
