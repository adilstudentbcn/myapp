<x-layout>
  <section class="max-w-3xl mx-auto space-y-8">

    <h1 class="text-3xl font-bold">Edit job</h1>

    <p class="text-gray-400 text-sm">
      Posting as
      <span class="font-semibold">{{ $job->employer->name }}</span>
    </p>

    <form action="{{ route('employer.jobs.update', $job) }}" method="POST" class="space-y-6">
      @csrf
      @method('PUT')

      {{-- Title --}}
      <div>
        <label class="block mb-2 text-sm">Job title</label>
        <input type="text" name="title" value="{{ old('title', $job->title) }}"
          class="w-full bg-gray-900 border border-gray-700 rounded-lg p-3" required>
      </div>

      {{-- Location --}}
      <div>
        <label class="block mb-2 text-sm">Location</label>
        <input type="text" name="location" value="{{ old('location', $job->location) }}"
          class="w-full bg-gray-900 border border-gray-700 rounded-lg p-3" required>
      </div>

      {{-- Salary --}}
      <div>
        <label class="block mb-2 text-sm">Salary</label>
        <input type="text" name="salary" value="{{ old('salary', $job->salary) }}"
          class="w-full bg-gray-900 border border-gray-700 rounded-lg p-3" required>
      </div>

      {{-- Apply URL --}}
      <div>
        <label class="block mb-2 text-sm">Apply URL (optional)</label>
        <input type="url" name="apply_url" value="{{ old('apply_url', $job->url) }}"
          class="w-full bg-gray-900 border border-gray-700 rounded-lg p-3">
      </div>

      {{-- Description --}}
      <div>
        <label class="block mb-2 text-sm">Job description</label>
        <textarea name="description" rows="6" class="w-full bg-gray-900 border border-gray-700 rounded-lg p-3"
          required>{{ old('description', $job->description) }}</textarea>
      </div>

      {{-- Tags --}}
      <div>
        <label class="block mb-2 text-sm">Tags</label>

        <div class="flex flex-wrap gap-4 text-sm">
          @foreach ($tags as $tag)
            <label class="flex items-center gap-1">
              <input type="checkbox" name="tags[]" value="{{ $tag->id }}" @checked(in_array($tag->id, old('tags', $job->tags->pluck('id')->toArray())))>
              {{ $tag->name }}
            </label>
          @endforeach
        </div>
      </div>

      {{-- Featured --}}
      <div class="mt-4">
        <label class="flex items-center gap-2">
          <input type="checkbox" name="featured" value="1" @checked(old('featured', $job->featured))>
          Mark as featured job
        </label>
      </div>

      {{-- Submit --}}
      <button type="submit"
        class="bg-amber-500 text-black font-semibold px-6 py-3 rounded-lg hover:bg-amber-400 transition">
        Save changes
      </button>
    </form>

  </section>
</x-layout>