<?php

declare(strict_types=1);

namespace App\Policies;

use App\Module\Ticket\Models\Ticket;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Module\User\Models\User;

class TicketPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view tickets', new Ticket());
    }

    public function view(User $user, Ticket $item): bool
    {
        return $user->can('view tickets', $item);
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Ticket $item): bool
    {
        return $user->can('update tickets', $item);
    }

    public function delete(User $user, Ticket $item): bool
    {
        return $user->can('delete tickets', $item);
    }

    public function restore(User $user, Ticket $item): bool
    {
        return false;
    }

    public function forceDelete(User $user, Ticket $item): bool
    {
        return false;
    }

    public function massDelete(User $user): bool
    {
        return false;
    }
}
