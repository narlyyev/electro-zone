<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class NewsController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('can:news');
	}

	public function index()
	{
		return view('admin.news.index');
	}

	public function create()
	{
		$newsCategories = NewsCategory::orderBy('id', 'desc')
			->get();
		return view('admin.news.create')
			->with([
				'newsCategories' => $newsCategories,
			]);
	}

	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required|string|unique:news,name',
			'name_ru' => 'required|string|unique:news,name_ru',
			'name_en' => 'required|string|unique:news,name_en',
			'description' => 'required|string',
			'description_ru' => 'required|string',
			'description_en' => 'required|string',
			// 'image' => 'nullable|image|mimes:jpg,jpeg,png|max:48|dimensions:width=220,height=180',
		]);

		$news = News::create([
			'name' => $request->name,
			'name_ru' => $request->name_ru,
			'name_en' => $request->name_en,
			'category_id' => $request->category_id,
			'description' => $request->description,
			'description_ru' => $request->description_ru,
			'description_en' => $request->description_en,
			'is_active' => $request->is_active ? 1 : 0,
		]);
		if ($request->has('image')) {
			$name = str()->random(10) . '.png';
			Storage::putFileAs('public/img/news', $request->image, $name);
			$news->image = $name;
			$news->update();
		}

		return redirect()->route('admin.news.index')
			->with([
				'success' => 'Habar ' . '<b>' . $news->name . '</b>' . ' döredildi'
			]);
	}

	public function edit($id)
	{
		$newsCategories = NewsCategory::orderBy('id', 'desc')
			->get();
		$news = News::findOrFail($id);

		return view('admin.news.edit')
			->with([
				'news' => $news,
				'newsCategories' => $newsCategories,
			]);
	}

	public function update(Request $request, $id)
	{
		$request->validate([
			'name' => 'required|string',
			// 'image' => 'nullable|image|mimes:jpg,jpeg,png|max:48|dimensions:width=200,height=200',
		]);

		$news = News::findOrFail($id);
		$news->update([
			'category_id' => $request->category_id,
			'name' => $request->name,
			'name_ru' => $request->name_ru,
			'name_en' => $request->name_en,
			'description' => $request->description,
			'description_ru' => $request->description_ru,
			'description_en' => $request->description_en,
			'is_active' => $request->is_active ? 1 : 0,
		]);

		if ($request->has('image')) {
			if ($news->image) {
				Storage::delete('public/img/news/' . $news->image);
			}
			$name = str()->random(10) . '.png';
			Storage::putFileAs('public/img/news/', $request->image, $name);
			$news->image = $name;
		}
		$news->update();

		return redirect()->route('admin.news.index')
			->with([
				'success' => 'Habar ' . '<b>' . $news->name . '</b>' . ' üýtgedildi'
			]);
	}

	public function destroy($id)
	{
		$news = News::findOrFail($id);

		if ($news->image) {
			Storage::delete('public/img/news/' . $news->image);
		}
		$news->delete();

		return redirect()->route('admin.news.index')
			->with([
				'success' => 'Habar ' . '<b>' . $news->name . '</b>' . ' pozuldy'
			]);
	}

	public function active(Request $request)
	{
		$request->validate([
			'id' => 'required|integer|min:0',
		]);

		$news = News::findOrFail($request->id);
		$news->is_active = $news->is_active ? 0 : 1;
		$news->save();

		return response()->json([
			'status' => '1',
			'is_active' => $news->is_active,
		], Response::HTTP_OK);
	}


	public function api(Request $request)
	{
		$request->validate([
			'category_id' => 'nullable|integer|min:0',
		]);

		$f_category = $request->category_id ?: null;

		$columns = [
			0 => 'id',
			1 => 'image',
			2 => 'name',
			3 => 'category', // Assuming you want to display the category name
			4 => 'is_active',
		];

		$totalData = News::count();
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');

		$query = News::with('category') // Eager load the category relationship
		->when($f_category, function ($q) use ($f_category) {
			return $q->where('category_id', $f_category);
		});

		if (!$request->input('search.value')) {
			$rs = $query->with('category')
				->offset($start)
				->limit($limit)
				->orderBy($order, $dir)
				->orderBy('id', 'desc')
				->get();
			$totalFiltered = $query->count();
		} else {
			$search = $request->input('search.value');
			$rs = $query->with('category') // Eager load the category relationship
			->where(function ($q) use ($search) {
				$q->orWhere('id', 'like', "%{$search}%")
					->orWhere('name', 'like', "%{$search}%")
					->orWhere('name_ru', 'like', "%{$search}%")
					->orWhere('name_en', 'like', "%{$search}%")
					->orWhere('slug', 'like', "%{$search}%");
			})
				->offset($start)
				->limit($limit)
				->orderBy($order, $dir)
				->orderBy('id', 'desc')
				->get();
			$totalFiltered = $query->where(function ($q) use ($search) {
				$q->orWhere('id', 'like', "%{$search}%")
					->orWhere('name', 'like', "%{$search}%")
					->orWhere('name_ru', 'like', "%{$search}%")
					->orWhere('name_en', 'like', "%{$search}%")
					->orWhere('slug', 'like', "%{$search}%");
			})
				->count();
		}

		$data = array();
		if ($rs) {
			foreach ($rs as $r) {
				$nestedData['id'] = $r->id;
				$nestedData['image'] = $r->image ? '<img src="' . asset('storage/img/news/' . $r->image) . '" alt="' . $r->image . '" class="p-1 rounded" width="95px">' : '<img src="' . asset('img/product.jpg') . '" alt="product" class="p-1 rounded" width="95px">';
				$nestedData['category'] = '<div class="h6 text-center text-danger pt-3">' . $r->category->getName() . '</div>';
				$nestedData['name'] = '<div class="mb-1">' . $r->name . '</div>'
					. '<div class="mb-1"><span class="font-monospace text-primary">RU</span> ' . $r->name_ru . '</div>'
					. '<div class="mb-1"><span class="font-monospace text-primary">EN</span> ' . $r->name_en . '</div>';
				$nestedData['is_active'] = '<div class="form-check form-switch">'
					. '<input class="form-check-input check-is_active" type="checkbox" role="switch" value="' . $r->id . '" id="check' . $r->id . '" ' . ($r->is_active ? 'checked' : '') . '>'
					. '<label class="form-check-label" for="check' . $r->id . '">' . 'Aktiw' . '</label>'
					. '</div>';
				$nestedData['action'] = '<a href="' . route('admin.news.edit', $r->id) . '" class="btn btn-success btn-sm my-1"><i class="bi-pencil"></i></a>'
					. '<form action="' . route('admin.news.destroy', $r->id) . '" method="post">' . csrf_field() . method_field('DELETE')
					. '<button type="submit" class="btn btn-dark btn-sm my-1"><i class="bi-trash"></i></button></form>';
				$data[] = $nestedData;
			}
		}

		$json_data = [
			'draw' => intval($request->input('draw')),
			'recordsTotal' => intval($totalData),
			'recordsFiltered' => intval($totalFiltered),
			'data' => $data,
		];
		return response()->json($json_data);
	}
}
