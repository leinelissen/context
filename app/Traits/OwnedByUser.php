<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Exception;

trait OwnedByUser
{
    /**
     * Attach to model boot handler
     *
     * @return void
     */
    public static function bootOwnedByUser()
    {
        // Attach to creating event in model
        static::creating(function ($item) {
            // Attach model to current user
            $item->user_id = parent::getUserId();
        });
    }

    public static function getUserId()
    {
        if (!Auth::check()) {
            throw new Exception("Route is not protected by Auth middleware");
        }
        return Auth::id();
    }
}
