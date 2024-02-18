@extends('admin.layouts.app')
@section('content')
    <div class="row justify-content-center ">
        <div class="col-10">
            <div class="container-xl bg-white rounded my-3 p-3">
                <div class="h3">
                    Create a new's category
                </div>
                <form action="{{ route('admin.news_categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="name_ru">Name RU</label>
                                <input type="text" class="form-control" id="name_ru" name="name_ru" value="{{ old('name_ru') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="name_ru">Name EN</label>
                                <input type="text" class="form-control" id="name_en" name="name_en" value="{{ old('name_en') }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}>
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