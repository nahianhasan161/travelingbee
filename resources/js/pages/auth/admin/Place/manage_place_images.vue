<script setup>
import axios from 'axios';
import { storeToRefs } from 'pinia';
import {onMounted ,ref,reactive} from 'vue';
import { UserStore } from '@/store/UserStore';
import { PlaceStore } from '@/store/place/PlaceStore';
import {AddressStore} from '@/store/address/Address'
import { useToastr } from '@/pages/toaster';
import {useRouter,useRoute} from 'vue-router'
            /* SweetAlert */
import {useSweetAlert} from '@/pages/sweetalert'



    const sweetAlert = useSweetAlert();
/* toaster */
const toastr = useToastr();

/* user */
const store = new UserStore();
const {currentUser} = UserStore();
const {allUser,getCurrentUser} = storeToRefs(UserStore());
const route = new useRoute();
const router = new useRouter();


/* place */
const placeStore = new PlaceStore();
const {places,loading} = storeToRefs(PlaceStore());
const {fetchPlace} = PlaceStore();
const {setRoleId} = PlaceStore();

/* user */
let users = ref(store.getAllUsers);

/* edit */
const editing = ref(false);
let editId = ref('')
const url = '/api/place/images/manage/'
let image = reactive([])

let form = reactive({

        images:[],

        place_id :null
    });
    let images = ref([])
    let errors = ref([]);
    const addImages = ()=>{
        /* imgInput.value.target.value = null */

      resetForm()
        editing.value = false
        $('#ModalCenter').modal('show');
    }
    const formAction =()=>{
       if(editing.value){
        updateImage()
       }else{
        createImages()
       }
      /*  console.log(editing.value); */
    }

    function setImage(event){

     image.value = event.target.files[0];
      console.log(image.value)
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

            form.images= []
            image.value = ''


    }

    function setForm_Data(){
          let form_data = new FormData();

          form_data.append('place_id',form.place_id)

          if(form.images){
          for(let i = 0;i < form.images.length ;i++){

            form_data.append('images[]',form.images[i])
        }
    }


           return form_data;
    }
    /* filters */


    function editImage(image){
        editing.value = true
        editId = image.id


        /* toastr.success('success') */

        image.value = image.name







        console.log('category')
        console.log(form)

        $('#ModalCenter').modal('show');
}
    const createImages = async()=>{

     form.user_id =  getCurrentUser.value.user_id;
    /*  console.log('id') */

    let form_data = new FormData();
        if(form.images){
          for(let i = 0;i < form.images.length ;i++){

            form_data.append('images[]',form.images[i])
        }
    }
    form_data.append('place_id',form.place_id)


        form_data.append('_method','post')


        let config = {
            header : {
                'Content-Type' : 'image/png'
            }
        }
        /* console.log(form_data) */
        await axios.post(url,form_data,config).then(res=>{
           if(res.data.success){



           fetchImages(form.place_id);

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

    function updateImage(){

    console.log(image.value)
    let form_data = setForm_Data()
        if(form.images){
          for(let i = 0;i < form.images.length ;i++){

            form_data.append('image',image.value)
        }
      }
      form_data.append('_method','put')

      let config = {
        header : {
          'Content-Type' : 'image/png'
        }
      }
      console.log(form_data)
         axios.post(url+editId,form_data,config).then(res=>{
           fetchImages(form.place_id);
            toastr.info('success')
            $('#ModalCenter').modal('hide');
        }).catch((err=>{
                console.log('Error! Can not Fetch All User'+err)
            })).finally(()=>{
            resetForm()


        })


}

async function fetchImages(id){



           await  axios.get(url+'?id='+id).then(res=>{
                if(res.data.success){
                    images.value = res.data.data
                    console.log(res)
                  /*   this.places = res.data.data */


                }else{
                    console.log(res)
                }

            })


}
function deleteConfirmed(id){
            deleteImage(id)
            sweetAlert.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )
        }
        function alert(id){


sweetAlert.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
    deleteConfirmed(id)
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === sweetAlert.DismissReason.cancel
  ) {
    sweetAlert.fire(
      'Cancelled',
      'Your imaginary file is safe :)',
      'error'
    )
  }
})
        }
function deleteImage(id){
    axios.delete(url+id).then(res=>{
        if(res.data.success){
            let index = images.value.findIndex(image=>image.id == id);
                images.value.splice(index,1);
            toastr.success(res.data.message)
        }else{
            toastr.error(res.data.message)

        }
    })
}





    onMounted( async ()=>{
   let roleId =  getCurrentUser.value.roles[0] ? getCurrentUser.value.user_id : null
       await fetchPlace(route.params.id);


      setRoleId(roleId)
      form.place_id = route.params.id
      fetchImages(route.params.id)


});

</script>

<template>
    <h1 class="text-center text-danger" v-if="places.length">No Data Found</h1>
    <div class="wrap" v-else>
      <!-- {{places}} -->
    <!--   {{images}} -->

        <div class="loader" v-if="loading"></div>
        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary my-3" @click="addImages">
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




    <div class="form-group " v-if="editing">
      <label for="inputImages">Change Image </label><br>
      <img :src="'image/place/more/'+image.value" alt="" srcset="">
      <input type="file" class="file-control"
        id="inputImages"  @change="setImage($event)">
        <!-- :class="errors.images ? 'is-invalid' : '' " -->



    </div>
    <div class="form-group " v-else>
      <label for="inputImages">Add Multiple Image </label><br>
      <input type="file" class="file-control" multiple
        id="inputImages" @change="setImages($event)">
        <!-- :class="errors.images ? 'is-invalid' : '' " -->



    </div>
  </div>





</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">{{editing? ' Save changes' : 'Create Image'}}</button>
</div>
</form>
    </div>
  </div>
</div>

        <div class="row">
<div class="col-12">
<div class="card">
<div class="card-header">
<h3 class="card-title"> {{places.name}} Images</h3>
</div>

<div class=" row">
    <!-- <h1 class="text-center text-danger" >No Images Found</h1> -->
<div class="col-md-4 card" v-for="image in images" v-if="images.length">
    <img class="card-img-top" loading="lazy"
:src=" image ? '/image/place/more/'+image.name : 'https://images.unsplash.com/photo-1587222318667-31212ce2828d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8Y294cyUyMGJhemFyfGVufDB8fDB8fA%3D%3D&w=1000&q=80'" width="340" height="340" alt="Card image cap" >
<div class="card-footer d-flex">
    <!-- <button class="btn btn-app bg-warning " @click="editImage(image)"
    v-show="true" >
        <i class="fas fa-pen"></i>
    </button> -->
    <button class="btn btn-app bg-danger ml-auto"
    v-show="true" @click="alert(image.id)">
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



