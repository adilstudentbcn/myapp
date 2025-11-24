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
              {{ $job->location }} · {{ $job->salary }}
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

          <div class="flex flex-col items-end gap-2">
            <a href="{{ route('jobs.show', $job) }}" class="text-sm text-amber-400 underline">
              View public page
            </a>

            {{-- Edit button --}}
            <a href="{{ route('employer.jobs.edit', $job) }}" class="text-sm text-blue-400 underline">
              Edit job
            </a>

            {{-- Delete button --}}
            <form action="{{ route('employer.jobs.destroy', $job) }}" method="POST"
              onsubmit="return confirm('Are you sure you want to delete this job?');">
              @csrf
              @method('DELETE')
              <button class="text-sm text-red-400 underline">
                Delete job
              </button>
            </form>


          </div>
        </article>
      @endforeach
    </div>
  @endif
</x-layout>