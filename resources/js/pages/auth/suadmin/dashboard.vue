<template>

    <div class="container">
       
    
    
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-xl-3">
                <div class="card bg-c-blue order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Orders Received</h6>
                        <h2 class="text-right"><i class="fa fa-cart-plus f-left"></i><span>486</span></h2>
                        <p class="m-b-0">Completed Orders<span class="f-right">351</span></p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 col-xl-3">
                <div class="card bg-c-green order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Orders Received</h6>
                        <h2 class="text-right"><i class="fa fa-rocket f-left"></i><span>486</span></h2>
                        <p class="m-b-0">Completed Orders<span class="f-right">351</span></p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 col-xl-3">
                <div class="card bg-c-yellow order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Orders Received</h6>
                        <h2 class="text-right"><i class="fa fa-refresh f-left"></i><span>486</span></h2>
                        <p class="m-b-0">Completed Orders<span class="f-right">351</span></p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 col-xl-3">
                <div class="card bg-c-pink order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Orders Received</h6>
                        <h2 class="text-right"><i class="fa fa-credit-card f-left"></i><span>486</span></h2>
                        <p class="m-b-0">Completed Orders<span class="f-right">351</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="btn-group border" role="group " aria-label="Basic example">
        <button type="button" class="btn btn-outline-danger waves-effect m-2 active"><i class="fas fa-map-marked-alt"></i>Place</button>
        <button type="button" class="btn btn-outline-danger waves-effect m-2"><i class="fas fa-bus"></i>Bus</button>
        <button type="button" class="btn btn-outline-danger waves-effect m-2 "><i class="fas fa-building"></i>Hotel</button>
      <button type="button" class="btn btn-outline-danger waves-effect m-2"><i class="fas fa-car fa-sm pr-2"
          aria-hidden="true"></i> Car</button>
      <button type="button" class="btn btn-outline-danger waves-effect m-2"><i class="fas fa-plane fa-sm pr-2"
          aria-hidden="true"></i>Plane</button>
      <button type="button" class="btn btn-outline-danger waves-effect m-2"><i class="fas fa-train fa-sm pr-2"
          aria-hidden="true"></i>Train</button>
          
    </div>
    <!-- old card -->
    <!-- <div class="container border">
        <div class="container-fluid">
        <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-horizontal">
                        <div class="img-square-wrapper">
                            <img class="" src="http://via.placeholder.com/300x180" alt="Card image cap">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Card title</h4>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Last updated 3 mins ago</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div> -->
    
    <!-- new -->
     <!-- {{bookings}}  -->
            
            <div class="card" > <!-- style="width: 680px;height: 290px;" -->
                <router-link :to="'/place/1'" class="row no-gutters my-1 border" v-for="(booking,index) in bookings" :key="index" v-if="bookings">
                   
                    
                    <div class="col-sm-5">
                       
                        <img class="card-img" 
                        :src="booking.feature_image ? '/image/place/feature/'+booking.feature_image : 'https://images.unsplash.com/photo-1587222318667-31212ce2828d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8Y294cyUyMGJhemFyfGVufDB8fDB8fA%3D%3D&w=1000&q=80'" alt="" style="height:290px">
                    </div>
                    <div class="col-sm-7 ">
                        <div class="card-body">
                            <h5 class="card-title">{{booking.name}}</h5>
                            <p class="card-text">{{booking.description}}</p>
                        </div>
                            <div class="container d-flex justify-content-between"> <!-- card-footer -->
                                <div>
    
                                    <p><b>17</b> per person*</p>
                                    <div class="pic">
                                        <i class="fas fa-star fa"></i>
                                        <i class="fas fa-star fa"></i>
                                        <i class="fas fa-star fa"></i>
                                        <i class="fas fa-star fa"></i>
                                        <i class="fas fa-star fa"></i>
                                        <p style="position: relative;left: 10px;top:-3px; color:black">28 reviews</p>
                                    </div>
                                    <p>{{booking.features}}</p>
                                    <h2>৳{{booking.price}}</h2>
                                    <h4 class="text-warning">Pending</h4>
                                </div>
                                <div>
    
                                    <a href="#" class="btn btn-outline-danger">Book Now</a>
                                </div>
                               
                            </div>
                           
                        
                    </div>
                </router-link>
                
            </div>
       
    
    
    
    
    <!-- {{getCurrentUser}} -->
    <!-- <button class="btn btn-danger" @click="logout">Logout</button> -->
    </div>
    </template>
    <script setup>
        import { onMounted,ref,watchEffect } from 'vue';
        import { storeToRefs } from 'pinia';
        import {useRouter} from 'vue-router'
       import {UserStore} from '@/store/UserStore'
        import axios from 'axios';
    
    
    
    
            let bookings = ref([])
            const router = new useRouter();
            const store = new UserStore();
            const {currentUser} = storeToRefs(UserStore())
            const {getCurrentUser} = UserStore()
    
    
           async function bookingapi(){
            await axios.get('/api/booking/1').then(res=>{
                if(res.data.success){
                    bookings.value = res.data.data
    
                    console.log(res.data.data)
                }
            })
            }
            function logout(){
                store.removeToken();
                store.removeUser();
                router.push({name:'login'})
            }
    
            watchEffect(()=>{
                bookingapi()
               })
            onMounted(async ()=>{
                await bookingapi()
            /* window.axios.default.headers.common['Authorization'] = `Bearer ${store.getToken}` */
            /*  this.store.fetchCurrentUser(); */
            /* axios.get('/api/user').then(res=>{
    
             console.log(res.data)
            }).catch((err)=>{
                console.log(err)
            }) */
            })
    
    
    
    
    
    
    </script>
    
    <style>
    /* old card style */
    /* .card-horizontal {
        display: flex;
        flex: 1 1 auto;
    } */
    /* end old card style */
    /* start new card style */
    .btn-card{
               position: relative;
               left:250px;
               top:-100px;
               background-color: darkmagenta;
               color:white;
               font-size: 1.3em;
           }
           .footer{
               background-color:#f2f2f2;
               position: relative;
               
           }
           .card{
               box-shadow: 0 2px 2px 2px black;
               position: relative;
               
    
           }
           
          .pic{
              color:green;
              font-size: 1em;
              display:flex;
          }
    /* end new card style */
    
    /* status cards style */
    body{
        margin-top:20px;
        background:#FAFAFA;
    }
    .order-card {
        color: #fff;
    }
    
    .bg-c-blue {
        background: linear-gradient(45deg,#4099ff,#73b4ff);
    }
    
    .bg-c-green {
        background: linear-gradient(45deg,#2ed8b6,#59e0c5);
    }
    
    .bg-c-yellow {
        background: linear-gradient(45deg,#FFB64D,#ffcb80);
    }
    
    .bg-c-pink {
        background: linear-gradient(45deg,#FF5370,#ff869a);
    }
    
    
    .card {
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
        box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
        border: none;
        margin-bottom: 30px;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
    }
    
    .card .card-block {
        padding: 25px;
    }
    
    .order-card i {
        font-size: 26px;
    }
    
    .f-left {
        float: left;
    }
    
    .f-right {
        float: right;
    }
    /* status cards style */
    </style>