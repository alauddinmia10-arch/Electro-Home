<?php

namespace App\Filament\Resources\Questions\Pages;

use App\Filament\Resources\Questions\QuestionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListQuestions extends ListRecords
{
    public function mount(): void
    {
        parent::mount();
        if (auth()->check()) {
            auth()->user()->unreadNotifications()->where('data', 'like', '%"title":"New Question"%')->update(['read_at' => now()]);
        }
    }

    protected static string $resource = QuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
