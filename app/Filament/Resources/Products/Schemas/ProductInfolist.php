<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('category.name')
                    ->label('Category'),
                TextEntry::make('brand.name')
                    ->label('Brand')
                    ->placeholder('-'),
                TextEntry::make('name'),
                TextEntry::make('sku')
                    ->label('SKU'),
                TextEntry::make('barcode')
                    ->label('Barcode')
                    ->placeholder('-'),
                TextEntry::make('regular_price')
                    ->money(),
                TextEntry::make('discount_price')
                    ->money()
                    ->placeholder('-'),
                TextEntry::make('stock_quantity')
                    ->numeric(),
                TextEntry::make('alert_stock')
                    ->numeric(),
                ImageEntry::make('cover_image')
                    ->placeholder('-'),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('specifications')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('status'),
                IconEntry::make('is_featured')
                    ->boolean(),
                IconEntry::make('is_flash_sale')
                    ->boolean(),
                TextEntry::make('flash_sale_ends_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('total_sold')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
