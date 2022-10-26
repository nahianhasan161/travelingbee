<template>
    <div class="wrap">
        <div class="loader" v-if="loading"></div>
        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary my-3" @click="addUser"> <!-- data-toggle="modal" data-target="#ModalCenter" -->
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
      <label for="inputName">Name</label>
      <input type="text" class="form-control" :class="errors.name ? 'is-invalid' : '' " id="inputName" placeholder="Name" v-model="form.name">
      <div class="text-danger" v-if="errors.name">
               <p v-for="error in errors.name">
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
      <label for="inputFeatures">features</label>
      <input type="features" class="form-control" :class="errors.features ? 'is-invalid' : '' " id="inputFeatures" placeholder="features" v-model="form.features">
      <div class="text-danger" v-if="errors.features">
               <p v-for="error in errors.features">
                {{error}}
               </p>
             </div>

    </div>
    <div class="form-group " >
      <label for="inputRating">Rating</label>
      <input type="number" class="form-control" :class="errors.rating ? 'is-invalid' : '' " id="inputRating" placeholder="Rating" v-model="form.rating">
      
      
    </div>
    <div class="form-group ">
      <label for="inputPrice">Price</label>
      <input type="number" class="form-control" :class="errors.price ? 'is-invalid' : '' " id="inputPrice" placeholder="Price" v-model="form.price">

     

    </div>
    <label for="inputPrice">Category</label>

    <div class="form-group " >
      <select class="custom-select" :class="errors.category_id ? 'is-invalid' : '' " id="inputCategory"  v-model="form.category_id">
  <!-- <option selected>Open this select menu</option> -->
  <option  v-for="category in categories" :value="category.id">{{category.name}}</option>

</select>
      <!-- <select class="form-control" >
      <option>Choose ...</option>
      </select> -->


     

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
<h3 class="card-title">Manage Users</h3>
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
<!-- <th>Category</th> -->
<th>Action</th>
</tr>
</thead>
<tbody>
<tr v-for="(place,index) in places" :key="place.id">
    <td>{{index+1}}</td>
<td > <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" width="240" height="240" class="rounded-circle img-fluid"></td>
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

<td>
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

    <script setup>
        import axios from 'axios';
import { storeToRefs } from 'pinia';
        import {onMounted ,ref,reactive} from 'vue';
        import { UserStore } from '@/store/UserStore';
        import { PlaceStore } from '@/store/place/PlaceStore';
       import { useToastr } from '@/pages/toaster';
        const toastr = useToastr();

        const store = new UserStore();
        const {deleteUser} = UserStore();
        const {allUser,loading,getCurrentUser} = storeToRefs(UserStore());

        const placeStore = new PlaceStore();
        const {places,categories} = storeToRefs(PlaceStore());
        const {deletePlace,fetchCategories,setRoleId} = PlaceStore();

        let users = ref(store.getAllUsers);
        const editing = ref(false);
        let editId = ref('')
        let p = ref([]);
        let form = reactive({
                name:'',
                description:'',
                features:'',
                rating:'',
                price:'',
                 category_id : null,
                 user_id :null
            });

            let errors = ref([]);
            const addUser = ()=>{
                editing.value = false
                $('#ModalCenter').modal('show');
            }
            const formAction =()=>{
               if(editing.value){
                updateUser()
               }else{
                register()
               }
              /*  console.log(editing.value); */
            }
            const resetForm = ()=>{
                    form.name =''
                    form.description=''
                    form.features=''
                    form.rating=''
                    form.price=''
                   /*  form.category='' */
            }

            function editPlace(place){  
                editing.value = true
                editId = place.id
                /* form.value = $user; */

                /* toastr.success('success') */
                form.name =place.name
                form.description =place.description
                form.features =place.features
                form.rating = place.rating
                form.price = place.price
                form.category_id = place.category_id
                form.user_id = place.user_id

                $('#ModalCenter').modal('show');
        }
            const register = async()=>{
            
             form.user_id =  getCurrentUser.value.user_id;
            
                await axios.post('/api/place',form).then(res=>{
                   if(res.data.success){


                   
                   placeStore.fetchPlaces();

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
                axios.put('/api/place/'+editId,form).then(res=>{
                    placeStore.fetchPlaces();
                    toastr.info('success')
                    $('#ModalCenter').modal('hide');
                }).finally(()=>{
                    resetForm()


                })
            }

            onMounted(()=>{
           let roleId =  getCurrentUser.value.roles[0] ? getCurrentUser.value.roles[0] == 'admin' ? 3 : null : null
              let pe =  placeStore.fetchPlaces(); 
              fetchCategories(); 
              setRoleId(roleId)
            console.log(roleId)


        });

    </script>

