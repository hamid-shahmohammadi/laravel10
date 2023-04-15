function listPost() {
    return {
        search: "",
        posts: [],
        nextPageUrl: null,
        showEditForm: false,
        form: {
            id: null,
            title: null,
            body: null
        },
        init() {
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
        editPost(post) {
            return `
            ${post.id} ${post.title} ${post.created_at}
            <svg @click="editFormPost(post)" class="cursor-pointer ml-2 w-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path>
            </svg>
          `;
        },
        editFormPost(post){
            console.log(post)
            this.form.id = post.id;
            this.form.title = post.title;
            this.form.body = post.body;
            this.showEditForm = ! this.showEditForm
        },
        getPost() {
            const self = this;
            let url = self.nextPageUrl ?? routePosts
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
        },
        createPost() {
            const self = this;
            console.log(this.form)
            axios.post(routePostsCreate, this.form, {
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + this.$store.post.token
                },
            }).then((res) => {
                if (res) {
                    console.log(res)
                    self.posts = res.data.data;
                    self.nextPageUrl = res.data.links.next;
                    self.$refs.closepost.click()
                    self.form = { title: null, body: null }
                }

            }).catch((err) => console.log(err));
        },
        updatePost() {
            console.log(this.form)
            self=this;
            axios.put(routePostsUpdate, this.form, {
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + this.$store.post.token
                },
            }).then((res) => {
                if (res) {
                    console.log(res)
                    self.posts = res.data.data;
                    self.nextPageUrl = res.data.links.next;
                    self.showEditForm=false;
                    self.form = { title: null, body: null }
                }
            }).catch((err) => console.log(err));
        }
    }
}




