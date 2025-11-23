@props(['job'])

<a href="{{ route('jobs.show', $job) }}" class="block w-full">

  <article class="w-full rounded-xl border border-transparent bg-white/5 p-6
               flex items-center justify-between transition duration-300
               group hover:border-amber-400">

    {{-- Left --}}
    <div class="flex items-start gap-4">

      <x-employer-logo />

      <div>
        <div class="text-sm font-semibold">
          {{ $job->employer->name }}
        </div>

        <h3 class="font-bold group-hover:text-amber-400">
          {{ $job->title }}
        </h3>

        <p class="font-semibold">{{ $job->salary }}</p>
      </div>
    </div>

    {{-- Right: Tags --}}
    <div class="flex gap-2 flex-wrap">
      @foreach ($job->tags as $tag)
        <x-tag :href="route('jobs.browse', ['tag' => $tag->name])">
          {{ $tag->name }}
        </x-tag>
      @endforeach
    </div>


  </article>

</a>