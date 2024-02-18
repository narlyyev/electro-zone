<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductView extends Model
{
	protected $guarded = [
		'id',
	];

	protected $casts = [
		'date' => 'date',
	];

	public $timestamps = false;
}
