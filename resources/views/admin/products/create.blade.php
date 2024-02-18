@extends('admin.layouts.app')
@section('content')
    <div class="row justify-content-center ">
        <div class="col-11">
            <div class="container-xl bg-white rounded-3 my-3 p-4">
                <div class="h3">
                    Create a product
                </div>
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row align-items-center">
                        <div class="col-4 form-group mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" id="category_id" class="form-control select2">
                                <option selected value>No</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-4 form-group mb-3">
                            <label for="brand_id" class="form-label">Brand</label>
                            <select name="brand_id" id="brand_id" class="form-control select2">
                                <option selected value>No</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-4 form-group mb-3">
                            <label for="color_id" class="form-label">Color</label>
                            <select name="color_id" id="color_id" class="form-control select2">
                                <option selected value>No</option>
                                @foreach($colors as $color)
                                    <option value="{{ $brand->id }}">
                                        {{ $color->getName() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row align-items-center">
                        <div class="col-4 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                        </div>
                        <div class="col-4 mb-3">
                            <label for="name_ru" class="form-label">Name RU</label>
                            <input type="text" class="form-control" id="name_ru" name="name_ru" value="{{ old('name_ru') }}">
                        </div>
                        <div class="col-4 mb-3">
                            <label for="name_ru" class="form-label">Name RU</label>
                            <input type="text" class="form-control" id="name_ru" name="name_ru" value="{{ old('name_ru') }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 mb-3">
                            <label for="barcode">Barcode</label>
                            <input type="number" class="form-control" id="barcode" name="barcode"
                                   value="{{ old('barcode') }}">
                        </div>
                        <div class="col-3 mb-3">
                            <label for="price">Price</label>
                            <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}">
                        </div>
                        <div class="col-3 mb-3">
                            <label for="stock">Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock') }}">
                        </div>
                        <div class="col-3 mb-3">
                            <label for="groupCode">Group code</label>
                            <input type="text" class="form-control" id="groupCode" name="group_code" value="{{ old('group_code') }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3">
                            <label for="description">Description</label>
                            <textarea class="form-control summernote" id="description" rows="3"
                                      name="description">{{ old('description') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="description_ru">Description RU</label>
                            <textarea class="form-control summernote" id="description_ru" rows="3"
                                      name="description_ru">{{ old('description_ru') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="description_ru">Description EN</label>
                            <textarea class="form-control summernote" id="description_en" rows="3"
                                      name="description_en">{{ old('description_en') }}</textarea>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input class="form-control" type="file" name="image" id="image">
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
