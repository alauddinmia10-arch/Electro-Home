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

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['gallery_images'] = $this->record->images->pluck('image_path')->toArray();
        return $data;
    }

    protected function afterSave(): void
    {
        $galleryImages = $this->data['gallery_images'] ?? [];
        if (is_array($galleryImages)) {
            $galleryImages = array_values($galleryImages);
        } else {
            $galleryImages = [];
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
