<?php

namespace Database\Seeders;

use App\Module\Ticket\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!Ticket::exists()) {
            Ticket::factory()->withMedia()->count(20)->create();
        }
    }
}
