<x-admin>
    {{-- CSS Custom --}}
    @prepend('styles')
        <style>
            tr:hover td {
                background-color: #f8f8f8;
            }

            .btn-primary,
            .btn-primary:hover,
            .btn-primary:focus,
            .btn-primary:active {
                outline: none;
                box-shadow: none;
                color: #0ea5e9 !important;
                border-color: #0ea5e9 !important;
                background-color: #e0f2fe !important;
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
    <h4 class="mb-2 fw-semibold d-inline-flex">Show Category</h4>

    {{-- Breadcrumbs --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="text-decoration-none" href="{{ route('category.index') }}">Category</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Show</li>
        </ol>
    </nav>

    <div class="card mt-4 shadow">
        <div class="card-header bg-light fw-medium py-3">
            <div class="d-flex align-items-center justify-content-between">
                Category: {{ $category->name }}
                <a href="{{ route('category.edit', ['category' => $category->slug]) }}"
                    class="btn btn-sm btn-warning custom align-middle"><i class="bi bi-pencil"></i></a>
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

                    {{-- Form --}}
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" value="{{ $category->name }}"
                                disabled>
                        </div>

                        <div class="col-12">
                            <label for="description" class="form-label">Short Description</label>
                            <textarea class="form-control" id="description" rows="5" disabled>{{ $category->description ? $category->description : '-' }}</textarea>
                        </div>
                    </div>

                    {{-- Products --}}
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered text-nowrap align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Product Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if ($category->products->isNotEmpty())
                                    @foreach ($category->products as $product)
                                        <tr>
                                            <td class="text-center">{{ $loop->index + 1 }}</td>
                                            <td class="text-center name">{{ $product->name }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('product.show', ['product' => $product->slug]) }}"
                                                    class="btn btn-sm btn-primary align-middle"><i
                                                        class="bi bi-eye"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3" class="text-center">Data not found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    {{-- Button Prev & Next --}}
                    <div class="d-flex justify-content-between mt-5">
                        @if ($previousCategory)
                            <a href="{{ route('category.show', ['category' => $previousCategory->slug]) }}"
                                class="btn btn-warning">
                                <i class="bi bi-chevron-double-left me-2"></i>Previous
                            </a>
                        @else
                            <button type="button" class="btn btn-warning" disabled>
                                <i class="bi bi-chevron-double-left me-2"></i>Previous
                            </button>
                        @endif

                        @if ($nextCategory)
                            <a href="{{ route('category.show', ['category' => $nextCategory->slug]) }}"
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
        {{--  --}}
    @endprepend
</x-admin>
