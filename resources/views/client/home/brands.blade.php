<div class="container-xl mb-4">
    <div class="splide" role="group" id="splide-brands">
        <div class="splide__track">
            <ul class="splide__list">
                @foreach($brands as $brand)
                    <li class="splide__slide">
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('brand.show', $brand->slug) }}" class="text-decoration-none">
                                <div class="text-hover">
                                    <div class="text-center">
                                        <img src="{{ $brand->image ? asset('storage/img/brands/' . $brand->image) : asset('img/brand.jpg') }}" alt="" style="height: 86px; width: 176px; border-radius: 12px;">
                                    </div>
                                    <div class="text-center pt-2" style="font-size: 12px; font-weight: 400; text-transform: uppercase;">
                                        {{ $brand->getName() }}
                                    </div>
                                </div>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>


<style>
    .text-hover {
        transition: .4s;
        color: #27272E!important;
    }

    .text-hover:hover {
        color: #fc1000!important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let splide = new Splide('#splide-brands', {
            type: 'loop',
            perPage: 4,
            pagination: false,
            autoScroll: {
                speed: 0.7,
                pauseOnHover: false,
            },
            gap: 200,
            padding: 250,
            arrows: false,
            pauseOnHover: false,
            breakpoints: {
                991: {
                    arrows: false,
                    perPage: 4,
                    gap: 200,
                    padding: 250,
                    autoScroll: {
                        speed: 0.7,
                    },
                },
                767: {
                    arrows: false,
                    perPage: 3,
                    gap: 200,
                    padding: 250,
                    autoScroll: {
                        speed: 0.7,
                    },
                },
                576: {
                    perPage: 2,
                    gap: 200,
                    padding: 150,
                    autoScroll: {
                        speed: 0.4,
                    },
                    arrows: false,
                    pagination: false,
                },

            }
        });
        splide.mount(window.splide.Extensions);
    });
</script>