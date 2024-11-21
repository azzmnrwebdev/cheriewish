<x-guest title="">
    {{-- CSS Custom --}}
    @prepend('styles')
        <link rel="stylesheet" href="{{ asset('owlcarousel/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('owlcarousel/owl.theme.default.min.css') }}">

        <style>
            /* Header */
            #header {
                min-height: 100vh;
                background-image: url('/images/background.jpg');
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center;
            }

            #header .row .col-12:nth-child(1) {
                padding-top: 140px;
                margin-bottom: -20px;
            }

            #header .card .card-body h1 {
                font-weight: 900;
            }

            #header .card .card-body h1:nth-child(1) {
                font-size: 2rem;
                margin-bottom: 0;
            }

            #header .card .card-body h1:nth-child(2) {
                font-size: 3rem;
                margin-bottom: 0;
            }

            #header img {
                width: auto;
                height: 250px;
            }

            .btn-white-pink {
                color: #FF8BAA;
                font-weight: 700;
                border-width: 3px;
                border-style: solid;
                background-color: #ffffff;
                border-color: #ffffff !important;
            }

            .btn-white-pink:hover,
            .btn-white-pink:focus {
                color: #ffffff !important;
                border-color: #ffffff !important;
                background-color: transparent !important;
            }

            /* Product */
            #feature-products h1.section-title {
                color: #FF8BAA;
            }

            .btn-pink {
                font-weight: 700;
                border-width: 3px;
                border-style: solid;
                color: #FF8BAA !important;
                border-color: #ffffff !important;
                background-color: #ffffff !important;
            }

            .btn-pink:hover,
            .btn-pink:focus {
                border-color: #ffffff !important;
                background-color: #ffffff !important;
            }

            /* Universal */
            #feature-products {
                background-color: #ffffff;
            }

            #testimonials {
                background-color: #F894AE;
            }

            #about-us {
                background-color: #FDBFD5;
            }

            #feature-products h1.section-title,
            #about-us h1.section-title,
            #testimonials h1.section-title {
                font-weight: 900;
            }

            .text-ellipsis {
                overflow: hidden;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                text-overflow: ellipsis;
                -webkit-box-orient: vertical;
            }

            @media (min-width: 576px) {
                #header img {
                    height: 300px;
                }

                #header .row .col-12:nth-child(1) {
                    padding-top: 100px;
                    margin-bottom: -20px;
                }
            }

            @media (min-width: 768px) {
                #header {
                    background-image: url('/images/background.png');
                }

                #header .row .col-12:nth-child(1) {
                    padding-top: 0;
                    margin-bottom: 0;
                }
            }

            @media (min-width: 992px) {
                #header .card .card-body h1:nth-child(1) {
                    font-size: 3rem;
                }

                #header .card .card-body h1:nth-child(2) {
                    font-size: 4rem;
                }

                #header img {
                    width: auto;
                    height: 400px;
                }
            }

            @media (min-width: 1200px) {
                #header .card .card-body h1:nth-child(1) {
                    font-size: 4rem;
                }

                #header .card .card-body h1:nth-child(2) {
                    font-size: 5rem;
                }
            }
        </style>
    @endprepend

    {{-- Hero --}}
    <header id="header">
        <div class="container min-vh-100">
            <div class="row justify-content-center align-items-center min-vh-100 g-0">
                <div class="col-12 col-md-6 mb-md-0 order-md-1 text-center text-md-end">
                    <img src="{{ asset('images/bg_header.png') }}" alt="People">
                </div>

                <div class="col-12 col-md-6">
                    <div class="card bg-transparent border-0">
                        <div class="card-body p-0 text-center">
                            <h1 class="text-uppercase text-white">
                                Ready To
                            </h1>

                            <h1 class="text-uppercase text-white">
                                Shopping?
                            </h1>

                            <a href="#" class="btn btn-lg btn-white-pink mt-2">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <section id="feature-products" class="py-5">
        <div class="container">
            <h1 class="text-uppercase text-center section-title mb-4">
                Featured Products
            </h1>

            <div class="owl-carousel owl-theme">
                @foreach ($products as $product)
                    <div class="item">
                        <div class="card border-0 rounded-0">
                            <div class="card-body p-4 text-center" style="background: #FED2E0;">
                                {{-- Product Image --}}
                                <div class="ratio ratio-1x1 mb-3">
                                    <img src="{{ asset($product['image']) }}" class="img-fluid"
                                        alt="Product Image {{ $product['id'] }}"
                                        style="object-fit: cover; width: 100%; height: 100%;">
                                </div>

                                {{-- Product Title --}}
                                <h5 class="card-title text-uppercase fs-3 text-ellipsis" style="font-weight: 900;">
                                    {{ $product['name'] }}
                                </h5>

                                {{-- Product Price --}}
                                <p class="card-text fw-semibold">
                                    {{ 'Rp ' . number_format($product['price'], 0, ',', '.') }}</p>

                                {{-- Product Button --}}
                                <a href="#" class="btn btn-pink">Shop now</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="about-us" class="py-5">
        <div class="container">
            <h1 class="text-uppercase text-center text-white section-title">
                About Us
            </h1>

            {{--  --}}
        </div>
    </section>

    <section id="testimonials" class="py-5">
        <div class="container">
            <h1 class="text-uppercase text-center text-white section-title">
                Testimonals
            </h1>

            {{--  --}}
        </div>
    </section>

    @prepend('scripts')
        <script src="{{ asset('owlcarousel/owl.carousel.min.js') }}"></script>

        <script>
            $('.owl-carousel').owlCarousel({
                items: 1,
                loop: true,
                margin: 10,
                nav: true,
                dots: false,
                autoplay: true,
                autoplayTimeout: 3000,
                responsive: {
                    576: {
                        items: 2,
                        center: true
                    },
                    992: {
                        items: 3,
                        center: true
                    },
                    1200: {
                        items: 4,
                        center: true
                    },
                }
            })
        </script>
    @endprepend
</x-guest>
