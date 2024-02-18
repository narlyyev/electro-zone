<div class="container-xl">
    @if($discountProducts->count())
        <div class="d-flex align-items-center justify-content-between pb-3">
            <div>
                <div style="font-weight: 700; font-size: 24px;">
                    <span style="color: rgba(29, 29, 31, 1)">Arzanlaşykdakylar</span>
                </div>
            </div>
            <div>
                <a href="{{ route('discount.products') }}" style="color: rgba(252, 16, 0, 1)">
                    SEE ALL
                </a>
            </div>
        </div>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-3">
            @foreach($discountProducts as $product)
                @if($product->hasDiscount())
                    <div class="col mb-5">
                        @include('client.app.product_card')
                    </div>
                @endif
            @endforeach
        </div>
    @endif

    <div class="d-flex align-items-center justify-content-between pb-3">
        <div>
            <div style="font-weight: 700; font-size: 24px;">
                <span style="color: rgba(29, 29, 31, 1)">Iň köp satylanlar</span>
            </div>
        </div>
        <div>
            <a href="#" style="color: rgba(252, 16, 0, 1)">
                SEE ALL
            </a>
        </div>
    </div>
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-3">
        @foreach($mostSoldProducts as $product)
            <div class="col mb-5">
                @include('client.app.product_card')
            </div>
        @endforeach
    </div>

    @if($newProducts->count())
        <div class="d-flex align-items-center justify-content-between pb-3">
            <div>
                <div style="font-weight: 700; font-size: 24px;">
                    <span style="color: rgba(29, 29, 31, 1)">Täzeler</span>
                </div>
            </div>
            <div>
                <a href="#" style="color: rgba(252, 16, 0, 1)">
                    SEE ALL
                </a>
            </div>
        </div>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-3">
            @foreach($newProducts as $product)
                <div class="col mb-5">
                    @include('client.app.product_card')
                </div>
            @endforeach
        </div>
    @endif

    <div class="d-flex align-items-center justify-content-between pb-3">
        <div>
            <div style="font-weight: 700; font-size: 24px;">
                <span style="color: rgba(29, 29, 31, 1)">Siziň üçin</span>
            </div>
        </div>
        <div>
            <a href="#" style="color: rgba(252, 16, 0, 1)">
                SEE ALL
            </a>
        </div>
    </div>
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-3">
        @foreach($recommendedProducts as $product)
            <div class="col mb-5">
                @include('client.app.product_card')
            </div>
        @endforeach
    </div>

</div>