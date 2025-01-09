<x-admin>
    {{-- CSS Custom --}}
    @prepend('styles')
        <style>
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
    <h4 class="mb-2 fw-semibold d-inline-flex">Company Management</h4>

    {{-- Breadcrumbs --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Company</li>
        </ol>
    </nav>

    <div class="card mt-4 shadow">
        <div class="card-header bg-white fw-medium py-3">
            <div class="d-flex align-items-center justify-content-between">
                My Company
                <a href="{{ route('company.form') }}" class="btn btn-sm btn-warning custom align-middle">Form<i
                        class="bi bi-pencil ms-2"></i></a>
            </div>
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

            @if ($company && $about)
                <h5 class="card-title text-center fw-semibold mt-4">{{ $about->title }}</h5>

                <div class="row mt-3 g-4">
                    <div class="col-md-5 col-xl-4">
                        <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo" class="img-fluid">
                    </div>

                    <div class="col-md-7 col-xl-8">
                        <div class="table-responsive">
                            <table class="table table-borderless text-wrap">
                                <tbody>
                                    <tr>
                                        <td class="px-0 pe-3 py-1">Name</td>
                                        <td class="px-1 py-1">:</td>
                                        <td class="px-0 py-1">{{ $company->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-0 pe-3 py-1">Email</td>
                                        <td class="px-1 py-1">:</td>
                                        <td class="px-0 py-1"><a href="mailto:{{ $company->email }}"
                                                class="text-decoration-underline">{{ $company->email }}</a></td>
                                    </tr>
                                    <tr>
                                        <td class="px-0 pe-3 py-1">Whatsapp Number</td>
                                        <td class="px-1 py-1">:</td>
                                        <td class="px-0 py-1"><a href="https://wa.me/{{ $company->phone_number }}"
                                                target="_blank"
                                                class="text-decoration-underline">{{ $company->phone_number }}</a></td>
                                    </tr>
                                    <tr>
                                        <td class="px-0 pe-3 py-1">Shopee</td>
                                        <td class="px-1 py-1">:</td>
                                        <td class="px-0 py-1"><a href="{{ $company->shopee }}" target="_blank"
                                                class="text-decoration-underline">{{ $company->shopee }}</a></td>
                                    </tr>
                                    <tr>
                                        <td class="px-0 pe-3 py-1">Facebook</td>
                                        <td class="px-1 py-1">:</td>
                                        <td class="px-0 py-1">
                                            @if ($company->facebook)
                                                <a href="{{ $company->facebook }}" target="_blank"
                                                    class="text-decoration-underline">{{ $company->facebook }}</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-0 pe-3 py-1">Instagram</td>
                                        <td class="px-1 py-1">:</td>
                                        <td class="px-0 py-1">
                                            @if ($company->instagram)
                                                <a href="{{ $company->instagram }}" target="_blank"
                                                    class="text-decoration-underline">{{ $company->instagram }}</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-0 pe-3 py-1">TikTok</td>
                                        <td class="px-1 py-1">:</td>
                                        <td class="px-0 py-1">
                                            @if ($company->tiktok)
                                                <a href="{{ $company->tiktok }}" target="_blank"
                                                    class="text-decoration-underline">{{ $company->tiktok }}</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-0 pe-3 py-1">Twitter</td>
                                        <td class="px-1 py-1">:</td>
                                        <td class="px-0 py-1">
                                            @if ($company->twitter)
                                                <a href="{{ $company->twitter }}" target="_blank"
                                                    class="text-decoration-underline">{{ $company->twitter }}</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-0 pe-3 py-1">Address</td>
                                        <td class="px-1 py-1">:</td>
                                        <td class="px-0 py-1">
                                            {{ $company->address ?? '-' }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            {{-- Short Description --}}
                            <h5 class="card-title mt-4">Short Description</h5>
                            <p class="card-text">{{ $about->short_description }}</p>

                            {{-- Long Description --}}
                            <h5 class="card-title mt-4">Long Description</h5>
                            <p class="card-text">{!! $about->description !!}</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <img src="{{ asset('images/empty.png') }}" width="300" class="img-fluid" alt="Empty">
                    <h5 class="card-title text-center">Data not yet available</h5>
                </div>
            @endif
        </div>
    </div>

    {{-- JS Custom --}}
    @prepend('scripts')
        <script>
            $(document).ready(function() {
                //
            });
        </script>
    @endprepend
</x-admin>
