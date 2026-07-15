<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class OrderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name')
                    ->label('User')
                    ->placeholder('-'),
                TextEntry::make('invoice_number'),
                TextEntry::make('subtotal')
                    ->numeric(),
                TextEntry::make('delivery_charge')
                    ->numeric(),
                TextEntry::make('discount_amount')
                    ->numeric(),
                TextEntry::make('total_amount')
                    ->numeric(),
                TextEntry::make('payment_method'),
                TextEntry::make('payment_status'),
                TextEntry::make('delivery_status'),
                TextEntry::make('customer_name'),
                TextEntry::make('customer_phone'),
                TextEntry::make('customer_alt_phone')
                    ->placeholder('-'),
                TextEntry::make('district'),
                TextEntry::make('thana'),
                TextEntry::make('full_address')
                    ->columnSpanFull(),
                TextEntry::make('order_note')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('coupon_code')
                    ->placeholder('-'),
                TextEntry::make('courier_name')
                    ->placeholder('-'),
                TextEntry::make('tracking_id')
                    ->placeholder('-'),
                TextEntry::make('assignedStaff.name')
                    ->label('Assigned staff')
                    ->placeholder('-'),
                TextEntry::make('transaction_id')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
