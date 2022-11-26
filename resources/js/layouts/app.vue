<template>



 <div class="wrapper">
<!-- Nav Bar -->
 <div >
    <div class="superNav border-bottom py-2 bg-light">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 centerOnMobile">
        <select  class="mr-3 border-0 bg-light">
          <option value="en-us">EN-US</option>
          <option value="en-us">BN-BD</option>
        </select>
        <span class="d-none d-lg-inline-block d-md-inline-block d-sm-inline-block d-xs-none mr-3"><strong>info@travelingbee.com</strong></span>
        <span class="mr-3"><i class="fas fa fa-phone mr-1 text-warning"></i> <strong>+8801918172343</strong></span>
      </div>
   <!--    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 d-none d-lg-block d-md-block-d-sm-block d-xs-none text-end ">
        <span class="mr-3"><i class="fas fa-truck text-muted "></i><a class="text-muted" href="#">Traveling</a></span>
        <span class="mr-3"><i class="fas fa-file  text-muted "></i><a class="text-muted" href="#">Policy</a></span>
      </div> -->
    </div>
  </div>
</div>
<nav class="navbar navbar-expand-lg bg-white sticky-top navbar-light p-3 shadow-sm">
  <div class="container">
  <router-link active-class="active" :to="{name:'welcome'}"  class="navbar-brand" >
      <i class=" fab fa-forumbee"></i><strong>Traveling Bee </strong>
</router-link>

  <!-- Mobile nav -->
    <button class="navbar-toggler"
    type="button"
     data-toggle="collapse"
      data-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown"
      aria-expanded="false"
        aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

   <!--  <div class="mx-auto my-3 d-lg-none d-sm-block d-xs-block">
      <div class="input-group">

        <input type="text" class="form-control border-warning" style="color:#7a7a7a">
        <button class="btn btn-warning text-white"><i class="fas fa-search"></i></button>
      </div>
    </div> -->
    <div class=" collapse navbar-collapse" id="navbarNavDropdown">
      <!-- <div class="ms-auto d-none d-lg-block">
        <div class="input-group">

          <input type="text" class="form-control border-warning" style="color:#7a7a7a">
          <button class="btn btn-warning text-white"><i class="fas fa-search"></i></button>
        </div>
      </div> -->
      <ul class="navbar-nav ms-auto ">

        <li class="nav-item">
          <router-link active-class="active" :to="{name:'dashboard'}"  class="nav-link mx-2 text-uppercase " >Home</router-link><!--  v-if="currentUser.roles[0] == 'User'" -->
         <!--  v-if="currentUser.roles[0] == 'User'" -->
          <!-- <router-link active-class="active" :to="{name:'admin_dashboard'}"  class="nav-link mx-2 text-uppercase " v-if="currentUser.roles[0] == 'Admin'">Home</router-link>
          <router-link active-class="active" :to="{name:'suadmin_dashboard'}"  class="nav-link mx-2 text-uppercase " v-if="currentUser.roles[0] == 'SuAdmin'">Home</router-link>
 -->
        </li>
        <li class="nav-item">
          <router-link class="nav-link mx-2 text-uppercase" :to="{name:'group-tour'}" ><i class="fa fa-users mr-1"></i>Group Tour</router-link>
        </li>
        <li class="nav-item">
            <router-link active-class="active" to="/posts" class="nav-link mx-2 text-uppercase" ><i class="fa fa-book mr-1"></i>Guide</router-link>
          </li>


        <li class="nav-item">
          <a class="nav-link mx-2 text-uppercase" href="#"><i class="fas fa-circle-info"></i>About</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto " v-if="!token">
        <li class="nav-item">

          <router-link active-class="active" to="/login" class="nav-link  text-uppercase" ><i class="fas fa-users mr-1" style="color:#2C6BF7" ></i> Login</router-link>
        </li>
        <li class="nav-item">

          <router-link active-class="active" to="/register" class="nav-link  text-uppercase" ><i class="fas fa-users mr-1" style="color:#5C26D6"  ></i> Signup</router-link>
        </li>
      </ul>


      <ul class="navbar-nav ms-auto " v-if="token">
        <li class="nav-item dropdown ">

        <a class="nav-link dropdown-toggle group-input" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img :src="'/image/profile/'+currentUser.image" width="40" height="40" class="rounded-circle" alt="profile_img" v-if="currentUser.image">

          <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" width="40" height="40" class="rounded-circle" alt="profile_img" v-else>
     <strong class="p-1 h3 text-dark text-bold">{{currentUser ? currentUser.name : 'Anonymous'}}</strong>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <router-link active-class="active" :to="{name:'dashboard'}" class="dropdown-item" ><i class="nav-icon fas fa-tachometer-alt mr-1"  ></i> Dashboard</router-link>
          <router-link active-class="active" :to="{name:'user_profile'}" class="dropdown-item" ><i class="fas fa-users mr-1"  ></i> Profile</router-link>

          <a class=" dropdown-item text-danger" @click="logout"><i class="fa fa-sign-out-alt"></i>Logout</a>
        </div>
    </li>

       <!--  <li class="nav-item">

        </li> -->
      </ul>

    </div>
  </div>

</nav>
<aside class="main-sidebar sidebar-dark-primary elevation-4" v-if="token">

<router-link active-class="active" :to="{name:'dashboard'}"  class="brand-link ml-3" >
    <i class="fab fa-forumbee "></i>
<!-- <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
<span class="brand-text font-weight-light">Traveling Bee</span>
</router-link>

<div class="sidebar">

<div class="user-panel mt-3 pb-3 mb-3 d-flex">
<div class="image">
  <img :src="'/image/profile/'+currentUser.image" class="img-circle elevation-2" alt="User Image" v-if="currentUser.image">

<!-- <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" width="40" height="40" class="rounded-circle" alt="profile_img" v-else> -->
<img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image" v-else>
</div>
<div class="info">
<a href="#" class="d-block">{{currentUser ? currentUser.name : 'Anonymous'}}</a>

<!-- {{JSON.parse(currentUser)}} -->
</div>
</div>



<nav class="mt-2">
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item " >


        <router-link active-class="active" :to="{name:'dashboard'}"  class="nav-link " >
            <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Home</p>
        </router-link>

</li>
<li class="nav-item " v-if="currentUser ? currentUser.email_verified == false : true">


<router-link active-class="active" :to="{name:'verify_email'}"  class="nav-link ">
    <i class="nav-icon fa fa-envelope"></i>
<p>Verify Mail </p>
</router-link>

</li>
<li class="nav-item"  v-if="currentUser ? currentUser.roles[0] == 'suadmin' : false">
<a href="#" class="nav-link " active-class="active">
<i class="nav-icon  fa fa-map-marker"></i>
<p >
Manage Places
<i class="right fas fa-angle-left"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li class="nav-item">
    <router-link active-class="active" :to="{name:'manage.place'}"  class="nav-link " >
        <i class="nav-icon fa fa-map-marker"></i>
        <p>Add Place</p>
        </router-link>


</li>
<li class="nav-item">
    <router-link active-class="active" :to="{name:'manage.group_tour'}"  class="nav-link " >
        <i class="nav-icon fa fa-map-marker"></i>
        <p>Add Group Tour</p>
        </router-link>


</li>


</ul>
</li>



<li class="nav-item "  v-if="currentUser ? currentUser.roles[0] == 'suadmin' : false">
<a href="#" class="nav-link " active-class="active">
<i class="nav-icon fas fa-tachometer-alt"></i>
<p >
More
<i class="right fas fa-angle-left"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li class="nav-item">
  <router-link active-class="active" :to="{name:'suadmin.place.category'}"  class="nav-link " >
            <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Category</p>
        </router-link>


</li>
<li class="nav-item "  v-if="currentUser ? currentUser.roles[0] == 'suadmin' : false">
<a href="#" class="nav-link " active-class="active">
<i class="nav-icon fa fa-globe"></i>
<p >
Address
<i class="right fas fa-angle-left"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li class="nav-item">
  <router-link active-class="active" :to="{name:'manage.division'}"  class="nav-link " >
            <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Division</p>
        </router-link>


</li>
<li class="nav-item">
  <router-link active-class="active" :to="{name:'manage.district'}"  class="nav-link " >
            <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>District</p>
        </router-link>


</li>
<li class="nav-item">
  <router-link active-class="active" :to="{name:'manage.area'}"  class="nav-link " >
            <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Area</p>
        </router-link>


</li>


</ul>
</li>

</ul>
</li>

<li class="nav-item"  v-if="currentUser ? currentUser.roles[0] == 'suadmin' : false">
<a href="#" class="nav-link " active-class="active">
<i class="nav-icon fas fa-tachometer-alt"></i>
<p >
Manage Users
<i class="right fas fa-angle-left"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li class="nav-item">
    <router-link active-class="active" :to="{name:'suadmin.manage.roles'}"  class="nav-link " >
        <i class="nav-icon fas fa-user-tag"></i>
    <p>Roles</p>
        </router-link>


</li>

<li class="nav-item">

    <router-link active-class="active" :to="{name:'suadmin.manage.user'}"  class="nav-link " >
        <i class="nav-icon fas fa-user-edit"></i>
        <p>All Users</p>

        </router-link>

</li>
</ul>
</li>


<li class="nav-item " @click="logout">
<a href="#" class="nav-link">

<i class="nav-icon fas fa-sign-out-alt text-danger"></i>
<p   class="text-danger">

    Logout
</p>
</a>
</li>
</ul>
</nav>

</div>

</aside>

<div :class="token? 'content-wrapper' : ''" >

<div class="content-header"  v-if="token">

<!-- <div class="container-fluid" >
<div class="row mb-2">
<div class="col-sm-6">
<h1 class="m-0">Starter Page</h1>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Starter Page</li>
</ol>
</div>
</div>
</div> -->
</div>

<section  class="content">

    <router-view></router-view>
</section>


</div>


</div>



<aside class="control-sidebar control-sidebar-dark">

    <div class="p-3">
<h5>Title</h5>
<p>Sidebar content</p>
</div>
</aside>


<footer class="main-footer">

    <div class="float-right d-none d-sm-inline">

        Anything you want
    </div>

    <strong>Copyright &copy; 2022.</strong> All rights reserved.
</footer>


<!-- <h1 class="text-center">{{token}}</h1> -->



<!-- <router-view v-slot="{ Component }">

    <transition name="fade" mode="out-in" appear>

        <component :is="Component"/>
    </transition> -->
</div>




</template>
<script setup>
    import {ref,onMounted} from 'vue';
    import { useRouter } from 'vue-router';
    import {UserStore} from '@/store/UserStore'
    import { storeToRefs } from 'pinia';
    /* mapState, */



            const store = new UserStore();
            const router = new useRouter();
            const {currentUser,token} = storeToRefs(UserStore());
            function logout(){
            store.removeToken();
            store.removeUser();
            router.push({name:'login'})

        }


       onMounted(()=>{
            /* window.axios.default.headers.common['Authorization'] = `Bearer ${store.getToken}` */
            /*  this.store.fetchCurrentUser(); */
           /*  axios.get('/api/user').then(res=>{ */

                /* console.log(res.data) */
         /*    }).catch((err)=>{
                console.log(err);
            }) */
        })
          /*   ...mapState(UserStore,['token'])

        }) */

</script>

<style>
  .fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
a {
  font-size:14px;
  font-weight:700
}
.superNav {
  font-size:13px;
}
.form-control {
  outline:none !important;
  box-shadow: none !important;
}
@media screen and (max-width:540px){
  .centerOnMobile {
    text-align:center
  }
}
</style>
