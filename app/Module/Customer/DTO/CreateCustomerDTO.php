<?php

declare(strict_types=1);

namespace App\Module\Customer\DTO;

final class CreateCustomerDTO
{
    public string $name;
    public string $phone_number;
    public string $email;
}
