<?php

namespace App\Services;

use App\Models\User;

class AbilitiesResolver
{
    public static function resolve(User $user, $device)
    {
        if($user->role == 'client'){
            return static::resolveClient($device);
        }

        if($user->role == 'delivery'){
            return static::resolveDelivery($device);
        }

        return [];
    }

    public static function resolveClient($device)
    {
        return match ($device){
            'watch' => [
                'establishment:show'
            ],
            default => [
                'establishment:show',
                'orders:create',
                'product:show',
                'orders:show',
                'cart:manager'
            ]
        };
    }

    public static function resolveDelivery($device)
    {
        return [
            'availability:update',
            'coordinates:update',
            'orders:show',
            'orders:update'
        ];
    }
}
