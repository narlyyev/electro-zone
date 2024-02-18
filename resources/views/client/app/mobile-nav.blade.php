<div class="d-flex d-lg-none justify-content-between align-items-center">
    <div>
        <div class="d-flex py-3">
            <div>
                <header class="d-block d-lg-none">
                    <div class="d-flex align-items-center">
                        <div class="menu-btn" style="margin-right: 20px;">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </header>
            </div>
            <div>
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('img/logo-white.svg') }}" alt="" class="img-fluid" style="height: 20px;">
                </a>
            </div>
        </div>
    </div>
    <div class="p-1"
         style="background-color: rgba(246, 246, 246, 0.10); border-radius: 12px; padding-bottom: 2px!important;">
        <div class="d-flex align-items-center">
            <div style="width: 39px; height: 23px; color: rgba(255, 255, 255, .6)">
                <a class="dropdown-item small text-decoration-none text-center"
                   href="{{ route('language', 'tm') }}"
                   @if(app()->getLocale() === 'tm') style="color: black; background: white; padding-right: 10px; padding-left: 9px; border-radius: 8px;" @endif>
                    TM
                </a>
            </div>
            <div style="width: 39px; height: 23px; color: rgba(255, 255, 255, .6)">
                <a class="dropdown-item small text-decoration-none text-center"
                   href="{{ route('language', 'ru') }}"
                   @if(app()->getLocale() === 'ru') style="color: black; background: white; padding-right: 10px; padding-left: 10px; border-radius: 8px;" @endif>
                    RU
                </a>
            </div>
            <div style="width: 39px; height: 23px; color: rgba(255, 255, 255, .6)">
                <a class="dropdown-item small text-decoration-none text-center"
                   href="{{ route('language', 'en') }}"
                   @if(app()->getLocale() === 'en') style="color: black; background: white; padding-right: 10px; padding-left: 10px; border-radius: 8px;" @endif>
                    EN
                </a>
            </div>
        </div>
    </div>
</div>
<div class="menu d-block d-lg-none">
    <ul class="navbar-nav d-flex justify-content-center align-items-center vh-100 ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link active text-white" aria-current="page" href="#">
                @lang('app.about-us')
            </a>
        </li>
        <li class="nav-item my-3">
            <a class="nav-link active text-white" aria-current="page" href="#">
                @lang('app.services')
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link active text-white" aria-current="page" href="#">
                @lang('app.guarantee')
            </a>
        </li>
        <li class="nav-item my-3">
            <a class="nav-link active text-white" aria-current="page" href="#">
                @lang('app.delivery-and-payment')
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link active text-white" aria-current="page" href="#">
                @lang('app.reviews')
            </a>
        </li>
        <li class="nav-item mt-3 mb-5 pb-3">
            <a class="nav-link active text-white" aria-current="page" href="#">
                @lang('app.report-a-problem')
            </a>
        </li>
        <div class="d-flex">
            <div class="border p-3">
                <a class="text-decoration-none text-white" href="{{ route('language', 'tm') }}">
                    TM
                </a>
            </div>
            <div class="mx-5 px-3 border p-3">
                <a class="text-decoration-none text-white" href="{{ route('language', 'ru') }}">
                    RU
                </a>
            </div>
            <div class="border p-3">
                <a class="text-decoration-none text-white" href="{{ route('language', 'en') }}">
                    EN
                </a>
            </div>
        </div>
    </ul>
</div>

<div class="row justify-content-center mb-2">
    <div class="col-12">
        <div>
            <form action="{{ route('product.index') }}" method="get" role="search">
                <div>
                    <div class="input-group">
                        <input class="border-0 size search" type="search"
                               placeholder="Write the product, category, or brand you are looking for"
                               aria-label="Search" name="q"
                               style="outline: none; font-size: 12px; font-weight: 400; background-color: #333333; color: white; border-radius: 8px; padding: 20px 20px 20px 45px; width: 100%;">
                    </div>
                    <div>
                        <div class="list-group d-none result" id="result"
                             style="z-index: 109; max-height: 50vh; overflow-y: auto; border-radius: 0; overflow-x: hidden;">
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
</div>

<style>
    .menu-btn {
        display: block;
        margin-left: auto;
        margin-right: 5px;
        width: 30px;
        height: 30px;
        position: relative;
        z-index: 15;
        overflow: hidden;
    }

    .menu-btn span {
        width: 25px;
        height: 2px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #858585;
        transition: all 0.5s;
        margin-right: 10px;
    }

    .menu-btn span:nth-of-type(2) {
        top: calc(50% - 5px);
    }

    .menu-btn span:nth-of-type(3) {
        top: calc(50% + 5px);
    }

    .menu {
        position: fixed;
        z-index: 10;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        padding: 15px;
        background: #0C0B37;
        transform: translateX(-100%);
        transition: transform 0.5s;
    }

    .menu.active {
        transform: translateX(0);
    }

    .menu li {
        list-style-type: none;
    }

    .menu-btn.active span:nth-of-type(1) {
        display: none;
    }

    .menu-btn.active span:nth-of-type(2) {
        top: 50%;
        transform: translate(-50%, 0%) rotate(45deg);
    }

    .menu-btn.active span:nth-of-type(3) {
        top: 50%;
        transform: translate(-50%, 0%) rotate(-45deg);
    }
</style>

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
