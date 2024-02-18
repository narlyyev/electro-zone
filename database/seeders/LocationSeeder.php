<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
			['name' => 'Aşgabat', 'name_ru' => 'Ашхабад', 'delivery_fee' => 20, 'sort_order' => 1],
			['name' => 'Ahal', 'name_ru' => 'Ахал', 'delivery_fee' => 50, 'sort_order' => 1],
			['name' => 'Mary', 'name_ru' => 'Мары', 'delivery_fee' => 100, 'sort_order' => 1],
			['name' => 'Lebap', 'name_ru' => 'Лебап', 'delivery_fee' => 100, 'sort_order' => 1],
			['name' => 'Daşoguz', 'name_ru' => 'Дашогуз', 'delivery_fee' => 100, 'sort_order' => 1],
			['name' => 'Balkan', 'name_ru' => 'Балкан', 'delivery_fee' => 100, 'sort_order' => 1],
		];

		Location::insert($locations);
    }
}
