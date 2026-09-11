<?php

namespace App\Filament\Plugins;

use Awcodes\Curator\Components\Forms\RichEditor\AttachCuratorMediaPlugin;
use Filament\Actions\Action;
use Filament\Support\Enums\Width;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CustomAttachCuratorMediaPlugin extends AttachCuratorMediaPlugin
{
    public function getEditorActions(): array
    {
        $actions = parent::getEditorActions();
        
        foreach ($actions as $action) {
            if ($action instanceof Action && $action->getName() === 'attachCuratorMedia') {
                $action->modalWidth(Width::SevenExtraLarge);
                $action->modalHeading('Select Images from Gallery');
                $action->modalSubmitAction(false);
                $action->modalCancelAction(false);
                $action->modalContent(function (\Filament\Forms\Components\RichEditor $component) {
                    $media = collect();
                    $seenPaths = [];

                    // 1. Fetch from curator table (Cloudinary images)
                    $curatorRows = DB::table('curator')
                        ->select('id', 'name', 'path', 'disk', 'title', 'alt', 'ext', 'type')
                        ->orderBy('created_at', 'desc')
                        ->get();
                    
                    foreach ($curatorRows as $row) {
                        try {
                            $url = Storage::disk($row->disk)->url($row->path);
                        } catch (\Exception $e) {
                            continue;
                        }
                        if (empty($url)) continue;
                        $seenPaths[$row->path] = true;
                        $media->push([
                            'id' => 'curator-' . $row->id,
                            'name' => $row->name,
                            'title' => $row->title ?? $row->name,
                            'alt' => $row->alt ?? $row->title ?? $row->name,
                            'url' => $url,
                            'ext' => $row->ext,
                            'source' => 'Gallery',
                        ]);
                    }

                    // 2. Fetch from product_images table (public disk)
                    $productImages = DB::table('product_images')
                        ->join('products', 'products.id', '=', 'product_images.product_id')
                        ->select('product_images.id', 'product_images.image_path', 'products.name as product_name')
                        ->orderBy('product_images.created_at', 'desc')
                        ->get();

                    foreach ($productImages as $row) {
                        if (isset($seenPaths[$row->image_path])) continue;
                        
                        $url = '';
                        $localPath = public_path('storage/' . $row->image_path);
                        if (file_exists($localPath)) {
                            try { $url = Storage::disk('public')->url($row->image_path); } catch (\Exception $e) {}
                        } else {
                            try { $url = Storage::disk('cloudinary')->url($row->image_path); } catch (\Exception $e) {}
                        }

                        if (empty($url)) continue;
                        $seenPaths[$row->image_path] = true;
                        $ext = pathinfo($row->image_path, PATHINFO_EXTENSION) ?: 'jpg';
                        $media->push([
                            'id' => 'pi-' . $row->id,
                            'name' => basename($row->image_path),
                            'title' => $row->product_name,
                            'alt' => $row->product_name,
                            'url' => $url,
                            'ext' => $ext,
                            'source' => 'Product',
                        ]);
                    }

                    // 3. Fetch cover images from products table
                    $products = DB::table('products')
                        ->select('id', 'name', 'cover_image')
                        ->whereNotNull('cover_image')
                        ->where('cover_image', '!=', '')
                        ->get();

                    foreach ($products as $row) {
                        if (isset($seenPaths[$row->cover_image])) continue;
                        
                        $url = '';
                        $localPath = public_path('storage/' . $row->cover_image);
                        if (file_exists($localPath)) {
                            try { $url = Storage::disk('public')->url($row->cover_image); } catch (\Exception $e) {}
                        } else {
                            try { $url = Storage::disk('cloudinary')->url($row->cover_image); } catch (\Exception $e) {}
                        }

                        if (empty($url)) continue;
                        $seenPaths[$row->cover_image] = true;
                        $ext = pathinfo($row->cover_image, PATHINFO_EXTENSION) ?: 'jpg';
                        $media->push([
                            'id' => 'cover-' . $row->id,
                            'name' => basename($row->cover_image),
                            'title' => $row->name . ' (Cover)',
                            'alt' => $row->name,
                            'url' => $url,
                            'ext' => $ext,
                            'source' => 'Cover',
                        ]);
                    }

                    return view('filament.modals.curator-panel-wrapper', [
                        'media' => $media->values()->toArray(),
                        'statePath' => $component->getStatePath(),
                    ]);
                });
            }
        }

        return $actions;
    }

    public function getTipTapJsExtensions(): array
    {
        return [
            asset('js/custom-rich-editor-integration.js'),
        ];
    }
}
