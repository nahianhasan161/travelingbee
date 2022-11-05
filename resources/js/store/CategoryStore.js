import axios from 'axios';
import {defineStore} from 'pinia';
import {ref} from 'vue';
import { useToastr } from '../pages/toaster';
const toastr = useToastr();
export const CategoryStore = defineStore({
    id :'categorystoreId',

    state:()=>({
        /* JSON.parse() */

        loading: false,
        categories:ref([]),
        url : '/api/category',
        name : ''
    }),
    getters:{


       getcategories : function(){
        return this.categories;
       }
    },

    actions:{




        async fetchCategories(){
            this.loading = true
           await axios.get(this.url).then(res=>{
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

        createCategory($data){
            this.loading = true
            
            axios.post(this.url,$data).then(res=>{
                console.log(res.data.message || res.data[0].success);
                if(res.data.success ){
                    console.log(res.data.success);
                    toastr.success(res.data.message); 
                    $('#ModalCenter').modal('hide');
                  /*   fetchCategories() */
                }else{
                    toastr.error(res.data[0].message) ;
                }
                this.loading = false
            }) .catch($e=>{
                
               /*  console.log('Error :'+ $e); */
                
            })
            this.fetchCategories()
        },

        editCategory(categoryId,data){
            this.loading = true
            let category = this.categories.find(cat=>cat.id == categoryId);

            if(!category){
                toastr.error('failed finding post');
            }else{

           
                this.editId = categoryId;
                if(category.name === data.name){
                    toastr.success('Updated');
                }else {

               
            axios.put(this.url+'/'+categoryId,data).then(res=>{
                console.log(res.data)
                let response = res.data
                 if(response.success){
                    toastr.success(response.message)
                    this.fetchCategories()
                    $('#exampleModalCenter').modal('hide');
                }else{
                    toastr.error(res.data[0].data.name)
                } 
            }); 
        }
    }
        this.loading = false
        }, 

    deleteCategory(categoryId){
        this.loading = true;
        console.log(categoryId);
        axios.delete(this.url+'/'+categoryId).then(res=>{
            let index = this.categories.findIndex(user=>user.id == categoryId);
            this.categories.splice(index,1);
            toastr.error('success')
            console.log(res.data);
        }).finally(()=>{
            this.loading = false

        })
    },
},

})
