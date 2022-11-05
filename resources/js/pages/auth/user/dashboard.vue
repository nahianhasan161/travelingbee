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
<!-- {{getCurrentUser}} -->
<h1>User</h1>
<div class="container">
  <div class="card-group vgr-cards m-5 p-1" v-for="booking in bookings">
    <div class="card">
      <div class="card-img-body">
      <img class="card-img" src="https://picsum.photos/500/230" alt="Card image cap">
      </div>
      <div class="card-body">
        <h4 class="card-title">{{booking.place.name}}</h4>
        <p class="card-text">{{booking.place.description}}</p>
        <div class="d-flex justify-content-between m-3">
            <p class="card-title">৳{{booking.place.price}}</p>
            <p class="card-text">{{booking.place.rating}}<i class="fas fa-star text-warning"></i></p>

        </div>
        <a @click="deleteBooking(booking.id)" class="btn btn-outline-danger">Cancle</a>
      </div>
    </div>
    </div>
    </div>


<button class="btn btn-danger" @click="logout">Logout</button>
</div>
</template>
<script setup>
    import { onMounted,ref } from 'vue';
    import { storeToRefs } from 'pinia';
    import {useRouter} from 'vue-router'
   import {UserStore} from '@/store/UserStore'
import axios from 'axios';


let bookings = ref([]);


        const router = new useRouter();
        const store = new UserStore();
        const {currentUser} = storeToRefs(UserStore())
        const {getCurrentUser} = UserStore()


        function deleteBooking($id){
            axios.delete('/api/booking/'+$id).then(res=>{
                console.log(res);
                fetchBooking()
            })
                
            
        }
        function fetchBooking($id){
            axios.get('/api/booking/'+getCurrentUser.user_id).then(res=>{
          if(res.data.success){
            bookings.value = res.data.data
          } 
         console.log(res.data)
        }).catch((err)=>{
            console.log(err)
        })
                
            
        }
        function logout(){
            store.removeToken();
            store.removeUser();
            router.push({name:'login'})
        }
        onMounted(()=>{

        /* window.axios.default.headers.common['Authorization'] = `Bearer ${store.getToken}` */
        /*  this.store.fetchCurrentUser(); */
        fetchBooking() 
        })






</script>

<style>

body {
  margin-top: 20px;
}


.card {
  border: none;
}
.card-img {
  border-radius: 0;
}


  .card {
    display: flex;
    flex-flow: wrap;
    flex: 100%;
    margin-bottom: 40px;

  /*   &:nth-child(even) .card-img-body {
      order: 2;
    }

    &:nth-child(even) .card-body {
      padding-left: 0;
      padding-right: 1.25rem; 
    } */
    
    @media (max-width: 576px) {
      display: block;
    }
    
  }

  .card-img-body {
    flex: 1;
    overflow: hidden;
    position: relative;
    
    @media (max-width: 576px) {
      width: 100%;
      height: 200px;
          margin-bottom: 20px;
    }
    
  }
  
  .card-img {
    width: 100%;
    height: auto;
    position: absolute;
    margin-left: 50%;
    transform: translateX(-50%);
    
    @media (max-width: 1140px) {
          margin: 0;
    transform: none;
    width: 100%;
    height: auto;
    }
    
  }

  .card-body {
    flex: 2;
    padding: 0 0 0 1.25rem;
    
    @media (max-width: 576px) {
      padding: 0;
    }
    
  }



</style>