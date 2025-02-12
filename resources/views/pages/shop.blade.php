<x-guest title="Shop">
    {{-- CSS Custom --}}
    @prepend('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

        <style>
            .select2-container--bootstrap-5.select2-container--focus .select2-selection,
            .select2-container--bootstrap-5.select2-container--open .select2-selection {
                border-color: #343a40;
                box-shadow: none !important;
                outline: #343a40 solid 1px;
            }

            .select2-container--bootstrap-5 .select2-dropdown {
                border-color: #343a40;
                outline: #343a40 solid 1px;
            }

            .select2-container--bootstrap-5 .select2-selection {
                background: transparent;
            }

            main {
                flex: 1;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                background-image: url('/images/background3.png');
                background-repeat: no-repeat;
                background-size: cover;
            }

            #header {
                display: flex;
                min-height: 45vh;
                padding-bottom: 2.5rem;
                flex-direction: column;
                justify-content: flex-end;

                .header_title {
                    color: #222222;
                    font-size: 24px;
                    font-weight: 900;
                    text-transform: uppercase;
                }

                .header_title::after {
                    content: "";
                    display: block;
                    width: 100%;
                    height: 2px;
                    margin-top: 3px;
                    background-color: #222222;
                }

                .header_text {
                    color: #222222;
                    font-size: 16px;
                    margin-bottom: 0;
                }
            }

            .card-title.price {
                font-size: 16px;
                color: #f5596c;
                font-weight: 800;
                overflow: hidden;
                display: -webkit-box;
                -webkit-line-clamp: 1;
                text-overflow: ellipsis;
                -webkit-box-orient: vertical;
            }

            .card-title.name {
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
                #header .header_title {
                    font-size: 28px;
                }

                #header .header_text {
                    font-size: 18px;
                }
            }

            @media (min-width: 992px) {
                #header {
                    min-height: 50vh;
                }

                #header .header_title {
                    font-size: 30px;
                }

                #header .header_text {
                    font-size: 20px;
                }
            }

            @media (min-width: 1200px) {
                /*  */
            }
        </style>
    @endprepend

    <main>
        {{-- Hero --}}
        <header id="header">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-10 col-lg-8 col-xl-6">
                        <h1 class="header_title d-inline-block">Products</h1>

                        <p class="header_text">
                            Our products are available in the catalog. You can choose the desired product.
                        </p>
                    </div>
                </div>
            </div>
        </header>

        {{-- Main Content --}}
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-12 col-md-4 col-xxl-3">
                    <div class="card shadow-sm position-sticky bg-transparent" style="top: 89.1375px;">
                        <div class="card-header d-flex align-items-center">
                            <i class="bi bi-filter me-2 fs-5"></i>Product Filters
                        </div>

                        <div class="card-body">
                            <form>
                                <div class="mb-3">
                                    <input type="search" class="form-control bg-transparent" id="search"
                                        name="search" value="{{ $search }}" placeholder="Search...">
                                </div>

                                <div class="mb-3">
                                    <select class="form-select" name="categories[]" id="multiple-select-clear-field"
                                        data-placeholder="Choose anything" multiple>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                @if (is_array($selectedCategories) && in_array($category->id, old('categories', $selectedCategories))) selected @endif>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-0">
                                    <select class="form-select bg-transparent" name="price" id="price">
                                        <option value="">Select price type</option>
                                        <option value="low" {{ request('price') == 'low' ? 'selected' : '' }}>Low
                                        </option>
                                        <option value="high" {{ request('price') == 'high' ? 'selected' : '' }}>High
                                        </option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-8 col-xxl-9">
                    @if ($products->count() > 0)
                        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-5 g-3">
                            @foreach ($products as $product)
                                <a href="{{ route('shop.show', ['slug' => $product->slug]) }}"
                                    class="text-decoration-none">
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
                                                <h5 class="card-title price">{{ $product->price }}</h5>

                                                {{-- Name --}}
                                                <h5 class="card-title name mb-3">{{ $product->name }}</h5>

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
                    @else
                        <p class="card-text">Sorry, product not found!</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <x-footer></x-footer>
    </main>

    @prepend('scripts')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
            $(document).ready(function() {
                $('.product-image-container').each(function() {
                    let currentIndex = 0;
                    const $images = $(this).find('.product-image');

                    setInterval(() => {
                        $images.eq(currentIndex).removeClass('active');
                        currentIndex = (currentIndex + 1) % $images.length;
                        $images.eq(currentIndex).addClass('active');
                    }, 3000);
                });

                // =============================================================================================

                let debounceTimeout;

                $('#search, #price').on('input keydown', function(e) {
                    if (e.which !== 13) {
                        clearTimeout(debounceTimeout);

                        debounceTimeout = setTimeout(function() {
                            filter();
                        }, 1000);
                    }
                });

                $('#search').on('keypress', function(e) {
                    if (e.which == 13) {
                        e.preventDefault();
                        filter();
                    }
                });

                $('#multiple-select-clear-field').on('change', function() {
                    filter();
                });

                function filter() {
                    const params = {};
                    const url = '{{ route('shop.index') }}';
                    const searchValue = $('#search').val();
                    const priceValue = $('#price').val();
                    const categories = $('#multiple-select-clear-field').val();

                    if (searchValue.trim() !== '') {
                        params.search = searchValue.trim().replace(/ /g, '+');
                    }

                    if (priceValue) {
                        params.price = priceValue;
                    }

                    if (categories && categories.length > 0) {
                        params.categories = categories.join(',');
                    }

                    const queryString = Object.keys(params).map(key => key + '=' + params[key]);

                    const finalUrl = url + '?' + queryString.join('&');
                    window.location.href = finalUrl;
                }

                // =============================================================================================

                $('#multiple-select-clear-field').select2({
                    theme: "bootstrap-5",
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                        'style',
                    placeholder: $(this).data('placeholder'),
                    closeOnSelect: false,
                    allowClear: true,
                });
            });
        </script>
    @endprepend
</x-guest>
