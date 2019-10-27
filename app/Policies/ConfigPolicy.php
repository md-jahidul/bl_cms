<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Config;
use Illuminate\Auth\Access\HandlesAuthorization;
use Pondit\Authorize\Models\Permission;

class ConfigPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any configs.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the config.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Config  $config
     * @return mixed
     */
    public function view(User $user, Config $config)
    {
        //
    }

    /**
     * Determine whether the user can create configs.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the config.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Config  $config
     * @return mixed
     */


    public function update(User $user, Config $config)
    {
//      dd($user);
        if ($user->email === 'assetlite@admin.com') {
            return true;
        }
        return false;
//        return is_array($user->email, ['assetlite@admin.com']);
    }

    /**
     * Determine whether the user can delete the config.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Config  $config
     * @return mixed
     */
    public function delete(User $user, Config $config)
    {
        //
    }

    /**
     * Determine whether the user can restore the config.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Config  $config
     * @return mixed
     */
    public function restore(User $user, Config $config)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the config.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Config  $config
     * @return mixed
     */
    public function forceDelete(User $user, Config $config)
    {
        //
    }
}
