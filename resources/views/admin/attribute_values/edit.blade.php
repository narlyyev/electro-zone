@extends('admin.layouts.app')
@section('content')
<div class="row justify-content-center ">
    <div class="col-11">
        <div class="container-xl rounded my-3 p-3">
            <div class="h3">
                Edit a value
            </div>
            <form action="{{ route('admin.attribute_values.update', $attributeValue->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="bg-white rounded-3 p-4 mb-4">
                    <div class="form-group mb-3">
                        <label for="attribute_id" class="form-label">Attribute</label>
                        <select name="attribute_id" id="attribute_id" class="form-control select2">
                            <option selected value>No</option>
                            @foreach($attributes as $attr)
                                <option value="{{ $attr->id }}" {{ $attributeValue->attribute->id == $attr->id ? 'selected' : '' }}>
                                    {{ $attr->getName() }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-3 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $attributeValue->name }}">
                        </div>
                        <div class="col-3 mb-3">
                            <label for="name_ru" class="form-label">Name RU</label>
                            <input type="text" class="form-control" id="name_ru" name="name_ru" value="{{ $attributeValue->name_ru }}">
                        </div>
                        <div class="col-3 mb-3">
                            <label for="name_en" class="form-label">Name EN</label>
                            <input type="text" class="form-control" id="name_en" name="name_en" value="{{ $attributeValue->name_en }}">
                        </div>
                        <div class="col-3 mb-3">
                            <label for="sort_order" class="form-label">Sort Order<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="sort_order" name="sort_order" value="{{ $attributeValue->sort_order }}">
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