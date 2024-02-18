@extends('admin.layouts.app')
@section('content')
<div class="row justify-content-center ">
    <div class="col-11">
        <div class="container-xl rounded my-3 p-3">
            <div class="h3">
                Create a category
            </div>
            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="bg-white rounded-3 p-4">
                    <div class="row">
                        <div class="col-6 form-group mb-3">
                            <label for="parent_id" class="form-label">Parent<span class="text-danger">*</span></label>
                            <select name="parent_id" id="parent_id" class="form-control select2">
                                <option selected value>No</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->getName() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="sort_order">Sort Order<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="sort_order" name="sort_order" value="{{ old('sort_order') }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="attribute" class="form-label fw-semibold">
                            Attribute
                        </label>
                        <select id="attribute" class="form-select{{ $errors->has('attribute') ? ' is-invalid' : '' }} select2" name="attributes[]" multiple>
                            @foreach($attributes as $attribute)
                                <option value="{{ $attribute->id }}">{{ $attribute->getName() }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('attribute'))
                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('attribute') }}</strong>
                    </span>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-4 mb-3">
                            <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                        </div>
                        <div class="col-4 mb-3">
                            <label for="name_ru" class="form-label">Name RU</label>
                            <input type="text" class="form-control" id="name_ru" name="name_ru" value="{{ old('name_ru') }}">
                        </div>
                        <div class="col-4 mb-3">
                            <label for="name_en" class="form-label">Name EN</label>
                            <input type="text" class="form-control" id="name_en" name="name_en" value="{{ old('name_en') }}">
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-3 p-4 my-4">
                    <div class="mb-3">
                        <label for="small_image" class="form-label">Kiçi surat</label>
                        <input class="form-control" type="file" id="small_image" name="small_image">
                    </div>
                    <div class="mb-3">
                        <label for="big_image" class="form-label">Uly surat</label>
                        <input class="form-control" type="file" id="big_image" name="big_image">
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
        $('#small_image').dropify();
        $('#big_image').dropify();
    });
</script>
@endsection