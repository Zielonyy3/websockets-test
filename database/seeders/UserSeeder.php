<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::factory()->create([
            'email' => 'admin@echo.pl',
            'name' => 'admin',
            'password' => Hash::make('admin.123'),
        ]);

        $user = User::factory()->create([
            'email' => 'test@echo.pl',
            'name' => 'test',
            'password' => Hash::make('test.123'),
        ]);
    }
}
