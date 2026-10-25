<x-guest-layout>

    {{-- Session Status --}}
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="login-form">
        @csrf

        {{-- Email --}}
        <div class="login-field">
            <label for="email" class="login-label">Email</label>
            <div class="login-input-wrapper">
                <span class="login-input-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                </span>
                <input id="email"
                       type="email"
                       name="email"
                       value="{{ old('email') }}"
                       placeholder="admin@tastyfood.com"
                       required
                       autofocus
                       autocomplete="username"
                       class="login-input">
            </div>
            @error('email')
                <p class="login-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password dengan Show/Hide --}}
        <div class="login-field">
            <label for="password" class="login-label">Password</label>
            <div class="login-input-wrapper">
                <span class="login-input-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                </span>
                <input id="password"
                       type="password"
                       name="password"
                       placeholder="Masukkan password"
                       required
                       autocomplete="current-password"
                       class="login-input login-input-password">

                {{-- Toggle Password --}}
                <button type="button" class="login-password-toggle" onclick="togglePassword()" aria-label="Toggle password visibility">
                    {{-- Icon Mata Terbuka (default) --}}
                    <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                    {{-- Icon Mata Tertutup --}}
                    <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none;">
                        <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                        <line x1="1" y1="1" x2="23" y2="23"></line>
                    </svg>
                </button>
            </div>
            @error('password')
                <p class="login-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Remember Me + Forgot Password --}}
        <div class="login-options">
            <label for="remember_me" class="login-checkbox-label">
                <input id="remember_me" type="checkbox" name="remember" class="login-checkbox">
                <span>Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="login-forgot">
                    Lupa password?
                </a>
            @endif
        </div>

        {{-- Submit Button --}}
        <button type="submit" class="login-btn-submit">
            Masuk ke Dashboard
        </button>

        {{-- Back to Home --}}
        <a href="{{ route('home') }}" class="login-back-link">
            ← Kembali ke Website
        </a>

    </form>

    {{-- JavaScript Toggle Password --}}
    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const eyeOpen = document.getElementById('eyeOpen');
            const eyeClosed = document.getElementById('eyeClosed');

            if (input.type === 'password') {
                input.type = 'text';
                eyeOpen.style.display = 'none';
                eyeClosed.style.display = 'block';
            } else {
                input.type = 'password';
                eyeOpen.style.display = 'block';
                eyeClosed.style.display = 'none';
            }
        }
    </script>

</x-guest-layout>