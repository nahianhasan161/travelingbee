import axios from 'axios';
import {defineStore} from 'pinia';
import {ref} from 'vue';
import { useToastr } from '../../pages/toaster';
const toastr = useToastr();
export const PlaceStore = defineStore({
    id :'PlaceStoreId',

    state:()=>({
        /* JSON.parse() */

        loading: false,
        placeId:ref(''),
        places:ref([]),
        place:ref([]),
        url : '/api/place',

        categories:ref([]),
         categoryUrl : '/api/category',

    }),
    getters:{


       getplace : function(){
        return this.place;
       }
    },

    actions:{




        async fetchPlaces(){
            this.loading = true
           await axios.get(this.url).then(res=>{
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
        async fetchPlace($id){
            this.loading = true
            await axios.get(this.url+'/'+$id).then(res=>{
                if(res.data.success){

                    this.place = res.data.data


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


                }else{
                    console.log(res)
                }

            }).catch((err=>{
                console.log('Error! Can not Fetch All User'+err)
            })).finally(()=>{
                this.loading = false
            });

        },
        setPlaceId($id){
            this.placeId = $id
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
