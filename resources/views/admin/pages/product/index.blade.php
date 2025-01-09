<x-admin>
    {{-- CSS Custom --}}
    @prepend('styles')
        <style>
            tr td.name a {
                color: #212529;
                text-decoration: none;
            }

            tr:hover td {
                background-color: #f8f8f8;
            }

            tr:hover td.name a {
                color: #0d70fc;
                text-decoration: underline;
            }

            .category-badge-container {
                display: flex;
                flex-wrap: wrap;
                gap: 5px;
                justify-content: center;
            }

            .category-badge-container .badge {
                max-width: 100%;
                white-space: nowrap;
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

            .btn-warning,
            .btn-warning:hover,
            .btn-warning:focus,
            .btn-warning:active {
                outline: none;
                box-shadow: none;
                color: #eab308 !important;
                border-color: #eab308 !important;
                background-color: #fef9c3 !important;
            }

            .btn-danger.custom,
            .btn-danger.custom:hover,
            .btn-danger.custom:focus,
            .btn-danger.custom:active {
                outline: none;
                box-shadow: none;
                color: #ef4444 !important;
                border-color: #ef4444 !important;
                background-color: #fee2e2 !important;
            }

            .btn-info,
            .btn-info:hover,
            .btn-info:focus,
            .btn-info:active {
                outline: none;
                box-shadow: none;
                color: #06b6d4 !important;
                border-color: #06b6d4 !important;
                background-color: #cffafe !important;
            }
        </style>
    @endprepend

    {{-- title --}}
    <h4 class="mb-2 fw-semibold d-inline-flex">Product Management</h4>

    {{-- Breadcrumbs --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Product</li>
        </ol>
    </nav>

    <div class="card mt-4 shadow">
        <div class="card-header bg-white fw-medium py-3">
            List Products
        </div>

        <div class="card-body p-lg-4">
            {{-- Alert --}}
            @if (session('success'))
                <div class="alert alert-success fw-medium mb-4" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger fw-medium mb-4" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Content --}}
            <div class="row align-items-center">
                <div class="col-sm-6 col-xl-9">
                    <a href="{{ route('product.create') }}" class="btn btn-dark">Create</a>
                </div>

                <div class="col-sm-6 col-xl-3 mt-3 mt-sm-0">
                    <input type="search" name="search" id="search" value="{{ $search }}" class="form-control"
                        placeholder="Search products?">
                </div>
            </div>

            {{-- Table --}}
            <div class="table-responsive mt-4">
                <table class="table table-bordered text-nowrap align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Thumbnail</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Shopee</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($products as $item)
                            <tr>
                                <td class="text-center">{{ $loop->index + $products->firstItem() }}</td>
                                <td class="text-center"><a href="javascript:void(0);" data-bs-toggle="modal"
                                        data-bs-target="#thumbnailModal"
                                        data-thumbnail="{{ asset('storage/' . $item->thumbnail->path) }}"><img
                                            src="{{ asset('storage/' . $item->thumbnail->path) }}"
                                            alt="{{ $item->name }}" class="img-thumbnail"
                                            style="max-width: 100px;"></a></td>
                                <td class="text-center name"><a
                                        href="{{ route('product.show', ['product' => $item->slug]) }}">{{ $item->name }}</a>
                                </td>
                                <td class="text-center">{{ 'Rp ' . $item->price }}</td>
                                <td class="text-center">
                                    <div class="category-badge-container">
                                        @foreach ($item->categories as $category)
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
                                </td>
                                <td class="text-center">
                                    <a href="{{ $item->url_shopee }}" target="_blank" class="btn btn-sm btn-info">
                                        <i class="bi bi-shop-window me-2"></i>Visit
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('product.show', ['product' => $item->slug]) }}"
                                        class="btn btn-sm btn-primary align-middle"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('product.edit', ['product' => $item->slug]) }}"
                                        class="btn btn-sm btn-warning align-middle"><i class="bi bi-pencil"></i></a>
                                    <button type="button" class="btn btn-sm btn-danger custom align-middle delete"
                                        data-id="{{ $item->id }}" data-name="{{ $item->name }}"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal"><i
                                            class="bi bi-trash3"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Data not found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="{{ $products->total() > 10 ? 'mt-4' : 'mt-0' }}">
                {{ $products->links() }}
            </div>
        </div>
    </div>

    {{-- Thumbnail Modal --}}
    <div class="modal fade" id="thumbnailModal" tabindex="-1" aria-labelledby="thumbnailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="thumbnailModalLabel">Thumbnail Preview</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Confirm Delete</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form class="d-inline" id="deleteForm" action="" method="POST">
                        <div id="deleteModalMessage" class="alert alert-info" role="alert"></div>

                        <div class="mb-3"><input type="text" class="form-control" name="name_confirmation"
                                id="name_confirmation" placeholder="Enter product name" required /></div>

                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                            @csrf
                            @method('delete')

                            <button type="submit" class="btn btn-danger">Yes, I am sure</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- JS Custom --}}
    @prepend('scripts')
        <script>
            $(document).ready(function() {
                let debounceTimeout;

                $('#search').on('input keydown', function(e) {
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

                function filter() {
                    const params = {};
                    const searchValue = $('#search').val();
                    const url = '{{ route('product.index') }}';

                    if (searchValue.trim() !== '') {
                        params.search = searchValue.trim().replace(/ /g, '+');
                    }

                    const queryString = Object.keys(params).map(key => key + '=' + params[key]);

                    const finalUrl = url + '?' + queryString.join('&');
                    window.location.href = finalUrl;
                }

                // =============================================================================================

                $('[data-bs-toggle="modal"]').on('click', function() {
                    const thumbnailPath = $(this).data('thumbnail');

                    $('#thumbnailModal .modal-body').html('<img src="' + thumbnailPath +
                        '" class="img-fluid" alt="Thumbnail Preview">');
                });

                // =============================================================================================

                $('.delete').on('click', function(event) {
                    event.stopPropagation();

                    const id = $(this).data('id');
                    const name = $(this).data('name');
                    const deleteUrl = "{{ route('product.destroy', ['product' => ':id']) }}"
                        .replace(':id', id);

                    $('#deleteForm').attr('action', deleteUrl);
                    $('#deleteModalMessage').html(
                        `Deleting a product will result in the loss of all data associated with that product. Once a product is deleted, the associated data cannot be recovered.<br><br>
                        To proceed with product deletion, please type <b>'${name}'</b> below as a form of deletion confirmation:`
                    );
                    $('#deleteModal').modal('show');
                });
            });
        </script>
    @endprepend
</x-admin>
