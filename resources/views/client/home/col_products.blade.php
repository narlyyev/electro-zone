<div class="container-xl">
    <div class="row mb-3 g-3">
        <div class="col-12 col-lg-6">
            <div class="bg-white h-100" style="border-radius: 20px;">
                <div style="color: #FA3434; font-weight: 600;">
                    @if(isset ($colProducts[0]->created_at) >= \Carbon\Carbon::now()->subMonths(2))
                        <div class="text-center pt-4 pb-2">Täze</div>
                    @endif
                </div>
                <div class="text-center pb-2" style="color: #1D1D1F; font-size: 32px; font-weight: 600;">
                    {{ isset($colProducts[0]) ? $colProducts[0]->getName() : '' }}
                </div>
                <div class="row justify-content-center g-3">
                    <div class="col-6">
                        <div class="pb-3 text-truncate">
                            {{ isset($colProducts[0]) ? $colProducts[0]->getDescription() : '' }}
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <a href="{{ route('product.show', $colProducts[0]->slug) }}">
                        <button class="btn px-3 mt-3" style="background: #fc1000; color: white; border-radius: 100px;">
                            Görüp geç
                        </button>
                    </a>
                </div>
                <div class="text-center pb-3">
                    {!! $colProducts[0]->image ?
                        (file_exists(public_path('storage/products/' . $colProducts[0]->image)) ?
                            '<img src="' . asset('storage/products/' . $colProducts[0]->image) . '" alt="' . $colProducts[0]->name . '" class="img-fluid" style="border-radius: 8px; width:375px">' :
                            '<img src="' . asset($colProducts[0]->image) . '" alt="' . $colProducts[0]->name . '" class="img-fluid" style="border-radius: 8px; width:375px">'
                        ) :
                        '<img src="' . asset('img/product.png') . '" alt="' . $colProducts[0]->name . '" class="img-fluid" style="border-radius: 8px; width:375px">'
                    !!}
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            @foreach($colProducts->take(3)->skip(1) as $product)
                <div class="bg-white p-3 margin-bottom" style="border-radius: 20px;">
                    <div class="row align-items-center g-3">
                        <div class="col-12 col-lg-5">
                            <div class="text-center text-lg-start">
                                {!! $product->image ?
                                    (file_exists(public_path('storage/products/sm/' . $product->image)) ?
                                        '<img src="' . asset('storage/products/sm/' . $product->image) . '" alt="' . $product->name . '" class="w-100" style="border-radius: 8px;">' :
                                        '<img src="' . asset($product->image) . '" alt="' . $product->name . '" class="w-100" style="border-radius: 8px;">'
                                    ) :
                                    '<img src="' . asset('img/product.png') . '" alt="' . $product->name . '" class="w-100" style="border-radius: 8px;">'
                                !!}
                            </div>
                        </div>
                        <div class="col-12 col-lg-7 pe-4">
                            <div style="color: #FA3434; font-weight: 600;">
                                @if(isset ($product->created_at) >= \Carbon\Carbon::now()->subMonths(2))
                                    <div class="text-center pt-4 pb-2">Täze</div>
                                @endif
                            </div>
                            <div class="text-center pb-2" style="font-size: 28px; font-weight: 600;">
                                {{ $product->getName() }}
                            </div>
                            <div class="pb-3 text-truncate">
                                {{ $product->getDescription() }}
                            </div>
                            <div class="text-center">
                                <a href="{{ route('product.show', $product->slug) }}">
                                    <button class="btn px-3 pt-2 mt-3" style="background: #fc1000; color: white; border-radius: 100px;">
                                        Görüp geç
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="container-xl pb-4">
    <div class="row g-3">
        @foreach($colProducts->skip(3) as $product)
            <div class="col-12 col-lg-6">
                <div class="bg-white p-3" style="border-radius: 20px;">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-5">
                            <div class="text-center text-lg-start">
                                {!! $product->image ?
                                    (file_exists(public_path('storage/products/sm/' . $product->image)) ?
                                        '<img src="' . asset('storage/products/sm/' . $product->image) . '" alt="' . $product->name . '" class="w-100" style="border-radius: 8px;">' :
                                        '<img src="' . asset($product->image) . '" alt="' . $product->name . '" class="w-100" style="border-radius: 8px;">'
                                    ) :
                                    '<img src="' . asset('img/product.png') . '" alt="' . $product->name . '" class="w-100" style="border-radius: 8px;">'
                                !!}
                            </div>
                        </div>
                        <div class="col-12 col-lg-7 pe-4">
                            <div style="color: #FA3434; font-weight: 600;">
                                @if(isset ($product->created_at) >= \Carbon\Carbon::now()->subMonths(2))
                                    <div class="text-center pt-4 pb-2">Täze</div>
                                @endif
                            </div>
                            <div class="text-center pb-2" style="font-size: 28px; font-weight: 600;">
                                {{ $product->getName() }}
                            </div>
                            <div class="pb-3 text-truncate">
                                {{ $product->getDescription() }}
                            </div>
                            <div class="text-center pb-3">
                                <a href="{{ route('product.show', $product->slug) }}">
                                    <button class="btn px-3 py-2 mt-3" style="background: #fc1000; color: white; border-radius: 100px;">
                                        Görüp geç
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
    .margin-bottom {
        margin-bottom: 15px;
    }

    .margin-bottom:last-child {
        margin-bottom: 0;
    }
</style>
