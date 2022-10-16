import axios from 'axios';
import {defineStore} from 'pinia';
import {ref} from 'vue';
import { useToastr } from '../pages/toaster';
const toastr = useToastr();
export const UserStore = defineStore({
    id :'UserStoreId',

    state:()=>({
        /* JSON.parse() */
        currentUser: ref(JSON.parse(localStorage.getItem('currentUser'))) || ref([]) ,
        token:  localStorage.getItem('token')|| 0,
        loading: false,
        allUser:[],
         url : 'api/user',

    }),
    getters:{

       /*  getToken:   state=>state.token */
       getToken : function(){
        return this.token;
       },
       getCurrentUser : function(){
        return this.currentUser;
       },
       getAllUser : function(){
        return this.allUser;
       }
    },

    actions:{

        setToken: function(token){
            this.token = token;
            localStorage.setItem('token',token);
        },

        removeToken: function(){
            this.token = 0;
            localStorage.removeItem('token');
        },

        fetchCurrentUser:function(){

            axios.post('/api/auth/user').then(res=>{
                if(res.data.success){


                     this.setCurrentUser(res.data.data)

                }else{
                    console.log(res)
                }

            }).catch((err=>{
                console.log('Error! Can not Fetch Authenticated User'+err)
            }))
        },
        setCurrentUser:function($data){
            localStorage.setItem('currentUser',JSON.stringify($data));
            this.currentUser = $data
        },
        removeUser:function(){
            this.currentUser = []
            localStorage.removeItem('currentUser');
        },
        async fetchAllUser(){
            this.loading = true
           await axios.post('/api/alluser').then(res=>{
                if(res.data.success){

                    this.allUser = res.data.data


                }else{
                    console.log(res)
                }

            }).catch((err=>{
                console.log('Error! Can not Fetch All User'+err)
            })).finally(()=>{
                this.loading = false
            });

        },

        /* updateUser(userId){
            let post = this.allUser.find(post=>post.user_id == userId);

            if(post){
                this.editId = userId;
                this.title = post.title;
                this.description = post.description;

            }else{
                console.log('failed finding post');
            }
            axios.put('/api/posts/'+postId).then(res=>{

            })
        }, */

    deleteUser(userId){
        this.loading = true;
        axios.delete('/api/user/'+userId).then(res=>{
            let index = this.allUser.findIndex(user=>user.user_id == userId);
            this.allUser.splice(index,1);
            toastr.error('success')
            console.log(res.data);
        }).finally(()=>{
            this.loading = false
        })
    },
},

})
