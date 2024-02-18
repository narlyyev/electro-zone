<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		$a = [
			/*1 => */['name' => 'Reňk', 'name_ru'=> 'Цвет', 'values' => [
				['name' => 'Ak', 'name_ru' => 'Белый'],
				['name' => 'Gara', 'name_ru' => 'Черный'],
				['name' => 'Çal', 'name_ru' => 'Серый'],
				['name' => 'Gyzyl', 'name_ru' => 'Красный'],
				['name' => 'Ýaşyl', 'name_ru' => 'Зеленый'],
				['name' => 'Gök', 'name_ru' => 'Синий'],
			]],
			/*2 => */['name' => 'Ölçegi', 'name_ru'=> 'Размер', 'values' => [
				['name' => '50-60', 'name_ru' => null],
				['name' => '150-70', 'name_ru' => null],
				['name' => '180-90', 'name_ru' => null],
				['name' => '190-120', 'name_ru' => null],
			]],
			/*3 => */['name' => 'Resolution', 'name_ru'=> 'Разрешение', 'values' => [
				['name' => 'HD', 'name_ru' => null],
				['name' => 'Full HD', 'name_ru' => null],
				['name' => '4K UHD', 'name_ru' => null],
				['name' => '2K', 'name_ru' => null],
				['name' => 'Quad HD', 'name_ru' => null],
				['name' => '4K', 'name_ru' => null],
			]],
			/*4 => */['name' => 'RAM', 'name_ru' => null, 'values' => [
				['name' => '2 GB', 'name_ru' => null],
				['name' => '4 GB', 'name_ru' => null],
				['name' => '6 GB', 'name_ru' => null],
				['name' => '8 GB', 'name_ru' => null],
				['name' => '12 GB', 'name_ru' => null],
				['name' => '16 GB', 'name_ru' => null],
			]],
			/*5 => */['name' => 'HDD', 'name_ru' => 'HDD', 'values' => [
				['name' => '128 GB', 'name_ru' => null],
				['name' => '256 GB', 'name_ru' => null],
				['name' => '512 GB', 'name_ru' => null],
				['name' => '1 TB', 'name_ru' => null],
			]],
			/*6 => */['name' => 'Diagonal', 'name_ru' => 'Diagonal', 'values' => [
				['name' => '13.3"', 'name_ru' => null],
				['name' => '14"', 'name_ru' => null],
				['name' => '15.6"', 'name_ru' => null],
				['name' => '17.3"', 'name_ru' => null],
				['name' => '19"', 'name_ru' => null],
				['name' => '20"', 'name_ru' => null],
				['name' => '24"', 'name_ru' => null],
				['name' => '27"', 'name_ru' => null],
				['name' => '32"', 'name_ru' => null],
				['name' => '42"', 'name_ru' => null],
				['name' => '65"', 'name_ru' => null],
				['name' => '75"', 'name_ru' => null],
			]],
			/*7 => */['name' => 'Tehnologiýa goldawy', 'name_ru' => 'Технологическая поддержка', 'values' => [
				['name' => 'HDMI', 'name_ru' => null],
				['name' => 'DisplayPort', 'name_ru' => null],
				['name' => 'USB', 'name_ru' => null],
				['name' => 'VGA', 'name_ru' => null],
				['name' => 'Ethernet', 'name_ru' => null],
			]],
			/*8 => */['name' => 'Matrisa görnüşi', 'name_ru' => 'Тип матрицы', 'values' => [
				['name' => 'IPS', 'name_ru' => null],
				['name' => 'TN', 'name_ru' => null],
				['name' => 'VA', 'name_ru' => null],
				['name' => 'OLED', 'name_ru' => null],
				['name' => 'QLED', 'name_ru' => null],
				['name' => 'LED', 'name_ru' => null],
			]],
			/*9 => */['name' => 'Sowadyjy görnüşi', 'name_ru' => 'Тип холодильника', 'values' => [
				['name' => 'one door', 'name_ru' => null, 'name_en' => null],
				['name' => 'two doors', 'name_ru' => null, 'name_en' => null],
			]],
			/*10 => */['name' => 'Göwrüm', 'name_ru' => 'Объем', 'values' => [
				['name' => '50', 'name_ru' => null],
				['name' => '100', 'name_ru' => null],
				['name' => '150', 'name_ru' => null],
				['name' => '200', 'name_ru' => null],
				['name' => '250', 'name_ru' => null],
				['name' => '300', 'name_ru' => null],
				['name' => '350', 'name_ru' => null],
				['name' => '400', 'name_ru' => null],
				['name' => '450', 'name_ru' => null],
				['name' => '500', 'name_ru' => null],
			]],
			/*11 => */['name' => 'SSD', 'name_ru' => 'SSD', 'values' => [
				['name' => '128 GB', 'name_ru' => null],
				['name' => '256 GB', 'name_ru' => null],
				['name' => '512 GB', 'name_ru' => null],
				['name' => '1 TB', 'name_ru' => null],
			]],
		];

		for ($i = 0; $i < count($a); $i++) {
			$attribute = Attribute::create([
				'name' => $a[$i]['name'],
				'name_ru' => $a[$i]['name_ru'],
			]);
			for ($j = 0; $j < count($a[$i]['values']); $j++) {
				AttributeValue::create([
					'attribute_id' => $attribute->id,
					'name' => $a[$i]['values'][$j]['name'],
					'name_ru' => $a[$i]['values'][$j]['name_ru'],
				]);
			}
		}
    }
}
