<?php

namespace App\Policies;

use App\Models\Perumahan;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DaftarPerumahanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Perumahan  $perumahan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Perumahan $perumahan)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Perumahan  $perumahan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Perumahan $perumahan)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Perumahan  $perumahan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Perumahan $perumahan)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Perumahan  $perumahan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Perumahan $perumahan)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Perumahan  $perumahan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Perumahan $perumahan)
    {
        //
    }
    public function agen(User $user)
    {
        $user->load('agen');
        $agen = $user->agen;
        $agen = $agen ? $agen->status_terverifikasi == 'aktif' : false;
        $developer = $user->role == 'developer' ?: false;
        return $agen && !$developer;
    }
}
