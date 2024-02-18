@extends('admin.layouts.app')
@section('title')
    Products panel
@endsection
<style>
    text.highcharts-credits {
        display: none;
    }

    .highcharts-axis.highcharts-yaxis {
        display: none;
    }
</style>
@section('content')
    <div class="h3 container-xl p-4">
        <div class="pb-4">
            Haryt paneli
        </div>
        <div id="daysByPrice"></div>
        <div class="row my-4">
            <div class="col-6">
                <div id="monthsByPrice"></div>
            </div>
            <div class="col-6">
                <div id="daysByQuantity"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div id="monthsByQuantity"></div>
            </div>
            <div class="col-6">
                <div id="daysByViewed"></div>
            </div>
        </div>
        <div class="pt-4" id="monthsByViewed"></div>
    </div>
    @include('admin.productPanel.daysByViewed')
    @include('admin.productPanel.monthsByViewed')
    @include('admin.productPanel.monthsByQuantity')
    @include('admin.productPanel.daysByQuantity')
    @include('admin.productPanel.monthsByPrice')
    @include('admin.productPanel.daysByPrice')
@endsection