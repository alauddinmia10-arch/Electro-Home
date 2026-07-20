<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    public function mount(): void
    {
        parent::mount();
        if (auth()->check()) {
            auth()->user()->unreadNotifications()->where('data', 'like', '%"title":"New Order"%')->update(['read_at' => now()]);
        }
    }

    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('print')
                ->label('Print')
                ->icon('heroicon-o-printer')
                ->color('info')
                ->url(fn (): string => route('invoice.print_all'))
                ->openUrlInNewTab(),
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => \Filament\Schemas\Components\Tabs\Tab::make('All Orders'),
            'unpaid' => \Filament\Schemas\Components\Tabs\Tab::make('Unpaid')
                ->modifyQueryUsing(fn (\Illuminate\Database\Eloquent\Builder $query) => $query->where('payment_status', 'unpaid')),
            'paid' => \Filament\Schemas\Components\Tabs\Tab::make('Paid')
                ->modifyQueryUsing(fn (\Illuminate\Database\Eloquent\Builder $query) => $query->where('payment_status', 'paid')),
        ];
    }
}
