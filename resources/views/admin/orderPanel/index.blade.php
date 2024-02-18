@extends('admin.layouts.app')
@section('title')
    Orders panel
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
            Sargyt paneli
        </div>
        <div class="row my-4">
            <div class="col-5">
                <div id="monthsByOrder"></div>
            </div>
            <div class="col-7">
                <div id="daysByOrder"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div id="monthsByPrice"></div>
            </div>
        </div>
    </div>
    @include('admin.orderPanel.daysByOrder')
    @include('admin.orderPanel.monthsByOrder')
    @include('admin.orderPanel.monthsByPrice')
{{--    @include('admin.productPanel.monthsByQuantity')--}}
{{--    @include('admin.productPanel.daysByQuantity')--}}
{{--    @include('admin.productPanel.daysByPrice')--}}
@endsection