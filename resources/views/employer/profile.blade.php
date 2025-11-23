<x-layout>

  <section class="max-w-2xl mx-auto space-y-8">

    <h1 class="text-3xl font-bold">Employer profile</h1>

    @if (session('status'))
      <div class="rounded-lg bg-emerald-900/40 border border-emerald-500 px-4 py-3 text-sm">
        {{ session('status') }}
      </div>
    @endif

    <p class="text-gray-400 text-sm">
      Logged in as <span class="font-semibold">{{ $user->email }}</span>.
    </p>

    <form action="{{ route('employer.profile.update') }}" method="POST" class="space-y-6">
      @csrf

      <div>
        <label class="block text-sm font-semibold mb-1">Company name</label>
        <input type="text" name="name" value="{{ old('name', $employer->name) }}" class="w-full rounded-lg bg-gray-900 border border-gray-700 px-3 py-2
                              focus:outline-none focus:border-amber-400">
        @error('name')
          <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label class="block text-sm font-semibold mb-1">Website (optional)</label>
        <input type="url" name="website" value="{{ old('website', $employer->website) }}" class="w-full rounded-lg bg-gray-900 border border-gray-700 px-3 py-2
                              focus:outline-none focus:border-amber-400">
        @error('website')
          <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label class="block text-sm font-semibold mb-1">Logo URL (optional)</label>
        <input type="url" name="logo" value="{{ old('logo', $employer->logo) }}" class="w-full rounded-lg bg-gray-900 border border-gray-700 px-3 py-2
                              focus:outline-none focus:border-amber-400">
        @error('logo')
          <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-amber-500
                           px-5 py-2.5 font-semibold text-black hover:bg-amber-400">
        Save company profile
      </button>
    </form>

  </section>

</x-layout>