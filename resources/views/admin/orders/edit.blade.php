@extends('admin.layouts.app')
@section('title') @lang('app.orders') @endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5">
        <div class="bg-white my-3 p-4 rounded-3">
            <div class="h3 mb-3">
                <a href="{{ route('admin.orders.index') }}"><i class="bi-arrow-left-circle"></i></a>
                Sargytlar
            </div>

            <form action="{{ route('admin.orders.update', $product->id) }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="location" class="form-label fw-semibold">
                        Ýer <span class="text-danger">*</span>
                    </label>
                    <select id="location" class="form-select{{ $errors->has('location') ? ' is-invalid' : '' }}" name="location" required autofocus>
                        @foreach($locations as $location)
                        <option value="{{ $location->id }}" {{ $product->location_id == $location->id ? 'selected':'' }}>{{ $location->getName() }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">
                        @lang('app.name') <span class="text-danger">*</span>
                    </label>
                    <input id="name" type="text" maxlength="50" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $product->customer_name }}" name="name" required>
                    @if($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label fw-semibold">
                        @lang('app.phone') <span class="text-danger">*</span>
                    </label>
                    <input id="phone" type="number" min="60000000" max="65999999" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ $product->customer_phone }}" name="phone" required>
                    @if($errors->has('phone'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label fw-semibold">
                        @lang('app.address') <span class="text-danger">*</span>
                    </label>
                    <input id="address" type="text" minlength="5" maxlength="255" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" value="{{ $product->customer_address }}" name="address" required>
                    @if($errors->has('address'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="note" class="form-label fw-semibold">
                        @lang('app.note')
                    </label>
                    <input id="note" type="text" maxlength="255" class="form-control{{ $errors->has('note') ? ' is-invalid' : '' }}" value="{{ $product->customer_note }}" name="note">
                    @if($errors->has('note'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('note') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="mb-3">
                    <input type="radio" class="btn-check" name="status" id="status0" value="0" autocomplete="off" {{ $product->status == 0 ? 'checked' : '' }}>
                    <label class="btn btn-warning" for="status0">Garaşylýar</label>

                    <input type="radio" class="btn-check" name="status" id="status1" value="1" autocomplete="off" {{ $product->status == 1 ? 'checked' : '' }}>
                    <label class="btn btn-light" for="status1">Kabul edildi</label>

                    <input type="radio" class="btn-check" name="status" id="status2" value="2" autocomplete="off" {{ $product->status == 2 ? 'checked' : '' }}>
                    <label class="btn btn-info" for="status2">Dowam edýär</label>

                    <input type="radio" class="btn-check" name="status" id="status3" value="3" autocomplete="off" {{ $product->status == 3 ? 'checked' : '' }}>
                    <label class="btn btn-success" for="status3">Tamamlandy</label>

                    <input type="radio" class="btn-check" name="status" id="status4" value="4" autocomplete="off" {{ $product->status == 4 ? 'checked' : '' }}>
                    <label class="btn btn-danger" for="status4">Ýatyryldy</label>
                </div>

                <button type="submit" class="btn btn-primary"><i class="bi-save"></i>Üýtget</button>
            </form>
        </div>
    </div>
</div>
@endsection