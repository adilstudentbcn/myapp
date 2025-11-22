@props(['job'])

<div
  class="border border-transparent rounded-xl hover:border-amber-400 hover:shadow-[0_0_12px_rgba(255,200,0,0.4)] transition-all duration-300 group">

  <div class="p-4 bg-white/5 rounded-xl flex gap-x-6 items-center">

    <div>
      <x-employer-logo />
    </div>

    <div class="flex-1 flex flex-col">
      <a href="#" class="text-sm font-semibold">
        {{ $job->employer->name }}
      </a>

      <h3 class="font-bold text-xl mt-3 group-hover:text-amber-400">
        {{ $job->title }}
      </h3>

      <p class="font-semibold text-sm text-gray-400 mt-auto">
        {{ $job->salary }}
      </p>
    </div>

    <div>
      @foreach ($job->tags as $tag)
        <x-tag>{{ $tag->name }}</x-tag>
      @endforeach
    </div>

  </div>
</div>