<div>
    <h2>Posts</h2>
    <div x-data="setup()">
        <template x-for="post in posts">
            <li x-text="`${post.id} ${post.title}`"></li>
        </template>
        <button class="bg-blue-500 text-white py-1 px-2 rounded-md disabled:bg-blue-200" @click="getPost()" :disabled="nextPageUrl===null">more</button>
    </div>

    <script>
        function setup() {
            return {
                posts: [],
                nextPageUrl:null,
                init() { // mounted vue
                    this.getPost();
                },


                getPost() {
                    const self=this;
                    let url = self.nextPageUrl ?? "{{ route('api.posts') }}"
                    axios.get(url, {
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization': 'Bearer ' + localStorage.getItem("token")
                        },
                    }).then((res) => {

                        self.posts=self.posts.concat(res.data.posts.data);
                        self.nextPageUrl=res.data.posts.next_page_url;
                        console.log(self.posts)
                    }).catch((err) => console.log(err));
                }
            }
        }
    </script>
</div>
