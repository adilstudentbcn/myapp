<x-layout>
  <section class="max-w-5xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
      <h1 class="text-3xl font-bold">Jobs</h1>

      @if (session('status'))
        <p class="text-sm text-green-400">
          {{ session('status') }}
        </p>
      @endif
    </div>

    <div class="rounded-xl bg-white/5 border border-white/10 overflow-hidden">
      <table class="w-full text-sm">
        <thead class="bg-white/5 text-gray-300 text-left">
          <tr>
            <th class="px-4 py-3">Title</th>
            <th class="px-4 py-3">Employer</th>
            <th class="px-4 py-3">Location</th>
            <th class="px-4 py-3">Salary</th>
            <th class="px-4 py-3">Type</th>
            <th class="px-4 py-3">Posted</th>
            <th class="px-4 py-3 text-right">Actions</th>
          </tr>
        </thead>

        <tbody class="divide-y divide-white/5">
          @forelse ($jobs as $job)
            <tr>
              <td class="px-4 py-3">
                <a href="{{ route('jobs.show', $job) }}" class="font-semibold hover:text-amber-400">
                  {{ $job->title }}
                </a>
              </td>

              <td class="px-4 py-3 text-gray-300">
                {{ $job->employer->name ?? '—' }}
              </td>

              <td class="px-4 py-3 text-gray-300">
                {{ $job->location }}
              </td>

              <td class="px-4 py-3 text-gray-300">
                {{ $job->salary }}
              </td>

              <td class="px-4 py-3 text-gray-300">
                {{ $job->type }}
              </td>

              <td class="px-4 py-3 text-gray-400">
                {{ $job->created_at?->diffForHumans() }}
              </td>

              <td class="px-4 py-3 text-right space-x-2">
                {{-- View public job page --}}
                <a href="{{ route('jobs.show', $job) }}"
                  class="inline-flex items-center px-3 py-1.5 rounded-lg bg-amber-500 text-black text-xs font-semibold hover:bg-amber-400">
                  View
                </a>

                {{-- Delete job --}}
                <form action="{{ route('admin.jobs.destroy', $job) }}" method="POST" class="inline"
                  onsubmit="return confirm('Delete this job posting? This cannot be undone.');">
                  @csrf
                  @method('DELETE')
                  <button type="submit"
                    class="inline-flex items-center px-3 py-1.5 rounded-lg bg-red-600 text-white text-xs font-semibold hover:bg-red-500">
                    Delete
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="px-4 py-4 text-center text-gray-400">
                No jobs found.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </section>
</x-layout>