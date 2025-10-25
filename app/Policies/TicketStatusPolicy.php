<?php

declare(strict_types=1);

namespace App\Policies;

use App\Module\TicketStatus\Models\TicketStatus;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Module\User\Models\User;

class TicketStatusPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasRole('admin');
    }

    public function view(User $user, TicketStatus $item): bool
    {
        return $user->hasRole('admin');;
    }

    public function create(User $user): bool
    {
        return $user->hasRole('admin');;
    }

    public function update(User $user, TicketStatus $item): bool
    {
        return $user->hasRole('admin');;
    }

    public function delete(User $user, TicketStatus $item): bool
    {
        return $user->hasRole('admin');;
    }

    public function restore(User $user, TicketStatus $item): bool
    {
        return false;
    }

    public function forceDelete(User $user, TicketStatus $item): bool
    {
        return false;
    }

    public function massDelete(User $user): bool
    {
        return false;
    }
}
