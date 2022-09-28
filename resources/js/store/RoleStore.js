import axios from 'axios';
import {defineStore} from 'pinia';
import {ref} from 'vue';
import { useToastr } from '../pages/toaster';
const toastr = useToastr();
export const RoleStore = defineStore({
    id :'RoleStoreId',

    state:()=>({
        /* JSON.parse() */

        loading: false,
        roles:ref([]),
         url : '/api/roles',

    }),
    getters:{


       getRoles : function(){
        return this.roles;
       }
    },

    actions:{




        async fetchRoles(){
            this.loading = true
           await axios.get(this.url).then(res=>{
                if(res.data.success){

                    this.roles = res.data.data


                }else{
                    console.log(res)
                }

            }).catch((err=>{
                console.log('Error! Can not Fetch All User'+err)
            })).finally(()=>{
                this.loading = false
            });

        },

        createRole($data){
            this.loading = true
            axios.post(this.url,$data).then(res=>{
                console.log(res)
            }) .finally(()=>{
                $('#exampleModalCenter').modal('hide');
                this.loading = false
                this.fetchRoles()
            })
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

    deleteRole(roleId){
        this.loading = true;
        console.log(roleId);
        axios.delete(this.url+'/'+roleId).then(res=>{
            let index = this.roles.findIndex(user=>user.id == roleId);
            this.roles.splice(index,1);
            toastr.error('success')
            console.log(res.data);
        }).finally(()=>{
            this.loading = false

        })
    },
},

})
