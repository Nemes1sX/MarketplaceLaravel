<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Marketplace;
use Illuminate\Auth\Access\HandlesAuthorization;

class MarketplacePolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->email === 'admin@example.com') {
            return true;
        }
    }

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Marketplace $marketplace)
    {
        return true;
    }

    public function create(User $user)
    {
        return !$user->marketplace()->exists();
    }

    public function update(User $user, Marketplace $marketplace)
    {
        return $user->id === $marketplace->user_id;
    }

    public function delete(User $user, Marketplace $marketplace)
    {
        return $user->id === $marketplace->user_id;
    }
} 