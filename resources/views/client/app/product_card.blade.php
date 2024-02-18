<div class="bg-white p-2 h-100 hover position-relative" style="border-radius: 14px; border: 1px solid #ecedef">
    <a href="{{ route('product.show', $product->slug) }}" class="a-hover">
        @if($product->hasDiscount())
            <span class="position-absolute" style="left: 12px;" id="discount-countdown-{{ $product->id }}">
                <span class="d-inline-block text-dark bg-white text-monospace fw-bold py-1 px-2 my-1 mr-1"
                      style="border-radius: 8px; border: 1px solid #f6f6f6; font-size: 14px;">
                    <i class="bi bi-stopwatch-fill fw-bold" style="color: #fc1000"></i>
                    <span><span class="days">1</span> <span>@lang('app.day') </span></span><span><span class="hours">1</span><span
                                class="d-none">@lang('hour')</span><span>:</span></span><span class="minutes">1</span>:<span class="seconds">1</span>
                </span>
            </span>
            @if($product->isNew())
                <span class="position-absolute" style="left: 12px; top: 43px;">
                <span class="d-inline-block text-monospace fw-bold py-1 px-2 my-1 mr-1"
                      style="border-radius: 4px; font-size: 14px; background: #fc1000; color: white;">
                    @lang('app.new')
                </span>
            </span>
            @endif
            <script>
                $(document).ready(function () {
                    $('#discount-countdown-{{ $product->id }}').countdown100({
                        endtimeYear: parseInt({{ $product->getDiscountEnd()->format('Y') }}),
                        endtimeMonth: parseInt({{ $product->getDiscountEnd()->format('n') }}),
                        endtimeDate: parseInt({{ $product->getDiscountEnd()->format('j') }}),
                        endtimeHours: parseInt({{ $product->getDiscountEnd()->format('H') }}),
                        endtimeMinutes: parseInt({{ $product->getDiscountEnd()->format('i') }}),
                        endtimeSeconds: parseInt({{ $product->getDiscountEnd()->format('s') }}),
                        timeZone: ""
                    });
                });
            </script>
        @endif

        @if(!$product->hasDiscount() && $product->isNew())
            <span class="position-absolute" style="left: 12px;">
                <span class="d-inline-block text-monospace fw-bold py-1 px-2 my-1 mr-1"
                      style="border-radius: 4px; font-size: 14px; background: #fc1000; color: white;">
                    @lang('app.new')
                </span>
            </span>
        @endif

        <div>
            <div style="border-radius: 8px; border: 1px solid #f6f6f6;">
                {!! $product->image ?
                    (file_exists(public_path('storage/products/sm/' . $product->image)) ?
                        '<img src="' . asset('img/product.png') . '" alt="' . $product->name . '" data-src="' . asset('storage/products/sm/' . $product->image) . '" class="w-100 load-image" style="border-radius: 8px;">' :
                        '<img src="' . asset('img/product.png') . '" alt="' . $product->name . '" data-src="' . asset($product->image) . '" class="w-100 load-image" style="border-radius: 8px;">'
                    ) :
                    '<img src="' . asset('img/product.png') . '" alt="' . $product->name . '" data-src="' . asset('img/product.png') . '" class="w-100 load-image" style="border-radius: 8px;">'
                !!}
            </div>
            <div>
                <div class="text-truncate name" style="font-size: 16px; font-weight: 400; padding-top: 12px;">
                    {{ $product->getName() }}
                </div>
                @if($product->hasDiscount())
                    <div class="d-flex align-items-baseline">
                        <div class="text-danger"
                             style="color: #FC1000; font-size: 16px; font-style: normal; font-weight: 700; line-height: normal; padding-right: 8px;">
                            {{ $product->discountPrice() }} <span
                                    style="color: #FC1000; font-size: 16px; font-style: normal; font-weight: 400; line-height: normal;">TMT</span>
                        </div>
                        <div
                                style="color: #6E6E73; font-size: 12px; font-style: normal;font-weight: 400; line-height: normal;text-decoration-line: line-through; padding-top: 12px;">
                            {{ $product->price() }} tmt
                        </div>
                    </div>
                @else
                    <div class="pb-2" style="font-weight: 800; font-size: 16px; color: #333;">
                        {{ $product->price() }} <span style="font-size: 12px; font-weight: 800;">tmt</span>
                    </div>
                @endif
            </div>
        </div>
    </a>
    @if($product->stock)
        <div>
            <button type="button" class="btn btn-cart btn-hover add-to-cart" value="{{ $product->id }}"
                    style="width: 100%; border-radius: 8px!important; margin-top: 12px;">
                <div class="row align-items-center justify-content-center">
                    <div class="col-4">
                        <svg width="19" height="18" viewBox="0 0 19 18" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.5626 7.875V4.5C12.5626 2.9467 11.3034 1.6875 9.75012 1.6875C8.19682 1.6875 6.93762 2.9467 6.93762 4.5V7.875M15.4546 6.38042L16.402 15.3804C16.4544 15.8786 16.0638 16.3125 15.5629 16.3125H3.93735C3.43641 16.3125 3.04579 15.8786 3.09823 15.3804L4.0456 6.38042C4.0908 5.951 4.45292 5.625 4.88471 5.625H14.6155C15.0473 5.625 15.4094 5.951 15.4546 6.38042ZM7.21887 7.875C7.21887 8.03033 7.09295 8.15625 6.93762 8.15625C6.78229 8.15625 6.65637 8.03033 6.65637 7.875C6.65637 7.71967 6.78229 7.59375 6.93762 7.59375C7.09295 7.59375 7.21887 7.71967 7.21887 7.875ZM12.8439 7.875C12.8439 8.03033 12.7179 8.15625 12.5626 8.15625C12.4073 8.15625 12.2814 8.03033 12.2814 7.875C12.2814 7.71967 12.4073 7.59375 12.5626 7.59375C12.7179 7.59375 12.8439 7.71967 12.8439 7.875Z"
                                  stroke="white" stroke-width="1.5" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="col-4" style="font-size: 14px; font-weight: 600">
                        @lang('app.add-to-cart')
                    </div>
                    <div class="col-4"></div>
                </div>
            </button>
        </div>
    @else
        <div>
            <button class="btn me-2" style="width: 100%; font-size: 14px; font-weight: 600;">
                Ammarda ýok
            </button>
        </div>
    @endif
</div>


<style>
    .btn-hover {
        background: #F3F4F6;
    }

    .btn-hover:hover {
        background: black;
        color: white;
    }

    button.btn-cart svg path {
        stroke: black !important;
    }

    button.btn-cart:hover svg path {
        stroke: white !important;
    }

    button.btn-red-svg svg path {
        stroke: white !important;
    }

    button.btn-red {
        background-color: #FC1000;
        color: white;
    }

    .card {
        border: 0;
        border-radius: 16px;
    }

    .a-hover {
        text-decoration: none;
        color: #333;
    }

    .a-hover .name {
        text-decoration: none;
        color: #333;
    }

    .a-hover:hover .name {
        text-decoration: underline;
        color: #fc1000;
    }

    .hover {
        transition: .4s;
    }

    .hover:hover {
        transform: scale(1.03);
    }
</style>