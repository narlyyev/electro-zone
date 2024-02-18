@extends('admin.layouts.app')
@section('content')
    <div class="row justify-content-center ">
        <div class="col-11">
            <div class="container-xl bg-white rounded my-3 p-3">
                <div class="h3">
                    Edit a product
                </div>
                <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-4 form-group mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" id="category_id" class="form-control select2">
                                <option value="No">No</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                        {{ $category->getName() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-4 form-group mb-3">
                            <label for="brand_id" class="form-label">Brand</label>
                            <select name="brand_id" id="brand_id" class="form-control select2">
                                <option value="No">No</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ $brand->id == $product->brand_id ? 'selected' : '' }}>
                                        {{ $brand->getName() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-4 form-group mb-3">
                            <label for="color_id" class="form-label">Color</label>
                            <select name="color_id" id="color_id" class="form-control select2">
                                <option value>No</option>
                                @foreach($colors as $color)
                                    <option value="{{ $color->id }}" {{ $color->id == $product->color_id ? 'selected' : '' }}>
                                        {{ $color->getName() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @foreach($categories as $category)
                        <div class="row">
                            @foreach($category['attributes'] as $attribute)
                                <div class="col">
                                    <div class="mb-3">
                                        @if($category->id == $product->category->id)
                                            <label for="attribute{{ $attribute->id }}" class="form-label fw-semibold">
                                                {{ $attribute->getName() }}
                                            </label>
                                            <select id="attribute{{ $attribute->id }}"
                                                    class="form-select{{ $errors->has('attributeValues') ? ' is-invalid' : '' }} select2"
                                                    name="attribute_values[]" multiple>
                                                <option value="0"></option>
                                                @foreach($attribute->attributeValues as $attributeValue)
                                                    <option value="{{ $attributeValue->id }}" {{ $product->attributeValues->contains($attributeValue->id) ? 'selected':'' }}>{{ $attributeValue->getName() }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach


                    <div class="row">
                        <div class="col-4 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
                        </div>
                        <div class="col-4 mb-3">
                            <label for="name_ru" class="form-label">Name RU</label>
                            <input type="text" class="form-control" id="name_ru" name="name_ru" value="{{ $product->name_ru }}">
                        </div>
                        <div class="col-4 mb-3">
                            <label for="name_en" class="form-label">Name EN</label>
                            <input type="text" class="form-control" id="name_en" name="name_en" value="{{ $product->name_en }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 mb-3">
                            <label for="barcode">Barcode</label>
                            <input type="number" class="form-control" id="barcode" name="barcode" value="{{ $product->barcode }}">
                        </div>
                        <div class="col-3 mb-3">
                            <label for="price">Price</label>
                            <input type="text" class="form-control" id="price" name="price" value="{{ $product->price }}">
                        </div>
                        <div class="col-3 mb-3">
                            <label for="stock">Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock" value="{{ $product->stock }}">
                        </div>
                        <div class="col-3 mb-3">
                            <label for="groupCode" class="form-label">Group Code</label>
                            <input type="text" class="form-control" id="groupCode" name="group_code" value="{{ $product->group_code }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description">Description</label>
                        <textarea class="form-control summernote" id="description" rows="3" name="description">{{ $product->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="description_ru">Description RU</label>
                        <textarea class="form-control summernote" id="description_ru" rows="3"
                                  name="description_ru">{{ $product->description_ru }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="description_en">Description EN</label>
                        <textarea class="form-control summernote" id="description_en" rows="3"
                                  name="description_en">{{ $product->description_en }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input class="form-control" type="file" name="image" id="image"
                               data-default-file="{{ asset('storage/products/sm' . '/' . $product->image) }}">
                    </div>
                    <div class="row">
                        <div class="col-4 mb-3">
                            <label for="discp">Discount percent</label>
                            <input type="number" class="form-control" id="discp" name="discount_percent" value="{{ $product->discount_percent }}">
                        </div>
                        <div class="col-4 mb-3">
                            <label for="discs">Discount start</label>
                            <input type="datetime-local" class="form-control" id="discs" name="discount_start" value="{{ $product->discount_start }}">
                        </div>
                        <div class="col-4 mb-3">
                            <label for="disce">Discount end</label>
                            <input type="datetime-local" class="form-control" id="disce" name="discount_end" value="{{ $product->discount_end }}">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary w-100">
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


<style>
    .selected-option {
        background-color: red !important;
    }
</style>
