@extends('client.layouts.app')
@section('title')
    @lang('app.cart') - @lang('app.appName')
@endsection
@section('content')
    <div class="container-xl py-3">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cart</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-center text-center">
            <div>
                <div class="text-black fs-5 border d-inline p-2" style="border-radius: 13px;">
                    <i class="bi-bag"></i>
                </div>
                <div style="font-size: 24px; font-weight: 600; color: #1D1D1F; padding-top: 14px;">
                    Sebedim
                </div>
            </div>
        </div>


        <div class="py-3" style="margin: 110px 0;">
            <div class="row">
                <div class="col-12 col-md-7 col-lg-8">
                    <div class="row g-0 p-4" style="border: 1px solid #E2E5E9; border-radius: 16px;">
                        @foreach($products as $product)
                            <div class="col-12 pb-4">
                                @include('client.app.cartProduct')
                            </div>
                        @endforeach
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{ route('home') }}" class="btn px-3" style="border-radius: 10px; border: 1px solid rgba(255, 255, 255, 0.12); background: linear-gradient(180deg, rgba(255, 255, 255, 0.12) 0%, rgba(255, 255, 255, 0.00) 100%), #007AFF; box-shadow: 0px 1px 2px 0px rgba(0, 114, 239, 0.48), 0px 0px 0px 1px #0072EF; color: white;">
                                <i class="bi-arrow-left pe-2"></i>Söwdany dowam et
                            </a>
                            <div>
                                <a href="{{ route('cart.clear') }}" class="btn" style="border-radius: 10px; border: 1px solid #E2E4E9; color: rgba(250, 52, 52, 1);">
                                     Ählisini aýyr
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-5 col-lg-4">
                    <div class="p-4" style="border-radius: 16px; border: 1px solid #E2E5E9;">
                        <div style="font-size: 28px; font-weight: 500; color: #333333; border-bottom: 1px solid #E2E4E9; padding-bottom: 10px;">
                            Order Summary
                        </div>
                        <div class="my-3">
                            <label for="location" class="form-label" style="font-size: 14px; font-weight:bold; color: #1D1D1F;">
                                Location <span class="text-danger">*</span>
                            </label>
                            <select id="location" class="form-select select2" name="location">
                                @foreach($locations as $location)
                                    <option value="{{ $location->id }}">{{ $location->getName() }}</option>
                                @endforeach
                            </select>
                        </div>

                        <table class="table">
                            <tbody>
                            <tr>
                                <td class="align-middle border border-0" style="color: #333; font-size: 14px; font-style: normal; font-weight: 500; line-height: normal; padding-top: 14px;">Products</td>
                                <td class="align-middle text-end border border-0" style="color: #333; font-size: 14px; font-style: normal; font-weight: 500; line-height: normal; padding-top: 14px;"><span id="products-price">0</span> <small>TMT</small></td>
                            </tr>
                            <tr style="border-bottom: 1px solid #E2E4E9;">
                                <td class="align-middle border border-0" style="color: #333; font-size: 14px; font-style: normal; font-weight: 500; line-height: normal; padding-bottom: 24px;">Delivery</td>
                                <td class="align-middle text-end border border-0" style="color: #333; font-size: 14px; font-style: normal; font-weight: 500; line-height: normal; padding-bottom: 24px;"><span id="delivery-fee">0</span> <small>TMT</small></td>
                            </tr>
                            <tr>
                                <td class="align-middle border border-0" style="color: #000; font-size: 18px; font-style: normal; font-weight: 700; line-height: normal; padding-top: 14px;">Total</td>
                                <td class="h5 align-middle text-end border border-0" style="color: #000; font-size: 18px; font-style: normal; font-weight: 700; line-height: normal; "><span
                                            id="total-price">0</span> <small>TMT</small></td>
                            </tr>
                            </tbody>
                        </table>
                        {{--                    {{ route('order.index') }}--}}
                        <a href="{{ route('order.index') }}" class="btn w-100 py-2" style="border-radius: 10px; border: 1px solid rgba(255, 255, 255, 0.12); background: linear-gradient(180deg, rgba(255, 255, 255, 0.12) 0%, rgba(255, 255, 255, 0.00) 100%), #007AFF; box-shadow: 0px 1px 2px 0px rgba(0, 114, 239, 0.48), 0px 0px 0px 1px #0072EF; color: white; font-weight: 600; font-size: 14px;">
                            Sargydy tassyklamak
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.increase').click(function () {
            $self = $(this);
            $self.attr("disabled", true);
            $.ajax({
                url: "{{ route('cart.add') }}",
                dataType: "json",
                type: "POST",
                data: {"_token": "{{ csrf_token() }}", "id": $self.val()},
                success: function (result, status, xhr) {
                    if (parseInt($self.prev().text()) === result["quantity"]) {
                        $self.prev().addClass('text-danger');
                        setTimeout(function () {
                            $self.prev().removeClass('text-danger');
                        }, 1000);
                    }
                    $self.attr("disabled", false);
                    if (result["cart"] > 0) {
                        $('#cart').removeClass('invisible').text(result["cart"]);
                    } else {
                        $('#cart').addClass('invisible').text(result["cart"]);
                    }
                    $self.prev().text(result["quantity"]);
                    updateCart();
                },
                error: function (result, status, xhr) {
                    updateCart();
                },
            });
        });
        $('.decrease').click(function () {
            $self = $(this);
            $self.attr("disabled", true);
            $.ajax({
                url: "{{ route('cart.remove') }}",
                dataType: "json",
                type: "POST",
                data: {"_token": "{{ csrf_token() }}", "id": $self.val()},
                success: function (result, status, xhr) {
                    if (parseInt($self.next().text()) === result["quantity"]) {
                        $self.next().addClass('text-danger');
                        setTimeout(function () {
                            $self.next().removeClass('text-danger');
                        }, 1000);
                    }
                    $self.attr("disabled", false);
                    if (result["cart"] > 0) {
                        $('#cart').removeClass('invisible').text(result["cart"]);
                    } else {
                        $('#cart').addClass('invisible').text(result["cart"]);
                    }
                    if (result["quantity"]) {
                        $self.next().text(result["quantity"]);
                    } else {
                        $self.closest('.cart-product').remove();
                    }
                    updateCart();
                },
                error: function (result, status, xhr) {
                    updateCart();
                },
            });
        });

        let locations = [
                @foreach($locations as $location){
                'id': parseInt({{ $location->id }}),
                'delivery_fee': parseInt({{ $location->delivery_fee }}),
            },@endforeach
        ];

        $("select[name='location']").change(function () {
            updateCart();
        });

        function updateCart() {
            let psPrice = 0;
            $('.cart-product').each(function () {
                let price = $(this).find('.pPrice').text();
                let quantity = $(this).find('.pQuantity').text();
                let pPrice = (price * quantity).toFixed(1);
                psPrice += parseFloat(pPrice);
                $(this).find('.cpPrice').text(parseFloat(pPrice).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$& '));
            });
            let location = locations.find(x => x.id === parseInt($('#location').val()));
            $('#o-location').val(location.id);
            let deliveryFee = location.delivery_fee;
            $('#products-price').text(psPrice.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$& '));
            $('#delivery-fee').text(deliveryFee.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$& '));
            $('#total-price').text((psPrice + deliveryFee).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$& '));
            if (psPrice > 0) {
                $('#order').removeClass('disabled');
            } else {
                $('#order').addClass('disabled');
            }
        }

        updateCart();
    </script>
@endsection