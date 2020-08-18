<?php

namespace App\Models;

use App\Models\Role;

trait Authorizable
{
    /**
     * @inheritdoc
     */
    public function newFromBuilder($attributes = array(), $connection = null)
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
        if (!count($this->roles)) {
            return false;
        }

        foreach ($this->roles as $role) {
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

    public function can_view($feature, $action = 'index')
    {
        if (!$this->isAdmin()) {
            if (!count($this->roles)) {
                return false;
            }
            foreach ($this->roles as $role) {
                $permission = $role->permissions
//                    ->where('controller', "LeadManagement" . 'Controller')
                    ->where('controller', $feature.'Controller')
                    ->where('action', $action);

//                dd($permission);

                if (count($permission) > 0) {
                    return true;
                }
            }
            return false;
        } else {
            return true;
        }
    }

    public function isAdmin()
    {
        foreach ($this->roles as $role) {
            if ($role->id == 1 || $role->id == 2) {
                return true;
            }
        }

        return false;
    }


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

    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('alias', strtolower($role));
        }

        return !!$role->intersect($this->roles)->count();
    }
}
