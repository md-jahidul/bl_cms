<?php

namespace App\Traits;

use App\Enums\ModelActions;
use App\LogModelAction as LogInDb;
use Illuminate\Support\Facades\Auth;

trait LogModelAction
{
    public static function boot() {
  
        parent::boot();
  
        static::created(function($item) {           
            
            LogInDb::create([
                'user_id' => Auth::id(),
                'action' => ModelActions::C,
                'data' => $item,
                'model' => (new \ReflectionClass($item))->getName()
            ]);

        });

        static::updated(function($item) {      
            
            LogInDb::create([
                'user_id' => Auth::id(),
                'action' => ModelActions::U,
                'data' => $item,
                'model' => (new \ReflectionClass($item))->getName()
            ]);

        });
  
        static::deleted(function($item) {            

            LogInDb::create([
                'user_id' => Auth::id(),
                'action' => ModelActions::D,
                'data' => $item,
                'model' => (new \ReflectionClass($item))->getName()
            ]);
            
        });
    }
}
