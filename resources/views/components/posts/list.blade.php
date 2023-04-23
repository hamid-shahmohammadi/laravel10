<div >
    <h2>Posts</h2>
    <input x-model="search" placeholder="Search..." class="my-4 p-2" />
    <div>
        <template x-for="post in searchItem" :key="post.id">
            <li class="my-2" x-html="editPost(post)"></li>
        </template>
    </div>
    <button class="mt-2 bg-blue-500 text-white py-1 px-2 rounded-md disabled:bg-blue-200" @click="getPost()"
        :disabled="nextPageUrl === null">read more</button>
</div>

