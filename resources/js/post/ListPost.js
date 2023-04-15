function setup() {
    return {
        search: '',
        nextPageUrl: null,
        showCreateForm:false,
        posts: [],
        form:{
            id:null,
            title:null,
            body:null
        },
        init() { // mounted vue
            this.getPost();
        },
        get searchItem() {
            if (this.search === "") {
                return this.posts;
            }
            return this.posts.filter((item) => {
                return item.title.toLowerCase().includes(this.search.toLowerCase())
            })
        },
        getPost() {
            const self = this;
            let url = self.nextPageUrl ?? routePostList;
            axios.get(url,{
                headers: {
                    'Content-Type':'application/json',
                    'Authorization': 'Bearer ' + this.$store.post.token
                  }
            }).then((res) => {
                console.log(res);
                self.posts = self.posts.concat(res.data.data);
                self.nextPageUrl = res.data.links.next;
                console.log(self.posts);
            }).catch((err) => console.log(err))
        },
        createPost(){
            console.log(this.form)
        }
    }
}
