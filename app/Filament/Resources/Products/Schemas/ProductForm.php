<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
                Select::make('brand_id')
                    ->relationship('brand', 'name')
                    ->nullable(),
                TextInput::make('name')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($set, ?string $state) => $set('slug', \Illuminate\Support\Str::slug($state))),
                \Filament\Forms\Components\Hidden::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                TextInput::make('sku')
                    ->label('SKU')
                    ->required(),
                TextInput::make('barcode')
                    ->label('Barcode'),
                TextInput::make('regular_price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('discount_price')
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('stock_quantity')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('alert_stock')
                    ->numeric()
                    ->default(0),
                \Awcodes\Curator\Components\Forms\CuratorPicker::make('cover_image_id')
                    ->label('Primary Cover Image (প্রধান কভার ছবি)')
                    ->relationship('coverMedia', 'id')
                    ->required()
                    ->columnSpanFull(),

                \Awcodes\Curator\Components\Forms\CuratorPicker::make('gallery_images')
                    ->label('Additional Gallery Images (অতিরিক্ত অন্যান্য ছবিসমূহ)')
                    ->multiple()
                    ->columnSpanFull(),
                RichEditor::make('description')
                    ->columnSpanFull(),
                \Filament\Forms\Components\KeyValue::make('specifications')
                    ->keyLabel('Feature')
                    ->valueLabel('Specification')
                    ->columnSpanFull(),
                TextInput::make('status')
                    ->required()
                    ->default('in_stock'),
                TextInput::make('total_sold')
                    ->required()
                    ->numeric()
                    ->default(0),
                \Filament\Schemas\Components\Group::make([
                    Toggle::make('is_featured')
                        ->required(),
                    Toggle::make('is_flash_sale')
                        ->required(),
                    DateTimePicker::make('flash_sale_ends_at'),
                ])->columns(3)->columnSpanFull(),
            ]);
    }
}
