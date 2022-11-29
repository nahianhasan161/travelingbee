import axios from 'axios';
import {defineStore} from 'pinia';
import {ref} from 'vue';
import { useToastr } from '../../pages/toaster';
const toastr = useToastr();
export const GroupTourStore = defineStore({
    id :'GroupTourStoreId',

    state:()=>({
        /* JSON.parse() */

        loading: false,

        roleId:ref(''),
        grouptours:ref([]),
        /* place:ref([]), */
        url : '/api/grouptour',

        categories:ref([]),
         categoryUrl : '/api/category',

    }),
    getters:{


    getGroupTour : function(){

        return this.places;
       },
       getCategories : function(){
        return this.categories;
       }
    },

    actions:{

        setRoleId(id){
            console.log(id);
        this.roleId = id;
        },



        async fetchGroupTours(){
            this.loading = true
           await axios.get(this.url).then(res=>{
                if(res.data.success){

                    this.grouptours = res.data.data

                   /*  console.log(res) */

                }else{
                    console.log(res)
                }

            }).catch((err=>{
                console.log('Error! Can not Fetch All User'+err)
            })).finally(()=>{
                this.loading = false
            });

        },
       async  fetchGroupTour(grouptourID){
            this.loading = true

           await  axios.get(this.url+'/'+grouptourID).then(res=>{
                if(res.data.success){

                    this.places = res.data.data


                }else{
                    console.log(res)
                }

            }).catch((err=>{
                console.log('Error! Can not Fetch All User'+err)
            })).finally(()=>{
                this.loading = false
            });

        },

        async fetchCategories(){
            this.loading = true
           await axios.get(this.categoryUrl).then(res=>{
                if(res.data.success){

                    this.categories = res.data.data
                    console.log(res.data.data)
                   /*  console.log('categories')
                    console.log(this.places)
                    console.log(this.categories) */


                }else{
                    console.log(res)
                }

            }).catch((err=>{
                console.log('Error! Can not Fetch All User'+err)
            })).finally(()=>{
                this.loading = false
            });

        },
        setPlaceId(id){
            this.placeId = id
        },

        deletePlace(placeId){

                this.loading = true;
                /* console.log(placeId); */
                axios.delete(this.url+'/'+placeId).then(res=>{
                    let index = this.places.findIndex(places=>places.id == placeId);
                    this.places.splice(index,1);
                    toastr.error('success')
                    /* console.log(this.places); */
                    toastr.success(res.data.message);
                    console.log(res.data);
                }).finally(()=>{
                    this.loading = false

                })
        }
       /*  createRole($data){
            this.loading = true
            axios.post(this.url,$data).then(res=>{
                console.log(res)
            }) .finally(()=>{
                $('#exampleModalCenter').modal('hide');
                this.loading = false
                this.fetchPlace()
            })
        }, */

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

   /*  deleteRole(roleId){
        this.loading = true;
        console.log(roleId);
        axios.delete(this.url+'/'+roleId).then(res=>{
            let index = this.place.findIndex(user=>user.id == roleId);
            this.place.splice(index,1);
            toastr.error('success')
            console.log(res.data);
        }).finally(()=>{
            this.loading = false

        })
    },*/
}

})
