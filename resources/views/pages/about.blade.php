<x-guest title="About">
    {{-- CSS Custom --}}
    @prepend('styles')
        <style>
            main {
                flex: 1;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                background-image: url('/images/background2.png');
                background-repeat: no-repeat;
                background-size: cover;
            }

            #header {
                display: flex;
                min-height: 45vh;
                padding-bottom: 2.5rem;
                flex-direction: column;
                justify-content: flex-end;

                .header_title {
                    color: #222222;
                    font-size: 24px;
                    font-weight: 900;
                    text-transform: uppercase;
                }

                .header_title::after {
                    content: "";
                    display: block;
                    width: 100%;
                    height: 2px;
                    margin-top: 3px;
                    background-color: #222222;
                }

                .header_text {
                    color: #222222;
                    font-size: 16px;
                    margin-bottom: 0;
                }
            }

            @media (min-width: 576px) {
                /*  */
            }

            @media (min-width: 768px) {
                #header .header_title {
                    font-size: 28px;
                }

                #header .header_text {
                    font-size: 18px;
                }
            }

            @media (min-width: 992px) {
                #header {
                    min-height: 50vh;
                }

                #header .header_title {
                    font-size: 30px;
                }

                #header .header_text {
                    font-size: 20px;
                }
            }

            @media (min-width: 1200px) {
                /*  */
            }
        </style>
    @endprepend

    <main>
        {{-- Hero --}}
        <header id="header">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-10 col-lg-8 col-xl-6">
                        <h1 class="header_title d-inline-block">{{ $about->title }}</h1>

                        <p class="header_text">
                            Explaining in full about our company.
                        </p>
                    </div>
                </div>
            </div>
        </header>

        {{-- Main Content --}}
        <div class="container py-5">
            <div class="row g-0">
                <div class="col-12 col-md-10 col-lg-8">
                    <div class="card border-0 rounded-none bg-transparent">
                        <div class="card-body p-0">
                            <img src="{{ asset('storage/' . $company->logo) }}" id="logo"
                                class="float-sm-start me-sm-3 mb-3 mb-sm-1" style="width: 300px;">
                            {!! $about->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <x-footer></x-footer>
    </main>

    @prepend('scripts')
        {{--  --}}
    @endprepend
</x-guest>
