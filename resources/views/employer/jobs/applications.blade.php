<x-layout>

  <div class="max-w-4xl mx-auto space-y-8">


    <div>
      <h1 class="text-3xl font-bold">
        Applicants for: {{ $job->title }}
      </h1>

      <p class="text-sm text-gray-400 mt-1">
        {{ $job->employer->name }} — {{ $job->location }} · {{ $job->salary }} · {{ $job->type }}
      </p>

      <a href="{{ route('jobs.show', $job) }}" class="text-amber-400 underline text-sm">
        View public job page →
      </a>
    </div>

    {{-- If no applications --}}
    @if ($applications->isEmpty())
      <div class="p-6 bg-white/5 rounded-xl text-gray-400 text-center">
        No one has applied to this job yet.
      </div>
    @else

      {{-- Applications list --}}
      <div class="space-y-4">
        @foreach ($applications as $application)
          <article class="bg-white/5 rounded-xl p-5 flex justify-between items-start gap-6">


            <div class="flex-1">


              <h3 class="font-semibold text-lg">
                {{ $application->user->name }}
              </h3>


              <p class="text-xs text-gray-500">
                Applied {{ $application->created_at->diffForHumans() }}
              </p>


              <div class="mt-3 text-gray-300 text-sm leading-relaxed whitespace-pre-line">
                {{ $application->message }}
              </div>


              @if ($application->cv_path || $application->cv_url)
                <div class="mt-3 text-sm">
                  <span class="text-gray-400">CV / Portfolio:</span>

                  <div class="mt-1 space-x-3">
                    @if ($application->cv_path)
                      <a href="{{ asset('storage/' . $application->cv_path) }}" target="_blank"
                        class="text-amber-400 underline">
                        Download CV file
                      </a>
                    @endif

                    @if ($application->cv_url)
                      <a href="{{ $application->cv_url }}" target="_blank" class="text-amber-400 underline">
                        Open CV link
                      </a>
                    @endif
                  </div>
                </div>
              @endif
            </div>

            }}
            <div class="w-14 h-14 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 text-xs">
              {{ strtoupper(substr($application->user->name, 0, 1)) }}
            </div>

          </article>
        @endforeach
      </div>

    @endif

  </div>

</x-layout>