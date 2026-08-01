<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Login') }} - POS Coffee Shop</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/login.css'])

</head>

<body>

    <div class="login-card">

        <div class="login-brand">
            <img src="{{ asset('assets/icons/logo/logo.svg') }}" alt="POS Coffee Shop">
            {{-- <span>Login</span> --}}
        </div>

        <hr class="login-divider">

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input type="email" name="email" id="email"
                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                    placeholder="{{ __('Masukkan email') }}" autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <div class="password-wrapper">
                    <input type="password" name="password" id="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="{{ __('Masukkan password') }}">
                    <button type="button" class="btn-toggle-password" id="togglePassword"
                        aria-label="Tampilkan password">
                        <i class="bi bi-eye" id="toggleIcon"></i>
                    </button>
                </div>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- <div class="login-options">
                <div class="form-check">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input">
                    <label for="remember" class="form-check-label">{{ __('Ingat saya') }}</label>
                </div>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="login-forgot">{{ __('Lupa password?') }}</a>
                @endif
            </div> --}}

            <button type="submit" class="btn-login mt-3">{{ __('Login') }}</button>

        </form>

    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        const toggleIcon = document.getElementById('toggleIcon');

        togglePassword.addEventListener('click', () => {
            const isHidden = passwordInput.type === 'password';
            passwordInput.type = isHidden ? 'text' : 'password';

            toggleIcon.classList.toggle('bi-eye', !isHidden);
            toggleIcon.classList.toggle('bi-eye-slash', isHidden);

            togglePassword.setAttribute('aria-label', isHidden ? 'Sembunyikan password' : 'Tampilkan password');
        });
    </script>
</body>

</html>
