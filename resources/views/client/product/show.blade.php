@extends('client.layouts.app')
@section('title')
    @lang('app.app-name') - {{ $product->name }}
@endsection
@section('content')
    <div class="container-xl">

        <nav class="mt-4" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none" style="color:#FF0032; font-weight: 600;">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="{{ route('category.show', $product->category->slug) }}" class="text-decoration-none"
                       style="color:#FF0032; font-weight: 600;">
                        {{ $product->category->getName() }}
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->getName() }}</li>
            </ol>
        </nav>
        <div class="row py-3">
            <div class="col-12 col-md-5 pb-3 pb-md-0">
                {!! $product->image ?
                    (file_exists(public_path('storage/products/' . $product->image)) ?
                        '<img src="' . asset('storage/products/' . $product->image) . '" alt="' . $product->name . '" class="d-block mx-auto w-100" style="border: 1px solid #E6E8F0;">' :
                        '<img src="' . asset($product->image) . '" alt="' . $product->name . '" class="d-block mx-auto w-100" style="border: 1px solid #E6E8F0;">'
                    ) :
                    '<img src="' . asset('img/product.png') . '" alt="' . $product->name . '" class="d-block mx-auto w-100" style="border: 1px solid #E6E8F0;">'
                !!}
            </div>
            <div class="col-12 col-md-7">
                <div style="color: #001424; font-size: 32px; font-weight: 500;">
                    {{ $product->getName() }} {{ $product->category->getName() }} {{ $product->brand->name }}
                </div>
                <div class="py-3">
                    <a href="{{ route('brand.show', $product->brand->slug) }}">
                        <img src="{{ asset('storage/img/brands/' . $product->brand->image) }}" alt="" class="img-fluid">
                    </a>
                </div>
                <div class="d-flex align-items-center pt-2">
                    <div class="pe-2" style="color: #001424;">
                        Barcode:
                    </div>
                    <div style="color: #4D5B66;">
                        {{ $product->barcode}}
                    </div>
                </div>
                <div class="d-flex align-items-center pt-4 pb-3">
                    <div class="pe-2" style="color: #001424;">
                        Color:
                    </div>
                    <div style="color: #4D5B66;">
                        {{ $product->color->getName()}}
                    </div>
                </div>
                <div class="d-flex">
                    @foreach($colors as $color)
                        <a class="pe-2" href="{{ route('product.show', $color->slug) }}">
                            {!! $color->image ?
                    (file_exists(public_path('storage/products/' . $color->image)) ?
                        '<img src="' . asset('storage/products/' . $color->image) . '" alt="' . $color->name . '" class="d-block mx-auto" style="border: 1px solid #E6E8F0; width: 76px; border-radius: 12px;">' :
                        '<img src="' . asset($color->image) . '" alt="' . $color->name . '" class="d-block mx-auto" style="border: 1px solid #E6E8F0; width: 76px; border-radius: 12px;">'
                    ) :
                    '<img src="' . asset('img/product.png') . '" alt="' . $color->name . '" class="d-block mx-auto" style="border: 1px solid #E6E8F0; width: 76px; border-radius: 12px;">'
                !!}
                        </a>
                    @endforeach
                </div>

                <div class="pt-4">
                    <div class="pe-2 pb-2" style="color: #001424;">
                        Gysga düşündiriş:
                    </div>
                    <div>
                        {!! $product->getDescription() !!}
                    </div>
                </div>

                <div class="border p-3 mt-4">
                    @if($product->hasDiscount())
                        <div class="d-flex align-items-center pt-1">
                            <div class="fw-bold text-decoration-line-through" style="color:#4D5B66; font-size: 18px;">
                                {{number_format((float)$product->price, 0, '.', ' ')}} <span class="small fw-normal">tmt</span>
                            </div>
                            <div class="ms-3" style="background: #FBE739; color: #222; border-radius: 4px; padding: 6px 7px; font-size: 18px;">
                                -{{ $product->price - $product->discountPrice() }} arzanaldyş
                            </div>
                        </div>
                        <div class="py-3" style="color: #FF0032; font-weight: 700; font-size: 24px; border-radius: 4px;">
                            {{ $product->price }} <span style="font-weight: 400;">TMT</span>
                        </div>
                    @else
                        <div class="py-3" style="color: #FF0032; font-weight: 700; font-size: 24px; border-radius: 4px;">
                            {{ $product->price }} <span style="font-weight: 400;">TMT</span>
                        </div>
                    @endif


                    @if($product->stock)
                        <div class="pb-2">
                            <button type="button" class="btn btn-cart me-2 btn-hover add-to-cart" value="{{ $product->id }}"
                                    style="width: 100%; border-radius: 8px!important; margin-top: 12px;">
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="me-2">
                                        <svg width="19" height="18" viewBox="0 0 19 18" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.5626 7.875V4.5C12.5626 2.9467 11.3034 1.6875 9.75012 1.6875C8.19682 1.6875 6.93762 2.9467 6.93762 4.5V7.875M15.4546 6.38042L16.402 15.3804C16.4544 15.8786 16.0638 16.3125 15.5629 16.3125H3.93735C3.43641 16.3125 3.04579 15.8786 3.09823 15.3804L4.0456 6.38042C4.0908 5.951 4.45292 5.625 4.88471 5.625H14.6155C15.0473 5.625 15.4094 5.951 15.4546 6.38042ZM7.21887 7.875C7.21887 8.03033 7.09295 8.15625 6.93762 8.15625C6.78229 8.15625 6.65637 8.03033 6.65637 7.875C6.65637 7.71967 6.78229 7.59375 6.93762 7.59375C7.09295 7.59375 7.21887 7.71967 7.21887 7.875ZM12.8439 7.875C12.8439 8.03033 12.7179 8.15625 12.5626 8.15625C12.4073 8.15625 12.2814 8.03033 12.2814 7.875C12.2814 7.71967 12.4073 7.59375 12.5626 7.59375C12.7179 7.59375 12.8439 7.71967 12.8439 7.875Z"
                                                  stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                  stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <div style="font-size: 14px; font-weight: 600">
                                        @lang('app.add-to-cart')
                                    </div>
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


            </div>
        </div>
    </div>

    <script>
        let redColor = document.getElementsByClassName('red-color');
        for (const item of redColor) {
            item.addEventListener('click', function () {
                item.classList.add('border')
                item.classList.add('border-danger')
            });
        }
    </script>

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
    </style>
@endsection