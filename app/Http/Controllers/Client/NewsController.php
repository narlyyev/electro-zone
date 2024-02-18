<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
	{
		$config = Config::first();

		$news = News::orderBy('id', 'desc')
			->get();

		return view('client.news.index')
			->with([
				'news' => $news,
				'config' => $config,
			]);
	}

	public function show($slug)
	{
		$config = Config::first();

		$news = News::where('slug', $slug)
			->orderBy('id', 'desc')
			->firstOrFail();

		return view('client.news.show')
			->with([
				'config' => $config,
				'news' => $news,
			]);
	}
}
