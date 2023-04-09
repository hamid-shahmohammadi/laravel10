function listPost () {
    return {
        search: "",
        posts: [],
        nextPageUrl: null,
        form:{
            title:null,
            body:null
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
        createPost(){
            const self = this;
            console.log(this.form)
            axios.post(routePostsCreate,this.form, {
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + this.$store.post.token
                },
            }).then((res) => {
                if(res){
                    console.log(res)
                    self.posts = res.data.data;
                    self.nextPageUrl = res.data.links.next;
                    self.$refs.closepost.click()
                }

            }).catch((err) => console.log(err));
        }
    }
}




