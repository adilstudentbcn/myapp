@props(['job'])

<article class="h-full rounded-xl border border-transparent bg-white/5 p-6
         flex flex-col justify-between transition duration-300
         hover:border-amber-400">

  {{-- Top --}}
  <div class="text-center space-y-6">
    <div class="text-sm font-semibold">
      {{ $job->employer->name }}
    </div>

    <div>
      {{-- title --}}
      <a href="{{ route('jobs.show', $job) }}" class="font-bold hover:text-amber-400">
        {{ $job->title }}
      </a>

      <p class="font-semibold">
        {{ $job->salary }}
      </p>

      {{-- Job Type --}}
      <p class="text-xs text-gray-300 capitalize">
        {{ $job->type }}
      </p>
    </div>
  </div>

  {{-- Bottom --}}
  <div class="mt-6 flex items-center justify-between">
    <div class="flex flex-wrap gap-2">
      @foreach ($job->tags as $tag)
        <x-tag :href="route('jobs.browse', ['tag' => $tag->name])">
          {{ $tag->name }}
        </x-tag>
      @endforeach
    </div>

    {{-- logo --}}
    <x-employer-logo :employer="$job->employer" size="64" />
  </div>

</article>