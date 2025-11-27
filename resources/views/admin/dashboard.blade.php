<x-layout>
  <div class="space-y-10">

    {{-- Header --}}
    <header class="space-y-4">
      <div>
        <h1 class="text-3xl font-bold">Admin Dashboard</h1>
        <p class="text-sm text-gray-400">
          Welcome, {{ $user->name }} ({{ $user->email }})
        </p>
      </div>

      {{-- Quick admin actions --}}
      <div class="flex flex-wrap gap-3">
        <a href="{{ route('admin.users.index') }}"
          class="inline-flex items-center px-4 py-2 rounded-lg bg-amber-500 text-black text-sm font-semibold hover:bg-amber-400 transition">
          Manage users
        </a>

        {{-- This route will be created in the next step --}}
        <a href="{{ route('admin.jobs.index') }}"
          class="inline-flex items-center px-4 py-2 rounded-lg bg-amber-500 text-black text-sm font-semibold hover:bg-amber-400 transition">
          Manage jobs
        </a>
        <a href="{{ route('admin.tags.index') }}"
          class="px-5 py-2 rounded-lg bg-amber-500 text-black font-semibold hover:bg-amber-400 transition">
          Manage tags
        </a>
      </div>
    </header>

    {{-- Top stats --}}
    <section class="grid gap-4 md:grid-cols-3">
      {{-- Users --}}
      <div class="rounded-xl bg-white/5 border border-white/10 p-4 space-y-1">
        <h2 class="text-sm font-semibold text-gray-300">Users</h2>
        <p class="text-2xl font-bold">{{ $totalUsers }}</p>
        <p class="text-xs text-gray-400">
          Applicants: {{ $totalApplicants }} · Employers: {{ $totalEmployers }} · Admins: {{ $totalAdmins }}
        </p>
      </div>

      {{-- Jobs --}}
      <div class="rounded-xl bg-white/5 border border-white/10 p-4 space-y-1">
        <h2 class="text-sm font-semibold text-gray-300">Jobs</h2>
        <p class="text-2xl font-bold">{{ $totalJobs }}</p>
        <p class="text-xs text-gray-400">
          Featured jobs: {{ $featuredJobs }}
        </p>
      </div>

      {{-- Applications --}}
      <div class="rounded-xl bg-white/5 border border-white/10 p-4 space-y-1">
        <h2 class="text-sm font-semibold text-gray-300">Applications</h2>
        <p class="text-2xl font-bold">{{ $totalApplications }}</p>
        <p class="text-xs text-gray-400">
          Recent activity from candidates.
        </p>
      </div>
    </section>

    {{-- Two-column layout: recent employers + jobs / recent applications --}}
    <section class="grid gap-6 lg:grid-cols-2">

      {{-- Left column --}}
      <div class="space-y-6">

        {{-- Recent employers --}}
        <div class="rounded-xl bg-white/5 border border-white/10 p-4">
          <h2 class="text-lg font-semibold mb-3">Recent employers</h2>

          @forelse ($recentEmployers as $employerUser)
            <div class="text-sm text-gray-2 00 flex justify-between py-1 border-b border-white/5 last:border-0">
              <div>
                <p class="font-semibold">{{ $employerUser->name }}</p>
                <p class="text-xs text-gray-400">{{ $employerUser->email }}</p>
              </div>
              <span class="text-xs text-gray-500">
                {{ $employerUser->created_at->diffForHumans() }}
              </span>
            </div>
          @empty
            <p class="text-sm text-gray-400">No employers yet.</p>
          @endforelse
        </div>

        {{-- Recent jobs --}}
        <div class="rounded-xl bg-white/5 border border-white/10 p-4">
          <h2 class="text-lg font-semibold mb-3">Recent jobs</h2>

          @forelse ($recentJobs as $job)
            <div class="text-sm text-gray-200 flex justify-between py-1 border-b border-white/5 last:border-0">
              <div>
                <p class="font-semibold">{{ $job->title }}</p>
                <p class="text-xs text-gray-400">
                  {{ $job->employer->name ?? 'Unknown employer' }} ·
                  {{ $job->location }} · {{ $job->salary }}
                </p>
              </div>
              <span class="text-xs text-gray-500">
                {{ $job->created_at->diffForHumans() }}
              </span>
            </div>
          @empty
            <p class="text-sm text-gray-400">No jobs posted yet.</p>
          @endforelse
        </div>
      </div>

      {{-- Right column: recent applications --}}
      <div class="rounded-xl bg-white/5 border border-white/10 p-4">
        <h2 class="text-lg font-semibold mb-3">Recent applications</h2>

        @forelse ($recentApplications as $application)
          <div class="text-sm text-gray-200 flex justify-between py-2 border-b border-white/5 last:border-0">
            <div>
              <p class="font-semibold">
                {{ $application->user->name ?? 'Unknown candidate' }}
              </p>
              <p class="text-xs text-gray-400">
                applied to
                “{{ $application->job->title ?? 'Unknown job' }}”
                @if($application->job && $application->job->employer)
                  at {{ $application->job->employer->name }}
                @endif
              </p>
            </div>
            <span class="text-xs text-gray-500">
              {{ $application->created_at->diffForHumans() }}
            </span>
          </div>
        @empty
          <p class="text-sm text-gray-400">No applications yet.</p>
        @endforelse
      </div>
    </section>

  </div>
</x-layout>