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
          fetchDistricts(){
            this.loading = true
            axios.get(this.districtUrl).then(res=>{
                if(res.data.success){

                    this.districts = res.data.data



                }else{
                    toastr.error('Can not get Districts')
                    console.log(res)
                }

            })

        },
          fetchDistrictsByDivision(divisionID){
            this.loading = true
            axios.post(this.districtUrl+'/id',{'id' : divisionID}).then(res=>{
                if(res.data.success){

                    this.districts = res.data.data



                }else{
                    toastr.error('Can not get Districts')
                    console.log(res)
                }

            })

        },

        deleteDistrict(districtID){

            this.loading = true;
            /* console.log(placeId); */
            axios.delete(this.districtUrl+'/'+districtID).then(res=>{
                let index = this.districts.findIndex(district=>district.id == districtID);
                this.districts.splice(index,1);

                /* console.log(this.places); */
                toastr.error(res.data.message);
                console.log(res.data);
            }).finally(()=>{
                this.loading = false

            })
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
        async fetchAreasByDistrict(districtID){
            this.loading = true

           await axios.post(this.areaUrl+'/district_id',{'id' : districtID}).then(res=>{
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
        deleteArea(areaID){

            this.loading = true;
            /* console.log(placeId); */
            axios.delete(this.areaUrl+'/'+areaID).then(res=>{
                let index = this.areas.findIndex(area=>area.id == areaID);
                this.areas.splice(index,1);

                /* console.log(this.places); */
                toastr.error(res.data.message);
                console.log(res.data);
            }).finally(()=>{
                this.loading = false

            })
    },
        /* end Area*/



    }
})
