<div class="row align-items-center g-2 g-md-3 g-xl-4 cart-product border-bottom pb-4">
    <div class="col-6">
        <a href="#">
            <div class="d-flex align-items-center">
                <div class="pe-3">
                    {!! $product['product']->image ?
                          (file_exists(public_path('storage/products/sm/' . $product['product']->image)) ?
                              '<img src="' . asset('storage/products/sm/' . $product['product']->image) . '" alt="' . $product['product']->name . '" class="img-fluid" style="border-radius: 8px; width: 62px;">' :
                              '<img src="' . asset($product['product']->image) . '" alt="' . $product['product']->name . '" class="img-fluid" style="border-radius: 8px; width: 62px;">'
                          ) :
                          '<img src="' . asset('img/product.png') . '" alt="' . $product['product']->name . '" class="w-100" style="border-radius: 8px;">'
                      !!}
                </div>
                <div class="text-name" style="color: #333; font-style: normal; font-weight: 400; line-height: 140%;
        text-decoration-line: underline;">
                    {{ $product['product']->getName() }}
                </div>
            </div>
        </a>
    </div>
    <div class="col-3 col-sm-3 text-center">
        <div class="d-flex justify-content-center align-items-center">
            <button type="button" class="btn btn-sm decrease" value="{{ $product['product']->id }}"
                    style="border-radius: 10px; background: #F3F4F6;">
                <i class="bi-dash-lg btn-decrease"></i>
            </button>
            <div class="pQuantity mx-1 mx-sm-2 px-2"
                 style="color: #007AFF; font-size: 16px; font-style: normal; font-weight: 500; line-height: normal; width: 35px;">{{ $product['quantity'] }}</div>
            <button type="button" class="btn btn-sm increase" value="{{ $product['product']->id }}"
                    style="border-radius: 10px; background: #F3F4F6;">
                <i class="bi-plus-lg btn-increase"></i>
            </button>
        </div>
    </div>
    <div class="col-3">
        <div class="pPrice d-none">
            {{ $product['product']->price() }}
        </div>
        <div class="d-flex justify-content-end">
            <div class="cpPrice h5 mb-0"
                 style="color: #333; text-align: center; font-size: 16px; font-style: normal; font-weight: 400; line-height: normal;">
                {{ number_format((float)$product['product']->price() * $product['quantity'], 2, '.', ' ') }}
            </div>
            <div class="ps-1"
                 style="color: #333; text-align: center; font-size: 16px; font-style: normal; font-weight: 400; line-height: normal;">
                tmt
            </div>
        </div>
    </div>
</div>

<style>
    .btn-decrease::before {
        color: #000000 !important;
        font-weight: 900 !important;
    }

    .btn-decrease:hover::before {
        color: #007AFF !important;
        font-weight: 900 !important;
    }

    .btn-increase::before {
        color: #000000 !important;
        font-weight: 900 !important;
    }

    .btn-increase:hover::before {
        color: #007AFF !important;
        font-weight: 900 !important;
    }

    .text-name:hover {
        color: #007AFF !important;
    }
</style>