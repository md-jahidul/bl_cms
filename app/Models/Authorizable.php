<?php

namespace App\Models;
use App\Models\Role;

trait Authorizable
{
    /**
     * @inheritdoc
     */
    public function newFromBuilder($attributes = array(), $connection = NULL)
    {
        $instance = parent::newFromBuilder($attributes);

        $instance->fireModelEvent('loaded');

        return $instance;
    }

    /**
     * Register a loaded model event with the dispatcher.
     *
     * @param  \Closure|string  $callback
     * @param  int  $priority
     * @return void
     */
    public static function loaded($callback, $priority = 0)
    {
        static::registerModelEvent('loaded', $callback, $priority);
    }

    public function isAuthorize($namespace, $controller, $method, $action)
    {
        if(!count($this->roles)) {
            return false;
        }

        foreach ( $this->roles as $role) {
            $permission = $role->permissions
                                ->where('namespace', $namespace)
                                ->where('controller', $controller)
                                ->where('method', $method)
                                ->where('action', $action);

            if (count($permission) > 0) {
                return true;
            }
        }
        
        return false;
    }

    public function can_view($feature)
    {
        if(!count($this->roles)) {
            return false;
        }

        foreach ( $this->roles as $role) {
            $permission = $role->permissions
                                ->where('controller', $feature . 'Controller');
                                
            if (count($permission) > 0) {
                return true;
            }
        }
        
        return false;
    }

    public function isAdmin()
    {
        foreach ($this->roles as $role) {            
            if($role->id == 1 || $role->id == 2){
                return true;
            }
        }

        return false;
    }

    /**
     * Get the type of the user.
     */
    // public function role()
    // {
    //     return $this->belongsTo('Pondit\Authorize\Models\Role');
    // }


    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    // public function assignRole($role)
    // {
    //     return $this->roles()->save(
    //                 Role::whereName($role)->firstOrFail()
    //             );
    // }

    // public function hasRole($role)
    // {
    //     if(is_string($role)){
    //         return $this->roles->contains('name',$role);
    //     }

    //     return !! $role->intersect($this->roles)->count();
    // }
}
