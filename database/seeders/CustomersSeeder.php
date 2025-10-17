<?php

namespace Database\Seeders;

use App\Module\Customer\Models\Customer;
use Illuminate\Database\Seeder;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!Customer::exists()) {
            Customer::factory()->count(10)->create();
        }
    }
}
