<x-layout>

  <div class="max-w-3xl mx-auto py-10 space-y-6">

    {{-- Back link --}}
    <a href="{{ route('jobs.browse') }}" class="text-sm hover:underline text-gray-300">
      ← All Jobs
    </a>

    <div class="p-6 rounded-xl bg-white/5 space-y-4">

      {{-- Company --}}
      <div class="text-sm text-gray-300">
        {{ $job->employer->name }}
      </div>

      {{-- Title --}}
      <h1 class="text-3xl font-bold">
        {{ $job->title }}
      </h1>

      {{-- Meta --}}
      <div class="text-gray-300 space-y-1">
        <p><span class="font-semibold">Salary:</span> {{ $job->salary }}</p>
        <p><span class="font-semibold">Location:</span> {{ $job->location }}</p>
        <p><span class="font-semibold">Type:</span> {{ $job->type }}</p>
      </div>

      {{-- Description --}}
      <div class="text-gray-200 leading-relaxed">
        {!! nl2br(e($job->description)) !!}
      </div>

      {{-- Tags --}}
      <div class="flex gap-2 mt-4">
        @foreach ($job->tags as $tag)
          <x-tag>{{ $tag->name }}</x-tag>
        @endforeach
      </div>

      @php
        $isOwner = auth()->check()
          && auth()->user()->employer
          && auth()->user()->employer->id === $job->employer_id;

        $currentUser = auth()->user();

        // Has this applicant already applied to this job?
        $hasApplied = false;

        if ($currentUser && $currentUser->role === 'applicant') {
          $hasApplied = \App\Models\JobApplication::where('job_id', $job->id)
            ->where('user_id', $currentUser->id)
            ->exists();
        }
      @endphp

      {{-- Flash message for applications --}}
      @if (session('status'))
        <p class="mt-4 text-sm text-emerald-400">
          {{ session('status') }}
        </p>
      @endif

      {{-- Only non-owners can apply --}}
      @if (!$isOwner)

        @auth
          @if ($currentUser->role === 'applicant')

            @if ($hasApplied)
              {{-- Applicant already applied: no form, just info --}}
              <p class="mt-6 text-sm text-emerald-400">
                You already applied to this job.
                <a href="{{ route('applications.index') }}" class="underline text-amber-400">
                  View your applications
                </a>.
              </p>
            @else
              {{-- External company apply link (if provided) --}}
              @if ($job->apply_url)
                <a href="{{ $job->apply_url }}" target="_blank" rel="noopener noreferrer"
                  class="inline-block mt-6 px-6 py-3 bg-amber-500 text-black font-semibold rounded-lg">
                  Apply on company site
                </a>
              @endif

              {{-- Internal Rocket application form --}}
              <section class="mt-8 pt-6 border-t border-white/10 space-y-4">
                <h2 class="text-xl font-semibold">Apply through Rocket</h2>
                <p class="text-sm text-gray-400">
                  We’ll send your application to {{ $job->employer->name }}.
                </p>

                {{-- Validation errors --}}
                @if ($errors->any())
                  <div class="text-sm text-red-400">
                    <ul class="list-disc list-inside space-y-1">
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif

                <form method="POST" action="{{ route('jobs.apply', $job) }}" class="space-y-4">
                  @csrf

                  {{-- Message --}}
                  <div>
                    <label class="block text-sm font-semibold mb-1" for="message">
                      Message to employer
                    </label>
                    <textarea id="message" name="message" rows="5"
                      class="w-full rounded-lg bg-black border border-white/10 px-3 py-2 text-sm focus:outline-none focus:border-amber-400"
                      placeholder="Introduce yourself and explain why you’re a good fit…">{{ old('message') }}</textarea>
                  </div>

                  {{-- Optional CV / portfolio link --}}
                  <div>
                    <label class="block text-sm font-semibold mb-1" for="cv_url">
                      CV / portfolio link (optional)
                    </label>
                    <input id="cv_url" name="cv_url" type="url" value="{{ old('cv_url') }}"
                      class="w-full rounded-lg bg-black border border-white/10 px-3 py-2 text-sm focus:outline-none focus:border-amber-400"
                      placeholder="https://…">
                  </div>

                  <button type="submit" class="px-6 py-3 bg-amber-500 text-black font-semibold rounded-lg">
                    Send application
                  </button>
                </form>
              </section>
            @endif

          @else
            {{-- Employers & admins --}}
            <p class="mt-6 text-sm text-gray-400">
              Employers and admins cannot apply using this account.
              <span class="text-amber-400">
                Please create a separate applicant account if you want to apply for jobs.
              </span>
            </p>
          @endif

        @else
          {{-- Guest: ask to log in --}}
          <p class="mt-6 text-sm text-gray-400">
            <a href="{{ route('login') }}" class="text-amber-400 underline">
              Log in
            </a>
            to apply for this job through Rocket.
          </p>

          {{-- Optional: guests can still see external company site link --}}
          @if ($job->apply_url)
            <a href="{{ $job->apply_url }}" target="_blank" rel="noopener noreferrer"
              class="inline-block mt-4 px-6 py-3 bg-amber-500 text-black font-semibold rounded-lg">
              Apply on company site
            </a>
          @endif
        @endauth

      @endif

    </div>

  </div>

</x-layout>