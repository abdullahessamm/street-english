<?php

namespace App\Policies\Users;

use App\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Admin  $authAdmin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function index(Admin $authAdmin)
    {
        return $authAdmin->hasAbility(Admin::ABILITIES_USERS_ADMINS_INDEX);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Admin  $authAdmin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $authAdmin)
    {
        return $authAdmin->hasAbility(Admin::ABILITIES_USERS_ADMINS_CREATE);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Admin  $authAdmin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $authAdmin)
    {
        return $authAdmin->hasAbility(Admin::ABILITIES_USERS_ADMINS_UPDATE);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Admin  $authAdmin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $authAdmin)
    {
        return $authAdmin->hasAbility(Admin::ABILITIES_USERS_ADMINS_DELETE);
    }
}
