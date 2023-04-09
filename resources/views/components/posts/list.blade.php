<div x-data="listPost()">
    <h2>Posts</h2>
    <input x-model="search" placeholder="Search..." class="dark:bg-gray-600 my-2 px-1 rounded-md">
    <div class="py-2">
        <template x-for="post in searchItem" :key="post.id">
            <li x-text="`${post.id} ${post.title}`"></li>
        </template>
        <button class="bg-blue-500 text-white py-1 px-2 rounded-md disabled:bg-blue-200 mt-2" @click="getPost()"
            :disabled="nextPageUrl === null">more</button>
    </div>
</div>
<script>
    const routePosts="{{ route('api.posts') }}";
</script>
<script src="{{ Vite::asset('resources/js/post/ListPost.js') }}"></script>





