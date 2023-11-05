<?php

namespace App\Traits;

use App\Enums\ModelActions;
use App\ActivityLog as LogInDb;
use Illuminate\Support\Facades\Auth;

trait LogModelAction
{
    public static function boot() {

        parent::boot();

        static::created(function($item) {

            LogInDb::create([
                'user_id' => Auth::id(),
                'user_name' => Auth::user()->name,
                'action' => ModelActions::C,
                'data' => $item,
                'model' => (new \ReflectionClass($item))->getName()
            ]);

        });

        static::updating(function($item) {

            LogInDb::create([
                'user_id' => Auth::id(),
                'user_name' => Auth::user()->name,
                'action' => ModelActions::U,
                'data' => json_encode([
                    'before' => $item,
                    'after' => $item->getOriginal(),
                ]),
                'model' => (new \ReflectionClass($item))->getName()
            ]);

        });

        static::deleted(function($item) {

            LogInDb::create([
                'user_id' => Auth::id(),
                'user_name' => Auth::user()->name,
                'action' => ModelActions::D,
                'data' => $item,
                'model' => (new \ReflectionClass($item))->getName()
            ]);

        });
    }
}
