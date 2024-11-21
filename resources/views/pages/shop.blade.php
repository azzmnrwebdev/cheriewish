<x-guest title="Shop">
    {{-- CSS Custom --}}
    @prepend('styles')
        <style>
            #header {
                padding: 6rem 0;
                margin-top: 56.2px;
                background-color: #FBB1C7;

                .header_title {
                    color: white;
                    font-size: 40px;
                    font-weight: 900;
                    margin-bottom: 24px;
                    text-transform: uppercase;
                }

                .header_text {
                    color: white;
                    font-size: 16px;
                    margin-bottom: 0;
                }
            }

            @media (min-width: 576px) {
                #header .header_title {
                    font-size: 50px;
                }
            }

            @media (min-width: 768px) {
                #header .header_title {
                    font-size: 58px;
                }

                #header .header_text {
                    font-size: 18px;
                }
            }

            @media (min-width: 992px) {
                #header {
                    padding: 8rem 0;
                }

                #header .header_title {
                    font-size: 70px;
                }

                #header .header_text {
                    font-size: 20px;
                }
            }

            @media (min-width: 1200px) {
                #header .header_title {
                    font-size: 80px;
                }

                #header .header_text {
                    font-size: 24px;
                }
            }
        </style>
    @endprepend

    {{-- Hero --}}
    <header id="header">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-10 col-md-8 col-lg-6">
                    <h1 class="header_title">Products</h1>

                    <p class="header_text">Take a minute to write an introduction that is short, sweet, and to the
                        point.
                    </p>
                </div>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    {{--  --}}

    @prepend('scripts')
        {{--  --}}
    @endprepend
</x-guest>
