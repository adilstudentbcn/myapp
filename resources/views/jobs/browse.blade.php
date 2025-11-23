<x-layout>

  <h1 class="text-4xl font-bold mb-10">Browse All Jobs</h1>


  <section class="mb-10">
    <div class="flex flex-wrap gap-2">
      @foreach ($tags as $tag)
        <x-tag>{{ $tag->name }}</x-tag>
      @endforeach
    </div>
  </section>


  <div class="space-y-6">
    @foreach ($jobs as $job)
      <x-job-card-wide :job="$job" />
    @endforeach
  </div>


  <div class="mt-10">
    {{ $jobs->links() }}
  </div>

</x-layout>