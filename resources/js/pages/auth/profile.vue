<template>
  
  <div class="row">
<div class="col-md-3">

<div class="card card-primary card-outline">
<div class="card-body box-profile">
<div class="text-center">
<img class="profile-user-img img-fluid img-circle" src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" alt="User profile picture">
</div>
<h3 class="profile-username text-center">{{currentUser.name}}</h3>
<p class="text-muted text-center">{{currentUser.email}}</p>
<ul class="list-group list-group-unbordered mb-3">
<li class="list-group-item">
<b>Role</b> <a class="float-right" v-for="role in currentUser.roles">|{{role}} |</a>
 
</li>


</ul>
<router-link active-class="active" :to="{name:'verify_email'}"  class="btn btn-primary btn-block" v-if="currentUser ? currentUser.email_verified == false : true">
            <i class="nav-icon fa fa-envelope mr-1"></i>
        <b>Verify Mail </b>
        </router-link>
<router-link active-class="active" :to="{name:'verify_email'}"  class="btn btn-success btn-block disabled" v-if="currentUser ? currentUser.email_verified == true : false">
            <i class="nav-icon fa fa-envelope mr-1"></i>
        <b> Mail Verified</b>
        </router-link>

</div>

</div>




</div>

<div class="col-md-9">
<div class="card">
<div class="card-header p-2">
<ul class="nav nav-pills">

<li class="nav-item"><a class="nav-link active" >Edit</a></li>

</ul>
</div>
<div class="card-body">
<div class="tab-content">

<div class="tab-pane active" id="settings">
<form class="form-horizontal">
<div class="form-group row">
<label for="inputName" class="col-sm-2 col-form-label">Name</label>
<div class="col-sm-10">
<input type="email" class="form-control" id="inputName" placeholder="Name">
</div>
</div>
<div class="form-group row">
<label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
<div class="col-sm-10">
<input type="email" class="form-control" id="inputEmail" placeholder="Email">
</div>
</div>
<div class="form-group row">
<label for="inputName2" class="col-sm-2 col-form-label">Role</label>
<div class="col-sm-10">
<input type="text" class="form-control " id="inputRole" placeholder="Role" disabled>
</div>

</div>
<div class="form-group row">
<label for="inputPhoto" class="col-sm-2 col-form-label">Photo</label>
<div class="col-sm-10">
    <div class="col-sm-10">
<input type="file" class="form-control-file " id="inputPhoto" placeholder="Photo">
</div>
</div>

</div>


<div class="form-group row">
<div class="offset-sm-2 col-sm-10">
<button type="submit" class="btn btn-danger">Submit</button>
</div>
</div>
</form>
</div>




</div>

</div>
</div>

</div>

</div>
    </template>
    
    <script setup>
    
        import axios from 'axios';
    import {reactive,ref,onMounted} from 'vue';
    import { useRouter } from 'vue-router';
    import {UserStore } from '@/store/UserStore';
  
    import { useToastr } from '@/pages/toaster.js';
    
      
     
      
            const toaster = useToastr();
            const router = new useRouter();
            const store = new UserStore();
            const {token,currentUser,fetchCurrentUser} = UserStore();
            let verifyUrl;
            let errmsg = ref('');
            
           onMounted(()=>{
            axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
            verifyUrl = router.currentRoute.value.query ? router.currentRoute.value.query.email_verify_url : '';
            if(verifyUrl){
              axios.post(verifyUrl).then(res=>{
                if(res.status == 200 ){
                /*   if(res.data.message == 'Email has been verified') { */
                    fetchCurrentUser()
                  /* }  */
                  toaster.success(res.data.message)
  
                  console.log(res);
                }
              });
            }
           console.log( verifyUrl) 
        
          }) 
  
  
            let form = reactive({
                email:'',
                password:'',
            });
            let errors = ref([]);
           
        
    
    
    </script>
    <style>
    
    .gradient-custom {
    /* fallback for old browsers */
    background: #6a11cb;
    
    /* Chrome 10-25, Safari 5.1-6 */
    background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));
    
    /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
    }
    
    </style>
    