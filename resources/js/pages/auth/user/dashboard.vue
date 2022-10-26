<template>

<div class="container">
    <div class="row">
<div class="col-lg-3 col-6">

<div class="small-box bg-info">
<div class="inner">
<h3>150</h3>
<p>New Orders</p>
</div>
<div class="icon">
<!-- <i class="ion ion-bag"></i> -->

<i class="fa fa-shopping-bag" aria-hidden="true"></i>
</div>
<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>

<div class="col-lg-3 col-6">

<div class="small-box bg-success">
<div class="inner">
<h3>53<sup style="font-size: 20px">%</sup></h3>
<p>Bounce Rate</p>
</div>
<div class="icon">
<i class="ion ion-stats-bars"></i>
</div>
<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>

<div class="col-lg-3 col-6">

<div class="small-box bg-warning">
<div class="inner">
<h3>44</h3>
<p>User Registrations</p>
</div>
<div class="icon">
<i class="ion ion-person-add"></i>
</div>
<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>

<div class="col-lg-3 col-6">

<div class="small-box bg-danger">
<div class="inner">
<h3>65</h3>
<p>Unique Visitors</p>
</div>
<div class="icon">
<i class="ion ion-pie-graph"></i>
</div>
<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>

</div>
{{getCurrentUser}}


<button class="btn btn-danger" @click="logout">Logout</button>
</div>
</template>
<script setup>
    import { onMounted } from 'vue';
    import { storeToRefs } from 'pinia';
    import {useRouter} from 'vue-router'
   import {UserStore} from '@/store/UserStore'
import axios from 'axios';





        const router = new useRouter();
        const store = new UserStore();
        const {currentUser} = storeToRefs(UserStore())
        const {getCurrentUser} = UserStore()


        function logout(){
            store.removeToken();
            store.removeUser();
            router.push({name:'login'})
        }
        onMounted(()=>{

        /* window.axios.default.headers.common['Authorization'] = `Bearer ${store.getToken}` */
        /*  this.store.fetchCurrentUser(); */
        /* axios.get('/api/user').then(res=>{

         console.log(res.data)
        }).catch((err)=>{
            console.log(err)
        }) */
        })






</script>

