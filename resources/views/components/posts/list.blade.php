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

listPost = () => {
    return {
        search: "",
        posts: [],
        nextPageUrl: null,
        init() { // mounted vue
            this.getPost();
        },
        get searchItem() {
            if (this.search === "") {
                return this.posts;
            }
            return this.posts.filter((item) => {
                console.log(item)
                return item.title
                    .toLowerCase()
                    .includes(this.search.toLowerCase());
            });
        },
        getPost() {
            const self = this;
            let url = self.nextPageUrl ?? "{{ route('api.posts') }}"
            axios.get(url, {
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + this.$store.post.token
                },
            }).then((res) => {
                console.log(res)
                self.posts = self.posts.concat(res.data.data);
                self.nextPageUrl = res.data.links.next;
                console.log(self.posts)
            }).catch((err) => console.log(err));
        }
    }
}

</script>
