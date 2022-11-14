<template>
    <div class="wrap">
        <!-- {{bookings}} -->
        <div class="loader" v-if="loading"></div>

        


        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary my-3" @click="addDivision"> 
  Create Division
</button > 

<!-- Modal -->
<div class="modal fade" id="ModalCenter" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form @submit.prevent="formAction">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle" v-if="editing">Edit Division</h5>
        <h5 class="modal-title" id="exampleModalLongTitle" v-else>Create Division</h5>
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
    <button type="submit" class="btn btn-primary">{{editing? ' Save changes' : 'Create User'}}</button>
</div>
</form>
    </div>
  </div>
</div>

        <div class="row">
<div class="col-12">
<div class="card">
<div class="card-header">
<h3 class="card-title">Manage Division</h3>
</div>

<div class="card-body table-responsive">
<table class="table table-bordered table-hover">
<thead>
<tr>
<th>#</th>
<th>Name</th>
<th>Bangla Name </th>
<th>Url</th>

<th>Actions</th>
</tr>
</thead>
<tbody>

<tr v-for="(division,index) in divisions" :key="division.id">
    <td>{{index+1}}</td>
<td >{{division.name}}</td>
<td >{{division.bn_name}}</td>

<td class="capital">{{division.url}}</td>
<td>
    



 <button class="btn btn-info mr-1" @click="editDivision(division)"><i class="far fa-edit"></i></button>
    <button class="btn btn-danger" @click="deleteUser(User.user_id)"><i class="fas fa-trash"></i></button>
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
        import { useRouter,useRoute } from 'vue-router';
        import { UserStore } from '@/store/UserStore';

        import { useToastr } from '@/pages/toaster';
       
        const toastr = useToastr();

        const store = new UserStore();
        const router = new useRouter();
        const route = new useRoute();

        const {deleteUser} = UserStore();
        const {allUser,loading} = storeToRefs(UserStore());
        
        let users = ref(store.getAllUsers);
        const editing = ref(false);
        let divisions = ref([])
        let editId = ref('')
        let form = reactive({
                name:'',
                bn_name:'',
                url:'',
              
            });

            let errors = ref([]);
            let orders = ref([]);
            const addDivision = ()=>{
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
                    form.bn_name=''
                    form.url=''
            }

            function editDivision($division){  
                editing.value = true
                editId = $division.id
                /* form.value = $user; */

                /* toastr.success('success') */
                form.name =$division.name
                form.bn_name =$division.bn_name
                form.url =$division.url

                $('#ModalCenter').modal('show');
        }
            const register = async()=>{

                await axios.post('/api/address/division',form).then(res=>{
                   if(res.data.success){


                   

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
                axios.put('/api/address/division/'+editId,form).then(res=>{
                    store.fetchAllUser();
                    toastr.info('success')
                    $('#ModalCenter').modal('hide');
                }).finally(()=>{
                    resetForm()


                })
            }
            function allDivision(){
                axios.get('/api/address/division').then(res=>{
                    divisions.value = res.data.data
                })
            }
            function getOrdersByBooking(id){

$('#ModalCenter').modal('show');

axios.get('/api/orders/'+id).then(res=>{
   orders.value = res.data.data
})
}
            function showPayments(bookingID){
            $('#ModalCenter').modal('show');
        }
    function invoice(id){
        $('#ModalCenter').modal('hide');
        router.push('/payment/invoice/'+id)
    }

            onMounted(()=>{
                store.fetchAllUser();
                allDivision()

        });

    </script>

