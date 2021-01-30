<?php

namespace App\Policies;

use App\Models\Competency;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompetencyPolicy
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
     * @param  \App\Models\Competency  $competency
     * @return mixed
     */
    public function view(User $user, Competency $competency)
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
     * @param  \App\Models\Competency  $competency
     * @return mixed
     */
    public function update(User $user, Competency $competency)
    {
        return $user->can('manage_forms');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Competency  $competency
     * @return mixed
     */
    public function delete(User $user, Competency $competency)
    {
        return $user->can('manage_forms');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Competency  $competency
     * @return mixed
     */
    public function restore(User $user, Competency $competency)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Competency  $competency
     * @return mixed
     */
    public function forceDelete(User $user, Competency $competency)
    {
        //
    }
}
