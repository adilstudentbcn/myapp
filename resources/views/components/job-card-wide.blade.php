@props(['job'])

<a href="{{ route('jobs.show', $job) }}"
  class="block w-full border border-transparent rounded-xl hover:border-amber-400 transition-colors duration-300 group">

  <div class="p-4 bg-white/5 rounded-xl flex items-center justify-between w-full">

    <div class="flex items-center gap-4">
      <x-employer-logo />

      <div>
        <div class="text-sm font-semibold">
          {{ $job->employer->name }}
        </div>

        <h3 class="font-bold group-hover:text-amber-400">
          {{ $job->title }}
        </h3>

        <p class="font-semibold">
          {{ $job->salary }}
        </p>
      </div>
    </div>


    <div class="flex gap-2">
      @foreach ($job->tags as $tag)
        <x-tag>{{ $tag->name }}</x-tag>
      @endforeach
    </div>

  </div>
</a>