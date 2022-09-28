<template>

    <div class="container text-monospace">
        <div class="text-monospace">

            <h1>
               {{place.name}}
            </h1>

            <div class="row">

                <p class="ml-3 "><i class="fas fa-star text-warning"></i>{{place.rating}}</p>
               <!--  <p class="ml-3">YO</p>
                <p class="ml-3">YO</p> -->


            </div>
        </div>


        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="https://images.unsplash.com/photo-1432958576632-8a39f6b97dc7?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ&s=6ecedc1e639d8a4b77aa8e85f4962f03" data-color="lightblue" alt="First Image">
      <div class="carousel-caption d-md-block">
        <h5>First Image</h5>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="https://images.unsplash.com/photo-1504736038806-94bd1115084e?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ&s=3d045bbf1ecc01c4c9ec011ce5c8977d" data-color="firebrick" alt="Second Image">
      <div class="carousel-caption d-md-block">
        <h5>Second Image</h5>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="https://images.unsplash.com/photo-1419064642531-e575728395f2?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ&s=76d5c793e4f8d02d7a9be27bc71256f7" data-color="violet" alt="Third Image">
      <div class="carousel-caption d-md-block">
        <h5>Third Image</h5>
      </div>
    </div>
  </div>
  <!-- Controls -->
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
<span class="carousel-control-prev-icon" aria-hidden="true"></span>
<span class="sr-only">Previous</span>
</a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
<span class="carousel-control-next-icon" aria-hidden="true"></span>
<span class="sr-only">Next</span>
</a>
</div>


<div class="row">
<div class="col-md-6">
    <div class="content">
    <h1>Host Name</h1>
    <small>available Room & People Per Room</small>
    <hr>

</div>

<div class="">
<h1>Features</h1>
<ul>
    {{place.features}}

</ul>
<hr>

</div>
<div class="">
    <h1>What this place offers</h1>
    <div class="row">

        <p class="col-md-6">
            <i class="fa fa-wifi"></i>
            Wifi
        </p>

        <p class="col-md-6">
            <i class="fa fa-wifi"></i>
            Wifi
        </p>
        <p class="col-md-6">
            <i class="fa fa-wifi"></i>
            Wifi
        </p>
        <p class="col-md-6">
            <i class="fa fa-wifi"></i>
            Wifi
        </p>
        <p class="col-md-6">
            <i class="fa fa-wifi"></i>
            Wifi
        </p>

    </div>
<hr>

</div>

<div class="">
<h1>Description</h1>
<ul>
    {{place.description}}

</ul>
<hr>

</div>

</div>
<div class="col-md-6">
    <div class="container ml-1">
  <div class="">
    <div class="">
      <div class="card text-center">
        <div class="card-header text-center border-bottom-0 bg-transparent text-success pt-4">
          <h5>Payment</h5>
        </div>
        <div class="card-body">
          <h1> ৳{{place.price}}</h1>
          <h5 class="text-muted"><small> per Day</small></h5>
        </div>
        <ul class="list-group list-group-flush">
            <div class="form-group">
    <label for="exampleInputEmail1">Date:</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">

  </div>

          <li class="list-group-item"><i class="fas fa-male text-success mx-2"></i>No Return</li>
          <li class="list-group-item"><i class="fas fa-venus text-success mx-2"></i>Pay only for what you will Get</li>
          <li class="list-group-item"><i class="fas fa-gavel text-success mx-2"></i> No  hidden fees</li>
        </ul>
        <div class="card-footer border-top-0 bg-warning">
          <a href="#" class=" text-uppercase">Book Now <i class="fas fa-arrow-right"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<!-- <div>User {{ $route.params.id }}</div> -->


    </div>
    </template>
    <script setup>
        import { onMounted } from 'vue';
        import {useRouter} from 'vue-router'
       import {UserStore} from '@/store/UserStore'
       import { PlaceStore } from '../store/place/PlaceStore';
        import {storeToRefs} from 'pinia'





            const router = new useRouter();
            const store = new UserStore();
            const {place} = storeToRefs(PlaceStore())
            const {fetchPlace} = PlaceStore()
            let currentUser;

            function logout(){
                store.removeToken();
                store.removeUser();
                router.push({name:'login'})
            }
            onMounted(()=>{

            /* window.axios.default.headers.common['Authorization'] = `Bearer ${store.getToken}` */
            /*  this.store.fetchCurrentUser(); */
           fetchPlace(1);
            })





    </script>
<style>
    .w-100{
        width: 100px;
        height: 70vh;
    }
</style>
