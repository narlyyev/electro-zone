@extends('admin.layouts.app')
@section('content')
<div class="row justify-content-center ">
    <div class="col-11">
        <div class="container-xl rounded my-3 p-3">
            <div class="h3">
                Edit an attribute
            </div>
            <form action="{{ route('admin.attributes.update', $attribute->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="bg-white rounded-3 p-4 mb-3">
                    <div class="row">
                        <div class="col-4 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $attribute->name }}">
                        </div>
                        <div class="col-4 mb-3">
                            <label for="name_ru" class="form-label">Name RU</label>
                            <input type="text" class="form-control" id="name_ru" name="name_ru" value="{{ $attribute->name_ru }}">
                        </div>
                        <div class="col-4 mb-3">
                            <label for="name_ru" class="form-label">Name EN</label>
                            <input type="text" class="form-control" id="name_en" name="name_en" value="{{ $attribute->name_en }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="sort_order">Sort Order<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="sort_order" name="sort_order" value="{{ $attribute->sort_order }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary px-4">
                    Submit
                </button>
            </form>
        </div>
    </div>
</div>
@endsection