<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		$configs = [
			[
				'hex_code' => '#212121',
				'logo' => 'logo-white.svg',
				'phone_1' => '+993(64)78-82-39',
				'phone_2' => '+993(65)85-58-73',
				'address' => 'A.Nyyazow köçe',
			]
		];

		foreach ($configs as $config) {
			Config::create($config);
		}
    }
}
