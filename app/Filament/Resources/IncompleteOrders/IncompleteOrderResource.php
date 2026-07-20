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
                \Filament\Actions\Action::make('view_cart')
                    ->label('View Cart')
                    ->icon('heroicon-o-eye')
                    ->modalContent(fn ($record) => view('filament.pages.incomplete-order-cart', ['cartData' => $record->cart_data])),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->toolbarActions([
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
