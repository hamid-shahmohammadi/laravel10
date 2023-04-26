function setup() {
    return {
        search: '',
        nextPageUrl: null,
        showCreateForm:false,
        showEditForm:false,
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
        },
        editPost(post){
            return `${post.id} ${post.title}
            <button @click="editModalPost(post)" class="text-sm rounded-md text-white bg-blue-500 p-2">EDIT</button>
            <button @click="deletePost(post)" class="text-sm rounded-md text-white bg-red-500 p-2">Delete</button>

            `;
        },
        editModalPost(post){
            console.log(post)
            this.form.id=post.id
            this.form.title=post.title
            this.form.body=post.body
            this.showEditForm=true;
        },
        updatePost(){
            const self = this;

            axios.put(routePostUpdate,this.form,{
                headers: {
                    'Content-Type':'application/json',
                    'Authorization': 'Bearer ' + this.$store.post.token
                  }
            }).then((res) => {
                console.log(res);
                self.posts = res.data.data;
                self.nextPageUrl = res.data.links.next;
                self.form={id:null,title:null,body:null};
                self.showEditForm=false;
            }).catch((err) => {
                console.log(err);
                self.errors=err.response.data.errors;
                console.log(self.errors);
            })
        },
        deletePost(post){
            const self = this;

            axios.delete('posts/delete/'+post.id,{
                headers: {
                    'Content-Type':'application/json',
                    'Authorization': 'Bearer ' + this.$store.post.token
                  }
            }).then((res) => {
                console.log(res);
                self.posts = res.data.data;
                self.nextPageUrl = res.data.links.next;
                self.form={id:null,title:null,body:null};
                self.showEditForm=false;
            }).catch((err) => {
                console.log(err);
                self.errors=err.response.data.errors;
                console.log(self.errors);
            })
        }

    }
}
