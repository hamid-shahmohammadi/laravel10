<div class="">
    <h2>Posts</h2>
    <input x-model="search" placeholder="Search..." class="dark:bg-gray-600 my-2 px-1 rounded-md">
    <div class="py-2">
        <ul class="max-w-md space-y-1 text-gray-500 list-none list-inside dark:text-gray-400">
            <template x-for="post in searchItem" :key="post.id">
                <li class="flex" x-html="editPost(post)" ></li>
            </template>
        </ul>
        <button class="bg-blue-500 text-white py-1 px-2 rounded-md disabled:bg-blue-200 mt-2" @click="getPost()"
            :disabled="nextPageUrl === null">more</button>
    </div>

    <x-posts.update />

</div>

</div>
