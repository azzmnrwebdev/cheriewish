<x-guest title="">
    {{-- CSS Custom --}}
    @prepend('styles')
        <link rel="stylesheet" href="{{ asset('owlcarousel/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('owlcarousel/owl.theme.default.min.css') }}">

        <style>
            /* Header */
            #header {
                min-height: 100vh;
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center bottom;
                background-image: url('/images/background.png');
            }

            #header .row .col-12:nth-child(1) {
                padding-top: 58px;
            }

            #header .row .col-12:nth-child(2) {
                margin-top: -28px;
            }

            #header .card .card-body h1 {
                font-weight: 900;
                font-size: 2rem;
            }

            #header img {
                width: auto;
                height: 250px;
            }

            .btn-white-pink {
                color: #ffffff;
                font-weight: 700;
                border-width: 3px;
                border-style: solid;
                background-color: #f5596c;
                border-color: #f5596c !important;
            }

            .btn-white-pink:hover,
            .btn-white-pink:focus {
                color: #ffffff !important;
                border-color: #f5596c !important;
                background-color: #f5596c !important;
            }

            /* Product */
            #feature-products h1.section-title {
                color: #FF8BAA;
            }

            .owl-carousel.products .card-title.name {
                font-size: 16px;
                font-weight: 400;
                overflow: hidden;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                text-overflow: ellipsis;
                -webkit-box-orient: vertical;
            }

            .owl-carousel.products .card-title.price {
                font-size: 16px;
                color: #f5596c;
                font-weight: 800;
                overflow: hidden;
                display: -webkit-box;
                -webkit-line-clamp: 1;
                text-overflow: ellipsis;
                -webkit-box-orient: vertical;
            }

            .owl-carousel.products .product-image {
                object-fit: cover;
                border-radius: 8px;
            }

            /* About */
            .img-miring {
                width: 80%;
                display: block;
                margin: 0 auto;
                transform: rotate(-5deg);
            }

            /* Testimonials */
            .owl-carousel.testimony .card {
                min-height: 250px;
            }

            /* Universal */
            #feature-products {
                background-color: #fce7f3;
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
            }

            @media (min-width: 768px) {
                #header .row .col-12:nth-child(1) {
                    padding-top: 0;
                }

                #header .row .col-12:nth-child(2) {
                    margin-top: 0;
                }
            }

            @media (min-width: 992px) {
                #header .card .card-body h1 {
                    font-size: 3rem;
                }

                #header img {
                    width: auto;
                    height: 400px;
                }

                .owl-carousel.testimony .card {
                    min-height: 300px;
                }

                .img-miring {
                    width: 60%;
                }
            }

            @media (min-width: 1200px) {
                #header .card .card-body h1 {
                    font-size: 4rem;
                }

                .owl-carousel.testimony .card {
                    min-height: 250px;
                }
            }
        </style>
    @endprepend

    {{-- Hero --}}
    <header id="header">
        <div class="container min-vh-100">
            <div class="row justify-content-center align-items-center min-vh-100 g-0">
                <div class="col-12 col-md-6 order-md-1 text-center text-md-end">
                    <img src="{{ asset('images/bg_header.png') }}" alt="Background">
                </div>

                <div class="col-12 col-md-6">
                    <div class="card bg-transparent border-0">
                        <div class="card-body p-0 text-center">
                            <h1 class="text-uppercase text-body-secondary">
                                Elevate Your Wardrobe with Korean Muslim Fashion!
                            </h1>

                            <a href="{{ route('shop.index') }}" class="btn btn-lg btn-white-pink mt-2">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <section id="feature-products" class="py-5">
        <div class="container">
            <h1 class="text-end section-title mb-4">
                Latest Products 🆕
            </h1>

            <div class="owl-carousel products owl-theme">
                @foreach ($products as $product)
                    <div class="item">
                        <a href="{{ route('shop.show', ['slug' => $product->slug]) }}" class="text-decoration-none">
                            <div class="card h-100 bg-transparent border-0 rounded-none">
                                <div class="card-body p-0">
                                    {{-- Image --}}
                                    <div class="ratio ratio-1x1 mb-3">
                                        <img src="{{ asset('storage/' . $product->thumbnail->path) }}"
                                            class="img-fluid product-image" alt="{{ $product->name }}">
                                    </div>

                                    {{-- Category --}}
                                    @foreach ($product->categories as $category)
                                        @php
                                            $colors = [
                                                ['bg' => '#fce7f3', 'text' => '#ec4899'],
                                                ['bg' => '#f3e8ff', 'text' => '#a855f7'],
                                                ['bg' => '#e0f2fe', 'text' => '#0ea5e9'],
                                                ['bg' => '#ccfbf1', 'text' => '#14b8a6'],
                                                ['bg' => '#ffedd5', 'text' => '#f97316'],
                                            ];

                                            $randomColor = $colors[array_rand($colors)];
                                        @endphp

                                        <span class="badge rounded-pill"
                                            style="background-color: {{ $randomColor['bg'] }}; color: {{ $randomColor['text'] }};">
                                            {{ $category->name }}
                                        </span>
                                    @endforeach

                                    {{-- Name --}}
                                    <h5 class="card-title name mt-2 mb-3">{{ $product->name }}</h5>

                                    {{-- Price --}}
                                    <h5 class="card-title price">{{ $product->price }}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="about-us" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 mb-5 mb-md-0">
                    <div class="card bg-transparent border-0">
                        <div class="card-body p-0">
                            {{-- Title --}}
                            <h1 class="section-title" style="color: #f5596c;">
                                Our Background 👋
                            </h1>

                            {{-- Short Description --}}
                            <p class="card-text">
                                {{ $about->short_description }}
                            </p>

                            {{-- Read More --}}
                            <a href="{{ route('about') }}" class="card-link text-decoration-none">Read More</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 mt-md-3 mt-lg-2">
                    {{-- Image --}}
                    <img src="{{ asset('images/group.jpg') }}" class="img-thumbnail img-miring" alt="Cheriewish Group">
                </div>
            </div>
        </div>
    </section>

    {{-- Testimony --}}
    <section id="testimonials" class="py-5">
        <div class="container">
            <h1 class="text-center text-white section-title">
                What do they say? 👀
            </h1>

            <div class="owl-carousel testimony owl-theme mt-5">
                @foreach ($reviews as $item)
                    <div class="item">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-4">
                                {{-- Name --}}
                                <h5 class="card-title fs-6">{{ $item->name }}</h5>

                                {{-- Stars --}}
                                <div>
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $item->stars)
                                            <i class="bi bi-star-fill fs-6" style="color: orange;"></i>
                                        @else
                                            <i class="bi bi-star fs-6"></i>
                                        @endif
                                    @endfor
                                </div>

                                {{-- Sub Ttitle --}}
                                <h6 class="card-subtitle mt-1 mb-3 text-muted">
                                    <small>{{ \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y') }} |
                                        {{ $item->product->name }}</small>
                                </h6>

                                {{-- Review --}}
                                <p class="card-text m-0 text-secondary" style="font-size: 15px;">
                                    {{ $item->description }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <x-footer></x-footer>

    @prepend('scripts')
        <script src="{{ asset('owlcarousel/owl.carousel.min.js') }}"></script>

        <script>
            const reviewsCount = {!! json_encode($reviews_count) !!};
            const productsCount = {!! json_encode($products_count) !!};

            $('.owl-carousel.products').owlCarousel({
                items: 2,
                margin: 10,
                nav: false,
                dots: false,
                autoplay: true,
                autoplayTimeout: 3000,
                loop: productsCount >= 2,
                responsive: {
                    576: {
                        items: 3,
                        loop: productsCount >= 3,
                    },
                    768: {
                        items: 4,
                        loop: productsCount >= 4,
                    },
                    992: {
                        items: 5,
                        loop: productsCount >= 5,
                    },
                    1400: {
                        items: 6,
                        loop: productsCount >= 6,
                    },
                }
            });

            // =============================================================================================

            $('.owl-carousel.testimony').owlCarousel({
                items: 1,
                margin: 10,
                nav: false,
                dots: false,
                autoplay: true,
                autoHeight: false,
                autoplayTimeout: 3000,
                loop: reviewsCount >= 2,
                responsive: {
                    768: {
                        items: 2,
                        loop: reviewsCount >= 2,
                    },
                    992: {
                        items: 3,
                        loop: reviewsCount >= 3,
                    },
                }
            });
        </script>
    @endprepend
</x-guest>
