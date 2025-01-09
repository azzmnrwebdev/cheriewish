<x-admin>
    {{-- CSS Custom --}}
    @prepend('styles')
        <style>
            .thumbnail-wrapper {
                width: 100%;
                height: 450px;
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
                border-color: white;
            }

            .image-box img:hover,
            .image-box img.active {
                border-color: #fdba74;
            }

            .btn-warning.custom,
            .btn-warning.custom:hover,
            .btn-warning.custom:focus,
            .btn-warning.custom:active {
                outline: none;
                box-shadow: none;
                color: #eab308 !important;
                border-color: #eab308 !important;
                background-color: #fef9c3 !important;
            }
        </style>
    @endprepend

    {{-- title --}}
    <h4 class="mb-2 fw-semibold d-inline-flex">Show Product</h4>

    {{-- Breadcrumbs --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="text-decoration-none" href="{{ route('product.index') }}">Product</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Show</li>
        </ol>
    </nav>

    <div class="card mt-4 shadow">
        <div class="card-header bg-white fw-medium py-3">
            <div class="d-flex align-items-center justify-content-between">
                Product: {{ $product->name }}
                <a href="{{ route('product.edit', ['product' => $product->slug]) }}"
                    class="btn btn-sm btn-warning custom align-middle">Edit<i class="bi bi-pencil ms-2"></i></a>
            </div>
        </div>

        <div class="card-body p-lg-4">
            <div class="row justify-content-md-center">
                <div class="col-12 col-md-10 col-lg-8 col-xl-6">
                    {{-- Alert --}}
                    @if (session('success'))
                        <div class="alert alert-success fw-medium mb-4" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Thumbnail --}}
                    <div class="thumbnail-wrapper border border-secondary rounded mb-3">
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

                    {{-- Product Name --}}
                    <h5 class="card-title mt-4">{{ $product->name }}</h5>

                    {{-- Product Price --}}
                    <p class="card-text">{{ 'Rp ' . $product->price }}</p>

                    {{-- Categories --}}
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

                        <a href="{{ route('category.show', ['category' => $category->slug]) }}">
                            <span class="badge rounded-pill"
                                style="background-color: {{ $randomColor['bg'] }}; color: {{ $randomColor['text'] }};">
                                {{ $category->name }}
                            </span>
                        </a>
                    @endforeach

                    {{-- Product Description --}}
                    <div class="alert alert-light mt-3 border-0" role="alert">
                        <span class="fw-medium fs-5">Product Description</span>
                    </div>

                    <p class="card-text">{!! $product->description !!}</p>

                    {{-- Button Prev & Next --}}
                    <div class="d-flex justify-content-between mt-5">
                        @if ($previousProduct)
                            <a href="{{ route('product.show', ['product' => $previousProduct->slug]) }}"
                                class="btn btn-warning">
                                <i class="bi bi-chevron-double-left me-2"></i>Previous
                            </a>
                        @else
                            <button type="button" class="btn btn-warning" disabled>
                                <i class="bi bi-chevron-double-left me-2"></i>Previous
                            </button>
                        @endif

                        @if ($nextProduct)
                            <a href="{{ route('product.show', ['product' => $nextProduct->slug]) }}"
                                class="btn btn-success">
                                Next<i class="bi bi-chevron-double-right ms-2"></i>
                            </a>
                        @else
                            <button type="button" class="btn btn-success" disabled>
                                Next<i class="bi bi-chevron-double-right ms-2"></i>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- JS Custom --}}
    @prepend('scripts')
        <script>
            $(document).ready(function() {
                $('.image-box img').on('mouseenter', function() {
                    $('.image-box img').removeClass('active');
                    $(this).addClass('active');
                    $('.thumbnail-wrapper img').attr('src', $(this).attr('src'));
                });
            });
        </script>
    @endprepend
</x-admin>
