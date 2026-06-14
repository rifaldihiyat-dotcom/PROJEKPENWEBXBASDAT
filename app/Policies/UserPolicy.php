<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
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

    public function viewAny(User $user): bool { return false; }

    public function view(User $user, User $model): bool { return false; }

    public function create(User $user): bool { return false; }

    public function update(User $user, User $model): bool { return false; }

    public function delete(User $user, User $model): bool { return false; }

    public function restore(User $user, User $model): bool { return false; }

    public function forceDelete(User $user, User $model): bool { return false; }
}
