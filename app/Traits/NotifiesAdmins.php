<?php

namespace App\Traits;

use App\Models\User;
use Filament\Notifications\Notification;

trait NotifiesAdmins
{
    public static function bootNotifiesAdmins()
    {
        static::created(function ($model) {
            $modelName = preg_replace('/(?<!^)[A-Z]/', ' $0', class_basename($model));
            $title = "New {$modelName}";
            
            $admins = User::admins()->get();
            
            Notification::make()
                ->title($title)
                ->body("A new {$modelName} has been submitted.")
                ->success()
                ->sendToDatabase($admins);
        });
    }
}
