@extends('client.layouts.app')
@section('title')Arzan harytlar - @lang('app.app-name')@endsection
@section('content')
    <div class="container-xl py-4">
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-3">
            @foreach($discountProducts as $product)
                @if($product->hasDiscount())
                    <div class="col">
                        @include('client.app.product_card')
                    </div>
                @endif
            @endforeach
        </div>
        <div class="mt-3 ">
            {{ $discountProducts->links() }}
        </div>
    </div>
@endsection