<div class="footer">
    <div class="container">
        @php
            $company = \App\Models\Company::latest()->first();

            $socialLinks = [
                'shopee' => $company->shopee ?? null,
                'facebook' => $company->facebook ?? null,
                'instagram' => $company->instagram ?? null,
                'tiktok' => $company->tiktok ?? null,
                'twitter' => $company->twitter ?? null,
            ];

            $socialLinks = array_filter($socialLinks);
        @endphp

        @if ($company)
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3">
                <div class="col-12 col-md-6 d-flex align-items-center">
                    <span class="mb-2 mb-md-0 text-body-secondary">© {{ date('Y') }}
                        {{ $company->name ?? 'Cheriewish' }}. All
                        rights reserved.</span>
                </div>

                <ul class="nav col-12 col-md-6 justify-content-md-end list-unstyled d-flex">
                    @foreach ($socialLinks as $key => $link)
                        <li class="{{ $loop->first ? 'ms-0' : 'ms-3' }}">
                            <a href="{{ $link }}" class="text-body-secondary" target="_blank">
                                <i
                                    class="bi {{ $key === 'shopee' ? 'bi-bag-fill' : ($key === 'twitter' ? 'bi-twitter-x' : 'bi-' . $key) }} fs-5"></i>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </footer>
        @else
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3">
                <div class="col-12 d-flex align-items-center">
                    <span class="text-body-secondary">© {{ date('Y') }} {{ $company->name ?? 'Cheriewish' }}. All
                        rights reserved.</span>
                </div>
            </footer>
        @endif
    </div>
</div>
