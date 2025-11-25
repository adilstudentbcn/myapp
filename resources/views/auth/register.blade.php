<x-guest-layout>

    {{-- Header --}}
    <div class="mb-6 text-center space-y-1">
        <h1 class="text-2xl font-bold">Create your account</h1>
        <p class="text-sm text-gray-400">
            Join Rocket Jobs and start your journey.
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf


        {{-- Name --}}
        <div>
            <x-breeze.input-label for="name" :value="__('Name')" class="text-sm text-gray-200" />

            <x-breeze.text-input id="name" name="name" type="text" :value="old('name')" required autofocus
                autocomplete="name" class="mt-1 block w-full bg-black border border-zinc-700 rounded-lg px-3 py-2
                       text-white placeholder-gray-500 focus:border-amber-400 focus:ring-amber-400" />

            <x-breeze.input-error :messages="$errors->get('name')" class="mt-2 text-red-400" />
        </div>


        {{-- Email --}}
        <div>
            <x-breeze.input-label for="email" :value="__('Email')" class="text-sm text-gray-200" />

            <x-breeze.text-input id="email" name="email" type="email" :value="old('email')" required
                autocomplete="username" class="mt-1 block w-full bg-black border border-zinc-700 rounded-lg px-3 py-2
                       text-white placeholder-gray-500 focus:border-amber-400 focus:ring-amber-400" />

            <x-breeze.input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>


        {{-- Password --}}
        <div>
            <x-breeze.input-label for="password" :value="__('Password')" class="text-sm text-gray-200" />

            <x-breeze.text-input id="password" name="password" type="password" required autocomplete="new-password"
                class="mt-1 block w-full bg-black border border-zinc-700 rounded-lg px-3 py-2
                       text-white placeholder-gray-500 focus:border-amber-400 focus:ring-amber-400" />

            <x-breeze.input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>


        {{-- Confirm Password --}}
        <div>
            <x-breeze.input-label for="password_confirmation" :value="__('Confirm Password')"
                class="text-sm text-gray-200" />

            <x-breeze.text-input id="password_confirmation" name="password_confirmation" type="password" required
                autocomplete="new-password" class="mt-1 block w-full bg-black border border-zinc-700 rounded-lg px-3 py-2
                       text-white placeholder-gray-500 focus:border-amber-400 focus:ring-amber-400" />

            <x-breeze.input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400" />
        </div>


        {{-- Role Selector --}}
        <div>
            <label class="block text-sm font-semibold text-gray-200 mb-1">
                Register as:
            </label>

            <select name="role" required class="w-full bg-black border border-zinc-700 text-white px-3 py-2 rounded-lg
                       focus:border-amber-400 focus:ring-amber-400">
                <option value="applicant" class="bg-black">Applicant</option>
                <option value="employer" class="bg-black">Employer</option>
            </select>

            <x-breeze.input-error :messages="$errors->get('role')" class="mt-2 text-red-400" />
        </div>


        {{-- Bottom Links --}}
        <div class="flex items-center justify-between pt-2 text-sm">
            <a href="{{ route('login') }}"
                class="text-gray-400 hover:text-amber-400 underline-offset-4 hover:underline">
                Already registered?
            </a>

            <x-breeze.primary-button class="bg-amber-500 hover:bg-amber-400 text-black border-0
                       px-5 py-2.5 rounded-lg font-semibold">
                {{ __('Register') }}
            </x-breeze.primary-button>
        </div>

    </form>
</x-guest-layout>