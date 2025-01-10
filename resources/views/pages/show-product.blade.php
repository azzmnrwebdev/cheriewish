<x-guest title="{{ $product->name }}">
    {{-- CSS Custom --}}
    @prepend('styles')
        <style>
            main {
                flex: 1;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                background-image: url('/images/background3.png');
                background-repeat: no-repeat;
                background-size: cover;
            }

            .thumbnail-wrapper {
                width: 100%;
            }

            .thumbnail-wrapper img {
                width: 100%;
                height: 100%;
                object-fit: contain;
            }

            .image-box {
                width: 83px;
                height: 83px;
                overflow: hidden;
                margin-right: 10px;
                flex-shrink: 0;
            }

            .image-box:last-child {
                margin-right: 0;
            }

            .image-box img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-radius: 8px;
                border-width: 3px;
                border-style: solid;
                border-color: transparent;
            }

            .image-box img:hover,
            .image-box img.active {
                border-color: #fdba74;
            }

            .card-title.name {
                font-size: 22px;
                font-weight: 600;
            }

            .card-title.price {
                font-size: 26px;
                font-weight: 800;
            }

            .card-title.other-price {
                font-size: 16px;
                color: #da1450;
                font-weight: 800;
                overflow: hidden;
                display: -webkit-box;
                -webkit-line-clamp: 1;
                text-overflow: ellipsis;
                -webkit-box-orient: vertical;
            }

            .card-title.other-name {
                font-size: 16px;
                font-weight: 400;
                overflow: hidden;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                text-overflow: ellipsis;
                -webkit-box-orient: vertical;
            }

            .product-image-container {
                width: 100%;
                overflow: hidden;
                padding-top: 100%;
                position: relative;
                margin-bottom: 8px;
            }

            .product-image {
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                opacity: 0;
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-radius: 8px;
                position: absolute;
                transition: opacity 0.5s ease;
            }

            .product-image.active {
                opacity: 1;
            }

            @media (min-width: 576px) {
                /*  */
            }

            @media (min-width: 768px) {
                /*  */
            }

            @media (min-width: 992px) {
                .card-title.name {
                    font-size: 26px;
                }

                .card-title.price {
                    font-size: 30px;
                }
            }

            @media (min-width: 1200px) {
                /*  */
            }
        </style>
    @endprepend

    {{-- Main Content --}}
    <main>
        <div class="container pt-3 pb-5" style="margin-top: 65.1375px;">
            <div class="alert alert-primary bg-transparent px-0 border-0 rounded-none" role="alert">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none"
                                style="color: #AF1040;"><small>Home</small></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('shop.index') }}" class="text-decoration-none"
                                style="color: #AF1040;"><small>Shop</small></a></li>
                        <li class="breadcrumb-item active text-dark" aria-current="page">
                            <small>{{ $product->name }}</small>
                        </li>
                    </ol>
                </nav>
            </div>

            <div class="row g-4">
                <div class="col-12 col-md-5 col-lg-4">
                    {{-- Thumbnail --}}
                    <div class="thumbnail-wrapper rounded-3 overflow-hidden mb-2">
                        <img src="{{ asset('storage/' . $product->thumbnail->path) }}" alt="Product Thumbnail">
                    </div>

                    {{-- Images --}}
                    <div class="overflow-x-auto w-100 d-flex">
                        @foreach ($product->images as $image)
                            <div class="image-box">
                                <img src="{{ asset('storage/' . $image->path) }}" alt="Product Image"
                                    class="{{ $product->thumbnail->id === $image->id ? 'active' : '' }}">
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-12 col-md-7 col-lg-6 col-xl-5">
                    {{-- Name --}}
                    <h5 class="card-title name">{{ $product->name }}</h5>

                    {{-- Price --}}
                    <h5 class="card-title price my-4">Rp {{ $product->price }}</h5>

                    {{-- Visit Shopee --}}
                    <div class="d-inline-flex align-items-center text-white fw-semibold ps-3 rounded-3"
                        style="height: 42px; width: 258px; background-color: #FF79A2;">
                        Local Product
                    </div>

                    <div class="d-block mt-3 mb-4">
                        <a href="#" class="btn btn-dark">
                            <i class="bi bi-bag-fill me-2"></i>Buy Now
                        </a>
                    </div>

                    {{-- Product Description --}}
                    <h5 class="card-title mb-3">Description</h5>

                    <p class="card-text mb-0">
                        {!! $product->description !!}
                    </p>
                </div>
            </div>

            {{-- Other Product --}}
            <div class="mt-5 mb-3 d-flex justify-content-between align-items-center">
                <h3 class="fw-bold">Other Products</h3>
                <a href="{{ route('shop.index') }}" class="text-decoration-none fw-semibold">See All</a>
            </div>

            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xxl-6 g-3">
                @foreach ($otherProducts as $product)
                    <a href="{{ route('shop.show', ['slug' => $product->slug]) }}" class="text-decoration-none">
                        <div class="col">
                            <div class="card h-100 border-0 rounded-none bg-transparent">
                                <div class="card-body p-0">
                                    {{-- Image --}}
                                    <div class="product-image-container">
                                        <img src="{{ asset('storage/' . $product->thumbnail->path) }}"
                                            alt="{{ $product->name }}" class="product-image main-image">

                                        @foreach ($product->images as $index => $image)
                                            <img src="{{ asset('storage/' . $image->path) }}"
                                                alt="{{ $product->name }}"
                                                class="product-image loop-image {{ $index === 0 ? 'active' : '' }}">
                                        @endforeach
                                    </div>

                                    {{-- Price --}}
                                    <h5 class="card-title other-price">{{ $product->price }}</h5>

                                    {{-- Name --}}
                                    <h5 class="card-title other-name mb-3">{{ $product->name }}</h5>

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
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Footer --}}
        <x-footer></x-footer>
    </main>

    {{-- JS Custom --}}
    @prepend('scripts')
        <script>
            $(document).ready(function() {
                $('.image-box img').on('mouseenter', function() {
                    $('.image-box img').removeClass('active');
                    $(this).addClass('active');
                    $('.thumbnail-wrapper img').attr('src', $(this).attr('src'));
                });

                // =============================================================================================

                $('.product-image-container').each(function() {
                    let currentIndex = 0;
                    const $images = $(this).find('.product-image');

                    setInterval(() => {
                        $images.eq(currentIndex).removeClass('active');
                        currentIndex = (currentIndex + 1) % $images.length;
                        $images.eq(currentIndex).addClass('active');
                    }, 3000);
                });
            });
        </script>
    @endprepend
</x-guest>
