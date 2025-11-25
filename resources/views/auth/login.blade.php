<x-guest-layout>
    {{-- Status message (e.g. "Password reset link sent") --}}
    <x-breeze.auth-session-status class="mb-4" :status="session('status')" />

    {{-- Header --}}
    <div class="mb-6 text-center space-y-1">
        <h1 class="text-2xl font-bold">Welcome back</h1>
        <p class="text-sm text-gray-400">
            Log in to manage your jobs or applications.
        </p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        {{-- Email --}}
        <div>
            <x-breeze.input-label for="email" :value="__('Email')" class="text-sm text-gray-200" />

            <x-breeze.text-input id="email" class="mt-1 block w-full bg-black border border-zinc-700 rounded-lg px-3 py-2
                       text-white placeholder-gray-500 focus:border-amber-400 focus:ring-amber-400" type="email"
                name="email" :value="old('email')" required autofocus autocomplete="username" />

            <x-breeze.input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        {{-- Password --}}
        <div>
            <x-breeze.input-label for="password" :value="__('Password')" class="text-sm text-gray-200" />

            <x-breeze.text-input id="password" class="mt-1 block w-full bg-black border border-zinc-700 rounded-lg px-3 py-2
                       text-white placeholder-gray-500 focus:border-amber-400 focus:ring-amber-400" type="password"
                name="password" required autocomplete="current-password" />

            <x-breeze.input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        {{-- Remember Me --}}
        <div class="flex items-center justify-between text-sm">
            <label for="remember_me" class="inline-flex items-center gap-2">
                <input id="remember_me" type="checkbox" name="remember" class="rounded border-zinc-600 bg-black text-amber-500 shadow-sm
                           focus:ring-amber-500 focus:ring-offset-0">
                <span class="text-gray-300">
                    {{ __('Remember me') }}
                </span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                    class="text-gray-400 hover:text-amber-400 underline-offset-4 hover:underline">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        {{-- Submit --}}
        <div class="mt-4 flex justify-end">
            <x-breeze.primary-button class="bg-amber-500 hover:bg-amber-400 text-black border-0
                       px-5 py-2.5 rounded-lg font-semibold">
                {{ __('Log in') }}
            </x-breeze.primary-button>
        </div>
    </form>
</x-guest-layout>