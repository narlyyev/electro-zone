@extends('client.layouts.app')
@section('title')@lang('app.order')@endsection
@section('content')
    <div class="container-xl py-3">
        <div class="row align-items-center">

            <h2>{{ $errors }}</h2>

            <div class="col-12 col-md-7 col-lg-6">
                <form action="{{ route('order') }}" method="post">
                    @csrf
                    @honeypot
                    <div class="mb-3">
                        <label for="o-location" class="form-label">
                            @lang('app.location') <span class="text-danger">*</span>
                        </label>
                        <select id="o-location" class="form-select{{ $errors->has('location') ? ' is-invalid' : '' }} select2-container" name="location" required>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}">{{ $location->getName() }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="o-name" class="form-label">
                            @lang('app.name') <span class="text-danger">*</span>
                        </label>
                        <input id="o-name" type="text" maxlength="50" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="o-phone" class="form-label">
                            @lang('app.phone') <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">+993</span>
                            <input id="o-phone" type="number" min="60000000" max="65999999" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}" name="phone" aria-label="@lang('app.phone')" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="o-address" class="form-label">
                            @lang('app.address') <span class="text-danger">*</span>
                        </label>
                        <textarea id="o-address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" maxlength="255" rows="2" required>{{ old('address') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="o-note" class="form-label">
                            @lang('app.note')
                        </label>
                        <textarea id="o-note" class="form-control{{ $errors->has('note') ? ' is-invalid' : '' }}" name="note" maxlength="255" rows="2">{{ old('note') }}</textarea>
                    </div>

                    <button type="submit" class="btn bg-success-subtle w-100" style="color: seagreen; font-weight: 700;"><i class="bi-truck"></i> @lang('app.order')</button>
                </form>
            </div>
            <div class="col-12 col-md-5 col-lg-6 py-3 py-md-0">
                <img src="{{ asset('img/order.png') }}" alt="" class="img-fluid">
            </div>
        </div>
    </div>
@endsection