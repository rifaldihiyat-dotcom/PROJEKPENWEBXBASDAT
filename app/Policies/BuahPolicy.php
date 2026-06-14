<?php

namespace App\Policies;

use App\Models\Buah;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BuahPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->hasRole('admin')) {
            return true;
        }
        return null;
    }

    public function viewAny(User $user): bool
    {
        return $user->hasRole('pegawai');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Buah $buah): bool
    {
        return $user->hasRole('pegawai');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('pegawai');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Buah $buah): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Buah $buah): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Buah $buah): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Buah $buah): bool
    {
        return false;
    }
}
