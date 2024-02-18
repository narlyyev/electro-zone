<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Arslan',
            'role' => 'superadmin',
            'phone' => '64788239',
            'password' => bcrypt('superman'),
			'permissions' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21]
        ]);

        User::create([
            'name' => 'Maksat',
            'role' => 'superadmin',
            'phone' => '65855873',
            'password' => bcrypt('superman'),
			'permissions' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21]
		]);
    }
}
