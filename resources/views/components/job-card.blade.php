@props(['job'])

<div class="w-full border border-transparent rounded-xl hover:border-amber-400 transition-colors duration-300 group">

  <div class="p-4 bg-white/5 rounded-xl flex flex-col justify-between text-center w-full">
    <div class="text-sm font-semibold">
      {{ $job->employer->name }}
    </div>

    <div class="py-8">
      <h3 class="font-bold group-hover:text-amber-400">
        {{ $job->title }}
      </h3>

      <p class="font-semibold">
        {{ $job->salary }}
      </p>
    </div>
  </div>

  <div class="flex justify-between items-center mt-4">

    <div class="flex gap-2">
      @foreach ($job->tags as $tag)
        <x-tag>{{ $tag->name }}</x-tag>
      @endforeach
    </div>

    <x-employer-logo />

  </div>

</div>