<?php

declare(strict_types=1);

namespace App\Module\Customer\Repositories;

use App\Module\Customer\Models\Customer;
use Throwable;

final class CustomerRepository
{
    /**
     * @throws Throwable
     */
    public function create(Customer $customer): void
    {
        $customer->saveOrFail();
    }
}
