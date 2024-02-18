@extends('admin.layouts.app')
@section('content')
    <div class="row justify-content-center ">
        <div class="col-11">
            <div class="container-xl rounded my-3 p-3">
                <div class="h3">
                    Create the news
                </div>
                <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="bg-white p-4 rounded-3">
                        <div class="form-group mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" id="category_id" class="form-control select2">
                                <option selected value>No</option>
                                @foreach($newsCategories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-4 mb-3">
                                <label for="name" class="form-label">Name TM</label>
                                <input type="text" class="form-control" id="name" placeholder="Write a name" name="name"
                                       value="{{ old('name') }}">
                            </div>
                            <div class="col-4 mb-3">
                                <label for="name" class="form-label">Name RU</label>
                                <input type="text" class="form-control" id="name" placeholder="Write a name" name="name_ru"
                                       value="{{ old('name_ru') }}">
                            </div>
                            <div class="col-4 mb-3">
                                <label for="name" class="form-label">Name EN</label>
                                <input type="text" class="form-control" id="name" placeholder="Write a name" name="name_en"
                                       value="{{ old('name_en') }}">
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-3 p-4 my-3">
                        <div class="mb-3">
                            <label for="description">Description TM</label>
                            <textarea class="form-control summernote" id="description" rows="3"
                                      name="description">{{ old('description') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="description_ru">Description RU</label>
                            <textarea class="form-control summernote" id="description_ru" rows="3"
                                      name="description_ru">{{ old('description_ru') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="description_en">Description EN</label>
                            <textarea class="form-control summernote" id="description_en" rows="3"
                                      name="description_en">{{ old('description_en') }}</textarea>
                        </div>
                    </div>
                    <div class="bg-white rounded-3 p-4 mb-3">
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input class="form-control" type="file" id="image" name="image">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary px-4">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#image').dropify();
        });
    </script>
@endsection