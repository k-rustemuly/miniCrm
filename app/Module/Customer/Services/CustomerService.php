<?php

declare(strict_types=1);

namespace App\Module\Customer\Services;

use App\Module\Customer\DTO\CreateCustomerDTO;
use App\Module\Customer\Models\Customer;
use App\Module\Customer\Repositories\CustomerRepository;

final class CustomerService
{
    public function __construct(
        private readonly CustomerRepository $customerRepository,
    ) {
    }

    public function create(CreateCustomerDTO $DTO): Customer
    {
        $customer = new Customer();

        $customer->name         = $DTO->name;
        $customer->phone_number = $DTO->phone_number;
        $customer->email        = $DTO->email;

        $this->customerRepository->create($customer);

        return $customer;
    }
}
