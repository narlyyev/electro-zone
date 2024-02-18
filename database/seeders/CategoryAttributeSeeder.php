<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryAttributeSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$categories = [
			[
				'name' => 'Monitorlar',
				'name_ru' => 'Мониторы',
				'is_home' => 1,
				'is_active' => 1,
				'sort_order' => 1,
				'slug' => 'monitorlar',
				'children' => null,
				'attr' => [1, 6, 8],
			],
			[
				'name' => 'Noutbuklar we beýlekiler',
				'name_ru' => 'Ноутбуки и другие',
				'is_home' => 1,
				'is_active' => 1,
				'sort_order' => 1,
				'slug' => 'noutbuklar-we-beýlekiler',
				'children' => [
					[
						'name' => 'Noutbuklar',
						'name_ru' => 'Ноутбуки',
						'is_home' => 1,
						'is_active' => 1,
						'sort_order' => 1,
						'slug' => 'noutbuklar',
						'attr' => [1, 3, 4, 5],
					],
					[
						'name' => 'Sumkalar we rýukzaklar',
						'name_ru' => 'Сумки и рюкзаки',
						'is_home' => 1,
						'is_active' => 1,
						'sort_order' => 1,
						'slug' => 'sumkalar-we-ryukzaklar',
						'attr' => [1],
					],
				],
			],
			[
				'name' => 'Telewizorlar we wideolar',
				'name_ru' => 'Телевизоры и видео',
				'is_home' => 1,
				'is_active' => 1,
				'sort_order' => 1,
				'slug' => 'telewizorlar-we-wideo',
				'children' => [
					[
						'name' => 'Telewizorlar',
						'name_ru' => 'Телевизоры',
						'is_home' => 1,
						'is_active' => 1,
						'sort_order' => 1,
						'slug' => 'telewizorlar',
						'attr' => [3, 6, 7, 8],
					],
					[
						'name' => 'Wideo player',
						'name_ru' => 'Видеоплеер',
						'is_home' => 1,
						'is_active' => 1,
						'sort_order' => 1,
						'slug' => 'wideo-player',
						'attr' => [1, 6, 8],
					],
					[
						'name' => 'Proýektorlar',
						'name_ru' => 'Проекторы',
						'is_home' => 1,
						'is_active' => 1,
						'sort_order' => 1,
						'slug' => 'proyektorlar',
						'attr' => [7],
					],
				],
			],
		];

		foreach ($categories as $categoryData) {
			$category = Category::create([
				'parent_id' => null,
				'name' => $categoryData['name'],
				'name_ru' => $categoryData['name_ru'],
				'is_home' => $categoryData['is_home'],
				'is_active' => $categoryData['is_active'],
				'sort_order' => $categoryData['sort_order'],
				'slug' => $categoryData['slug'],
			]);

			if (isset($categoryData['attr'])) {
				$category->attributes()->sync($categoryData['attr']);
			}

			if (isset($categoryData['children'])) {
				foreach ($categoryData['children'] as $subCategoryData) {
					$subCategory = Category::create([
						'parent_id' => $category->id,
						'name' => $subCategoryData['name'],
						'name_ru' => $subCategoryData['name_ru'],
						'is_home' => $subCategoryData['is_home'],
						'is_active' => $subCategoryData['is_active'],
						'sort_order' => $subCategoryData['sort_order'],
						'slug' => $subCategoryData['slug'],
					]);

					if (isset($subCategoryData['attr'])) {
						$subCategory->attributes()->sync($subCategoryData['attr']);
					}
				}
			}
		}
	}
}
