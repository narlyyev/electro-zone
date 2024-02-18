@extends('client.layouts.app')
@section('title')
    @lang('app.app-name') - {{ $category->name }}
@endsection
@section('content')
    <div class="container-xl pb-4">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                @if($category->parent)
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ route('category.show', $category->parent->slug) }}" class="text-decoration-none">
                            {{ $category->parent->getName() }}
                        </a>
                    </li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">{{ $category->getName() }}</li>
            </ol>
        </nav>

        <div class="row row-cols-6 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-2">
            @foreach ($category->children as $subcategory)
                <div class="col">
                    <a href="{{ route('category.show', $subcategory->slug) }}" class="text-decoration-none text-dark">
                        <div class="card card-category h-100 px-1" style="border-radius: 16px;">
                            <div class="d-flex align-items-center">
                                <div class="card-body">
                                    <div class="row align-items-center g-0">
                                        <div class="col-4">
                                            <div>
                                                @php
                                                    $subCategoryImagePath = $subcategory->big_image ? public_path('storage/img/categories/big_images/' . $subcategory->big_image) : null;
                                                @endphp

                                                <img src="{{ $subCategoryImagePath && file_exists($subCategoryImagePath) ? asset('storage/img/categories/big_images/'. $subcategory->big_image) : asset($subcategory->big_image) }}"
                                                     alt="" class="d-block" style="object-fit: cover; width: 60px;">
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <div class="mt-2">
                                                <div class="h6" style="font-size: 14px; color: #1D1D1F; font-weight: 600;">
                                                    {{ $subcategory->getName() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pe-3">
                                    <div class="text-center pt-1 arrow">
                                        <i class="bi-arrow-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <form action="{{ route('category.show', $category->slug) }}" method="GET" id="productFilter">
        <div class="container-xl filter-container">
            <div class="row py-3">
                <div class="col-2"></div>
                <div class="col-10">
                    <div class="row align-items-center">
                        <!-- Total product count -->
                        <div class="col-9" id="product-count" style="color: #333; font-size: 22px; font-weight: 600;"></div>
                        <!-- Filter dropdown -->
                        <div class="col-3">
                            <select class="form-select form-select-sm" name="ordering" id="ordering" size="1"
                                    onchange="$('form#productFilter').submit();">
                                <option value="">@lang('app.ordering'): @lang('app.default')</option>
                                @foreach(array_keys(config()->get('settings.ordering')) as $ordering)
                                    <option value="{{ $ordering }}" {{ $ordering == $f_order ? 'selected' : '' }}>
                                        @lang('app.' . $ordering)
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Subcategory list -->
            <div class="row py-4">
                <div class="col-2">
                    @if($category->children->count())
                        <div class="border-bottom pb-4">
                            <div class="h5 pb-2">
                                Sub categories
                            </div>
                            <div style="height: 180px; overflow-y: scroll">
                                @foreach($category->children as $subcategory)
                                    <div class="d-flex">
                                        <input class="form-check-input pb-3 me-2 subcategory-filter" type="checkbox" id="c{{ $subcategory->id }}"
                                               name="c[]"
                                               value="{{ $subcategory->id }}" {{ $f_categories->contains($subcategory->id) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="c{{ $subcategory->id }}">{{ $subcategory->getName() }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="border-bottom pb-4">
                        <div class="h5 pb-2">
                            Brands
                        </div>
                        <div style="height: 180px; overflow-y: scroll">
                            @foreach($brands as $brand)
                                <div class="d-flex">
                                    <input class="form-check-input pb-3 me-2 brand-filter" type="checkbox" id="b{{ $brand->id }}" name="b[]"
                                           value="{{ $brand->id }}" {{ $f_brands->contains($brand->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="b{{ $brand->id }}">{{ $brand->getName() }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="border-bottom py-4">
                        <div class="h5 pb-2">
                            Colors
                        </div>
                        <div style="height: 180px; overflow-y: scroll">
                            @foreach($colors as $color)
                                <div class="d-flex">
                                    <input class="form-check-input pb-3 me-2 color-filter" type="checkbox" id="color{{ $color->id }}" name="color[]"
                                           value="{{ $color->id }}" {{ $f_colors->contains($color->id) ? 'checked' : '' }}>
                                    <label for="color{{ $color->id }}">{{ $color->getName() }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @foreach($category['attributes'] as $attribute)
                        <div class="border-bottom py-4">
                            <div class="h5 pb-2">
                                {{ $attribute->getName() }}
                            </div>
                            <div style="height: 180px; overflow-y: scroll">
                                @foreach($attribute['attributeValues'] as $value)
                                    <div class="d-flex">
                                        <input class="form-check-input pb-3 me-2 value-filter" type="checkbox" id="a{{ $value->id }}"
                                               data-attribute="{{ $attribute->id }}" name="v[][$attribute->id]"
                                               value="{{ $value->id }}" {{ $f_values->contains($value->id) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="a{{ $value->id }}">{{ $value->getName() }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                    <div>
                        <a href="{{ url()->current() }}" class="btn btn-secondary w-100">
                            <i class="bi-trash2"></i>
                        </a>
                    </div>
                </div>

                <!-- Product cards -->
                <div class="col-10">
                    <div class="row row-cols-2 row-cols-lg-3 row-cols-xl-4 products-container g-3">
                        @foreach($products as $product)
                            <div class="col product-card post" id="product-{{$product->id}}" data-brand="{{ optional($product->brand)->id }}"
                                 data-value="{{ implode(',', optional($product->attributeValues)->pluck('id')->toArray()) }}"
                                 data-color="{{ optional($product->color)->id }}" data-subcategory="{{ $product->category->id }}">
                                @include('client.app.product_card')
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </form>

    <style>
        .arrow {
            background: rgba(242, 243, 245, 1);
            width: 32px;
            height: 32px;
            border-radius: 100%
        }

        .card-category:hover .arrow {
            background: #FC1000;;
            color: white;
            transition: .4s;
        }

        .card-category {
            border: 1px solid #F5F5F7;
        !important;
            transition: .4s;
            background: #F5F5F7;
        }

        .card-category:hover {
            border: 1px solid #FC1000;
        !important;
        }

        input.gray[type="checkbox"] {
            background-color: red;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let brandFilter = document.getElementsByClassName('brand-filter');
            let products = document.getElementsByClassName('product-card');
            let valueFilter = document.getElementsByClassName('value-filter');
            let colorFilter = document.getElementsByClassName('color-filter');
            let subcategoryFilter = document.getElementsByClassName('subcategory-filter');
            let productCountElement = document.getElementById('product-count');

            function applyFilters() {
                let selectedBrands = [];
                let selectedValues = [];
                let selectedColors = [];
                let selectedSubcategories = [];

                // Collect selected brands, values, config, and subcategories
                for (const brandCheckbox of brandFilter) {
                    if (brandCheckbox.checked) {
                        selectedBrands.push(brandCheckbox.value);
                    }
                }

                for (const valueCheckbox of valueFilter) {
                    if (valueCheckbox.checked) {
                        selectedValues.push(valueCheckbox.value);
                    }
                }

                for (const colorCheckbox of colorFilter) {
                    if (colorCheckbox.checked) {
                        selectedColors.push(colorCheckbox.value);
                    }
                }

                for (const subcategoryCheckbox of subcategoryFilter) {
                    if (subcategoryCheckbox.checked) {
                        selectedSubcategories.push(subcategoryCheckbox.value);
                        console.log((subcategoryCheckbox.value))
                    }
                }

                // Loop through products
                let visibleProductCount = 0;
                for (const product of products) {
                    product.classList.remove('d-none');

                    let productBrand = product.getAttribute('data-brand');
                    let productValues = product.getAttribute('data-value').split(',');
                    let productColor = product.getAttribute('data-color');
                    let productSubcategory = product.getAttribute('data-subcategory');

                    // Check brand filter
                    if (selectedBrands.length > 0 && !selectedBrands.includes(productBrand)) {
                        product.classList.add('d-none');
                    }

                    // Check attribute value filter
                    if (selectedValues.length > 0 && !selectedValues.some(value => productValues.includes(value))) {
                        product.classList.add('d-none');
                    }

                    // Check color filter
                    if (selectedColors.length > 0 && !selectedColors.includes(productColor)) {
                        product.classList.add('d-none');
                    }

                    // Check subcategory filter
                    if (selectedSubcategories.length > 0 && !selectedSubcategories.includes(productSubcategory)) {
                        product.classList.add('d-none');
                    }

                    // Check if the product is visible
                    if (!product.classList.contains('d-none')) {
                        visibleProductCount++;
                    }
                }

                // Update the product count on the page with the total quantity
                productCountElement.textContent = visibleProductCount + ' / {{ $productsCount }}';
                productCountElement.textContent = visibleProductCount + ' haryt bar';
            }

            // Attach change event listeners
            for (const item of brandFilter) {
                item.addEventListener('change', applyFilters);
            }

            for (const valueCheckbox of valueFilter) {
                valueCheckbox.addEventListener('change', applyFilters);
            }

            for (const colorCheckbox of colorFilter) {
                colorCheckbox.addEventListener('change', applyFilters);
            }

            for (const subcategoryCheckbox of subcategoryFilter) {
                subcategoryCheckbox.addEventListener('change', applyFilters);
            }

            // Initial call to apply filters on page load
            applyFilters();
        });
    </script>

@endsection
