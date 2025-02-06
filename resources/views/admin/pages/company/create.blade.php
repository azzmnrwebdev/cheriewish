<x-admin>
    {{-- CSS Custom --}}
    @prepend('styles')
        <style>
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
    <h4 class="mb-2 fw-semibold d-inline-flex">Form Company</h4>

    {{-- Breadcrumbs --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="text-decoration-none" href="{{ route('company.index') }}">Company</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Form</li>
        </ol>
    </nav>

    {{-- Form --}}
    <form action="{{ route('company.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="companyId" value="{{ $company->id ?? '' }}">

        {{-- Company Logo --}}
        <div class="card mt-4 shadow">
            <div class="card-header bg-white fw-medium py-3">
                Company Logo
            </div>

            <div class="card-body p-lg-4">
                <div class="row justify-content-md-center">
                    <div class="col-md-10 col-lg-8 col-xl-6">
                        <div class="row g-3">
                            {{-- Logo --}}
                            <div class="col-12">
                                <label for="logo" class="form-label"><i class="bi bi-image me-2"></i>Logo</label>
                                <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                    id="logo" name="logo" accept="image/*">

                                @if ($company && $company->logo)
                                    <input type="hidden" name="old_logo" value="{{ $company->logo }}">
                                @endif

                                <div class="form-text">Only files of type jpg, png and jpeg are allowed.</div>

                                @error('logo')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror

                                <div class="d-flex mt-2">
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#logoModal">
                                        <i class="bi bi-eye"></i>
                                    </button>

                                    @if ($company && $company->logo)
                                        <button type="button" class="btn btn-sm btn-danger ms-1" id="deleteLogoButton">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-sm btn-danger ms-1 d-none"
                                            id="deleteLogoButton">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- General Data --}}
        <div class="card mt-4 shadow">
            <div class="card-header bg-white fw-medium py-3">
                General Data
            </div>

            <div class="card-body p-lg-4">
                <div class="row justify-content-md-center">
                    <div class="col-md-10 col-lg-8 col-xl-6">
                        <div class="row g-3">
                            {{-- Name --}}
                            <div class="col-12">
                                <label for="name" class="form-label"><i class="bi bi-building me-2"></i>Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $company->name ?? '') }}"
                                    placeholder="Company name">

                                @error('name')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="col-12">
                                <label for="email" class="form-label"><i
                                        class="bi bi-envelope me-2"></i>Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email', $company->email ?? '') }}"
                                    placeholder="Company email">

                                @error('email')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>

                            {{-- Whatsapp Number --}}
                            <div class="col-12">
                                <label for="phone_number" class="form-label"><i class="bi bi-whatsapp me-2"></i>Whatsapp
                                    Number</label>
                                <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                    id="phone_number" name="phone_number"
                                    value="{{ old('phone_number', $company->phone_number ?? '') }}"
                                    placeholder="Company number">

                                @error('phone_number')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>

                            {{-- Shopee URL --}}
                            <div class="col-12">
                                <label for="shopee" class="form-label"><i class="bi bi-link-45deg me-2"></i>Shopee
                                    URL</label>
                                <input type="text" class="form-control @error('shopee') is-invalid @enderror"
                                    id="shopee" name="shopee" value="{{ old('shopee', $company->shopee ?? '') }}"
                                    placeholder="Company store">

                                @error('shopee')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>

                            {{-- Address --}}
                            <div class="col-12">
                                <label for="address" class="form-label"><i class="bi bi-globe2 me-2"></i>Address
                                    (optional)</label>
                                <textarea name="address" id="address" rows="5" class="form-control" placeholder="Company address">{{ old('address', $company->address ?? '') }}</textarea>

                                @error('address')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- About the Company --}}
        <div class="card mt-4 shadow">
            <div class="card-header bg-white fw-medium py-3">
                About the Company
            </div>

            <div class="card-body p-lg-4">
                <div class="row justify-content-md-center">
                    <div class="col-md-10 col-lg-8 col-xl-6">
                        <div class="row g-3">
                            {{-- Short Description --}}
                            <div class="col-12">
                                <label for="short_description" class="form-label"><i
                                        class="bi bi-card-text me-2"></i>Short Description (optional)</label>
                                <textarea name="short_description" id="short_description" rows="5" class="form-control"
                                    placeholder="Short description">{{ old('short_description', $company->short_description ?? '') }}</textarea>

                                @error('short_description')
                                    <small class="invalid-feedback d-block"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>

                            {{-- Long Description --}}
                            <div class="col-12">
                                <label for="description" class="form-label"><i class="bi bi-body-text me-2"></i>Long
                                    Description (optional)</label>
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                    placeholder="Long description">{{ old('description', $company->description ?? '') }}</textarea>

                                @error('description')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sosial Media --}}
        <div class="card mt-4 shadow">
            <div class="card-header bg-white fw-medium py-3">
                Sosial Media
            </div>

            <div class="card-body p-lg-4">
                <div class="row justify-content-md-center">
                    <div class="col-md-10 col-lg-8 col-xl-6">
                        <div class="row g-3">
                            {{-- Facebook --}}
                            <div class="col-12">
                                <label for="facebook" class="form-label"><i class="bi bi-facebook me-2"></i>Facebook
                                    (optional)</label>
                                <input type="text" class="form-control @error('facebook') is-invalid @enderror"
                                    id="facebook" name="facebook"
                                    value="{{ old('facebook', $company->facebook ?? '') }}"
                                    placeholder="Facebook account">

                                @error('facebook')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>

                            {{-- Instagram --}}
                            <div class="col-12">
                                <label for="instagram" class="form-label"><i
                                        class="bi bi-instagram me-2"></i>Instagram (optional)</label>
                                <input type="text" class="form-control @error('instagram') is-invalid @enderror"
                                    id="instagram" name="instagram"
                                    value="{{ old('instagram', $company->instagram ?? '') }}"
                                    placeholder="Instagram account">

                                @error('instagram')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>

                            {{-- Tiktok --}}
                            <div class="col-12">
                                <label for="tiktok" class="form-label"><i class="bi bi-tiktok me-2"></i>TikTok
                                    (optional)</label>
                                <input type="text" class="form-control @error('tiktok') is-invalid @enderror"
                                    id="tiktok" name="tiktok"
                                    value="{{ old('tiktok', $company->tiktok ?? '') }}" placeholder="Tiktok account">

                                @error('tiktok')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>

                            {{-- Twitter --}}
                            <div class="col-12">
                                <label for="twitter" class="form-label"><i class="bi bi-twitter-x me-2"></i>Twitter
                                    (optional)</label>
                                <input type="text" class="form-control @error('twitter') is-invalid @enderror"
                                    id="twitter" name="twitter"
                                    value="{{ old('twitter', $company->twitter ?? '') }}"
                                    placeholder="Twitter account">

                                @error('twitter')
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

    {{-- Logo Modal --}}
    <div class="modal fade" id="logoModal" tabindex="-1" aria-labelledby="logoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="logoModalLabel">Logo Preview</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    @if ($company && $company->logo)
                        <img id="logoPreview" src="{{ asset('storage/' . $company->logo) }}" alt="Logo Preview"
                            class="img-fluid" />
                        <p id="noLogoMessage" class="m-0 d-none">You haven't uploaded a logo yet.</p>
                    @else
                        <img id="logoPreview" src="" alt="Logo Preview" class="img-fluid d-none" />
                        <p id="noLogoMessage" class="m-0">You haven't uploaded a logo yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- JS Custom --}}
    @prepend('scripts')
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
                $('#logo').on('change', function(event) {
                    const file = event.target.files[0];
                    const $logoPreview = $('#logoPreview');
                    const $noLogoMessage = $('#noLogoMessage');
                    const $deleteLogoButton = $('#deleteLogoButton');
                    const $oldLogoInput = $('input[name="old_logo"]');

                    if (file) {
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            $oldLogoInput.val('');
                            $logoPreview.attr('src', e.target.result);
                            $logoPreview.removeClass('d-none');
                            $noLogoMessage.addClass('d-none');
                            $deleteLogoButton.removeClass('d-none');
                        };

                        reader.readAsDataURL(file);
                    } else {
                        $oldLogoInput.val('');
                        $logoPreview.addClass('d-none');
                        $noLogoMessage.removeClass('d-none');
                        $deleteLogoButton.addClass('d-none');
                    }
                });

                $('#deleteLogoButton').on('click', function() {
                    const $logo = $('#logo');
                    const $deleteLogoButton = $(this);
                    const $logoPreview = $('#logoPreview');
                    const $noLogoMessage = $('#noLogoMessage');
                    const $oldLogoInput = $('input[name="old_logo"]');

                    $logo.val('');
                    $oldLogoInput.val('');
                    $logoPreview.addClass('d-none').attr('src', '');
                    $noLogoMessage.removeClass('d-none');
                    $deleteLogoButton.addClass('d-none');
                });

                // =============================================================================================

                $('#phone_number').on('input', function() {
                    let value = $(this).val();
                    value = value.replace(/[^0-9]/g, '');

                    if (value.startsWith('0')) {
                        value = '62' + value.slice(1);
                    }

                    $(this).val(value);
                });
            });
        </script>
    @endprepend
</x-admin>
