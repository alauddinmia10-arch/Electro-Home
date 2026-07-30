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
            foreach (array_values($galleryImages) as $index => $path) {
                $this->record->images()->create([
                    'image_path' => $path,
                    'sort_order' => $index,
                ]);
            }
        }
    }
}
