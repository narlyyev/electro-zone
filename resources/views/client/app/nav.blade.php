<style>
    .min-brightness {
        filter: brightness(0.6);
    }

    .dropbtn {
        background-color: #fff;
        color: #333;
        font-size: 14px;
        font-weight: 500;
        border: none;
        cursor: pointer;
        outline: none;
        width: 100%;
    }

    .dropend .dropdown-toggle::after {
        display: none !important;
    }

    .overflow-scroll-none {
        overflow-y: hidden;
    }

    .blur {
        filter: blur(5px);
    }

    /* clears the ‘X’ from Internet Explorer */
    input[type=search]::-ms-clear {
        display: none;
        width: 0;
        height: 0;
    }

    input[type=search]::-ms-reveal {
        display: none;
        width: 0;
        height: 0;
    }

    #clear-search {
        color: white;
    }

    #clear-search:hover {
        color: #FC1000;
    }

    .search-btn path {
        stroke: #fc1000;
    }

    /* clears the ‘X’ from Chrome */
    input[type="search"]::-webkit-search-decoration,
    input[type="search"]::-webkit-search-cancel-button,
    input[type="search"]::-webkit-search-results-button,
    input[type="search"]::-webkit-search-results-decoration {
        display: none;
    }

    .text-red {
        color: #FC1000;
    }
</style>
<div>
    <div style="background-color: {{ $config->hex_code }}">
        <div class="container-xl py-3">
            <div class="row align-items-center">
                <div class="col-3">
                    <div class="row align-items-center">
                        <div class="col-3">
                            <div id="red-category" class="red-stroke"
                                 style="background-color: #FC1000; border: 1px solid #FC1000; border-radius: 12px; width: 46px; height: 46px; cursor: pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="white"
                                     style="position: relative; transform: translate(11px, 9px);">
                                    <path d="M3.75 6.75H20.25M3.75 12H20.25M3.75 17.25H20.25" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div id="x-mark" class="d-none"
                                 style="border: 1px solid #FC1000; background-color: #FC1000; border-radius: 13px; width: 46px; height: 46px; cursor: pointer">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="white"
                                     xmlns="http://www.w3.org/2000/svg"
                                     style="position: relative; transform: translate(11px, 9px);">
                                    <path d="M6 18L18 6M6 6L18 18" stroke="white" stroke-width="1.5"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                        <div class="col-9">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('img/' . $config->logo) }}" alt="" class="img-fluid">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex justify-content-center align-items-center pt-1">
                        <div class="d-flex align-items-center">
                            <div class="d-flex">
                                <div>
                                    <a class="nav-link active fs-13px text-uppercase {{ request()->routeIs('home') ? 'text-red fw-bold' : 'text-white' }}"
                                       aria-current="page" href="{{ route('home') }}"
                                       style="font-size: 14px; font-weight: 500;">
                                        @lang('app.home')
                                    </a>
                                </div>
                                <div class="h6 mb-0 mx-1 text-white">
                                    <i class="bi-dot"></i>
                                </div>
                                <div>
                                    <a class="nav-link active fs-13px text-uppercase {{ request()->routeIs('about.index') ? 'text-red fw-bold' : 'text-white' }}"
                                       aria-current="page" href="{{ route('about.index') }}"
                                       style="font-size: 14px; font-weight: 500;">
                                        @lang('app.about')
                                    </a>
                                </div>
                                <div class="h6 mb-0 mx-1 text-white">
                                    <i class="bi-dot"></i>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div>
                                    <a class="nav-link active fs-13px text-uppercase {{ request()->routeIs('news.index') ? 'text-red fw-bold' : 'text-white' }}"
                                       aria-current="page" href="{{ route('news.index') }}"
                                       style="font-size: 14px; font-weight: 500;">
                                        @lang('app.news')
                                    </a>
                                </div>
                                <div class="h6 mb-0 mx-1 text-white">
                                    <i class="bi-dot"></i>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div>
                                    <a class="nav-link active fs-13px text-uppercase {{ request()->routeIs('contact.index') ? 'text-red fw-bold' : 'text-white' }}"
                                       aria-current="page" href="{{ route('contact.index') }}"
                                       style="font-size: 14px; font-weight: 500;">
                                        @lang('app.contact')
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="d-flex align-items-center justify-content-end">
                        <div class="me-4"
                             style="background-color: rgba(246, 246, 246, 0.10); border-radius: 12px; padding: 4px;">
                            <div class="d-flex align-items-center">
                                <div style="width: 41px; height: 31px; color: rgba(255, 255, 255, .6);">
                                    <a class="dropdown-item small text-decoration-none text-center"
                                       href="{{ route('language', 'tm') }}"
                                       @if(app()->getLocale() === 'tm') style="color: black; background: white; padding: 5px; border-radius: 8px; width: 41px; height: 31px;" @else style="padding: 5px; width: 41px; height: 31px;" @endif>
                                        TM
                                    </a>
                                </div>
                                <div style="width: 41px; height: 31px; color: rgba(255, 255, 255, .6);">
                                    <a class="dropdown-item small text-decoration-none text-center"
                                       href="{{ route('language', 'ru') }}"
                                       @if(app()->getLocale() === 'ru') style="color: black; background: white; padding: 5px; border-radius: 8px; width: 41px; height: 31px;" @else style="padding: 5px; width: 41px; height: 31px;" @endif>
                                        RU
                                    </a>
                                </div>
                                <div style="width: 41px; height: 31px; color: rgba(255, 255, 255, .6);">
                                    <a class="dropdown-item small text-decoration-none text-center"
                                       href="{{ route('language', 'en') }}"
                                       @if(app()->getLocale() === 'en') style="color: black; background: white; padding: 5px; border-radius: 8px; width: 41px; height: 31px;" @else style="padding: 5px; width: 41px; height: 31px;" @endif>
                                        EN
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="pe-2" id="search-btn" style="cursor: pointer">
                            <svg width="26" height="26" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.58341 17.5C13.9557 17.5 17.5001 13.9555 17.5001 9.58329C17.5001 5.21104 13.9557 1.66663 9.58341 1.66663C5.21116 1.66663 1.66675 5.21104 1.66675 9.58329C1.66675 13.9555 5.21116 17.5 9.58341 17.5Z"
                                      stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M18.3334 18.3333L16.6667 16.6666" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div>
                            <a href="{{ route('cart') }}" class="nav-link position-relative"
                               style="font-weight: 500;">
                                <div class="d-flex align-items-center">
                                    <div class="ps-2">
                                        <div>
                                            <svg width="26" height="26" viewBox="0 0 19 18" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12.5626 7.875V4.5C12.5626 2.9467 11.3034 1.6875 9.75012 1.6875C8.19682 1.6875 6.93762 2.9467 6.93762 4.5V7.875M15.4546 6.38042L16.402 15.3804C16.4544 15.8786 16.0638 16.3125 15.5629 16.3125H3.93735C3.43641 16.3125 3.04579 15.8786 3.09823 15.3804L4.0456 6.38042C4.0908 5.951 4.45292 5.625 4.88471 5.625H14.6155C15.0473 5.625 15.4094 5.951 15.4546 6.38042ZM7.21887 7.875C7.21887 8.03033 7.09295 8.15625 6.93762 8.15625C6.78229 8.15625 6.65637 8.03033 6.65637 7.875C6.65637 7.71967 6.78229 7.59375 6.93762 7.59375C7.09295 7.59375 7.21887 7.71967 7.21887 7.875ZM12.8439 7.875C12.8439 8.03033 12.7179 8.15625 12.5626 8.15625C12.4073 8.15625 12.2814 8.03033 12.2814 7.875C12.2814 7.71967 12.4073 7.59375 12.5626 7.59375C12.7179 7.59375 12.8439 7.71967 12.8439 7.875Z"
                                                      stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                        <span class="position-absolute translate-middle badge rounded-pill"
                                              id="cart" style="background: red; font-size: 12px; left: 37px; top: 2px;">
                                0
                                </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-none container-xl position-absolute start-0 end-0" style="z-index: 5" id="items">
        <div class="bg-white border shadow"
             style="border-radius: 0 0 24px 24px; padding: 16px; max-height: 80vh; overflow-y: scroll; overflow-x: hidden;  position: relative;">
            @include('client.app.nav-category')
        </div>
    </div>
</div>
<div class="py-4 d-none" style="background: #333;" id="search-place">
    <div class="d-flex align-items-center justify-content-center ms-3">
        <form action="{{ route('product.index') }}" method="get" class="d-flex" role="search">
            <div>
                <div class="d-flex align-items-center">
                    <div class="input-group">
                        <input class="border-0 size search text-white" type="search" name="q"
                               placeholder="Write the product, category, or brand you are looking for" id="search"
                               value="{{ isset($q) ? $q : old('q') }}"
                               style="outline: none; height: 50px; font-size: 14px; font-weight: 400; background-color: rgba(246, 246, 246, 0.10); border: 1px solid rgba(246, 246, 246, 0.10); border-radius: 14px; padding: 0 45px;">
                    </div>
                    <div class="fs-6 ps-3" id="clear-search" style="cursor: pointer;">
                        <i class="bi-x-lg"></i>
                    </div>
                </div>
                <div>
                    <div class="list-group d-none result" id="result"
                         style="z-index: 109; max-height: 50vh; overflow-y: auto; border-radius: 0;">
                    </div>
                    <div class="text-center" id="all_result">
                        <button class="btn mt-2" style="color: #FC1000; text-decoration: underline;">
                            ÄHLI NETIJELER
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    #x-mark, #red-category {
        transition: opacity 0.3s ease-in-out;
    }

    .fs-13px {
        font-size: 13px !important;
    }

    a.nav-link:hover {
        color: #FC1000 !important;
    }

    body {
        font-family: "Inter", sans-serif;
        background-color: rgba(230, 238, 249, 0.5);
    }

    @media screen and (min-width: 1200px) {
        .size {
            width: 650px;
            height: 56px;
        }

        .result {
            width: 100%;
            top: 150px;
        }
    }

    @media screen and (max-width: 1399px) {
        .size {
            width: 600px;
            height: 50px;
        }

        .result {
            width: 100%;
            top: 110px;
        }
    }

    @media screen and (max-width: 1127px) {
        .size {
            width: 550px;
            height: 45px;
        }

        .result {
            top: 100%;
            width: 516px;
        }
    }


    @media screen and (max-width: 1077px) {
        .size {
            width: 500px;
            height: 40px;
        }

        .result {
            width: 100%;
            top: 105px;
        }
    }


    @media screen and (max-width: 389px) {
        .size {
            width: 650px;
            height: 56px;
        }

        .result {
            width: 100%;
        }
    }

    @media screen and (max-width: 353px) {
        .size {
            width: 650px;
            height: 56px;
        }

        .result {
            width: 100%;
        }
    }

    .size::placeholder {
        color: #9B9B9B;
        font-weight: 400;
    }

    .size {
        background: url("{{ asset('img/search.svg') }}") no-repeat 14px;
    }

    .list-group {
        --bs-list-group-bg: transparent;
        --bs-list-group-border-color: transparent;
        --bs-list-group-color: white;
        --bs-list-group-hover-bg: transparent;
        --bs-list-group-action-hover-bg: rgba(246, 246, 246, 0.10);
        --bs-list-group-action-active-bg: rgba(246, 246, 246, 0.10);
        --bs-list-group-action-active-color: white;
        --bs-list-group-action-hover-color: white;
        margin-top: 10px;
        margin-bottom: 10px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let xMark = document.getElementById('x-mark');
        let redCategory = document.getElementById('red-category');
        let item = document.getElementById('items');
        let content = document.getElementById('content');

        redCategory.addEventListener('click', function () {
            xMark.classList.remove('d-none');
            redCategory.classList.add('d-none');
            item.classList.remove('d-none');
            document.body.classList.add('overflow-scroll-none');
            content.classList.add('min-brightness');
            content.classList.add('bg-shadow');
        });

        xMark.addEventListener('click', function () {
            redCategory.classList.remove('d-none');
            xMark.classList.add('d-none');
            item.classList.add('d-none');
            document.body.classList.remove('overflow-scroll-none');
            content.classList.remove('min-brightness');
            content.classList.remove('bg-shadow');
        });
    });

</script>

<script>
    $(document).ready(function () {
        let timeout = null;
        $('.search').keyup(function () {
            clearTimeout(timeout);
            let search = $(this).val();
            timeout = setTimeout(function () {
                if (search.length > 2) {
                    $.ajax({
                        url: "{{ route('quick.search') }}",
                        dataType: "json",
                        type: "GET",
                        data: {
                            'q': search,
                            'slug_tm': search,
                            'slug_ru': search,
                            'slug_en': search,
                        },
                        success: function (result) {
                            let products = '';
                            if (result.products && result.products.data && result.products.data.length > 0) {
                                for (let i = 0; i < result.products.data.length; i++) {
                                    let slug = result.products.data[i].slug;
                                    let productUrl = "{{ route('product.show', ':slug') }}".replace(':slug', slug);
                                    products +=
                                        '<a href="' + productUrl + '" class="list-group-item list-group-item-action px-2 px-sm-3 py-2" style="border-radius: 8px;">' +
                                        '<div class="row align-items-center">' +
                                        '<div class="col-auto rounded"><img src="' + ((result.products.data[i].image && result.products.data[i].image.startsWith('/storage/techno-products/'))
                                            ? result.products.data[i].image
                                            : '/storage/products/sm/' + result.products.data[i].image) + '" class="img-fluid rounded" width="50"></div>' +
                                        '<div class="col line-clamp-2">' + result.products.data[i].name + '</div>' +
                                        '</div></a>';
                                }
                            } else {
                                products = '<div class="list-group-item">@lang('admin.product ') @lang('admin.not - found ')</div>';
                            }
                            $('.result').html(products).removeClass('d-none');
                        },
                        error: function (xhr, status, error) {
                            console.error("AJAX Error:", status, error);
                            // Handle error here
                        }
                    });
                } else {
                    $('.result').html('').addClass('d-none');
                }
            }, 100);
        });
    });
</script>

<script>
    let clear = document.getElementById('clear-search');
    let search = document.getElementById('search');
    let result = document.getElementById('result');
    let searchBtn = document.getElementById('search-btn')
    let searchPlace = document.getElementById('search-place');
    let allResult = document.getElementById('all_result');

    clear.addEventListener('click', function () {
        console.log(11)
        if (search.value !== '') {
            search.value = '';
            result.classList.add('d-none');
        }
    });

    searchBtn.addEventListener('click', function () {
        searchPlace.classList.toggle('d-none');
        searchBtn.classList.toggle('search-btn')
    });
</script>






