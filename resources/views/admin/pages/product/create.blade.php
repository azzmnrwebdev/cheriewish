<x-admin>
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

            .btn-danger,
            .btn-danger:hover,
            .btn-danger:focus,
            .btn-danger:active {
                outline: none;
                box-shadow: none;
                color: #ef4444 !important;
                border-color: #ef4444 !important;
                background-color: #fee2e2 !important;
            }
        </style>
    @endprepend

    {{-- title --}}
    <h4 class="mb-2 fw-semibold d-inline-flex">Create Product</h4>

    {{-- Breadcrumbs --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="text-decoration-none" href="{{ route('product.index') }}">Product</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>

    {{-- Form --}}
    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Thumbnail & Images --}}
        <div class="card mt-4 shadow">
            <div class="card-header bg-light fw-medium py-3">
                Thumbnail & Images
            </div>

            <div class="card-body p-lg-4">
                <div class="row justify-content-md-center">
                    <div class="col-md-10 col-lg-8 col-xl-6">
                        <div class="row g-3">
                            {{-- Thumbnail --}}
                            <div class="col-12">
                                <label for="thumbnail" class="form-label">Thumbnail</label>
                                <input type="file" class="form-control @error('thumbnail') is-invalid @enderror"
                                    id="thumbnail" name="thumbnail" accept="image/*">

                                <div class="form-text">Only files of type jpg, png and jpeg are allowed.</div>

                                <div class="d-flex mt-2">
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#thumbnailModal">
                                        <i class="bi bi-eye"></i>
                                    </button>

                                    <button type="button" class="btn btn-sm btn-danger ms-1 d-none"
                                        id="deleteThumbnailButton">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </div>

                                @error('thumbnail')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>

                            {{-- Number of Images --}}
                            <div class="col-12">
                                <label for="numberImages" class="form-label">Number of Images</label>
                                <input type="number" min="1" max="10" value="{{ old('numberImages', 1) }}"
                                    class="form-control" name="numberImages" id="numberImages">
                            </div>

                            {{-- Alert --}}
                            @if ($errors->has('images') || $errors->has('images.*'))
                                <div class="col-12">
                                    <div class="alert alert-danger mb-0" role="alert">
                                        <ul class="mb-0">
                                            @foreach ($errors->get('images') as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach

                                            @foreach ($errors->get('images.*') as $imageErrors)
                                                @foreach ($imageErrors as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            {{-- Dynamic Input for Images --}}
                            <div class="col-12" id="imageInputsContainer">
                                {{-- Dynamic inputs will be appended here --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- General Information --}}
        <div class="card mt-4 shadow">
            <div class="card-header bg-light fw-medium py-3">
                General Information
            </div>

            <div class="card-body p-lg-4">
                <div class="row justify-content-md-center">
                    <div class="col-md-10 col-lg-8 col-xl-6">
                        <div class="row g-3">
                            {{-- Category --}}
                            <div class="col-12">
                                <label for="categories" class="form-label">Category</label>

                                <select class="form-select @error('categories') is-invalid @enderror"
                                    name="categories[]" id="multiple-select-clear-field"
                                    data-placeholder="Choose anything" multiple>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if (in_array($category->id, old('categories', []))) selected @endif>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('categories')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>

                            {{-- Name --}}
                            <div class="col-12">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}">

                                @error('name')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>

                            {{-- Price --}}
                            <div class="col-12">
                                <label for="price" class="form-label">Price</label>
                                <input type="text" class="form-control @error('price') is-invalid @enderror"
                                    id="price" name="price" value="{{ old('price') }}">

                                @error('price')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>

                            {{-- Description --}}
                            <div class="col-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>

                                @error('description')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- Thumbnail Modal --}}
    <div class="modal fade" id="thumbnailModal" tabindex="-1" aria-labelledby="thumbnailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="thumbnailModalLabel">Thumbnail Preview</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <img id="thumbnailPreview" src="" alt="Thumbnail Preview" class="img-fluid d-none" />
                    <p id="noThumbnailMessage" class="m-0">You haven't uploaded a thumbnail yet.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- JS Custom --}}
    @prepend('scripts')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.tiny.cloud/1/fvu7bcpprbvgdzeosolmgm996o4j4czc65ax19vwqf6yblbs/tinymce/7/tinymce.min.js"
            referrerpolicy="origin"></script>

        <script>
            tinymce.init({
                selector: 'textarea#description',
                plugins: 'code table lists',
                toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
            });
        </script>

        <script>
            $(document).ready(function() {
                const $numberImagesInput = $('#numberImages');
                const $imageInputsContainer = $('#imageInputsContainer');

                function generateImageInputs(count) {
                    $imageInputsContainer.empty();

                    for (let i = 1; i <= count; i++) {
                        const $div = $('<div>').addClass('col-12 mb-3');

                        const $label = $('<label>')
                            .addClass('form-label')
                            .attr('for', `images-${i}`)
                            .text(`Image-${i}`);

                        const $input = $('<input>')
                            .attr({
                                type: 'file',
                                id: `images-${i}`,
                                name: 'images[]',
                                accept: 'image/*',
                            })
                            .addClass('form-control')
                            .on('change', function() {
                                const file = this.files[0];
                                const $modalImage = $(`#imageModal-${i} #imagePreview`);
                                const $noImageMessage = $(`#imageModal-${i} #noImageMessage`);
                                const $deleteButton = $(`#deleteImageButton-${i}`);

                                if (file) {
                                    const reader = new FileReader();
                                    reader.onload = function(e) {
                                        $modalImage.attr('src', e.target.result);
                                        $modalImage.removeClass('d-none');
                                        $noImageMessage.addClass('d-none');
                                    };
                                    reader.readAsDataURL(file);
                                    $deleteButton.removeClass('d-none');
                                } else {
                                    $modalImage.addClass('d-none');
                                    $noImageMessage.removeClass('d-none');
                                }
                            });

                        const $information = $(`
                            <div class="form-text">Only files of type jpg, png and jpeg are allowed.</div>
                        `);

                        const $buttons = $(`
                            <div class="d-flex mt-2">
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#imageModal-${i}">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger ms-1 d-none" id="deleteImageButton-${i}">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </div>
                        `);

                        $buttons.find(`#deleteImageButton-${i}`).on('click', function() {
                            const $modalImage = $(`#imageModal-${i} #imagePreview`);
                            const $noImageMessage = $(`#imageModal-${i} #noImageMessage`);
                            $input.val('');
                            $modalImage.addClass('d-none');
                            $noImageMessage.removeClass('d-none');
                            $(this).addClass('d-none');
                        });

                        const $modal = $(`
                            <div class="modal fade" id="imageModal-${i}" tabindex="-1" aria-labelledby="imageModalLabel-${i}" aria-hidden="true">
                                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="imageModalLabel-${i}">Image-${i} Preview</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img id="imagePreview" src="" alt="Image-${i} Preview" class="img-fluid d-none" />
                                            <p id="noImageMessage" class="m-0">You haven't uploaded a image yet.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `);

                        $div.append($label, $input, $information, $buttons, $modal);
                        $imageInputsContainer.append($div);
                    }
                }

                $numberImagesInput.on('input', function() {
                    const value = parseInt($(this).val(), 10);
                    if (!isNaN(value) && value > 0 && value <= 10) {
                        generateImageInputs(value);
                    }
                });

                generateImageInputs($numberImagesInput.val());

                // =============================================================================================

                $('#multiple-select-clear-field').select2({
                    theme: "bootstrap-5",
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                        'style',
                    placeholder: $(this).data('placeholder'),
                    closeOnSelect: false,
                    allowClear: true,
                });

                // =============================================================================================

                const $priceInput = $('#price');

                $priceInput.on('input', function() {
                    let value = $(this).val().replace(/[^0-9]/g, '');
                    const formattedValue = new Intl.NumberFormat('id-ID').format(value);

                    $(this).val(formattedValue);
                });

                // =============================================================================================

                $('#thumbnail').on('change', function(event) {
                    const file = event.target.files[0];
                    const $thumbnailPreview = $('#thumbnailPreview');
                    const $noThumbnailMessage = $('#noThumbnailMessage');
                    const $deleteThumbnailButton = $('#deleteThumbnailButton');

                    if (file) {
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            $thumbnailPreview.attr('src', e.target.result);
                            $thumbnailPreview.removeClass('d-none');
                            $noThumbnailMessage.addClass('d-none');
                            $deleteThumbnailButton.removeClass('d-none');
                        };

                        reader.readAsDataURL(file);
                    } else {
                        $thumbnailPreview.addClass('d-none');
                        $noThumbnailMessage.removeClass('d-none');
                        $deleteThumbnailButton.addClass('d-none');
                    }
                });

                $('#deleteThumbnailButton').on('click', function() {
                    const $thumbnail = $('#thumbnail');
                    const $deleteThumbnailButton = $(this);
                    const $thumbnailPreview = $('#thumbnailPreview');
                    const $noThumbnailMessage = $('#noThumbnailMessage');

                    $thumbnail.val('');
                    $thumbnailPreview.addClass('d-none').attr('src', '');
                    $noThumbnailMessage.removeClass('d-none');
                    $deleteThumbnailButton.addClass('d-none');
                });
            });
        </script>
    @endprepend
</x-admin>
