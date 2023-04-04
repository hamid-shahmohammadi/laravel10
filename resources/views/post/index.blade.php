<x-app-layout>
    <x-slot name="header" class="flex">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-posts.create  />
                    <hr class="my-4"/>
                    <x-posts.list  />

                </div>
            </div>
        </div>
    </div>
    <script>
        localStorage.setItem("token", "{{ $token }}");
    </script>
</x-app-layout>
