@extends('client.layouts.app')
@section('title')
    @lang('app.app-name')
@endsection
@section('content')
    <div class="container-xl py-3">
        @include('client.home.slider')
    </div>
    <div class="d-none d-lg-block">
        @include('client.home.categories')
    </div>
    <div>
        @include('client.home.home_products')
    </div>
    <div>
        @include('client.home.col_products')
    </div>
    <div>
        @include('client.home.banners')
    </div>
    <div>
        @include('client.home.news')
    </div>
    <div>
        @include('client.home.brands')
    </div>
@endsection
