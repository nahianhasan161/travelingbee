<script setup>
import axios from 'axios';
import { storeToRefs } from 'pinia';
import {onMounted ,ref,reactive} from 'vue';
import { UserStore } from '@/store/UserStore';
import { PlaceStore } from '@/store/place/PlaceStore';
import {AddressStore} from '@/store/address/Address'
import { useToastr } from '@/pages/toaster';
/* toaster */
const toastr = useToastr();

/* user */
const store = new UserStore();
const {deleteUser,currentUser} = UserStore();
const {allUser,getCurrentUser} = storeToRefs(UserStore());
/* Address */
const addressStore = new AddressStore();
const {fetchDivisions,fetchDistricts,fetchAreas} = AddressStore();
const {divisions,districts,areas} = storeToRefs(AddressStore());

/* place */
const placeStore = new PlaceStore();
const {places,categories,loading} = storeToRefs(PlaceStore());
const {fetchPlaces} = PlaceStore();
const {deletePlace,fetchCategories,setRoleId} = PlaceStore();

/* user */
let users = ref(store.getAllUsers);
let currentUserPlaces = ref([]);
/* edit */
const editing = ref(false);
let editId = ref('')
  

           
let form = reactive({
        title:'',
        description: '',
        
        person:'',
        rating:'',
        price:'',
        day : '',
        
        place: '',
        division:'',
        district:'',
        area:'',

        feature_image : '',
        images:'',

        plans:[{
            place: '',
            description: '',
            category : '',
            time:'',
            day:'',

           
        }]
        
        
      
    });
   
    let errors = ref([]);
    function addPlan(){
      form.plans.push([{
            place: '',
            description: '',
            category : '',
            time:'',
            day:'',

           
        }])
    }
    function removePlan(){
      form.plans.pop()
    }
    const addUser = ()=>{
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
      console.log(event)
    }
    function setImages(event){
      form.images = event.target.files;
      /* let form_data = new FormData();
      form_data.append('images',event.target.files[0])
      console.log(form_data) */
      console.log(event)
    }
    /* defining and reset */
    const resetForm = ()=>{
        form.title ='',
        form.description = '',
        
        form.people ='',
        form.rating ='',
        form.price ='',
        form.day  = '',
        
        form.place = '',
        form.division ='',
        form.district ='',
        form.area ='',

        form.feature_image  = '',
        form.images ='',

        form.plans = [{
            place: '',
            description: '',
            category : '',
            time:'',
            day:'',

           
        }] 
            
           /*  this.$refs.fileupload.value=null; */
           /*  form.category='' */
    }
    
    function setForm_Data(){
          let form_data = new FormData();
          
        form_data.append('title',form.title)
        form_data.append('feature_image',form.feature_image)
        form_data.append('description',form.description)
        form_data.append('rating',form.rating)
        form_data.append('price',form.price)
        form_data.append('images',form.images)
        
        form_data.append('day',form.day)
        form_data.append('people',form.people)
        
        form_data.append('place',form.place)
        form_data.append('division',form.division)
        form_data.append('district',form.district)
        form_data.append('area',form.area)

        form_data.append('plans',form.plans)
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
        await axios.post('/api/group-tour',form_data,config).then(res=>{
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
  function  getCurrentUserPlaces(){
     currentUserPlaces = places.value.filter(place => place.user.id == currentUser.user_id)
     console.log(currentUserPlaces)
    }

    //Selection Event
function selectionDivision(){

  if(form.division){
   
    form.area = ''
    form.district = ''
 
    filteredDistricts()
    filteredAreas()

  }
  
}
function selectionDistrict(){

  if(form.district){
    
   form.area = ''
    
    filteredAreas()
  }

}
    onMounted( async ()=>{
   let roleId =  getCurrentUser.value.roles[0] ? getCurrentUser.value.user_id : null 
       await fetchPlaces(); 
      fetchCategories(); 
      fetchDivisions(); 
      fetchDistricts(); 
      fetchAreas(); 
      setRoleId(roleId)
      getCurrentUserPlaces()


});

</script>

<template>
    <div class="wrap">

      {{form}}
     <!--  {{divisions}}
      {{areas}} -->
        <div class="loader" v-if="loading"></div>
        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary my-3" @click="addUser"> 
  Create Place
</button >

<!-- Modal -->
<div class="modal fade" id="ModalCenter" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <form @submit.prevent="formAction">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle" v-if="editing">Edit Place</h5>
        <h5 class="modal-title" id="exampleModalLongTitle" v-else>Create Place</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  <div class="form">
    <div class="form-group ">
      <label for="inputName">Title</label>
      <input type="text" class="form-control" :class="errors.title ? 'is-invalid' : '' " id="inputTitle" placeholder="Title" v-model="form.title">
      <div class="text-danger" v-if="errors.title">
               <p v-for="error in errors.title">
                {{error}}
               </p>
             </div>
    </div>
    <div class="form-group ">
      <label for="inputDescription">description</label>
      <input type="description" class="form-control" :class="errors.description ? 'is-invalid' : '' " id="inputDescription" placeholder="description" v-model="form.description">
      <div class="text-danger" v-if="errors.description">
               <p v-for="error in errors.description">
                {{error}}
               </p>
             </div>
    </div>
  
    <div class="form-group " >
      <label for="inputRating">Rating</label>
      <input type="number" class="form-control" :class="errors.rating ? 'is-invalid' : '' " id="inputRating" placeholder="Rating" v-model="form.rating">
      <div class="text-danger" v-if="errors.rating">
               <p v-for="error in errors.rating">
                {{error}}
               </p>
             </div>
      
    </div>
    <div class="form-group " >
      <label for="inputDay">Day</label>
      <input type="number" class="form-control" :class="errors.day ? 'is-invalid' : '' " id="inputDay" placeholder="Day" v-model="form.day">
      <div class="text-danger" v-if="errors.day">
               <p v-for="error in errors.day">
                {{error}}
               </p>
             </div>
      
    </div>
    <div class="form-group " >
      <label for="inputPeople">Person</label>
      <input type="number" class="form-control" :class="errors.person ? 'is-invalid' : '' " id="inputPeople" placeholder="Person" v-model="form.person">
      <div class="text-danger" v-if="errors.person">
               <p v-for="error in errors.person">
                {{error}}
               </p>
             </div>
      
    </div>
    <div class="form-group ">
      <label for="inputPrice">Price</label>
      <input type="number" class="form-control" :class="errors.price ? 'is-invalid' : '' " id="inputPrice" placeholder="Price" v-model="form.price">
      <div class="text-danger" v-if="errors.price">
               <p v-for="error in errors.price">
                {{error}}
               </p>
             </div>
     

    </div>
    
   <!--  <div class="form-group " >
      <label for="inputPrice">Category</label>
      <select class="custom-select" :class="errors.category_id ? 'is-invalid' : '' " id="inputCategory"  v-model="form.category_id">
  
  <option value="" >Choose ...</option>
  <option  v-for="category in categories" :value="category.id">{{category.name}}</option>

</select>
    

    </div> -->
    <div class="form-group " >
      <label for="inputPlace">Place</label>
      <input type="text" class="form-control" :class="errors.place ? 'is-invalid' : '' " id="inputPlace" placeholder="Place" v-model="form.place">
      <div class="text-danger" v-if="errors.place">
               <p v-for="error in errors.place">
                {{error}}
               </p>
             </div>

    </div>

    <div class="form-group " >
      <label for="inputPrice">Division </label>
      <select class="custom-select" :class="errors.division ? 'is-invalid' : '' " id="inputDivision"  v-model="form.division" @change="selectionDivision()">
  <!-- <option selected>Open this select menu</option> -->
  <option value="" selected>Choose ...</option>
  <option  v-for="division in divisions" :value="division.name">{{division.name}}</option>

</select>


    </div>
    <div class="form-group " v-show="form.division">
      <label for="inputPrice">District</label>
      <select class="custom-select" :class="errors.district ? 'is-invalid' : '' " id="inputDistrict"  v-model="form.district" @change="selectionDistrict()">
  <!-- <option selected>Open this select menu</option> -->
  <option value="" >Choose ...</option>
  <option  v-for="district in filteredDistricts()" :value="district.name">{{district.name}}</option>

</select>
    

    </div>
    <div class="form-group " v-show="form.district && form.division">
      <label for="inputPrice">Area</label>
      <select class="custom-select" :class="errors.area ? 'is-invalid' : '' " id="inputArea"  v-model="form.area">
  <!-- <option selected>Open this select menu</option> -->
  <option value="" >Choose ...</option>
  <option  v-for="area in filteredAreas()" :value="area.name">{{area.name}}</option>

</select>
    

    </div>


    <div class="form-group " >
      <label for="inputFeatureImage">Feature Image </label><br>
      <input type="file" class="file-control" :class="errors.feature_image ? 'is-invalid' : '' " id="inputFeatureImage" @change="setFeatureImage($event)">
      

     

    </div>
    <div class="form-group " >
      <label for="inputImages">More Image </label><br>
      <input type="file" class="file-control" multiple
       :class="errors.images ? 'is-invalid' : '' " id="inputImages" @change="setImages($event)">
      
      
     

    </div>
    <div class="card border p-3" v-if="form.plans.length">
        <div class="form-group " v-for="(plan,index) in form.plans" :key="index">
          <label for="inputDay">Day</label>
          <input type="number" class="form-control" :class="errors.plans ? 'is-invalid' : '' " id="inputDay" placeholder="Day" v-model="form.plans[0].day">
        <!--   <div class="text-danger" v-if="errors.plans[0].day">
                   <p v-for="error in errors.plans[0].day">
                    {{error}}
                   </p>
                 </div> -->
          
        </div>

        <div class="form-group " >
          <label for="inputDay">Time</label>
          <picker v-model="form.plans[0].time" timePicker />
        <!--   <div class="text-danger" v-if="errors.plans[0].day">
                   <p v-for="error in errors.plans[0].day">
                    {{error}}
                   </p>
                 </div> -->
          
        </div>
        <div class="form-group " >
      <label for="inputCategory">Category</label>
      <select class="custom-select" :class="errors.plans ? 'is-invalid' : '' " id="inputCategory"  v-model="form.plans[0].category">
  <!-- <option selected>Open this select menu</option> -->
  <option value="" selected>Choose ...</option>
  <option value="eat" >Eating</option>
  <option value="stay" >Stay</option>
  <option value="roaming" >Roaming</option>
  <option value="traveling" >Traveling</option>
 

</select>
    

    </div>
        <div class="form-group ">
      <label for="inputPlace">Place</label>
      <input type="text" class="form-control" :class="errors.plans ? 'is-invalid' : '' " id="inputPlace" placeholder="description" v-model="form.plans[0].place">
      <!-- <div class="text-danger" v-if="errors.plans[0].place">
               <p v-for="error in errors.plans[0].place">
                {{error}}
               </p>
             </div> -->
    </div>
        <div class="form-group ">
      <label for="inputDescription">Description</label>
      <textarea type="text" class="form-control" :class="errors.plans ? 'is-invalid' : '' " id="inputDescription" placeholder="description" v-model="form.plans[0].description" cols='10' rows='5'></textarea>
  <!--     <div class="text-danger" v-if="errors.plans[0].description">
               <p v-for="error in errors.plans[0].description">
                {{error}}
               </p>
             </div> -->
    </div>
    <a class="btn btn-sm btn-danger m-1" @click="removePlan()" v-if="form.plans.length > 1 "><i class="fa fa-times"></i> Remove Plan</a>
    <a class="btn btn-success" @click="addPlan()"> <i class="fa fa-plus"></i> Add Plan</a>
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
<h3 class="card-title">Manage Place</h3>
</div>

<div class="card-body table-responsive">
<table class="table table-bordered table-hover">
<thead>
<tr>
<th>#</th>
<th>Image</th>
<th>Name</th>
<th>Description</th>
<th>features</th>
<th>rating</th>
<th>Price</th>
<th>Address</th>
<!-- <th>Category</th> -->
<th>Action</th>
</tr>
</thead>
<tbody>
  {{currentUserPlaces.value}}
  <tr v-for="(place,index) in filterPlaces()" :key="place.id" >

    
    <td>{{index+1}}</td>
    <td v-if="place.feature_image"> <img :src="'/image/place/feature/'+place.feature_image" width="240" height="240" class=" img-fluid" ></td>
<td v-else> <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" width="240" height="240" class=" img-fluid" ></td>
<td ><strong>{{place.name}}</strong></td>
<td > 
  <textarea name="description" id="description" class="form-control" cols="30" rows="10" disabled>{{place.description}}</textarea>
  
<!--   <div class="form-group">

  <textarea class="form-control rounded-0" id="exampleFormControlTextarea1" rows="10">{{place.description}}</textarea>
</div> -->
 


</td>
<td ><textarea  name="features" id="features" class="form-control" cols="30" rows="10" disabled>{{place.features}}</textarea></td>
<td >{{place.rating}}<i class="fas fa-star text-warning"></i></td>
<td >৳{{place.price}}</td>
<td >{{place.area}},{{place.district}},{{place.division}}</td>

<td>
  <router-link :to="'/manage/place/'+place.id+'/booking'" class="btn btn-warning mr-1">Bookings</router-link>
    <button class="btn btn-primary mr-3" @click="editPlace(place)">


 <i class="far fa-edit"></i></button>
    <button class="btn btn-danger" @click="deletePlace(place.id)"><i class="fas fa-trash"></i></button>
</td>

</tr>










</tbody>
</table>
</div>

</div>

</div>
</div>
    </div>
</template>



