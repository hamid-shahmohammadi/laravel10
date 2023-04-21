function setup() {
    return {
        search: '',
        nextPageUrl: null,
        showCreateForm:false,
        posts: [],
        errors:[],
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
            const self = this;

            axios.post(routePostStore,this.form,{
                headers: {
                    'Content-Type':'application/json',
                    'Authorization': 'Bearer ' + this.$store.post.token
                  }
            }).then((res) => {
                console.log(res);
                self.posts = res.data.data;
                self.nextPageUrl = res.data.links.next;
                self.form={id:null,title:null,body:null};
                self.showCreateForm=false;
            }).catch((err) => {
                console.log(err);
                self.errors=err.response.data.errors;
                console.log(self.errors);
            })
        }
    }
}
