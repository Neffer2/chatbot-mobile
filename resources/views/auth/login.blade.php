<x-guest-layout>
    <div class="login-container">
        <!-- Image Section -->
        <div class="image-section">
            <img src="{{ asset('assets/login-plan-choque-text.png') }}" alt="Login Image">

        </div>

        <!-- Form Section -->
        <div class="form-section">
            <!-- Session Status -->
            <x-auth-session-status :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <x-text-input id="email" class="block mt-1 w-full custom-input" type="email" name="email"
                        :value="old('email')" required autofocus autocomplete="username"
                        placeholder="{{ __('CORREO') }}" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 custom-error" />
                </div>
            
                <!-- Password -->
                <div class="mt-4">
                    <x-text-input id="password" class="block mt-1 w-full custom-input" type="password" name="password"
                        required autocomplete="current-password" placeholder="{{ __('CONTRASEÑA') }}" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 custom-error" />
                </div>
            
                <!-- Remember Me -->
                <div class="remember-me-login-cont">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="custom-checkbox" name="remember">
                        <span class="custom-checkbox-text">{{ __('TRATAMIENTO DE DATOS') }}</span>
                    </label>
                </div>

                <div class="">
                    {{-- @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif --}}

                    <div class="login-btn-container">
                        <x-primary-button class="custom-button">
                            {{ __('INGRESAR') }}
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="login-footer">
        <p>© MOBIL | TERPEL 2024. TODOS LOS DERECHOS RESERVADOS.</p>
        <img src="{{ asset('assets/mobil-terpel.png') }}" alt="">
    </div>
</x-guest-layout>
