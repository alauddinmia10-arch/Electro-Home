<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MigrateImagesToCurator extends Command
{
    protected $signature = 'app:migrate-images-to-curator';
    protected $description = 'Migrate existing product images to Curator media library';

    public function handle()
    {
        $this->info('Migrating product cover images...');
        
        $products = \App\Models\Product::all();
        foreach ($products as $product) {
            if ($product->cover_image && !$product->cover_image_id) {
                $path = 'public/' . $product->cover_image;
                if (\Illuminate\Support\Facades\Storage::exists($path) || \Illuminate\Support\Facades\Storage::disk('public')->exists($product->cover_image)) {
                    // Try to create media
                    $media = \Awcodes\Curator\Models\Media::create([
                        'disk' => 'public',
                        'directory' => 'products',
                        'visibility' => 'public',
                        'name' => pathinfo($product->cover_image, PATHINFO_FILENAME),
                        'path' => $product->cover_image,
                        'ext' => pathinfo($product->cover_image, PATHINFO_EXTENSION),
                        'type' => 'image/' . pathinfo($product->cover_image, PATHINFO_EXTENSION),
                        'alt' => $product->name,
                        'title' => $product->name,
                        'size' => \Illuminate\Support\Facades\Storage::disk('public')->exists($product->cover_image) ? \Illuminate\Support\Facades\Storage::disk('public')->size($product->cover_image) : 0,
                    ]);
                    $product->update(['cover_image_id' => $media->id]);
                }
            }
        }

        $this->info('Migrating product gallery images...');
        
        $images = \App\Models\ProductImage::all();
        foreach ($images as $image) {
            if ($image->image_path && !$image->media_id) {
                if (\Illuminate\Support\Facades\Storage::disk('public')->exists($image->image_path)) {
                    $media = \Awcodes\Curator\Models\Media::create([
                        'disk' => 'public',
                        'directory' => 'products',
                        'visibility' => 'public',
                        'name' => pathinfo($image->image_path, PATHINFO_FILENAME),
                        'path' => $image->image_path,
                        'ext' => pathinfo($image->image_path, PATHINFO_EXTENSION),
                        'type' => 'image/' . pathinfo($image->image_path, PATHINFO_EXTENSION),
                        'alt' => 'Gallery Image',
                        'title' => 'Gallery Image',
                        'size' => \Illuminate\Support\Facades\Storage::disk('public')->size($image->image_path),
                    ]);
                    $image->update(['media_id' => $media->id]);
                }
            }
        }

        $this->info('Migration completed successfully!');
    }
}
