<template>
    <div class="wrap">
        <div class="loader" v-if="loading"></div>
        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary my-3" @click="addUser"> <!-- data-toggle="modal" data-target="#exampleModalCenter" -->
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
    <div class="form-group ">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" :class="errors.email ? 'is-invalid' : '' " id="inputEmail4" placeholder="Email" v-model="form.email">
      <div class="text-danger" v-if="errors.email">
               <p v-for="error in errors.email">
                {{error}}
               </p>
             </div>
    </div>
    <div class="form-group " v-if="!editing">
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control" :class="errors.password ? 'is-invalid' : '' " id="inputPassword4" placeholder="Password" v-model="form.password">
      <div class="text-danger" v-if="errors.password">
               <p v-for="error in errors.password">
                {{error}}
               </p>
             </div>

    </div>
    <div class="form-group " v-if="!editing">
      <label for="inputPassword4">Confirm Password</label>
      <input type="password" class="form-control" :class="errors.password ? 'is-invalid' : '' " id="inputPassword4" placeholder="Password" v-model="form.password_confirmation">


    </div>
    <div class="form-group ">
      <label for="FormControlSelect">Role</label>
      <select v-model="form.role" class="form-control" id="FormControlSelect">
      <option default>Choose...</option>
      <option value="user">User</option>
      <option value="admin">Admin</option>
      <option value="suadmin">Super Admin</option>

    </select>

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
<h3 class="card-title">Manage Users</h3>
</div>

<div class="card-body table-responsive">
<table class="table table-bordered table-hover">
<thead>
<tr>
<th>#</th>
<th>Name</th>
<th>Email</th>
<th>Created</th>
<th>Role</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<tr v-for="(User,index) in allUser" :key="User.id">
    <td>{{index+1}}</td>
<td >{{User.name}}</td>
<td >{{User.email}}</td>
<td >{{User.created_at}}</td>
<td class="capital">{{User.roles[0]}}</td>
<td>
    <button class="btn btn-primary mr-3" @click="editUser(User)">


 <i class="far fa-edit"></i></button>
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

        import { UserStore } from '@/store/UserStore';

       import { useToastr } from '@/pages/toaster';

        const toastr = useToastr();

        const store = new UserStore();

        const {deleteUser} = UserStore();
        const {allUser,loading} = storeToRefs(UserStore());
        
        let users = ref(store.getAllUsers);
        const editing = ref(false);
        let editId = ref('')
        let form = reactive({
                name:'',
                email:'',
                password:'',
                password_confirmation:'',
                role:''
            });

            let errors = ref([]);
            const addUser = ()=>{
                editing.value = false
                $('#exampleModalCenter').modal('show');
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
                    form.email=''
                    form.password=''
                    form.password_confirmation=''
                    form.role=''
            }

            function editUser($user){  
                editing.value = true
                editId = $user.user_id
                /* form.value = $user; */

                /* toastr.success('success') */
                form.name =$user.name
                form.email =$user.email
                form.role =$user.roles[0]

                $('#exampleModalCenter').modal('show');
        }
            const register = async()=>{

                await axios.post('/api/register',form).then(res=>{
                   if(res.data.success){


                    store.fetchAllUser();

                    toastr.success('success')

                    $('#exampleModalCenter').modal('hide');
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
                axios.put('/api/user/'+editId,form).then(res=>{
                    store.fetchAllUser();
                    toastr.info('success')
                    $('#exampleModalCenter').modal('hide');
                }).finally(()=>{
                    resetForm()


                })
            }

            onMounted(()=>{
                store.fetchAllUser();


        });

    </script>

