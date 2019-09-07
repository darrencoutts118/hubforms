<?php

namespace App\Policies;

use App\Models\Form;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FormPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any forms.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the form.
     *
     * @param  \App\User  $user
     * @param  \App\odel=App\Models\Form  $form
     * @return mixed
     */
    public function view(User $user, Form $form)
    {
        //
    }

    /**
     * Determine whether the user can create forms.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the form.
     *
     * @param  \App\User  $user
     * @param  \App\odel=App\Models\Form  $form
     * @return mixed
     */
    public function update(User $user, Form $form)
    {
        //
    }

    /**
     * Determine whether the user can delete the form.
     *
     * @param  \App\User  $user
     * @param  \App\odel=App\Models\Form  $form
     * @return mixed
     */
    public function delete(User $user, Form $form)
    {
        //
    }

    /**
     * Determine whether the user can restore the form.
     *
     * @param  \App\User  $user
     * @param  \App\odel=App\Models\Form  $form
     * @return mixed
     */
    public function restore(User $user, Form $form)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the form.
     *
     * @param  \App\User  $user
     * @param  \App\odel=App\Models\Form  $form
     * @return mixed
     */
    public function forceDelete(User $user, Form $form)
    {
        //
    }
}
