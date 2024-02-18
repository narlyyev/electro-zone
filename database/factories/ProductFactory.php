<?php

namespace Database\Factories;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
	public function configure()
	{
		return $this->afterMaking(function (Product $product) {
			//
		})->afterCreating(function (Product $product) {
			$product->save();

			$attributes = Attribute::with('attributeValues')
				->where('name' , '!=', 'Reňk')
				->orderBy('id', 'desc')
				->get();

			$values = [];
			foreach ($attributes as $attribute) {
				$values[] = $attribute->attributeValues->random()->id;
			}

			$product->attributeValues()->sync($values);
		});
	}

	// Inside your ProductFactory
	public function definition(): array
	{
		$category = Category::doesntHave('children')->inRandomOrder()->first();
		$brand = Brand::inRandomOrder()->first();
		$color = AttributeValue::where('attribute_id', 1)->inRandomOrder()->first();
		$hasDiscount = $this->faker->boolean(40);
		$isRecommended = $this->faker->boolean(50);

		// Get a random image from local storage
		$image = $this->getRandomLocalImage();

		return [
			'category_id' => $category->id,
			'brand_id' => $brand->id,
			'color_id' => $color->id,
			'group_code' => $this->faker->postcode,
			'name' => $this->faker->unique()->streetName,
			'name_ru' => $this->faker->unique()->streetName,
			'slug' => str('name')->slug('-'),
			'description' => $this->faker->text(300),
			'description_ru' => $this->faker->text(300),
			'barcode' => $this->faker->unique()->isbn13(),
			'price' => $this->faker->randomFloat(1, 100, 3000),
			'stock' => rand(0, 100),
			'discount_percent' => $hasDiscount ? rand(10, 20) : 0,
			'discount_start' => $hasDiscount
				? Carbon::today()->subDays(rand(1, 7))->subHours(rand(1, 24))->subMinutes(rand(1, 60))->toDateTimeString()
				: Carbon::today()->startOfMonth()->toDateTimeString(),
			'discount_end' => $hasDiscount
				? Carbon::today()->addDays(rand(1, 7))->addHours(rand(1, 24))->addMinutes(rand(1, 60))->toDateTimeString()
				: Carbon::today()->startOfMonth()->toDateTimeString(),
			'is_active' => 1,
			'sold' => rand(1, 20),
			'is_recommended' => $isRecommended ? 1 : 0,
			'viewed' => rand(0, 40),
			'created_at' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),
			'image' => $image,
		];
	}

	protected function getRandomLocalImage(): ?string
	{
		$imageFolder = public_path('storage/techno-products');

		$imageFiles = glob($imageFolder . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE);

		if (empty($imageFiles)) {
			return null;
		}

		$randomImage = $imageFiles[array_rand($imageFiles)];

		return str_replace(public_path(), '', $randomImage);
	}
}
