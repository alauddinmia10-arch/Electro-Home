<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name'),
                TextInput::make('invoice_number')
                    ->required(),
                TextInput::make('subtotal')
                    ->required()
                    ->numeric(),
                TextInput::make('delivery_charge')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('discount_amount')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('total_amount')
                    ->required()
                    ->numeric(),
                TextInput::make('payment_method')
                    ->required()
                    ->default('cod'),
                TextInput::make('payment_status')
                    ->required()
                    ->default('unpaid'),
                TextInput::make('delivery_status')
                    ->required()
                    ->default('pending'),
                TextInput::make('customer_name')
                    ->required(),
                TextInput::make('customer_phone')
                    ->tel()
                    ->required(),
                TextInput::make('customer_alt_phone')
                    ->tel(),
                TextInput::make('district')
                    ->required(),
                TextInput::make('thana')
                    ->required(),
                Textarea::make('full_address')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('order_note')
                    ->columnSpanFull(),
                TextInput::make('coupon_code'),
                TextInput::make('courier_name'),
                TextInput::make('tracking_id'),
                Select::make('assigned_staff_id')
                    ->relationship('assignedStaff', 'name'),
                TextInput::make('transaction_id'),
            ]);
    }
}
