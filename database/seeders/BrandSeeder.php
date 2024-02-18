<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
			'Asus',
			'Lenovo',
			'Dyson',
			'Samsung',
			'Philips',
			'Vestel',
		];

		foreach ($brands as $brand) {
			Brand::create([
				'name' => $brand,
				'slug' => str($brand)->slug('-'),
			]);
		}
    }
}
