<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function afterCreate(): void
    {
        $galleryImages = $this->data['gallery_images'] ?? [];
        
        if (is_array($galleryImages) && !empty($galleryImages)) {
            foreach (array_values(array_filter($galleryImages)) as $index => $id) {
                $this->record->images()->create([
                    'media_id' => $id,
                    'sort_order' => $index,
                ]);
            }
        }
    }
}
