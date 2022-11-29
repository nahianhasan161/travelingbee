

   <script setup>

   import axios from 'axios';
   import { storeToRefs } from 'pinia';
   import {onMounted ,ref,reactive} from 'vue';
   import { useRouter,useRoute } from 'vue-router';
   import { UserStore } from '@/store/UserStore';
   import {AddressStore} from '@/store/address/Address'
   import { useToastr } from '@/pages/toaster';
   import area_table from '@/pages/component/manage_table.vue'
   import {useSweetAlert} from '@/pages/sweetalert'

    /* import 'sweetalert2/src/sweetalert2.scss' */

   const toastr = useToastr();
   const sweetAlert = useSweetAlert();

   const router = new useRouter();
   const route = new useRoute();
   /* UserStore */
   const store = new UserStore();
   const {} = UserStore();
   const {loading} = storeToRefs(UserStore());
   /* AddressStore */

   const {fetchAreasByDistrict,deleteArea} = AddressStore();
 const {areas} = storeToRefs(AddressStore());

    const areaUrl ='/api/address/area/'
   let users = ref(store.getAllUsers);
   const editing = ref(false);
   let currentDistrictID = '';
   let editId = ref('')
   let form = reactive({
           name:'',
           bn_name:'',
           url:'',

       });
       let errors = ref([]);


       const addArea = ()=>{
        form.district_id = currentDistrictID
        resetForm()
           editing.value = false
         $('#ModalCenter').modal('show');
       }
       const resetForm = ()=>{
        form.name = '',
        form.bn_name = '',
        form.url = ''
        form.district_id = ''
       }
       const formAction =()=>{
        form.district_id = currentDistrictID
          if(editing.value){
           updateArea(editId,form)
          }else{
           createArea(form)
          }
         /*  console.log(editing.value); */
       }


      function test(id){
        console.log(id)
       }
       function editArea(area){
           editing.value = true
           editId = area.id
           console.log(area)
           /* form.value = $user; */

           /* toastr.success('success') */
           form.name =area.name
           form.bn_name =area.bn_name
           form.url =area.url

           $('#ModalCenter').modal('show');
   }
    async  function createArea(data){

           await axios.post(areaUrl,data).then(res=>{
              if(res.data.success){

                fetchAreasByDistrict(currentDistrictID)


               toastr.success('success')

               $('#ModalCenter').modal('hide');
               resetForm()

               }else{
                    errors.value = res.data ? res.data[0].data : ''
                   console.log(res)

               }
           })



           console.log('finally');
       }



      function updateArea(id,data){
            axios.put(areaUrl+id,data).then(res=>{
                fetchAreasByDistrict(currentDistrictID)
                toastr.info('success')
                $('#ModalCenter').modal('hide');
            }).finally(()=>{
                resetForm()


            })
        }

        function deleteConfirmed(id){
            deleteArea(id)
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


/*   function edit() {
 console.log('here')
} */

       onMounted(()=>{
        currentDistrictID = route.params.id
           store.fetchAllUser();
           fetchAreasByDistrict(currentDistrictID)
           console.log(areas)


       /*  console.log(emit.edit) */
   });

</script>

<template>
    <div class="wrap">
        <!-- {{bookings}} -->

        <div class="loader" v-if="loading"></div>




        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary my-3" @click="addArea">
  Create Area
</button >

<!-- Modal -->
<div class="modal fade" id="ModalCenter" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form @submit.prevent="formAction">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle" v-if="editing">Edit Area</h5>
        <h5 class="modal-title" id="exampleModalLongTitle" v-else>Create Area</h5>
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
      <label for="inputEmail4">Bangla Name</label>
      <input type="text" class="form-control" :class="errors.bn_name ? 'is-invalid' : '' " id="inputbn_name4" placeholder="Bangla Name" v-model="form.bn_name">
      <div class="text-danger" v-if="errors.bn_name">
               <p v-for="error in errors.bn_name">
                {{error}}
               </p>
             </div>
    </div>
    <div class="form-group ">
      <label for="inputEmail4">URL</label>
      <input type="text" class="form-control" :class="errors.url ? 'is-invalid' : '' " id="inputurl" placeholder="URL" v-model="form.url">
      <div class="text-danger" v-if="errors.url">
               <p v-for="error in errors.url">
                {{error}}
               </p>
             </div>
    </div>


   <!--  <div class="form-group ">
      <label for="FormControlSelect">Role</label>
      <select v-model="form.role" class="form-control" id="FormControlSelect">
      <option default>Choose...</option>
      <option value="user">User</option>
      <option value="admin">Admin</option>
      <option value="suadmin">Super Admin</option>

    </select>

    </div> -->
  </div>





</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">{{editing? ' Save changes' : 'Create Area'}}</button>
</div>
</form>
    </div>
  </div>
</div>

        <div class="row">
<div class="col-12">
<div class="card">
<div class="card-header">
<h3 class="card-title">Manage Area</h3>
</div>


<area_table
:data="areas"
 :names="['#','Name','Bangla Name ','Url','Actions']"


 @edit-prop="editArea"
 @delete-prop="alert"
 />

</div>

</div>
</div>

    </div>
</template>



