<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="listPostFN">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100" >
                    <x-posts.create />
                    <x-posts.list />
                    <x-posts.edit />
                </div>
            </div>
        </div>
    </div>

    <script>
        let routePostList="{{ route('api.posts') }}";
        let routePostStore="{{ route('api.posts.store') }}";
        let routePostUpdate="{{ route('api.posts.update') }}";

        document.addEventListener('alpine:init', () => {
        Alpine.store('post', {
            token: "{{ $token }}",
        })
    })
    </script>

    {{-- <script src="{{ Vite::asset('resources/js/post/ListPost.js') }}"></script> --}}
    <script src="{{ asset('asset/js/post/list.js') }}"></script>


</x-app-layout>
