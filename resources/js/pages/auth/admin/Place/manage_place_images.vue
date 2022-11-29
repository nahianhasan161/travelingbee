<script setup>
import axios from 'axios';
import { storeToRefs } from 'pinia';
import {onMounted ,ref,reactive} from 'vue';
import { UserStore } from '@/store/UserStore';
import { PlaceStore } from '@/store/place/PlaceStore';
import {AddressStore} from '@/store/address/Address'
import { useToastr } from '@/pages/toaster';
import {useRouter,useRoute} from 'vue-router'

/* toaster */
const toastr = useToastr();

/* user */
const store = new UserStore();
const {deleteUser,currentUser} = UserStore();
const {allUser,getCurrentUser} = storeToRefs(UserStore());
const route = new useRoute();
const router = new useRouter();
/* Address */
const addressStore = new AddressStore();
const {fetchDivisions,fetchDistricts,fetchAreas} = AddressStore();
const {divisions,districts,areas} = storeToRefs(AddressStore());

/* place */
const placeStore = new PlaceStore();
const {places,categories,loading} = storeToRefs(PlaceStore());
const {fetchPlaces,fetchPlace} = PlaceStore();
const {deletePlace,fetchCategories,setRoleId} = PlaceStore();

/* user */
let users = ref(store.getAllUsers);
let currentUserPlaces = ref([]);
/* edit */
const editing = ref(false);
let editId = ref('')


let form = reactive({
        name:'',
        feature_image: '',
        description:'',
        features:'',
        rating:'',
        price:'',
        division:'',
        district:'',
        area:'',
        images:[],
         category_id : null,
         user_id :null
    });

    let errors = ref([]);
    const addUser = ()=>{
        /* imgInput.value.target.value = null */

      resetForm()
        editing.value = false
        $('#ModalCenter').modal('show');
    }
    const formAction =()=>{
       if(editing.value){
        updateUser()
       }else{
        createPlace()
       }
      /*  console.log(editing.value); */
    }
    /* Setters & Getters*/
    function getDivision(name){

    return name ? divisions.value.find(division=>division.name == name) : []
    }
    function getDistrict(name){
    return name ? districts.value.find(district=>district.name == name) : []
    }
    function getArea(name){
    return name ? areas.value.find(area=>area.name == name) : []
    }
    function setFeatureImage(event){

      form.feature_image = event.target.files[0];
      console.log(form.feature_image)
    }
    function setImages(event){
      form.images = event.target.files;
      /* let form_data = new FormData();
      form_data.append('images',event.target.files[0])
      console.log(form_data) */
      console.log(form.images)
    }
    /* defining and reset */
    const resetForm = ()=>{
            form.name =''
            form.description=''
            form.features=''
            form.rating=''
            form.price=''
            form.images= []
            form.feature_image=''
            form.division = ''
            form.district = ''
            form.area = ''

           /*  this.$refs.fileupload.value=null; */
           /*  form.category='' */
    }

    function setForm_Data(){
          let form_data = new FormData();
          form_data.append('user_id',form.user_id)
        form_data.append('category_id',form.category_id)
        form_data.append('name',form.name)
        form_data.append('feature_image',form.feature_image)
        form_data.append('description',form.description)
        form_data.append('features',form.features)
        form_data.append('rating',form.rating)
        form_data.append('price',form.price)
        form_data.append('images',form.images)

        form_data.append('division',form.division)
        form_data.append('district',form.district)
        form_data.append('area',form.area)
           return form_data;
    }
    /* filters */
    function filterPlaces(){
    return (currentUser.roles[0] == 'suadmin') ? places.value : currentUserPlaces
    }
    function filteredDistricts(){

                if(form.division){
                  let selected = getDivision(form.division)
                  let results =  districts.value.filter(district => district.division_id == selected.id)


                  return results
                }else{
                  console.log('No filter')
                    return []
                }

            }
    function filteredAreas(){

                if(form.district){
                  let selected = getDistrict(form.district)
                  let results =  areas.value.filter(area => area.district_id == selected.id)




                  return results
                }else{
                  console.log('No filter')
                    return []
                }

            }

    function editPlace(place){
        editing.value = true
        editId = place.id


        /* toastr.success('success') */
        form.name =place.name
        form.description =place.description
        form.features =place.features
        form.price = place.price
        form.category_id = place.category.id
        form.user_id = place.id
        form.rating = place.rating

        form.division = place.division
        selectionDivision()
        form.district = place.district
        selectionDistrict()
        form.area = place.area


        console.log('category')
        console.log(form)
        console.log(place)
        $('#ModalCenter').modal('show');
}
    const createPlace = async()=>{

     form.user_id =  getCurrentUser.value.user_id;
    /*  console.log('id') */

     let form_data = setForm_Data()

        form_data.append('_method','post')


        let config = {
            header : {
                'Content-Type' : 'image/png'
            }
        }
        /* console.log(form_data) */
        await axios.post('/api/place',form_data,config).then(res=>{
           if(res.data.success){



           fetchPlaces();

            toastr.success('success')

            $('#ModalCenter').modal('hide');
            resetForm()


            }else{
                errors.value = res.data[0].data

            }
        }).catch(e=>{
            toastr.error(e.response.data)
            errors.value = e.response.data
        })

        console.log('finally');
    }

    function updateUser(){
      /* let form_data = new FormData(); */
    /*  let form_data = setForm_Data(); */
    console.log(form.category_id)
    let form_data = setForm_Data()
        if(form.images){
          for(let i = 0;i < form.images.length ;i++){

            form_data.append('images[]',form.images[i])
        }
      }
      form_data.append('_method','put')

      let config = {
        header : {
          'Content-Type' : 'image/png'
        }
      }
      console.log(form_data)
         axios.post('/api/place/'+editId,form_data,config).then(res=>{
           fetchPlaces();
            toastr.info('success')
            $('#ModalCenter').modal('hide');
        }).catch((err=>{
                console.log('Error! Can not Fetch All User'+err)
            })).finally(()=>{
            resetForm()


        })


}

async function fetchImages(id){



           await  axios.get('/api/place/images/manage/?id='+id).then(res=>{
                if(res.data.success){
                    console.log(res)
                  /*   this.places = res.data.data */


                }else{
                    console.log(res)
                }

            })


}





    onMounted( async ()=>{
   let roleId =  getCurrentUser.value.roles[0] ? getCurrentUser.value.user_id : null
       await fetchPlace(route.params.id);


      setRoleId(roleId)
      fetchImages(route.params.id)


});

</script>

<template>
    <h1 class="text-center text-danger" v-if="places.length">No Data Found</h1>
    <div class="wrap" v-else>
      {{places}}

        <div class="loader" v-if="loading"></div>
        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary my-3" @click="addUser">
  Add Image on {{places.name}}
</button >

<!-- Modal -->
<div class="modal fade" id="ModalCenter" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <form @submit.prevent="formAction">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle" v-if="editing">Change Image of this Place</h5>
        <h5 class="modal-title" id="exampleModalLongTitle" v-else>Add Image on Place</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  <div class="form">




    <div class="form-group " >
      <label for="inputImages">Add Multiple Image </label><br>
      <input type="file" class="file-control" multiple
       :class="errors.images ? 'is-invalid' : '' " id="inputImages" @change="setImages($event)">




    </div>
  </div>





</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">{{editing? ' Save changes' : 'Create Place'}}</button>
</div>
</form>
    </div>
  </div>
</div>

        <div class="row">
<div class="col-12">
<div class="card">
<div class="card-header">
<h3 class="card-title">Manage Place Images</h3>
</div>

<div class=" row">
<div class="col-md-4 card">
    <img class="card-img-top" loading="lazy"
:src=" 'https://images.unsplash.com/photo-1587222318667-31212ce2828d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8Y294cyUyMGJhemFyfGVufDB8fDB8fA%3D%3D&w=1000&q=80'" width="340" height="340" alt="Card image cap" >
<div class="card-footer d-flex">
    <button class="btn btn-app bg-warning "
    v-show="true" >
        <i class="fas fa-pen"></i>
    </button>
    <button class="btn btn-app bg-danger ml-auto"
    v-show="true" >
        <i class="fas fa-trash"></i>
    </button>

</div>
</div>
<div class="col-md-4"></div>
<div class="col-md-4"></div>
</div>

</div>

</div>
</div>
    </div>
</template>



