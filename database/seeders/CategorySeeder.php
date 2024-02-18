<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function PHPSTORM_META\map;

class CategorySeeder extends Seeder
{
	use WithoutModelEvents;

	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$categories =
			[
				[
					'name' => 'Monitors', // 1
					'name_ru' => 'Мониторы',
					'parent_id' => null,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 3,
					'slug' => 'monitors',
					'branch' => '/1/',
				],
				[
					'name' => 'Computers', // 2
					'name_ru' => 'Компьютеры',
					'parent_id' => null,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 1,
					'slug' => 'computers',
					'branch' => '/2/',
				],
				[
					'name' => 'Laptops', // 3
					'name_ru' => 'Ноутбуки',
					'parent_id' => 2,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 1,
					'slug' => 'laptops',
					'branch' => '/2/3/',
				],
				[
					'name' => 'Desktops', // 4
					'name_ru' => 'Настольные ПК',
					'parent_id' => 2,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 2,
					'slug' => 'desktops',
					'branch' => '/2/4/',
				],
				[
					'name' => 'Smartphones', // 5
					'name_ru' => 'Смартфоны',
					'parent_id' => null,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 2,
					'slug' => 'smartphones',
					'branch' => '/5/',
				],
				[
					'name' => 'Android', // 6
					'name_ru' => 'Android',
					'parent_id' => 5,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 1,
					'slug' => 'android',
					'branch' => '/5/6/',
				],
				[
					'name' => 'iOS', // 7
					'name_ru' => 'iOS',
					'parent_id' => 5,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 2,
					'slug' => 'ios',
					'branch' => '/5/7/',
				],
				[
					'name' => 'Audio', // 8
					'name_ru' => 'Аудио',
					'parent_id' => null,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 3,
					'slug' => 'audio',
					'branch' => '/8/',
				],
				[
					'name' => 'Headphones', // 9
					'name_ru' => 'Наушники',
					'parent_id' => 8,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 1,
					'slug' => 'headphones',
					'branch' => '/8/9/',
				],
				[
					'name' => 'Speakers', // 10
					'name_ru' => 'Колонки',
					'parent_id' => 8,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 2,
					'slug' => 'speakers',
					'branch' => '/8/10/',
				],
				[
					'name' => 'Cameras', // 11
					'name_ru' => 'Камеры',
					'parent_id' => null,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 4,
					'slug' => 'cameras',
					'branch' => '/11/',
				],
				[
					'name' => 'DSLR Cameras', // 12
					'name_ru' => 'Зеркальные камеры',
					'parent_id' => 11,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 1,
					'slug' => 'dslr-cameras',
					'branch' => '/11/12/',
				],
				[
					'name' => 'Action Cameras', // 13
					'name_ru' => 'Экшн-камеры',
					'parent_id' => 11,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 2,
					'slug' => 'action-cameras',
					'branch' => '/11/13/',
				],
				[
					'name' => 'Accessories', // 14
					'name_ru' => 'Аксессуары',
					'parent_id' => null,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 5,
					'slug' => 'accessories',
					'branch' => '/14/',
				],
				[
					'name' => 'Chargers', // 15
					'name_ru' => 'Зарядные устройства',
					'parent_id' => 14,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 1,
					'slug' => 'chargers',
					'branch' => '/14/15/',
				],
				[
					'name' => 'Cables', // 16
					'name_ru' => 'Кабели',
					'parent_id' => 14,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 2,
					'slug' => 'cables',
					'branch' => '/14/16/',
				],
				[
					'name' => 'Power Banks', // 17
					'name_ru' => 'Power Banks',
					'parent_id' => 14,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 3,
					'slug' => 'power-banks',
					'branch' => '/14/17/',
				],
				[
					'name' => 'Lenses', // 18
					'name_ru' => 'Объективы',
					'parent_id' => 14,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 4,
					'slug' => 'lenses',
					'branch' => '/14/18/',
				],
				[
					'name' => 'Batteries', // 19
					'name_ru' => 'Батареи',
					'parent_id' => 14,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 5,
					'slug' => 'batteries',
					'branch' => '/14/19/',
				],
				[
					'name' => 'Cases', // 20
					'name_ru' => 'Чехлы',
					'parent_id' => 14,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 6,
					'slug' => 'cases',
					'branch' => '/14/20/',
				],
				[
					'name' => 'Memory Cards', // 21
					'name_ru' => 'Карты памяти',
					'parent_id' => 14,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 7,
					'slug' => 'memory-cards',
					'branch' => '/14/21/',
				],
				[
					'name' => 'Tripods', // 22
					'name_ru' => 'Штативы',
					'parent_id' => 14,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 8,
					'slug' => 'tripods',
					'branch' => '/14/22/',
				],
				[
					'name' => 'Filters', // 23
					'name_ru' => 'Фильтры',
					'parent_id' => 14,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 9,
					'slug' => 'filters',
					'branch' => '/14/23/',
				],
				[
					'name' => 'Bags', // 24
					'name_ru' => 'Сумки',
					'parent_id' => 14,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 10,
					'slug' => 'bags',
					'branch' => '/14/24/',
				],
				[
					'name' => 'Boilers', // 25
					'name_ru' => 'Котлы',
					'parent_id' => null,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 6,
					'slug' => 'boilers',
					'branch' => '/25/',
				],
				[
					'name' => 'Electric Boilers', // 26
					'name_ru' => 'Электрические котлы',
					'parent_id' => 25,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 1,
					'slug' => 'electric-boilers',
					'branch' => '/25/26/',
				],
				[
					'name' => 'Gas Boilers', // 27
					'name_ru' => 'Газовые котлы',
					'parent_id' => 25,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 2,
					'slug' => 'gas-boilers',
					'branch' => '/25/27/',
				],
				[
					'name' => 'Stove', // 28
					'name_ru' => 'Плиты',
					'parent_id' => null,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 7,
					'slug' => 'stove',
					'branch' => '/28/',
				],
				[
					'name' => 'Electric Stove', // 29
					'name_ru' => 'Электрические плиты',
					'parent_id' => 28,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 1,
					'slug' => 'electric-stove',
					'branch' => '/28/29/',
				],
				[
					'name' => 'Gas Stove', // 30
					'name_ru' => 'Газовые плиты',
					'parent_id' => 28,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 2,
					'slug' => 'gas-stove',
					'branch' => '/28/30/',
				],
				[
					'name' => 'Ovens', // 31
					'name_ru' => 'Духовки',
					'parent_id' => 28,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 3,
					'slug' => 'ovens',
					'branch' => '/28/31/',
				],
				[
					'name' => 'Hoods', // 32
					'name_ru' => 'Вытяжки',
					'parent_id' => 28,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 4,
					'slug' => 'hoods',
					'branch' => '/28/32/',
				],
				[
					'name' => 'Kitchen Machines', // 33
					'name_ru' => 'Стиральные машины',
					'parent_id' => null,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 8,
					'slug' => 'kitchen-machines',
					'branch' => '/33/',
				],
				[
					'name' => 'Dishwashers', // 33
					'name_ru' => 'Посудомоечные машины',
					'parent_id' => 33,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 5,
					'slug' => 'dishwashers',
					'branch' => '/33/34/',
				],
				[
					'name' => 'Washing Machines', // 34
					'name_ru' => 'Стиральные машины',
					'parent_id' => 33,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 6,
					'slug' => 'washing-machines',
					'branch' => '/33/35/',
				],
				[
					'name' => 'Dryers', // 35
					'name_ru' => 'Сушильные машины',
					'parent_id' => 33,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 7,
					'slug' => 'dryers',
					'branch' => '/33/36/',
				],
				[
					'name' => 'Refrigerators and Freezers', // 35
					'name_ru' => 'Холодильники и морозильные камеры',
					'parent_id' => null,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 9,
					'slug' => 'refrigerators-and-freezers',
					'branch' => '/37/',
				],
				[
					'name' => 'Refrigerators', // 35
					'name_ru' => 'Холодильники',
					'parent_id' => 35,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 7,
					'slug' => 'refrigerators',
					'branch' => '/37/38/',
				],
				[
					'name' => 'Freezers', // 36
					'name_ru' => 'Морозильные камеры',
					'parent_id' => 35,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 8,
					'slug' => 'freezers',
					'branch' => '/37/39/',
				],
				[
					'name' => 'Air Conditioners', // 37
					'name_ru' => 'Кондиционеры',
					'parent_id' => null,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 10,
					'slug' => 'air-conditioners',
					'branch' => '/40/',
				],
				[
					'name' => 'Split Systems', // 38
					'name_ru' => 'Сплит-системы',
					'parent_id' => 37,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 9,
					'slug' => 'split-systems',
					'branch' => '/40/41/',
				],
				[
					'name' => 'Mobile Air Conditioners', // 39
					'name_ru' => 'Мобильные кондиционеры',
					'parent_id' => 37,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 10,
					'slug' => 'mobile-air-conditioners',
					'branch' => '/40/42/',
				],
				[
					'name' => 'Heaters', // 40
					'name_ru' => 'Обогреватели',
					'parent_id' => null,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 11,
					'slug' => 'heaters',
					'branch' => '/40/43/',
				],
				[
					'name' => 'Electric Heaters', // 41
					'name_ru' => 'Электрические обогреватели',
					'parent_id' => 40,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 11,
					'slug' => 'electric-heaters',
					'branch' => '/40/43/44/',
				],
				[
					'name' => 'Gas Heaters', // 42
					'name_ru' => 'Газовые обогреватели',
					'parent_id' => 40,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 12,
					'slug' => 'gas-heaters',
					'branch' => '/40/43/45/',
				],
				[
					'name' => 'Water Heaters', // 43
					'name_ru' => 'Водонагреватели',
					'parent_id' => 40,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 13,
					'slug' => 'water-heaters',
					'branch' => '/40/43/46/',
				],
				[
					'name' => 'Fans', // 44
					'name_ru' => 'Вентиляторы',
					'parent_id' => 40,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 14,
					'slug' => 'fans',
					'branch' => '/40/43/47/',
				],
				[
					'name' => 'Humidifiers', // 45
					'name_ru' => 'Увлажнители',
					'parent_id' => 40,
					'is_home' => 1,
					'is_active' => 1,
					'sort_order' => 15,
					'slug' => 'humidifiers',
					'branch' => '/40/43/48/',
				],
			];

		foreach ($categories as &$category) {
			$category['big_image'] = $this->getRandomLocalImage();
		}

		Category::insert($categories);
	}

	/**
	 * Get a random image from local storage.
	 */
	protected function getRandomLocalImage(): ?string
	{
		$imageFolder = public_path('storage/category-images');

		$imageFiles = glob($imageFolder . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE);

		if (empty($imageFiles)) {
			return null;
		}

		$randomImage = $imageFiles[array_rand($imageFiles)];

		return str_replace(public_path(), '', $randomImage);
	}
}
