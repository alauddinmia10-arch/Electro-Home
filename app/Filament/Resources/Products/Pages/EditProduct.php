<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $allImages = $this->data['all_images'] ?? [];
        if (!empty($allImages)) {
            $images = array_values($allImages);
            $data['cover_image'] = $images[0];
        } else {
            $data['cover_image'] = null;
        }
        return $data;
    }

    protected function afterSave(): void
    {
        $allImages = $this->data['all_images'] ?? [];
        $galleryImages = [];
        if (is_array($allImages) && count($allImages) > 1) {
            $galleryImages = array_slice(array_values($allImages), 1);
        }
        
        $existingImages = $this->record->images->pluck('image_path')->toArray();
        
        $imagesToDelete = array_diff($existingImages, $galleryImages);
        if (!empty($imagesToDelete)) {
            $this->record->images()->whereIn('image_path', $imagesToDelete)->delete();
        }
        
        foreach ($galleryImages as $index => $path) {
            $this->record->images()->updateOrCreate(
                ['image_path' => $path],
                ['sort_order' => $index]
            );
        }
    }
}
