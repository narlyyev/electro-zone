<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	use HasFactory;

	protected $fillable = ['group_code', 'category_id', 'brand_id', 'color_id', 'name', 'name_ru', 'name_en', 'slug', 'description', 'description_ru', 'description_en', 'barcode', 'price', 'stock', 'discount_percent', 'discount_start', 'discount_end', 'image', 'is_active', 'sold', 'is_recommended', 'viewed',];

	protected $casts = [
		'discount_start' => 'datetime',
		'discount_end' => 'datetime',
		'image_updated_at' => 'datetime',
		'created_at' => 'datetime',
	];

	protected static function booted()
	{
		static::creating(function ($product) {
			$product->slug = str($product->name)->slug('-');
		});


		static::updating(function ($product) {
			$product->slug = str($product->name)->slug('-');
		});
	}

	public function orderProducts()
	{
		return $this->hasMany(OrderProduct::class);
	}

	CONST UPDATED_AT = null;

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function brand()
	{
		return $this->belongsTo(Brand::class);
	}

	public function color()
	{
		return $this->belongsTo(AttributeValue::class, 'color_id');
	}

	public function attributeValues()
	{
		return $this->belongsToMany(AttributeValue::class, 'product_attribute_values');
	}

	public function hasDiscount()
	{
		if ($this->discount_start <= Carbon::now()->toDateTimeString() and $this->discount_end >= Carbon::now()->toDateTimeString() and $this->discount_percent > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function discountPercent()
	{
		if ($this->discount_start <= Carbon::now() and $this->discount_end >= Carbon::now() and $this->discount_percent > 0) {
			return $this->discount_percent;
		} else {
			return 0;
		}
	}

	public function discountPrice()
	{
		if ($this->hasDiscount()) {
			return round($this->price * (1 - $this->discount_percent / 100), 1);
		}
	}

	public function price()
	{
		return round($this->price, 1);
	}

	public function isNew()
	{
		if ($this->created_at <= Carbon::now()->subMonths(2)) {
			return true;
		} else {
			return false;
		}
	}

	public function inStock()
	{
		if ($this->stock > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function bestSeller()
	{
		if ($this->sold > 5) {
			return true;
		} else {
			return false;
		}
	}

	public function scopeFilterQuery($query, $f_category, $f_brand, $f_hasDiscount, $f_hasStock)
	{
		return $query
			->when($f_category, function ($query) use ($f_category) {
				if ($f_category == 0) {
					return $query->doesntHave('category');
				} else {
					return $query->whereHas('category', function ($query) use ($f_category) {
						$query->where('id', $f_category);
					});
				}
			})
			->when($f_brand, function ($query) use ($f_brand) {
				if ($f_brand == 0) {
					return $query->doesntHave('brand');
				} else {
					return $query->whereHas('brand', function ($query) use ($f_brand) {
						$query->where('id', $f_brand);
					});
				}
			})
			->when(isset($f_hasDiscount), function ($query) {
				return $query->where('discount_percent', '>', 0)
					->where('discount_start', '<=', Carbon::now())
					->where('discount_end', '>=', Carbon::now());
			})
			->when(isset($f_hasStock), function ($query) {
				return $query->where('stock', '>', 0);
			});
	}


	public function getName()
	{
		$locale = app()->getLocale();
		switch ($locale) {
			case 'tm':
				return $this->name;
				break;
			case 'ru':
				return $this->name_ru ?: $this->name;
				break;
			default:
				return $this->name;
		}
	}

	public function getDiscountEnd()
	{
		$diff = Carbon::parse($this->discount_start)->diffInDays(Carbon::now());
		return Carbon::parse($this->discount_end)->subWeeks(intval($diff / 7));
	}

	public function getColorName()
	{
		$locale = app()->getLocale();
		switch ($locale) {
			case 'tm':
				return $this->color->name;
				break;
			case 'ru':
				return $this->color->name_ru ?: $this->color->name;
				break;
			default:
				return $this->color->name;
		}
	}

	public function getDescription()
	{
		$locale = app()->getLocale();
		switch ($locale) {
			case 'tm':
				return $this->description;
				break;
			case 'ru':
				return $this->description_ru ?: $this->description;
				break;
			default:
				return $this->description;
		}
	}

}
