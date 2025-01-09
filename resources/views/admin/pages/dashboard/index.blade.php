<x-admin>
    {{-- CSS Custom --}}
    @prepend('styles')
        {{--  --}}
    @endprepend

    {{-- title --}}
    <h4 class="mb-2 fw-semibold d-inline-flex">Dashboard</h4>

    {{-- Breadcrumbs --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 g-3 mb-4">
        <div class="col">
            <a href="{{ route('category.index') }}">
                <div class="card border-0 shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center px-4">
                        <div class="lh-base me-3">
                            <h5 class="card-title fw-semibold mb-1">{{ $totalCategory }}</h5>
                            <p class="card-text mb-0 lh-sm">Total Category</p>
                        </div>

                        <i class="bi bi-tags-fill fs-1" style="color: #FF6F61;"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('product.index') }}">
                <div class="card border-0 shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center px-4">
                        <div class="lh-base me-3">
                            <h5 class="card-title fw-semibold mb-1">{{ $totalProduct }}</h5>
                            <p class="card-text mb-0 lh-sm">Total Product</p>
                        </div>

                        <i class="bi bi-box-fill fs-1" style="color: #28A745;"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('testimony.index') }}">
                <div class="card border-0 shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center px-4">
                        <div class="lh-base me-3">
                            <h5 class="card-title fw-semibold mb-1">{{ $totalTestimony }}</h5>
                            <p class="card-text mb-0 lh-sm">Total Testimony</p>
                        </div>

                        <i class="bi bi-chat-quote-fill fs-1" style="color: #6C63FF;"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>

    {{-- JS Custom --}}
    @prepend('scripts')
        {{--  --}}
    @endprepend
</x-admin>
