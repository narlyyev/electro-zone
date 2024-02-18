<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
	{
		$config = Config::first();

		return view('client.contact.index')
			->with([
				'config' => $config,
			]);
	}
}
