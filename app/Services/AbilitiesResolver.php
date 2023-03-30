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
        return false;
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
                'product:show'
            ]
        };
    }
}
