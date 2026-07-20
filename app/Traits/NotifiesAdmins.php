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
            
            $notification = Notification::make()
                ->title($title)
                ->body("A new {$modelName} has been submitted.")
                ->success();

            $url = null;
            if ($model instanceof \App\Models\Order) {
                $url = \App\Filament\Resources\Orders\OrderResource::getUrl('index');
            } elseif ($model instanceof \App\Models\IncompleteOrder) {
                $url = \App\Filament\Resources\IncompleteOrders\IncompleteOrderResource::getUrl('index');
            } elseif ($model instanceof \App\Models\WholesaleRequest) {
                $url = \App\Filament\Resources\WholesaleRequests\WholesaleRequestResource::getUrl('index');
            } elseif ($model instanceof \App\Models\Question) {
                $url = \App\Filament\Resources\Questions\QuestionResource::getUrl('index');
            } elseif ($model instanceof \App\Models\Review) {
                $url = \App\Filament\Resources\Reviews\ReviewResource::getUrl('index');
            }

            if ($url) {
                $notification->actions([
                    \Filament\Actions\Action::make('view')
                        ->label('View ' . $modelName)
                        ->url($url)
                        ->button()
                        ->markAsRead(),
                ]);
            }
                
            $notification->sendToDatabase($admins);
        });
    }
}
