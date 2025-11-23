<x-layout>

  <div class="max-w-3xl mx-auto py-10 space-y-6">


    <a href="/" class="text-sm text-gray-400 hover:text-amber-400">
      ← Back to jobs
    </a>


    <div class="p-6 rounded-xl bg-white/5 space-y-4">


      <div class="text-sm text-gray-300">
        {{ $job->employer->name }}
      </div>


      <h1 class="text-3xl font-bold">
        {{ $job->title }}
      </h1>


      <div class="text-gray-300 space-y-1">
        <p><span class="font-semibold">Salary:</span> {{ $job->salary }}</p>
        <p><span class="font-semibold">Location:</span> {{ $job->location }}</p>
        <p><span class="font-semibold">Type:</span> {{ $job->type }}</p>
      </div>


      <div class="text-gray-200 leading-relaxed">
        {!! nl2br(e($job->description)) !!}
      </div>


      <div class="flex gap-2 mt-4">
        @foreach ($job->tags as $tag)
          <x-tag>{{ $tag->name }}</x-tag>
        @endforeach
      </div>


      <div class="mt-6">
        <a href="#"
          class="inline-block px-6 py-3 bg-amber-500 text-black font-bold rounded-xl hover:bg-amber-400 transition">
          Apply for this job
        </a>
      </div>

    </div>

  </div>

</x-layout>