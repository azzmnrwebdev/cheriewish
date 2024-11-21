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
        </style>
    @endprepend

    {{-- title --}}
    <h4 class="mb-2 fw-semibold d-inline-flex">Testimony Management</h4>

    {{-- Breadcrumbs --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Testimony</li>
        </ol>
    </nav>

    <div class="card mt-4 shadow">
        <div class="card-header bg-light fw-medium py-3">
            List Testimonies
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
                    <a href="javascript:void(0);" class="btn btn-dark" data-bs-toggle="modal"
                        data-bs-target="#formCreateModal">Create</a>
                </div>

                <div class="col-sm-6 col-xl-3 mt-3 mt-sm-0">
                    <input type="search" name="search" id="search" value="{{ $search }}" class="form-control"
                        placeholder="Search testimonies?">
                </div>
            </div>

            {{-- Table --}}
            <div class="table-responsive mt-4">
                <table class="table table-bordered text-nowrap align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Produk</th>
                            <th class="text-center">Review</th>
                            <th class="text-center">Value</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($testimonies as $item)
                            <tr>
                                <td class="text-center">{{ $loop->index + $testimonies->firstItem() }}</td>
                                <td class="text-center name">
                                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#showModal"
                                        data-product-name="{{ $item->product->name }}" data-name="{{ $item->name }}"
                                        data-description="{{ $item->description }}"
                                        data-stars="{{ $item->stars }}">{{ $item->name }}</a>
                                </td>
                                <td class="text-center">
                                    {{ $item->product->name }}
                                </td>
                                <td class="text-center">
                                    @if ($item->description)
                                        {{ \Illuminate\Support\Str::limit($item->description, 40) }}
                                    @endif
                                </td>
                                <td class="text-center">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $item->stars)
                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                        @else
                                            <i class="bi bi-star fs-5"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td class="text-center">
                                    {{--  --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Data not found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="{{ $testimonies->total() > 10 ? 'mt-4' : 'mt-0' }}">
                {{ $testimonies->links() }}
            </div>
        </div>
    </div>

    <!-- Form Create Modal -->
    <div class="modal fade" id="formCreateModal" tabindex="-1" aria-labelledby="formCreateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="formCreateModalLabel">Create Testimony</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('testimony.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="product_id" class="form-label">Product</label>
                            <select name="product_id" id="product_id"
                                class="form-select @error('product_id') is-invalid @enderror">
                                <option value="">Select One</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}"
                                        {{ old('product_id') == $product->id ? 'selected' : '' }}>{{ $product->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('product_id')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">People Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ old('name') }}">

                            @error('name')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Review</label>
                            <textarea name="description" id="description" rows="5"
                                class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>

                            @error('description')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="stars" class="form-label">Value</label>
                            <input type="hidden" name="stars" id="stars"
                                class="form-control @error('stars') is-invalid @enderror"
                                value="{{ old('stars', '') }}">

                            <div class="star-rating">
                                <i class="bi bi-star fs-2" data-value="1"></i>
                                <i class="bi bi-star fs-2" data-value="2"></i>
                                <i class="bi bi-star fs-2" data-value="3"></i>
                                <i class="bi bi-star fs-2" data-value="4"></i>
                                <i class="bi bi-star fs-2" data-value="5"></i>
                            </div>

                            @error('stars')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- View Modal --}}
    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="showModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="product_id" class="form-label">Product</label>
                        <input type="text" class="form-control" id="product_id" value="" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">People Name</label>
                        <input type="text" class="form-control" id="name" value="" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Review</label>
                        <textarea id="description" rows="5" class="form-control" disabled></textarea>
                    </div>

                    <div class="mb-0">
                        <label for="stars" class="form-label">Value</label>
                        {{--  --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- JS Custom --}}
    @prepend('scripts')
        @if (session('open_modal') === 'formCreateModal')
            <script>
                $(document).ready(function() {
                    $('#formCreateModal').modal('show');

                    function updateStars(value) {
                        $('.star-rating i').removeClass('bi-star-fill').addClass('bi-star').css('color', '');
                        $('.star-rating i').each(function() {
                            if ($(this).data('value') <= value) {
                                $(this).removeClass('bi-star').addClass('bi-star-fill').css('color', 'orange');
                            }
                        });
                    }

                    $('.star-rating i').on('click', function() {
                        const value = $(this).data('value');
                        $('#stars').val(value);
                        updateStars(value);
                    });

                    const oldStarsValue = $('#stars').val();

                    if (oldStarsValue) {
                        updateStars(oldStarsValue);
                    }
                });
            </script>
        @endif

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
                    const url = '{{ route('testimony.index') }}';

                    if (searchValue.trim() !== '') {
                        params.search = searchValue.trim().replace(/ /g, '+');
                    }

                    const queryString = Object.keys(params).map(key => key + '=' + params[key]);

                    const finalUrl = url + '?' + queryString.join('&');
                    window.location.href = finalUrl;
                }

                // =============================================================================================

                $('.star-rating i').on('click', function() {
                    const value = $(this).data('value');

                    $('#stars').val(value);
                    $('.star-rating i').removeClass('bi-star-fill').addClass('bi-star').css('color', '');
                    $('.star-rating i').each(function() {
                        if ($(this).data('value') <= value) {
                            $(this).removeClass('bi-star').addClass('bi-star-fill').css('color',
                                'orange');
                        }
                    });
                });

                // =============================================================================================

                $('#showModal').on('show.bs.modal', function(event) {
                    const link = $(event.relatedTarget);

                    const productName = link.data('product-name');
                    const name = link.data('name');
                    const description = link.data('description');
                    const stars = link.data('stars');

                    const modal = $(this);
                    modal.find('#showModalLabel').text(`Testimony: ${name}`);
                    modal.find('#product_id').val(productName);
                    modal.find('#name').val(name);
                    modal.find('#description').val(description);
                });
            });
        </script>
    @endprepend
</x-admin>
