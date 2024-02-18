@extends('client.layouts.app')
@section('title')
    @lang('app.app-name') - {{ $brand->name }}
@endsection
@section('content')
    <div class="container-xl py-3">
        <div class="text-center pb-3">
            <img src="{{ asset('storage/img/brands/' . $brand->image) }}" alt="{{ $brand->name }}" class="img-fluid">
        </div>
        <div>
            <div class="row row-cols-2 row-cols-md-3 row-cols-xl-5 g-3">
                @foreach($products as $product)
                    <div class="col">
                        @include('client.app.product_card')
                    </div>
                @endforeach
            </div>
            <div class="pt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection