<x-layout>
   <div class="max-w-5xl mx-auto space-y-10">

      {{-- Hero + search --}}
      <section class="text-center pt-6">
         <h1 class="font-bold text-5xl">Smart Job Matches</h1>

         <form action="{{ route('jobs.browse') }}" method="GET" class="mt-6">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search jobs..." class="w-full p-4 rounded-lg bg-gray-800 border border-transparent
                           focus:border-amber-400 outline-none max-w-xl">
         </form>
      </section>

      {{-- Featured Jobs --}}
      <section class="mb-20">
         <x-section-heading>Featured Jobs</x-section-heading>

         <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach ($featuredJobs as $job)
               <x-job-card :job="$job" />
            @endforeach
         </div>
      </section>

      {{-- Tags --}}
      <section class="mb-20">
         <x-section-heading>Tags</x-section-heading>

         <div class="mt-6 space-x-1">
            @foreach ($tags as $tag)
               <x-tag :href="route('jobs.browse', ['tag' => $tag->name])">
                  {{ $tag->name }}
               </x-tag>
            @endforeach
         </div>
      </section>

      {{-- Recent Jobs --}}
      <section class="mb-20">
         <x-section-heading>Recent Jobs</x-section-heading>

         <div class="mt-6 space-y-6">
            @foreach ($recentJobs as $job)
               <x-job-card-wide :job="$job" />
            @endforeach
         </div>
      </section>

   </div>
</x-layout>