<?php

namespace Database\Seeders;

use App\Module\User\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!User::exists()) {
            User::factory()->admin()->create([
                'email' => 'admin@mail.kz',
                'password' => Hash::make('123456'),
            ]);

            User::factory(5)->manager()->create();
        }
    }
}
