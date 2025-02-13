<x-auth title="Login">
    {{-- CSS Custom --}}
    @prepend('styles')
        <style>
            .text-primary {
                color: #f5596c !important;
            }

            .btn-primary {
                border-color: #f5596c !important;
                background: #f5596c !important;
            }
        </style>
    @endprepend

    {{-- Content --}}
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-xs col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
            <div class="card border-0 shadow-lg" style="border-radius: 20px;">
                <div class="card-body p-5">
                    <h2 style="margin-bottom: 1.5rem; font-weight: 800; color: #f5596c;">Cheriewish</h2>
                    <h5 class="card-title" style="font-weight: 700;">Hello, welcome 👋</h5>
                    <h6
                        class="card-subtitle text-body-secondary
                        {{ session('success') || session('error') ? 'mb-3' : 'mb-4' }}">
                        Please log in to your account.
                    </h6>

                    {{-- Alert --}}
                    @if (session('error'))
                        <div class="alert alert-danger fw-medium" role="alert">
                            {!! session('error') !!}
                        </div>
                    @endif

                    <form class="row g-0" action="{{ route('loginAct') }}" method="POST">
                        @csrf

                        {{-- Email --}}
                        <div class="col-12 mb-3">
                            <div class="input-group">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name='email' id="email" placeholder="Email" value="{{ old('email') }}">

                                <span class="input-group-text">
                                    <i class="bi bi-person-fill"></i>
                                </span>

                                <small class="d-none text-danger"
                                    style="width:100%; margin-top:.25rem; font-size:.875em;"><strong>Email tidak
                                        valid</strong></small>

                                <small class="d-none text-success"
                                    style="width:100%; margin-top:.25rem; font-size:.875em;"><strong>Email sudah
                                        benar</strong></small>

                                @error('email')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>
                        </div>

                        {{-- Password --}}
                        <div class="col-12 mb-3">
                            <div class="input-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name='password' id="password" placeholder="Password">

                                <span class="input-group-text" id="toggle-password">
                                    <i class="bi bi-eye-fill"></i>
                                </span>

                                @error('password')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>
                        </div>

                        {{-- Captcha --}}
                        <div class="col-12 mb-4">
                            <div class="captcha d-flex align-items-end">
                                <span>{!! captcha_img('flat') !!}</span>

                                <button type="button" class="btn btn-sm btn-danger ms-2" id="reloadCaptcha">
                                    &#x21bb
                                </button>
                            </div>

                            <input type="text" class="form-control @error('captcha') is-invalid @enderror mt-2"
                                name='captcha' id="captcha" placeholder="Captcha">

                            @error('captcha')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        {{-- Button Submit --}}
                        <div class="col-12 mb-3">
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </div>

                        {{-- Forgot Password --}}
                        <div class="col-12 text-center">
                            <a href="{{ route('forgot_pass') }}" class="text-decoration-none text-primary"
                                style="font-weight: 600;">Forgot
                                password?</a>
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
                $("#email").on("input", function() {
                    let emailValue = $(this).val().trim();
                    let validText = $(this).closest(".input-group").find(".text-success");
                    let invalidText = $(this).closest(".input-group").find(".text-danger");

                    if (emailValue === "") {
                        validText.addClass("d-none");
                        invalidText.addClass("d-none");
                    } else if (emailValue.includes("@")) {
                        validText.removeClass("d-none");
                        invalidText.addClass("d-none");
                    } else {
                        invalidText.removeClass("d-none");
                        validText.addClass("d-none");
                    }
                });

                // =============================================================================================

                const passwordInput = $("#password");
                const togglePassword = $("#toggle-password");

                togglePassword.on("click", function() {
                    const eyeIcon = $(this).find("i");
                    const type = passwordInput.attr("type") === "password" ? "text" : "password";

                    passwordInput.attr("type", type);

                    if (eyeIcon.hasClass("bi-eye-fill")) {
                        eyeIcon.removeClass("bi-eye-fill").addClass("bi-eye-slash-fill");
                    } else {
                        eyeIcon.removeClass("bi-eye-slash-fill").addClass("bi-eye-fill");
                    }
                });

                // =============================================================================================

                $('#reloadCaptcha').click(function() {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('reload_captcha') }}",
                        success: function(data) {
                            $(".captcha span").html(data.captcha);
                        }
                    });
                });

                // =============================================================================================

                $("#captcha").on("input", function() {
                    let value = $(this).val();
                    value = value.replace(/[^a-zA-Z0-9]/g, '');

                    if (value.length > 5) {
                        value = value.substring(0, 5);
                    }

                    $(this).val(value);
                });
            });
        </script>
    @endprepend
</x-auth>
