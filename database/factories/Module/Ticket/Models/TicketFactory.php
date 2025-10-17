<?php

namespace Database\Factories\Module\Ticket\Models;

use App\Module\Customer\Models\Customer;
use App\Module\Ticket\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Module\Ticket\Models\Ticket>
 */
class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'         => fake()->text(50),
            'description'   => fake()->text(200),
            'customer_id'   => Customer::inRandomOrder()->first()->id
        ];
    }
}
