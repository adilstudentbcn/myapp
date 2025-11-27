<x-layout>

  <h1 class="text-4xl font-bold mb-2">Manage Tags</h1>


  {{-- Create new tag --}}
  <section class="p-6 rounded-xl bg-white/5 max-w-3xl mx-auto mb-12">
    <h2 class="font-semibold text-lg mb-3">Add a new tag</h2>

    <form action="{{ route('admin.tags.store') }}" method="POST" class="space-y-4">
      @csrf

      <input type="text" name="name" placeholder="e.g. Remote, Internship, Senior"
        class="w-full p-3 rounded-lg bg-black border border-white/10 focus:border-amber-400 outline-none">

      <button type="submit"
        class="w-full py-3 bg-amber-500 text-black font-semibold rounded-lg hover:bg-amber-400 transition cursor-pointer">
        Create tag
      </button>
    </form>
  </section>


  {{-- Existing tags --}}
  <section class="p-6 rounded-xl bg-white/5 max-w-3xl mx-auto">
    <h2 class="font-semibold text-lg mb-6">Existing tags</h2>

    <div class="divide-y divide-white/10">
      @foreach ($tags as $tag)
        <div class="flex justify-between items-center py-3 px-1 hover:bg-white/5 transition rounded cursor-pointer">

          {{-- Tag name --}}
          <span class="text-gray-200 text-sm">{{ $tag->name }}</span>

          {{-- Delete --}}
          <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST">
            @csrf
            @method('DELETE')

            <button type="submit" class="text-red-400 text-sm hover:text-red-300 transition cursor-pointer">
              Delete
            </button>
          </form>

        </div>
      @endforeach
    </div>
  </section>

</x-layout>