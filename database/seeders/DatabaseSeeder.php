<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		$this->call([
			UserSeeder::class,
			BrandSeeder::class,
			AttributeValueSeeder::class,
			CategorySeeder::class,
			LocationSeeder::class,
			ConfigSeeder::class,
		]);

		for ($i = 0; $i < 5; $i++) {
			Product::factory(1000)->create();
		}
	}
}
