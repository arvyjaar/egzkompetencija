<?php

namespace App\Policies;

use App\Models\Criterion;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CriterionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->can('manage_forms');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Criterion  $criterion
     * @return mixed
     */
    public function view(User $user, Criterion $criterion)
    {
        return $user->can('manage_forms');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('manage_forms');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Criterion  $criterion
     * @return mixed
     */
    public function update(User $user, Criterion $criterion)
    {
        return $user->can('manage_forms');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Criterion  $criterion
     * @return mixed
     */
    public function delete(User $user, Criterion $criterion)
    {
        return $user->can('manage_forms');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Criterion  $criterion
     * @return mixed
     */
    public function restore(User $user, Criterion $criterion)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Criterion  $criterion
     * @return mixed
     */
    public function forceDelete(User $user, Criterion $criterion)
    {
        //
    }
}
