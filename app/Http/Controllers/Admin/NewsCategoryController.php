<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsCategory;
use Illuminate\Http\Request;

class NewsCategoryController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('can:news_categories');
	}

	public function index()
	{
		$newsCategories = NewsCategory::orderBy('id', 'desc')
			->get();

		return view('admin.news_categories.index')
			->with([
				'newsCategories' => $newsCategories,
			]);
	}

	public function create()
	{
		return view('admin.news_categories.create');
	}

	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required|string|max:100|unique:news_categories,name',
			'name_ru' => 'required|string|max:100|unique:news_categories,name_ru',
			'name_en' => 'required|string|max:100|unique:news_categories,name_en',
			'is_active' => 'nullable|boolean',
		]);

		$newsCategory = NewsCategory::create([
			'name' => $request->name,
			'name_ru' => $request->name_ru,
			'name_en' => $request->name_en,
			'is_active' => $request->is_active ? 1 : 0,
		]);

		return redirect()->route('admin.news_categories.index')
			->with([
				'success' => 'Habarlaryň kategoriýasy ' . '<b>' . $newsCategory->name . '</b>' . ' döredildi'
			]);
	}

	public function edit($id)
	{
		$newsCategory = NewsCategory::findOrFail($id);

		return view('admin.news_categories.edit')
			->with([
				'newsCategory' => $newsCategory,
			]);
	}

	public function update(Request $request, $id)
	{
		$request->validate([
			'name' => 'nullable|string|max:100',
			'name_ru' => 'nullable|string|max:100',
			'name_en' => 'nullable|string|max:100',
			'is_active' => 'nullable|boolean',
		]);

		$newsCategory = NewsCategory::findOrFail($id);
		$newsCategory->update([
			'name' => $request->name,
			'name_ru' => $request->name_ru,
			'name_en' => $request->name_en,
			'is_active' => $request->is_active ? 1 : 0,
		]);

		return redirect()->route('admin.news_categories.index')
				->with([
					'success' => 'Habarlaryň kategoriýasy ' . '<b>' . $newsCategory->name . '</b>' . ' üýtgedildi'
				]);
	}

	public function destroy($id)
	{
		$newsCategory = NewsCategory::findOrFail($id);

		$newsCategory->delete();

		return redirect()->route('admin.news_categories.index')
			->with([
				'success' => 'Habarlaryň kategoriýasy ' . '<b>' . $newsCategory->name . '</b>' . ' pozuldy'
			]);
	}

}
