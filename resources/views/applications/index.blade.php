<x-layout>
  <h1 class="text-3xl font-bold mb-6">My applications</h1>

  @if ($applications->isEmpty())
    <p class="text-gray-400">
      You haven’t applied to any jobs yet.
    </p>
  @else
    <div class="space-y-4">
      @foreach ($applications as $application)
        @php
          $job = $application->job;
        @endphp

        <article class="rounded-xl bg-white/5 p-4 flex justify-between items-center">
          <div>
            <div class="text-sm text-gray-300">
              {{ optional($job->employer)->name }}
            </div>

            <h2 class="font-bold text-lg">
              <a href="{{ route('jobs.show', $job) }}" class="hover:text-amber-400">
                {{ $job->title }}
              </a>
            </h2>

            <p class="text-sm text-gray-400">
              {{ $job->location }} · {{ $job->salary }}
            </p>

            <p class="mt-2 text-xs text-gray-500">
              Applied {{ $application->created_at->diffForHumans() }}
            </p>

            @if ($application->message)
              <p class="mt-2 text-sm text-gray-200">
                <span class="font-semibold">Your message:</span>
                {{ \Illuminate\Support\Str::limit($application->message, 140) }}
              </p>
            @endif

            @if ($application->cv_path || $application->cv_url)
              <p class="mt-2 text-sm">
                <span class="font-semibold text-gray-300">CV:</span>

                @if ($application->cv_path)
                  <a href="{{ asset('storage/' . $application->cv_path) }}" target="_blank"
                    class="text-amber-400 underline ml-1">
                    Download file
                  </a>
                @endif

                @if ($application->cv_url)
                  <a href="{{ $application->cv_url }}" target="_blank" class="text-amber-400 underline ml-3">
                    Open link
                  </a>
                @endif
              </p>
            @endif
          </div>
        </article>
      @endforeach
    </div>
  @endif
</x-layout>