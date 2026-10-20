<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Seeder;


class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'adedelight11@gmail.com',
                'name' => 'Super Admin',
                'password' => 'Admin@12345',
            ]
        );
    }
}
