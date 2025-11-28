@props(['job'])

<a href="{{ route('jobs.show', $job) }}" class="block w-full">

  <article class="w-full rounded-xl border border-transparent bg-white/5 p-6
           flex items-start justify-between gap-6
           transition duration-300 group hover:border-amber-400">

    {{-- Left: logo + basic info --}}
    <div class="flex items-start gap-4">

      {{-- Logo with custom size --}}
      <x-employer-logo :employer="$job->employer" size="48" />

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

        {{-- Job Type --}}
        <p class="text-xs text-gray-300 capitalize">
          {{ $job->type }}
        </p>
      </div>
    </div>

    {{-- Right: Tags (always aligned to the right edge) --}}
    <div class="flex flex-wrap gap-2 justify-end shrink-0">
      @foreach ($job->tags as $tag)
        <x-tag :href="route('jobs.browse', ['tag' => $tag->name])">
          {{ $tag->name }}
        </x-tag>
      @endforeach
    </div>

  </article>

</a>