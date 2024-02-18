<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;

class AboutController extends Controller
{
	public function index()
	{
		$config = Config::first();

		return view('client.about.index')
			->with([
				'config' => $config,
			]);
	}

}
