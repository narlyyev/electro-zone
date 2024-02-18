@extends('admin.layouts.app')
@section('content')
    <div class="row justify-content-center ">
        <div class="col-11">
            <div class="container-xl rounded my-3 p-3">
                <div class="h3">
                    Edit the news
                </div>
                <form action="{{ route('admin.news.update', $news->id) }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="bg-white p-4 rounded-3">
                        <div class="form-group mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" id="category_id" class="form-control select2">
                                <option value="">No</option>
                                @foreach($newsCategories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $news->category_id ? 'selected' : '' }}>
                                        {{ $category->getName() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-4 mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Write a name" name="name"
                                       value="{{ $news->name }}">
                            </div>
                            <div class="col-4 mb-3">
                                <label for="name_ru" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name_ru" placeholder="Write a name" name="name_ru"
                                       value="{{ $news->name_ru }}">
                            </div>
                            <div class="col-4 mb-3">
                                <label for="name_en" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name_en" placeholder="Write a name" name="name_en"
                                       value="{{ $news->name_en }}">
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-3 p-4 my-4">
                        <div class="mb-3">
                            <label for="name" class="form-label">Description TM</label>
                            <textarea type="text" class="form-control summernote" id="name"
                                      name="description">{{ $news->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="description_ru" class="form-label">Description RU</label>
                            <textarea type="text" class="form-control summernote" id="description_ru"
                                      name="description_ru">{{ $news->description_ru }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="description_en" class="form-label">Description EN</label>
                            <textarea type="text" class="form-control summernote" id="description_en"
                                      name="description_en">{{ $news->description_en }}</textarea>
                        </div>
                    </div>
                    <div class="bg-white rounded-3 p-4 mb-4">
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input class="form-control" type="file" id="image" name="image"
                                   data-default-file="{{ asset('storage/img/news/' . $news->image) }}">
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