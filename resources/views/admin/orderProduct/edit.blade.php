@extends('admin.layouts.app')
@section('title') Orders @endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-10 col-md-8 col-lg-6 col-xl-4">
        <div class="bg-white my-3 p-4 rounded-3">
            <div class="h3 mb-3">
                <a href="{{ route('admin.orders.index') }}"><i class="bi-arrow-left-circle"></i></a>
                Sargytlar
            </div>

            <form action="{{ route('admin.orderProducts.update', $obj->id) }}" method="post">
                {{ method_field('PUT') }}
                @csrf

                <div class="mb-3">
                    <label for="price" class="form-label fw-semibold">
                        Bahasy <span class="text-danger">*</span>
                    </label>
                    <input id="price" type="number" min="0" step="0.1" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" value="{{ $obj->price }}" name="price" required autofocus>
                    @if($errors->has('price'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('price') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="quantity" class="form-label fw-semibold">
                        Sany <span class="text-danger">*</span>
                    </label>
                    <input id="quantity" type="number" min="0" class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}" value="{{ $obj->quantity }}" name="quantity" required>
                    @if($errors->has('quantity'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('quantity') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="discount_percent" class="form-label fw-semibold">
                        Arzanladyş bahasy <span class="text-danger">*</span>
                    </label>
                    <input id="discount_percent" type="number" min="0" class="form-control{{ $errors->has('discount_percent') ? ' is-invalid' : '' }}" value="{{ $obj->discount_percent }}" name="discount_percent" required>
                    @if($errors->has('discount_percent'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('discount_percent') }}</strong>
                    </span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary"><i class="bi-save"></i> @lang('app.update')</button>
            </form>
        </div>
    </div>
</div>
@endsection