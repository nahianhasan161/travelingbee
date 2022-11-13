<template>
    <div class="wrap">
        <div class="loader" v-if="loading"></div>
        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary my-3" @click="addRole"> <!-- data-toggle="modal" data-target="#exampleModalCenter" -->
  Create User
</button >

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <form @submit.prevent="formAction">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle" v-if="editing">Edit User</h5>
        <h5 class="modal-title" id="exampleModalLongTitle" v-else>Create User</h5>
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
<h3 class="card-title">Manage Roles</h3>
</div>

<div class="card-body table-responsive">
<table class="table table-bordered table-hover">
<thead>
<tr>
<th>#</th>
<th>Name</th>
<th>Guard</th>
<th>Created</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
   <!--  {{roles}} -->
    <tr v-for="(role,index) in roles" :key="role.id">
    <td>{{index+1}}</td>
<td >{{role.name}}</td>
<td >{{role.guard_name}}</td>
<td >{{role.created_at}}</td>

<td>
    <button class="btn btn-primary mr-3" ><!--  @click="editUser(User)" -->


 <i class="far fa-edit"></i></button>
    <button class="btn btn-danger" @click="deleteRole(role.id)"><i class="fas fa-trash"></i></button>
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

        import {RoleStore} from '@/store/RoleStore';
        
       import { useToastr } from '@/pages/toaster';
        const toastr = useToastr();
        const store = new RoleStore();
        const {fetchRoles,deleteRole,createRole} = RoleStore();
        const {roles,loading} = storeToRefs(RoleStore());
        let Roles = ref(store.getRoles);
        const editing = ref(false);
        let editId = ref('')
        let form = reactive({
                name:'',

            });

            let errors = ref([]);
            const addRole = ()=>{
                editing.value = false
                $('#exampleModalCenter').modal('show');
            }
            const formAction =()=>{
               if(editing.value){
                updateRole()
               }else{
                createRole(form)
               }
              /*  console.log(editing.value); */
            }
            const resetForm = ()=>{
                    form.name =''

            }

         /*    function editUser($user){
                editing.value = true
                editId = $user.user_id

                form.name =$user.name
                form.email =$user.email
                form.role =$user.roles[0]

                $('#exampleModalCenter').modal('show');
        } */
           /*  const register = async()=>{

                await axios.post('/api/register',form).then(res=>{
                   if(res.data.success){


                    store.fetchAllUser();

                    toastr.success('success')

                    $('#exampleModalCenter').modal('hide');
                    this.resetForm()

                    }else{
                        errors.value = res.data[0].data

                    }
                }).catch(e=>{
                    toastr.error(e.response.data)
                    errors.value = e.response.data
                })

                console.log('finally');
            } */
            /* function updateUser(){
                axios.put('/api/user/'+editId,form).then(res=>{
                    store.fetchAllUser();
                    toastr.info('success')
                    $('#exampleModalCenter').modal('hide');
                }).finally(()=>{
                    this.resetForm()


                })
            } */

            onMounted(()=>{
                fetchRoles()


        });

    </script>
