<?php

namespace Database\Seeders;

use App\Module\TicketStatus\Models\TicketStatus;
use Illuminate\Database\Seeder;

class TicketStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!TicketStatus::exists()) {
            collect(['Новый', 'В работе', 'Обработан'])->each(function ($status) {
                TicketStatus::create(['name' => $status]);
            });
        }
    }
}
