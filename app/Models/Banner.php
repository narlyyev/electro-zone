<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public $timestamps = false;

	public $fillable = [
		'image',
		'image_ru',
		'start_date',
		'end_date',
	];
}
