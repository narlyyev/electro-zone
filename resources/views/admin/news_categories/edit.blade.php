@extends('admin.layouts.app')
@section('content')
    <div class="row justify-content-center ">
        <div class="col-10">
            <div class="container-xl bg-white rounded my-3 p-3">
                <div class="h3">
                    Edit a news's category
                </div>
                <form action="{{ route('admin.news_categories.update', $newsCategory->id) }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="name" class="form-label">Name TM</label>
                            <input type="text" class="form-control" id="name" placeholder="Write a name" name="name"
                                   value="{{ $newsCategory->name }}">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="name_ru" class="form-label">Name RU</label>
                            <input type="text" class="form-control" id="name_ru" placeholder="Write a name" name="name_ru"
                                   value="{{ $newsCategory->name_ru }}">
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="name_en" class="form-label">Name EN</label>
                                <input type="text" class="form-control" id="name_en" placeholder="Write a name" name="name_en"
                                       value="{{ $newsCategory->name_en }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <input type="checkbox" class="form-check-input" id="is_active" name="is_active"
                                       value="1" {{ $newsCategory->is_active == 1 ? 'checked' : '' }}>
                                <label for="is_active">Active</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary w-100">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection