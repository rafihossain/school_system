<div class="loginpage">
    <x-auth-layout>
        <x-slot name="title">
            @lang('Login')
        </x-slot>

        <x-auth-card>

            <x-slot name="logo">
                <a href="/">
                    <img src="{{ asset('assets/images/logo.png') }}">
                </a>
            </x-slot>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
     

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-label for="email" :value="__('Email')" />

                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Password')" />

                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                </div>

                <!-- Remember Me -->
                <div class="flex align-items-center mt-4 mb-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                     @if (Route::has('password.request'))
                    <a class="ml-auto underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                    @endif
                </div>
                <x-button class="block w-full justify-center py-3">
                    {{ __('Log in') }}
                </x-button>
                 
            </form>

            <x-slot name="extra">
                @if (Route::has('register'))
                <p class="text-center text-gray-600 mt-4">
                    Do not have an account? <a href="{{ route('register') }}" class="underline hover:text-gray-900">Register</a>.
                </p>
                @endif
            </x-slot>
        </x-auth-card>
    </x-auth-layout>
</div>