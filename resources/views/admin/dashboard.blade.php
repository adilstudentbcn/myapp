<x-layout>
  <h1 class="text-3xl font-bold mb-6">Admin dashboard</h1>

  <p class="text-gray-300 mb-6">
    Welcome, {{ $user->name }} ({{ $user->email }})
  </p>

  <div class="space-y-3 text-sm">
    <p class="text-gray-400">Manage you business:</p>

    <ul class="list-disc list-inside space-y-1 text-gray-300">
      <li>Total users, employers, applicants</li>
      <li>Total jobs posted</li>
      <li>Recent applications</li>
    </ul>

  </div>
</x-layout>`