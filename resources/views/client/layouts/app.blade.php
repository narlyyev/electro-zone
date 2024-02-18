<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="{{ $config->hex_code }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/splide.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('js/splide.min.js') }}" defer></script>
    <script src="{{ asset('js/splide-autoscroll.js') }}" defer></script>
    <script src="{{ asset('js/countdowntime.js') }}" defer></script>
    <script>
        function init() {
            const loadImages = document.getElementsByClassName('load-image');
            for (const loadImage of loadImages) {
                const dataSrc = loadImage.getAttribute('data-src');
                if (dataSrc) {
                    loadImage.src = dataSrc;
                }
            }
        }
        window.onload = init;
    </script>

    <style>
        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content {
            flex-grow: 1;
        }

        .footer {
            margin-top: auto;
        }

        #snow {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
            z-index: 2000;
        }

        .bg-gray {
            background-color: #f5f5f7 !important;
        }

        .bg-shadow {
            background: rgba(0, 0, 0, 0.20);
            backdrop-filter: blur(2px);
        }
    </style>


</head>

<body class="font-sf {{ request()->routeIs('home') ? 'bg-gray' : 'bg-white' }}">
<div class="wrapper">
    <div class="d-none d-lg-block sticky-top" id="nav">
        @include('client.app.nav')
    </div>
    <div class="d-block d-lg-none" style="background: {{ $config->hex_code }};">
        <div class="container-xl">
            @include('client.app.mobile-nav')
        </div>
    </div>
    @include('client.app.alert')
    <div class="content position-relative" id="content">
        @yield('content')
    </div>
    <footer class="footer">
        @include('client.app.footer')
    </footer>
    <div id="snow">
        <canvas class="particles-js-canvas-el" style="width: 100%; height: 100%;"></canvas>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        let menuBtn = document.querySelector('.menu-btn');
        let menu = document.querySelector('.menu');

        menuBtn.addEventListener('click', function () {
            menuBtn.classList.toggle('active');
            menu.classList.toggle('active');
        });

        $('.add-to-cart').click(function () {
            console.log(1);
            let self = $(this);

            if (self.val() === "added") {
                window.location.href = "{{ route('cart') }}";
            } else {
                self.prop("disabled", true); // Use .prop() instead of .attr() for boolean attributes
                $.ajax({
                    url: "{{ route('cart.add') }}",
                    dataType: "json",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": self.val()
                    },
                    success: function (result, status, xhr) {
                        self.val("added").prop("disabled", false);
                        let cartElement = $('#cart');
                        cartElement.removeClass('invisible').text(result["cart"]);

                        let icon = '<svg width="19" height="18" viewBox="0 0 19 18" fill="white" xmlns="http://www.w3.org/2000/svg">' +
                            '<path fill-rule="evenodd" clip-rule="evenodd" d="M15.437 3.46947C15.6955 3.64179 15.7654 3.99103 15.593 4.24952L8.84303 14.3745C8.74955 14.5147 8.59813 14.6057 8.43043 14.6223C8.26273 14.6389 8.09642 14.5794 7.97725 14.4602L3.47725 9.96025C3.25758 9.74058 3.25758 9.38442 3.47725 9.16475C3.69692 8.94508 4.05308 8.94508 4.27275 9.16475L8.28757 13.1796L14.657 3.62548C14.8293 3.36699 15.1785 3.29715 15.437 3.46947Z" fill="white"/>' +
                            '</svg>';

                        let content = "<div class='row'>" +
                            "<div class='col-4'>"+ icon +"</div>" +
                            "<div class='col-4'>@lang('app.added-to-cart')</div>" +
                            "<div class='col-4'></div>" +
                            "</div>";

                        self.removeClass("btn-outline-danger btn-cart").addClass('btn-red-svg btn-red').html(content);
                    },
                    error: function (xhr, status, error) {
                        console.error("Error:", xhr, status, error);
                        self.removeClass("btn-outline-danger").addClass("btn-dark").html("<div class='h5 fw-normal mb-0 text-capitalize'>@lang('app.error')</div>");
                    },
                });
            }
        });

        function setCartPs() {
            let products = {!! json_encode($cartPs) !!};
            let cart = {{ $cart }};
            let cartElement = $('#cart');

            if (parseInt(cart) > 0) {
                cartElement.removeClass('invisible').text(parseInt(cart));
            }
        }

        setCartPs();
    });
</script>

{{--snow--}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var script = document.createElement('script');
        script.src = "{{ asset('js/particles.min.js') }}";
        script.onload = function () {
            particlesJS("snow", {
                "particles": {
                    "number": {
                        "value": 300,
                        "density": {
                            "enable": true,
                            "value_area": 800
                        }
                    },
                    "color": {
                        "value": "#ffffff"
                    },
                    "opacity": {
                        "value": 0.8,
                        "random": false,
                        "anim": {
                            "enable": false
                        }
                    },
                    "size": {
                        "value": 3,
                        "random": true,
                        "anim": {
                            "enable": false
                        }
                    },
                    "line_linked": {
                        "enable": false
                    },
                    "move": {
                        "enable": true,
                        "speed": 2,
                        "direction": "bottom",
                        "random": true,
                        "straight": false,
                        "out_mode": "out",
                        "bounce": false,
                        "attract": {
                            "enable": true,
                            "rotateX": 300,
                            "rotateY": 1200
                        }
                    }
                },
                "interactivity": {
                    "events": {
                        "onhover": {
                            "enable": false
                        },
                        "onclick": {
                            "enable": false
                        },
                        "resize": false
                    }
                },
                "retina_detect": true
            });
        }
        document.head.append(script);
    });
</script>

</body>

</html>