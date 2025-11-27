<x-layout>
  <section class="max-w-5xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
      <h1 class="text-3xl font-bold">Users</h1>

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
            <th class="px-4 py-3">Name</th>
            <th class="px-4 py-3">Email</th>
            <th class="px-4 py-3">Role</th>
            <th class="px-4 py-3">Joined</th>
            <th class="px-4 py-3 text-right">Actions</th>
          </tr>
        </thead>

        <tbody class="divide-y divide-white/5">
          @forelse ($users as $user)
            <tr>
              <td class="px-4 py-3">
                {{ $user->name }}
              </td>
              <td class="px-4 py-3 text-gray-300">
                {{ $user->email }}
              </td>
              <td class="px-4 py-3 capitalize">
                {{ $user->role ?? 'applicant' }}
              </td>
              <td class="px-4 py-3 text-gray-400">
                {{ $user->created_at?->diffForHumans() }}
              </td>
              <td class="px-4 py-3 text-right">
                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline"
                  onsubmit="return confirm('Delete this user? This cannot be undone.');">
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
              <td class="px-4 py-4 text-center text-gray-400" colspan="5">
                No users found.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </section>
</x-layout>