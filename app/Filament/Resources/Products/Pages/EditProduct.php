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
        $data['gallery_images'] = $this->record->images->pluck('media_id')->filter()->toArray();
        return $data;
    }

    protected function afterSave(): void
    {
        $galleryImages = $this->data['gallery_images'] ?? [];
        if (is_array($galleryImages)) {
            $galleryImages = array_values(array_filter($galleryImages));
        } else {
            $galleryImages = [];
        }
        
        $existingImages = $this->record->images->pluck('media_id')->filter()->toArray();
        
        $imagesToDelete = array_diff($existingImages, $galleryImages);
        if (!empty($imagesToDelete)) {
            $this->record->images()->whereIn('media_id', $imagesToDelete)->delete();
        }
        
        foreach ($galleryImages as $index => $id) {
            $this->record->images()->updateOrCreate(
                ['media_id' => $id],
                ['sort_order' => $index]
            );
        }
    }
}
