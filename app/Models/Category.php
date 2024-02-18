<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable =
        [
            'parent_id',
            'name',
            'name_ru',
            'name_en',
            'slug',
            'sort_order',
            'is_home',
        ];

    public $timestamps = false;

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

	protected static function booted()
	{
		static::saving(function ($obj) {
			$obj->slug = Str::slug($obj->name, '-');
		});
	}

	public function attributes()
	{
		return $this->belongsToMany(Attribute::class, 'category_attributes');
	}

	public function products()
	{
		return $this->hasMany(Product::class);
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
}
