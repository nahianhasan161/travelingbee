import axios from 'axios';
import {defineStore} from 'pinia';
import {ref} from 'vue';
import { useToastr } from '../../pages/toaster';
const toastr = useToastr();
export const AddressStore = defineStore({
    id :'AddressStoreId',

    state:()=>({
        /* JSON.parse() */

        loading: false,

        divisionId:ref(''),

        userId:ref(''),
        placeId:ref(''),
        divisions:ref([]),
        districts:ref([]),
        areas:ref([]),

        url : '/api/address',


         divisionUrl : '/api/address/division',
         districtUrl : '/api/address/district',
         areaUrl : '/api/address/area',

    }),
    getters:{


    getDivisions : function(){

        return this.divisions;
       },
       getCategories : function(){
        return this.categories;
       }
    },

    actions:{

        setRoleId(id){

        this.roleId = id;
        },
        setDivisionId(id){

        this.bookingId = id;
        },


        /* Division */
        async fetchDivisions(){
            this.loading = true
           await axios.get(this.divisionUrl).then(res=>{
                if(res.data.success){

                    this.divisions = res.data.data



                }else{
                    toastr.error('Can not get Divisions')
                    console.log(res)
                }

            }).catch((err=>{
                toastr.error('Error! Can not get Divisions')
                console.log('Error! Can not Fetch Divisions'+err)
            })).finally(()=>{
                this.loading = false
            });

        },
       async  fetchDivision(divisionID){
            this.loading = true

           await  axios.get(this.DivisionUrl+'/'+divisionID).then(res=>{
                if(res.data.success){

                    this.divisions = res.data.data


                }else{
                    toastr.error('Error! Can not get Division')
                    console.log(res)
                }

            }).catch((err=>{
                console.log('Error! Can not Fetch All User'+err)
            })).finally(()=>{
                this.loading = false
            });

        },



        async getDivision(id){
            await axios.get(this.divisionUrl+'/'+id).then(res=>{
                if(res.data.success){
                    this.bookings.value = res.data.data

                    console.log(res.data.data)
                }else{
                    console.log(res)

                }
            })
            },

        deleteDivision(divisionID){

                this.loading = true;
                /* console.log(placeId); */
                axios.delete(this.divisionUrl+'/'+divisionID).then(res=>{
                    let index = this.divisions.findIndex(division=>division.id == divisionID);
                    this.divisions.splice(index,1);

                    /* console.log(this.places); */
                    toastr.error(res.data.message);
                    console.log(res.data);
                }).finally(()=>{
                    this.loading = false

                })
        },
        /* end Division */

        /*  District */
        async fetchDistricts(id){
            this.loading = true
           await axios.get(this.districtUrl+'/?id='+id).then(res=>{
                if(res.data.success){

                    this.districts = res.data.data



                }else{
                    toastr.error('Can not get Districts')
                    console.log(res)
                }

            }).catch((err=>{
                toastr.error('Error! Can not get Districts')
                console.log('Error! Can not Fetch Districts'+err)
            })).finally(()=>{
                this.loading = false
            });

        },
        /* end  District */



        /*end  Area*/
        async fetchAreas(){
            this.loading = true
           await axios.get(this.areaUrl).then(res=>{
                if(res.data.success){

                    this.areas = res.data.data



                }else{
                    toastr.error('Can not get Areas')
                    console.log(res)
                }

            }).catch((err=>{
                toastr.error('Error! Can not get Areas')
                console.log('Error! Can not Fetch Areas'+err)
            })).finally(()=>{
                this.loading = false
            });

        },

        /* end Area*/



    }
})
