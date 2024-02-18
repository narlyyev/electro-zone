<div class="d-none d-lg-block" style="border-top: 1px solid rgba(226, 229, 233, 1);">
    <div class="container-xl border-bottom py-5">
        <div class="row row-cols-1 row-col-md-2 row-cols-lg-4" style="color:rgba(66, 66, 69, 1)">
            <div class="col d-flex justify-content-center">
                <div>
                    <div class="h5 pb-3">
                        Maglumatlar
                    </div>
                    <div class="pb-3">
                        <a class="text-decoration-none" style="color:rgba(66, 66, 69, 1);" href="#">
                            @lang('app.home')
                        </a>
                    </div>
                    <div class="pb-3">
                        <a class="text-decoration-none" style="color:rgba(66, 66, 69, 1);" href="#">
                            @lang('app.about')
                        </a>
                    </div>
                    <div class="pb-3">
                        <a class="text-decoration-none" style="color:rgba(66, 66, 69, 1);" href="#">
                            @lang('app.secondHand')
                        </a>
                    </div>
                    <div class="pb-3">
                        <a class="text-decoration-none" style="color:rgba(66, 66, 69, 1);" href="#">
                            @lang('app.news')
                        </a>
                    </div>
                    <div>
                        <a class="text-decoration-none" style="color:rgba(66, 66, 69, 1);" href="#">
                            @lang('app.contact')
                        </a>
                    </div>
                </div>
            </div>
            <div class="col d-flex justify-content-center">
                <div>
                    <div class="h5 pb-3">
                        Esasy bölümler
                    </div>
                    <div class="pb-3">
                        <a class="text-decoration-none" style="color:rgba(66, 66, 69, 1);" href="#">
                            Telefon
                        </a>
                    </div>
                    <div class="pb-3">
                        <a class="text-decoration-none" style="color:rgba(66, 66, 69, 1);" href="#">
                            PC Notebook
                        </a>
                    </div>
                    <div class="pb-3">
                        <a class="text-decoration-none" style="color:rgba(66, 66, 69, 1);" href="#">
                            Tehniki enjamlar
                        </a>
                    </div>
                    <div class="pb-3">
                        <a class="text-decoration-none" style="color:rgba(66, 66, 69, 1);" href="#">
                            Nauşnikler
                        </a>
                    </div>
                    <div class="pb-3">
                        <a class="text-decoration-none" style="color:rgba(66, 66, 69, 1);" href="#">
                            Akylly sagatlar
                        </a>
                    </div>
                </div>
            </div>
            <div class="col d-flex justify-content-center">
                <div>
                    <div class="h5 pb-3">
                        @lang('app.contact')
                    </div>
                    <div class="pb-3">
                        <a class="text-decoration-none" style="color:rgba(66, 66, 69, 1);" href="#">
                            {{ $config->phone_1 }}
                        </a>
                    </div>
                    <div class="pb-3">
                        <a class="text-decoration-none" style="color:rgba(66, 66, 69, 1);" href="#">
                            {{ $config->phone_2 }}
                        </a>
                    </div>
                    <div>
                        <a class="text-decoration-none" style="color:rgba(66, 66, 69, 1);" href="#">
                            {{ $config->address }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="col d-flex justify-content-center">
                <div>
                    <div class="h5 pb-3">
                        Bizi yzarlaň
                    </div>
                    <div class="pb-3">
                        <a href="#" class="text-decoration-none pe-3">
                            <img src="{{ asset('img/instagram.svg') }}" alt="">
                        </a>
                        <a href="#" class="text-decoration-none" style="color:#424245;">
                            <img src="{{ asset('img/tiktok.svg') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-xl py-5">
        <div class="d-flex justify-content-center">
            <div>
                Copyright &copy; {{ date('Y') }} Media. All rights reserved.
            </div>
        </div>
    </div>
</div>


<div class="d-block d-lg-none" style="margin-top: 120px;">
    <div class="bg-white py-4 fixed-bottom">
        <div class="container-xl">
            <div class="row">
                <div class="col-4">
                    <div class="d-flex justify-content-center">
                        <div class="text-center">
                            <a href="{{ route('home') }}"
                               class="{{ request()->routeIs('home') ? 'text-blue text-decoration-none' : 'text-decoration-none text-black' }}">
                                <div>
                                    <i class="bi-house {{ request()->routeIs('home') ? 'text-blue' : 'text-black'}}" style="font-size: 25px;"></i>
                                </div>
                                <div>
                                    Home
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="d-flex justify-content-center">
                        <div class="text-center">
                            <a href="#"
                               class="{{ request()->routeIs('categories') ? 'text-blue text-decoration-none' : 'text-decoration-none text-black' }}">
                                <div class="{{ request()->routeIs('categories') ? 'fill-blue' : ''}}">
                                    <i class="bi-view-stacked {{ request()->routeIs('categories') ? 'text-blue' : 'text-black'}}" style="font-size: 25px;"></i>
                                </div>
                                <div>
                                    Categories
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="d-flex justify-content-center">
                        <div class="text-center">
                            <a href="{{ route('cart') }}"
                               class="{{ request()->routeIs('cart') ? 'text-blue text-decoration-none' : 'text-decoration-none text-black' }}">
                                <div class="{{ request()->routeIs('cart') ? 'fill-blue' : ''}}">
                                    <i class="bi-bag {{ request()->routeIs('cart') ? 'text-blue' : 'text-black'}}" style="font-size: 25px;"></i>
                                </div>
                                <div>
                                    Cart
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    .text-blue {
        color: #007AFF;
        font-weight: 700;
    }

    .fill-blue svg path{
        stroke: #007AFF;
    }

    .fill-black svg path{
        stroke: black;
    }
</style>