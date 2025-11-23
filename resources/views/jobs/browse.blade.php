<x-layout>

  <h1 class="text-4xl font-bold mb-10">Available Opportunities</h1>


  <section class="mb-10">
    <div class="mt-6 space-x-2">
      @foreach ($tags as $tag)
        <x-tag :href="route('jobs.browse', ['tag' => $tag->name] + request()->only('q'))"
          :active="request('tag') === $tag->name">
          {{ $tag->name }}
        </x-tag>
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