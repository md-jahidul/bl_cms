<?php

namespace App\Policies;

use App\Models\User;
use App\Partner;
use Illuminate\Auth\Access\HandlesAuthorization;

class PartnerPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any partners.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the partner.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Partner  $partner
     * @return mixed
     */
    public function view(User $user, Partner $partner)
    {
        //
    }

    /**
     * Determine whether the user can create partners.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the partner.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Partner  $partner
     * @return mixed
     */
    public function update(User $user, Partner $partner)
    {
        //
    }

    /**
     * Determine whether the user can delete the partner.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Partner  $partner
     * @return mixed
     */
    public function delete(User $user, Partner $partner)
    {
        //
    }

    /**
     * Determine whether the user can restore the partner.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Partner  $partner
     * @return mixed
     */
    public function restore(User $user, Partner $partner)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the partner.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Partner  $partner
     * @return mixed
     */
    public function forceDelete(User $user, Partner $partner)
    {
        //
    }
}
