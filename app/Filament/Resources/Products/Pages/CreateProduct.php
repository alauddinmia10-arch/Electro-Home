<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $allImages = $this->data['all_images'] ?? [];
        if (!empty($allImages)) {
            $images = array_values($allImages);
            $data['cover_image'] = $images[0];
        }
        return $data;
    }

    protected function afterCreate(): void
    {
        $allImages = $this->data['all_images'] ?? [];
        
        if (is_array($allImages) && count($allImages) > 1) {
            $galleryImages = array_slice(array_values($allImages), 1);
            foreach ($galleryImages as $index => $path) {
                $this->record->images()->create([
                    'image_path' => $path,
                    'sort_order' => $index,
                ]);
            }
        }
    }
}
