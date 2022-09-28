import axios from 'axios';
import {defineStore} from 'pinia'
export const PostStore = defineStore({
    id:'PostStoreId',
    state:()=>({
        posts : [],
        title : null,
        description : null,
        editId : null,
        image : null,
        loading : false,
        url : '/api/posts/'
    }),
    getters:{

    },
    actions:{
       async fetchPosts(){
            this.posts = [];
            this.loading = true;
            try{
                let posts = await axios.get('api/posts');
                this.posts = posts.data;
            }catch( error){
                console.log(error)
            }finally{
                this.loading = false
            }
        },
        addItem(){
            if(this.title != null && this.description != null){

                let form_data = new FormData();

                form_data.append('title',this.title)
                form_data.append('description',this.description)
                form_data.append('image',this.image)

                let config = {
                    header : {
                        'Content-Type' : 'image/png'
                    }
                }

                if(this.editId){
                    form_data.append('_method','put')

                axios.post(this.url+this.editId,form_data,config).then(res=>{

                })
                }else{


                axios.post(this.url,form_data,config).then(res=>{

                })

            }
            this.formReset()
            this.fetchPosts()
        }
        },
        editItem(postId){
            let post = this.posts.find(post=>post.id == postId);

            if(post){
                this.editId = postId;
                this.title = post.title;
                this.description = post.description;

            }else{
                console.log('failed finding post');
            }
           /*  axios.put('/api/posts/'+postId).then(res=>{

            }) */
        },
        setItem(){

        }
        ,
        deleteItem(postId){
            axios.delete(this.url+postId).then(res=>{
                let index = this.posts.findIndex(post=>post.id == postId);
                this.posts.splice(index,1);
                console.log(res.data);
            })
        },
        formReset(){
            this.editId = null;
            this.title = null;
            this.description = null;
        },

        imageUpload(event){
            this.image = event.target.files[0];

        }
    }


})
