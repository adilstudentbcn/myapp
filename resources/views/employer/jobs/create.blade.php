<x-layout>

  <section class="max-w-3xl mx-auto space-y-8">

    <h1 class="text-3xl font-bold">Post a new job</h1>

    <p class="text-gray-400 text-sm">
      Posting as <span class="font-semibold">{{ $employer->name }}</span>
    </p>

    <form action="{{ route('employer.jobs.store') }}" method="POST" class="space-y-6">
      @csrf

      <div>
        <label class="block text-sm font-semibold mb-1">Job title</label>
        <input type="text" name="title" value="{{ old('title') }}" class="w-full rounded-lg bg-gray-900 border border-gray-700 px-3 py-2
                              focus:outline-none focus:border-amber-400">
        @error('title')
          <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label class="block text-sm font-semibold mb-1">Location</label>
        <input type="text" name="location" value="{{ old('location') }}" class="w-full rounded-lg bg-gray-900 border border-gray-700 px-3 py-2
                              focus:outline-none focus:border-amber-400">
        @error('location')
          <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label class="block text-sm font-semibold mb-1">Salary</label>
        <input type="text" name="salary" value="{{ old('salary') }}" placeholder="EUR 60k" class="w-full rounded-lg bg-gray-900 border border-gray-700 px-3 py-2
                              focus:outline-none focus:border-amber-400">
        @error('salary')
          <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
        @enderror
      </div>



      {{-- Job description --}}
      <div class="mt-6">
        <label for="description" class="block text-sm font-medium mb-1">
          Job description
        </label>
        <textarea id="description" name="description" rows="5"
          class="w-full bg-black border border-gray-600 rounded-lg px-4 py-2"
          placeholder="Describe the role, responsibilities, tech stack, etc.">{{ old('description') }}</textarea>
      </div>




      <div>
        <label class="block text-sm font-semibold mb-1">Apply URL (optional)</label>
        <input type="url" name="apply_url" value="{{ old('apply_url') }}" placeholder="https://..." class="w-full rounded-lg bg-gray-900 border border-gray-700 px-3 py-2
                              focus:outline-none focus:border-amber-400">
        @error('apply_url')
          <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label class="block text-sm font-semibold mb-2">Tags</label>
        <div class="flex flex-wrap gap-2">
          @foreach ($tags as $tag)
            <label class="inline-flex items-center gap-2 text-sm">
              <input type="checkbox" name="tags[]" value="{{ $tag->id }}" @checked(in_array($tag->id, old('tags', [])))>
              <span>{{ $tag->name }}</span>
            </label>
          @endforeach
        </div>
        @error('tags')
          <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="flex items-center gap-2">
        <input type="checkbox" name="featured" value="1" @checked(old('featured'))>
        <span class="text-sm">Mark as featured job</span>
      </div>

      <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-amber-500
                           px-5 py-2.5 font-semibold text-black hover:bg-amber-400">
        Publish job
      </button>

    </form>

  </section>

</x-layout>