<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use Illuminate\Support\Str;

class SyncCloudinary extends Command
{
    protected $signature = 'sync:cloudinary';
    protected $description = 'Sync all local public files to Cloudinary';

    public function handle()
    {
        $this->info('Starting sync to Cloudinary...');

        // 1. Sync all files from local 'public' to 'cloudinary'
        $files = Storage::disk('public')->allFiles();
        $this->info('Found ' . count($files) . ' files in local public disk.');

        foreach ($files as $file) {
            // Remove extension for public_id
            $pathInfo = pathinfo($file);
            $relativePath = ($pathInfo['dirname'] !== '.' ? $pathInfo['dirname'] . '/' : '') . $pathInfo['filename'];
            
            $this->info("Uploading: {$relativePath}");
            try {
                $contents = Storage::disk('public')->get($file);
                Storage::disk('cloudinary')->put($relativePath, $contents);
                $this->info("Success: {$relativePath}");
            } catch (\Exception $e) {
                $this->error("Failed to upload {$relativePath}: " . $e->getMessage());
            }
        }

        // 2. Update curator table
        \Illuminate\Support\Facades\DB::table('curator')->update(['disk' => 'cloudinary']);
        $this->info('Updated curator table to use cloudinary disk.');

        $this->info('Sync completed!');
    }
}
