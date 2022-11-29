

   <script setup>

   import axios from 'axios';
   import { storeToRefs } from 'pinia';
   import {onMounted ,ref,reactive} from 'vue';
   import { useRouter,useRoute } from 'vue-router';
   import { UserStore } from '@/store/UserStore';
   import {AddressStore} from '@/store/address/Address'
   import { useToastr } from '@/pages/toaster';
   import district_table from '@/pages/component/manage_table.vue'
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

   const {fetchDistrictsByDivision,deleteDistrict} = AddressStore();
 const {districts} = storeToRefs(AddressStore());

    const districtUrl = '/api/address/district/'
   let users = ref(store.getAllUsers);
   const editing = ref(false);
    let currentDivisionID = '';
   let editId = ref('')
   let form = reactive({
           name:'',
           bn_name:'',
           url:'',
           division_id:''

       });
       let errors = ref([]);


       const addDistrict = ()=>{
        resetForm()
           editing.value = false
         $('#ModalCenter').modal('show');
       }
       const resetForm = ()=>{
        form.name = '',
        form.bn_name = '',
        form.url = ''
       }
       const formAction =()=>{
        form.division_id = currentDivisionID
          if(editing.value){
           updateDistrict(editId,form)
          }else{
           createDistrict(form)
          }
         /*  console.log(editing.value); */
       }


      function test(id){
        console.log(id)
       }
       function editDistrict(district){
           editing.value = true
           editId = district.id
           console.log(district)
           /* form.value = $user; */

           /* toastr.success('success') */
           form.name =district.name
           form.bn_name =district.bn_name
           form.url =district.url

           $('#ModalCenter').modal('show');
   }
    async  function createDistrict(data){

           await axios.post(districtUrl,data).then(res=>{
              if(res.data.success){

                fetchDistrictsByDivision(currentDivisionID)


               toastr.success('success')

               $('#ModalCenter').modal('hide');
               resetForm()

               }else{
                   errors.value = res.data[0].data

               }
           })



           console.log('finally');
       }


       /* function allDivision(){
           axios.get('/api/address/division').then(res=>{
               divisions.value = res.data.data
           })
       } */
      function updateDistrict(id,data){
            axios.put(districtUrl+id,data).then(res=>{
                fetchDistrictsByDivision(currentDivisionID)
                toastr.info('success')
                $('#ModalCenter').modal('hide');
            }).finally(()=>{
                resetForm()


            })
        }

        function deleteConfirmed(id){
            deleteDistrict(id)
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
           store.fetchAllUser();
           currentDivisionID = route.params.id
           fetchDistrictsByDivision(currentDivisionID)

           console.log(districts)

          /*  allDivision() */
       /*  console.log(emit.edit) */
   });

</script>

<template>
    <div class="wrap">
        <!-- {{bookings}} -->

        <div class="loader" v-if="loading"></div>




        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary my-3" @click="addDistrict">
  Create District
</button >

<!-- Modal -->
<div class="modal fade" id="ModalCenter" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form @submit.prevent="formAction">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle" v-if="editing">Edit Division</h5>
        <h5 class="modal-title" id="exampleModalLongTitle" v-else>Create District</h5>
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
  <!--   <div class="form-group ">
      <label for="inputDistrict">District</label>
      <select class="form-control" id="inputDistrict"
       v-model="form.division_id" :class="errors.division_id ? 'is-invalid' : '' ">

        <option value="">Choose..</option>
        <option v-if="divisions.length" v-for="(division,index) in divisions" :key="index" :value="division.id">{{division.name}}</option>
      </select>

      <div class="text-danger" v-if="errors.division_id">
               <p v-for="error in errors.division_id">
                {{error}}
               </p>
             </div>
    </div> -->


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
    <button type="submit" class="btn btn-primary">{{editing? ' Save changes' : 'Create District'}}</button>
</div>
</form>
    </div>
  </div>
</div>

        <div class="row">
<div class="col-12">
<div class="card">
<div class="card-header">
<h3 class="card-title">Manage District</h3>
</div>


<district_table
:data="districts"
 :names="['#','Name','Bangla Name ','Url','Actions']"
 :fields="[{'name' : 'text'},{'bn_name' : 'text'},{'url':'text'},{'edit' : 'google.com' ,'delete' : 'test.com'}]"
 :buttons="['Areas']"
 :buttonLinks="['/manage/area/']"
 @edit-prop="editDistrict"
 @delete-prop="alert"
 />

</div>

</div>
</div>

    </div>
</template>



