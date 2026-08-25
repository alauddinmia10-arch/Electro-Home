<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class SyncDatabaseCommand extends Command
{
    protected $signature = 'db:sync-to-remote';
    protected $description = 'Syncs local SQLite data to remote PostgreSQL database';

    public function handle()
    {
        // 1. Setup Remote Connection
        Config::set('database.connections.remote', [
            'driver' => 'pgsql',
            'host' => 'dpg-d9p0s9egekts73f0iso0-a.oregon-postgres.render.com',
            'port' => '5432',
            'database' => 'electrohome',
            'username' => 'electrohome',
            'password' => 'sO0vf0elf8t4m82oqZ2ZK0cMTiImOJUd',
            'charset' => 'utf8',
            'prefix' => '',
            'schema' => 'public',
            'sslmode' => 'prefer',
        ]);

        $this->info("Connecting to remote PostgreSQL database...");
        
        try {
            DB::connection('remote')->getPdo();
            $this->info("Successfully connected to remote database!");
        } catch (\Exception $e) {
            $this->error("Could not connect to remote database: " . $e->getMessage());
            return;
        }

        $modelsToSync = [
            \App\Models\Banner::class,
            \Awcodes\Curator\Models\Media::class,
            \App\Models\Category::class,
            \App\Models\Brand::class,
            \App\Models\Product::class,
            \App\Models\ProductImage::class,
            \App\Models\Setting::class,
        ];

        // Delete in reverse order to respect foreign keys
        foreach (array_reverse($modelsToSync) as $modelClass) {
            $tableName = (new $modelClass)->getTable();
            $this->info("Deleting records from {$tableName}");
            DB::connection('remote')->table($tableName)->delete();
        }

        foreach ($modelsToSync as $modelClass) {
            $this->info("Syncing table for model: {$modelClass}");
            $localRecords = $modelClass::all();
            
            $modelInstance = new $modelClass;
            $tableName = $modelInstance->getTable();

            $count = 0;
            $batch = [];
            foreach ($localRecords as $record) {
                $attributes = $record->getAttributes();
                
                // PostgreSQL boolean fix
                foreach ($record->getCasts() as $key => $type) {
                    if (str_contains($type, 'boolean') || str_contains($type, 'bool')) {
                        if (array_key_exists($key, $attributes)) {
                            $attributes[$key] = $attributes[$key] ? true : false;
                        }
                    }
                }
                
                $batch[] = $attributes;
                $count++;
            }
            
            if (count($batch) > 0) {
                foreach (array_chunk($batch, 100) as $chunk) {
                    DB::connection('remote')->table($tableName)->insert($chunk);
                }
            }
            
            $this->info("Synced {$count} records for {$tableName}");
        }

        $this->info("Database sync completed successfully!");
    }
}
