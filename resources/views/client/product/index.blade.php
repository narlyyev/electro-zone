@extends('client.layouts.app')
@section('title')
    @lang('app.app-name') - @lang('app.products')
@endsection
@section('content')
    <div class="container-xl pt-3">
        <form action="{{ url()->current() }}" id="productFilter" class="pb-3">
            <div class="row align-items-center">
                <!-- Total product count -->
                <div class="col-9" style="color: #333; font-size: 22px; font-weight: 600;">
                    {{ $productsCount }} haryt bar
                </div>
                <!-- Filter dropdown -->
                <div class="col-3">
                    <input type="hidden" name="q" value="{{ request('q') }}">
                    <select class="form-select form-select-sm" name="ordering" id="ordering" size="1"
                            onchange="$('form#productFilter').submit();">
                        <div class="row border rounded-3 px-4 py-2">
                            <div class="col-6">
                                <option value>@lang('app.ordering'): @lang('app.default')</option>
                                @foreach(array_keys(config()->get('settings.ordering')) as $ordering)
                                    <option value="{{ $ordering }}" {{ $ordering == $f_order ? 'selected' : '' }}>
                                        @lang('app.' . $ordering)
                                    </option>
                                @endforeach
                            </div>
                            <div class="col-6 text-end">
                                <i class="bi-filter"></i>
                            </div>
                        </div>
                    </select>
                </div>
            </div>
        </form>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-3">
            @foreach($products as $product)
                <div class="col">
                    @include('client.app.product_card')
                </div>
            @endforeach
        </div>
        <div class="py-3">
            {{ $products->links() }}
        </div>
    </div>
@endsection