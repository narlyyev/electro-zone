<div class="splide" role="group" id="splide-slider">
    <div class="splide__track">
        <ul class="d-none d-md-flex splide__list">
            @forelse($sliders as $slider)
                @php
                    $currentLanguage = app()->getLocale() == 'tm' ? 'image' : 'image_ru';
                    $imagePath = asset("storage/img/sliders/{$currentLanguage}/{$slider->$currentLanguage}");
                @endphp
                <li class="splide__slide">
                    <img src="{{ $imagePath }}"
                         alt="{{ $slider->$currentLanguage }}"
                         class="w-100 d-block" style="object-fit: cover; border-radius: 20px;">
                </li>
            @empty
                <li class="splide__slide">
                    <img src="{{ asset('img/image1.png') }}"
                         alt="Default Image"
                         class="w-100 d-block" style="object-fit: cover; border-radius: 20px;">
                </li>
            @endforelse
        </ul>

        <div class="splide__arrows splide__arrows--ltr">
            <button
                    class="splide__arrow splide__arrow--prev"
                    type="button"
                    style="border: 1px solid rgba(255, 255, 255, 0.20); background: rgba(0, 0, 0, 0.10); box-shadow: 0px 1px 6px 0px rgba(0, 0, 0, 0.10); backdrop-filter: blur(25px); padding: 20px;"
                    aria-label="Previous slide"
                    aria-controls="splide01-track"
            >
                <img src="{{ asset('img/arrow-left.svg') }}" alt="">
            </button>
            <button
                    class="splide__arrow splide__arrow--next"
                    type="button"
                    style="border: 1px solid rgba(255, 255, 255, 0.20); background: rgba(0, 0, 0, 0.10); box-shadow: 0px 1px 6px 0px rgba(0, 0, 0, 0.10); backdrop-filter: blur(25px); padding: 20px;"
                    aria-label="Next slide"
                    aria-controls="splide01-track"
            >
                <img src="{{ asset('img/arrow-right.svg') }}" alt="">
            </button>
        </div>
    </div>
</div>


<div class="splide" role="group" id="splide-mobile-slider">
    <div class="splide__track">
        <ul class="d-flex d-md-none splide__list">
            @forelse($sliders as $slider)
                @php
                    $currentLanguage = app()->getLocale() == 'tm' ? 'mobile_image' : 'mobile_image_ru';
                    $imagePath = asset("storage/img/sliders/{$currentLanguage}/{$slider->$currentLanguage}");
                @endphp
                <li class="splide__slide">
                    <img src="{{ $imagePath }}"
                         alt="{{ $slider->$currentLanguage }}"
                         class="w-100 d-block" style="object-fit: cover; border-radius: 20px;">
                </li>
            @empty
                <li class="splide__slide">
                    <img src="{{ asset('img/image1.png') }}"
                         alt="Default Image"
                         class="w-100 d-block" style="object-fit: cover; border-radius: 20px;">
                </li>
            @endforelse
        </ul>

        <div class="splide__arrows splide__arrows--ltr">
            <button
                    class="splide__arrow splide__arrow--prev"
                    type="button"
                    style="border: 1px solid rgba(255, 255, 255, 0.20); background: rgba(0, 0, 0, 0.10); box-shadow: 0px 1px 6px 0px rgba(0, 0, 0, 0.10); backdrop-filter: blur(25px); padding: 20px;"
                    aria-label="Previous slide"
                    aria-controls="splide01-track"
            >
                <img src="{{ asset('img/arrow-left.svg') }}" alt="">
            </button>
            <button
                    class="splide__arrow splide__arrow--next"
                    type="button"
                    style="border: 1px solid rgba(255, 255, 255, 0.20); background: rgba(0, 0, 0, 0.10); box-shadow: 0px 1px 6px 0px rgba(0, 0, 0, 0.10); backdrop-filter: blur(25px); padding: 20px;"
                    aria-label="Next slide"
                    aria-controls="splide01-track"
            >
                <img src="{{ asset('img/arrow-right.svg') }}" alt="">
            </button>
        </div>
    </div>
</div>

<style>
    .splide__pagination__page {
        border-radius: 20px;
        height: 4px;
        margin: 0 8px;
        border: 0.2px solid rgba(0, 0, 0, 0.10);
        background: rgba(255, 255, 255, 0.50);
        backdrop-filter: blur(10px);
        width: 60px;
    }

    .splide__pagination__page.is-active {
        border-radius: 100px;
        margin: 0 8px;
        background: rgb(255, 255, 255);
        height: 4px;
        width: 45px;

    }

    button.splide__arrow.splide__arrow--prev {
        transition: .4s;
    }

    button.splide__arrow.splide__arrow--next {
        transition: .4s;
    }

    button.splide__arrow.splide__arrow--prev:hover {
        border: 1px solid white !important;
    }

    button.splide__arrow.splide__arrow--next:hover {
        border: 1px solid white !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let splide = new Splide('#splide-slider', {
            type: 'loop',
            autoplay: true,
            arrows: true,
            pagination: true,
            gap: 25,
            interval: 3000,
            perMove: 1,
            perPage: 1,
            pauseOnHover: false,
            pauseOnFocus: false,
        });
        splide.mount();
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        let splide_2 = new Splide('#splide-mobile-slider', {
            type: 'loop',
            autoplay: true,
            arrows: true,
            pagination: false,
            gap: 25,
            interval: 3000,
            perMove: 1,
            perPage: 1,
            pauseOnHover: false,
            pauseOnFocus: false,
        });
        splide_2.mount();
    });
</script>