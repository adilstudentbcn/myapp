<x-layout>
  <h1 class="text-3xl font-bold mb-6">My jobs</h1>

  @if ($jobs->isEmpty())
    <p class="text-gray-400">
      You haven’t posted any jobs yet.
      <a href="{{ route('employer.jobs.create') }}" class="text-amber-400 underline">
        Post your first job
      </a>.
    </p>
  @else
    <div class="space-y-4">
      @foreach ($jobs as $job)
        <article class="rounded-xl bg-white/5 p-4 flex justify-between items-center">
          <div>
            <div class="text-sm text-gray-300">{{ $job->employer->name }}</div>

            <h2 class="font-bold text-lg">{{ $job->title }}</h2>

            <p class="text-sm text-gray-400">
              {{ $job->location }} · {{ $job->salary }} · {{ $job->type }}
            </p>

            <div class="mt-2 flex flex-wrap gap-2">
              @foreach ($job->tags as $tag)
                <x-tag>{{ $tag->name }}</x-tag>
              @endforeach
            </div>

            <p class="mt-2 text-xs text-gray-500">
              Posted {{ $job->created_at->diffForHumans() }}
            </p>
          </div>

          {{-- ACTION BUTTONS --}}
          <div class="flex flex-col items-end gap-2">

            @php
              $btn = 'inline-flex items-center justify-center cursor-pointer 
                                                    min-w-[180px] px-4 py-2 text-sm font-semibold rounded-lg transition';
            @endphp

            {{-- View Public Page --}}
            <a href="{{ route('jobs.show', $job) }}" class="{{ $btn }} bg-amber-500 text-black hover:bg-amber-400">
              View Public Page
            </a>

            {{-- View Applicants --}}
            <a href="{{ route('employer.jobs.applications', $job) }}"
              class="{{ $btn }} bg-blue-600 text-white hover:bg-blue-500">
              View Applicants ({{ $job->applications_count ?? $job->applications->count() }})
            </a>

            {{-- Edit Job --}}
            <a href="{{ route('employer.jobs.edit', $job) }}" class="{{ $btn }} bg-gray-700 text-white hover:bg-gray-600">
              Edit Job
            </a>

            {{-- Delete Job --}}
            <form action="{{ route('employer.jobs.destroy', $job) }}" method="POST"
              onsubmit="return confirm('Are you sure you want to delete this job?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="{{ $btn }} bg-red-600 text-white hover:bg-red-500">
                Delete Job
              </button>
            </form>

          </div>

        </article>
      @endforeach
    </div>
  @endif
</x-layout>