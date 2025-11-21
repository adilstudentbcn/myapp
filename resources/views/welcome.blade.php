<x-layout>
   <div class="space-y-10">

      <section class="text-center pt-6">
         <h1 class="font-bold text-5xl">Smart Job Matches</h1>



         <form action="" class="mt-6">
            <input type="text" placeholder="Search jobs..."
               class="w-full p-4 rounded-lg bg-gray-800 border border-transparent focus:border-amber-400 outline-none max-w-xl">
         </form>

      </section>

      <section class="mb-20">
         <x-section-heading>Featured Jobs</x-section-heading>

         <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-6">
            <x-job-card />
            <x-job-card />
            <x-job-card />
         </div>
      </section>

      <section class="mb-20">
         <x-section-heading>Tags</x-section-heading>
         <div class="mt-6 space-x-1">
            <x-tag>Tag</x-tag>
            <x-tag>Tag</x-tag>
            <x-tag>Tag</x-tag>
            <x-tag>Tag</x-tag>
            <x-tag>Tag</x-tag>
            <x-tag>Tag</x-tag>
            <x-tag>Tag</x-tag>
            <x-tag>Tag</x-tag>
            <x-tag>Tag</x-tag>
            <x-tag>Tag</x-tag>
         </div>
      </section>

      <section class="mb-20">
         <x-section-heading>Recent Jobs</x-section-heading>

         <div class="mt-6 space-y-6">
            <x-job-card-wide />
            <x-job-card-wide />
            <x-job-card-wide />
         </div>
      </section>
   </div>
</x-layout>