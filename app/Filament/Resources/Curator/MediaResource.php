<?php

declare(strict_types=1);

namespace App\Filament\Resources\Curator;

use Awcodes\Curator\Resources\Media\MediaResource as BaseMediaResource;
use Filament\Tables\Table;

class MediaResource extends BaseMediaResource
{
    public static function getSlug(?\Filament\Panel $panel = null): string
    {
        return 'media';
    }

    /** @throws \Exception */
    public static function table(Table $table): Table
    {
        // Call the parent/base table method which calls MediaTable::configure($table)
        $table = parent::table($table);
        $livewire = $table->getLivewire();

        // Override the content grid to ensure 4 items per row on mobile, and more on desktop
        $table->contentGrid(function () use ($livewire): ?array {
            if ($livewire->layoutView === 'grid') {
                return [
                    'default' => 2,
                    'sm' => 3,
                    'md' => 5,
                    'lg' => 7,
                    'xl' => 10,
                    '2xl' => 10,
                ];
            }

            return null;
        });

        return $table;
    }
}
