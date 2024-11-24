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
    <h4 class="mb-2 fw-semibold d-inline-flex">Company Management</h4>

    {{-- Breadcrumbs --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Company</li>
        </ol>
    </nav>

    <div class="card mt-4 shadow">
        <div class="card-header bg-light fw-medium py-3">
            My Company
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
            </div>

            {{-- Table --}}
        </div>
    </div>

    <!-- Form Create Modal -->
    <div class="modal fade" id="formCreateModal" tabindex="-1" aria-labelledby="formCreateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="formCreateModalLabel">Create Company</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('company.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ old('name') }}"
                                placeholder="Enter company name">

                            @error('name')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" value="{{ old('email') }}"
                                placeholder="Enter company email">

                            @error('email')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Phone Number</label><br />
                            <button type="button" class="btn btn-sm btn-dark mb-3" id="add_phone_number">Add Phone
                                Number</button>

                            <div id="phone_number_container">
                                <div class="mb-3 d-flex phone-input-wrapper" id="phone_wrapper_1">
                                    <input type="text"
                                        class="form-control me-2 phone-number-input @error('phone_number') is-invalid @enderror"
                                        id="phone_number_1" name="phone_numbers[]" value="{{ old('phone_numbers.0') }}"
                                        placeholder="Enter company phone number">
                                    <button type="button" class="btn btn-sm btn-danger remove-phone" data-id="1"><i
                                            class="bi bi-trash3"></i></button>
                                </div>
                            </div>

                            @error('phone_number')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="social_media" class="form-label">Social Media</label><br />
                            <button type="button" class="btn btn-sm btn-dark mb-3" id="add_social_media">Add Social
                                Media</button>

                            <div id="social_media_container">
                                <div class="mb-3 d-flex social-media-wrapper" id="social_media_wrapper_1">
                                    <div class="row me-2 g-0">
                                        <div class="col-12 mb-2">
                                            <select name="social_medias[1][platform]"
                                                class="form-select platform-input">
                                                <option value="">Select Platform</option>
                                                <option value="facebook">Facebook</option>
                                                <option value="instagram">Instagram</option>
                                                <option value="tiktok">Tiktok</option>
                                                <option value="twitter">Twitter</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <input type="text" name="social_medias[1][url]"
                                                class="form-control url-input" placeholder="Enter URL">
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-danger remove-social-media"
                                        data-id="1">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </div>
                            </div>

                            @error('social_media')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" id="address" rows="5" class="form-control @error('address') is-invalid @enderror"
                                placeholder="Enter company address">{{ old('address') }}</textarea>

                            @error('address')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">Save</button>
                    </form>
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
                });
            </script>
        @endif

        <script>
            $(document).ready(function() {
                $('#formCreateModal').on('show.bs.modal', function() {
                    let maxPhoneNumbers = 3;
                    let phoneNumberCount = 1;

                    function validateNumberInput(input) {
                        input.value = input.value.replace(/[^0-9]/g, '');
                    }

                    $('#phone_number_1').on('input', function() {
                        validateNumberInput(this);
                    });

                    $('#add_phone_number').on('click', function() {
                        if (phoneNumberCount < maxPhoneNumbers) {
                            phoneNumberCount++;

                            $('#phone_number_container').append(`
                                <div class="mb-3 d-flex phone-input-wrapper" id="phone_wrapper_${phoneNumberCount}">
                                    <input type="text" class="form-control me-2 phone-number-input"
                                        id="phone_number_${phoneNumberCount}" name="phone_numbers[]"
                                        placeholder="Enter company phone number">
                                    <button type="button" class="btn btn-sm btn-danger remove-phone" data-id="${phoneNumberCount}">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </div>
                            `);

                            $(`#phone_number_${phoneNumberCount}`).on('input', function() {
                                validateNumberInput(this);
                            });

                            if (phoneNumberCount === maxPhoneNumbers) {
                                $(this).prop('disabled', true);
                            }
                        }
                    });

                    $('#phone_number_container').on('click', '.remove-phone', function() {
                        let id = $(this).data('id');

                        if (id === 1) {
                            $(this).closest('.phone-input-wrapper').find('input').val('');
                        } else {
                            $(`#phone_wrapper_${id}`).remove();
                            phoneNumberCount--;

                            if (phoneNumberCount < maxPhoneNumbers) {
                                $('#add_phone_number').prop('disabled', false);
                            }
                        }
                    });

                    // =============================================================================================

                    let maxSocialMedia = 4;
                    let socialMediaCount = 1;

                    function updatePlatformOptions() {
                        const selectedPlatforms = [];

                        $('.platform-input').each(function() {
                            const value = $(this).val();
                            if (value) selectedPlatforms.push(value);
                        });

                        $('.platform-input').each(function() {
                            const currentValue = $(this).val();
                            $(this).find('option').each(function() {
                                const optionValue = $(this).attr('value');

                                if (selectedPlatforms.includes(optionValue) && optionValue !==
                                    currentValue) {
                                    $(this).hide();
                                } else {
                                    $(this).show();
                                }
                            });
                        });
                    }

                    function disableAddButton() {
                        $('#add_social_media').prop('disabled', socialMediaCount >= maxSocialMedia);
                    }

                    $('#add_social_media').on('click', function() {
                        if (socialMediaCount < maxSocialMedia) {
                            socialMediaCount++;

                            $('#social_media_container').append(`
                                <div class="mb-3 d-flex social-media-wrapper" id="social_media_wrapper_${socialMediaCount}">
                                    <div class="row me-2 g-0">
                                        <div class="col-12 mb-2">
                                            <select name="social_medias[${socialMediaCount}][platform]" class="form-select platform-input">
                                                <option value="">Select Platform</option>
                                                <option value="facebook">Facebook</option>
                                                <option value="instagram">Instagram</option>
                                                <option value="tiktok">Tiktok</option>
                                                <option value="twitter">Twitter</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <input type="text" name="social_medias[${socialMediaCount}][url]" class="form-control url-input"
                                                placeholder="Enter URL">
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-danger remove-social-media" data-id="${socialMediaCount}">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </div>
                            `);

                            disableAddButton();
                            updatePlatformOptions();
                        }
                    });

                    $(document).on('click', '.remove-social-media', function() {
                        const id = $(this).data('id');

                        if (id === 1) {
                            $(`#social_media_wrapper_${id} .platform-input`).val('');
                            $(`#social_media_wrapper_${id} .url-input`).val('');
                        } else {
                            $(`#social_media_wrapper_${id}`).remove();
                            socialMediaCount--;
                            disableAddButton();
                        }

                        updatePlatformOptions();
                    });

                    $(document).on('change', '.platform-input', function() {
                        updatePlatformOptions();
                    });

                    disableAddButton();
                    updatePlatformOptions();
                });
            });
        </script>
    @endprepend
</x-admin>
