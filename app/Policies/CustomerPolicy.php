<?php

declare(strict_types=1);

namespace App\Policies;

use App\Module\Customer\Models\Customer;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Module\User\Models\User;

class CustomerPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Customer $item): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Customer $item): bool
    {
        return false;
    }

    public function delete(User $user, Customer $item): bool
    {
        return false;
    }

    public function restore(User $user, Customer $item): bool
    {
        return false;
    }

    public function forceDelete(User $user, Customer $item): bool
    {
        return false;
    }

    public function massDelete(User $user): bool
    {
        return false;
    }
}
