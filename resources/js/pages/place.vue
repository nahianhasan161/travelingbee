<template>
 
         
       
    <div class="wrap" :class="loading? 'text-muted' : ''">
    <div class="container text-monospace" >
      <div class="loader" v-if="loading"></div>
        <div class="text-monospace">

            <h1>
            <!--  {{places.images}} -->
               {{places.name}}
               <!-- {{places.user}} -->
            </h1>

          <div class="row">
            <p class="card-text"><i class="fa fa-star star-rating"></i><i class="fa fa-star star-rating"></i><i class="fa fa-star star-rating"></i><i class="fa fa-star star-rating"></i><i class="fa fa-star star-rating"></i> </p>
          
            
                <!-- <br><p class="ml-3 "><i class="fas fa-star text-warning"></i>{{places.rating}}</p> -->
               <!--  <p class="ml-3">YO</p>
                <p class="ml-3">YO</p> -->


            </div>
            <a class="link">Chittagong,Bandorban</a>
        </div>

        <Suspense>
    <template #default>
        <div>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
 <!--  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol> -->
  <!-- Wrapper for slides -->
  <div class="carousel-inner">
 <!--    <div class="carousel-item active" >
  
      <img class="d-block w-100" src="data:image/jpeg;base64,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" data-color="lightblue" alt="First Image">
      
      <div class="carousel-caption d-md-block">
        
      </div>
    </div> -->
   
    <div  class="carousel-item " v-for="(image,count) in places.images" :key="image.id"  :class="count == 0 ? 'active' : '' ">
      
      <!--   {{image}} -->
      <!-- <img class="d-block w-100" src="data:image/jpeg;base64,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" data-color="lightblue" alt="First Image"> -->
      <img class="d-block w-100" :src="'/image/place/more/'+image.name" data-color="lightblue" alt="First Image">
      <div class="carousel-caption d-md-block">
        
      </div>
    </div>
  </div>
 <!--    <div class="carousel-item">
      <img class="d-block w-100" src="https://images.unsplash.com/photo-1587222318667-31212ce2828d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8Y294cyUyMGJhemFyfGVufDB8fDB8fA%3D%3D&w=1000&q=80" data-color="firebrick" alt="Second Image">
      <div class="carousel-caption d-md-block">
        
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="https://images.unsplash.com/photo-1419064642531-e575728395f2?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ&s=76d5c793e4f8d02d7a9be27bc71256f7" data-color="violet" alt="Third Image">
      <div class="carousel-caption d-md-block">
         <h5>Third Image</h5> 
      </div>
    </div> -->
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
</div>
    </template>
    <template #fallback>
        <div>
            loading...
        </div>
    </template>
 </Suspense>
<!-- {{places}} -->
<div class="row" @click="test">
<div class="col-md-6">
<!--   <div class="row content mt-1" v-if="places.user">
      <div>
        <img class="rounded-circle" :src="'/image/profile/'+places.user.image" alt="profile-img" width="40" height="40" srcset="">
        
      </div>
      <div>
        <h1>{{places.user.name}}</h1>
        <small>{{places.user.email}}</small>

      </div>
    <hr>

</div> -->
<div class="row content my-5" v-if="places.user">
<div class=" user-block">
<img class="profile-user-img img-fluid img-circle  img-bordered-lg" :src="places.user.image ?  '/image/profile/'+places.user.image : 'https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg'"  alt="User Image">
<span class="username">
<a >{{places.user? places.user.name : 'Anonymous'}}</a>

</span>
<span class="description">{{places.user ? places.user.email : 'not available'}}</span>
</div>
</div>


<div class="">
<h1>Features</h1>
<ul>
    {{places.features}}

</ul>
<hr>

</div>
<!-- <div class="">
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

</div> -->

<div class="">
<h1>Description</h1>
<ul>
    {{places.description}}

</ul>
<hr>

</div>

</div>
<div class="col-md-6" >
    <div class="container ml-1">
  
      <div class="card text-center">
        <div class="card-header text-center border-bottom-0 bg-transparent text-success pt-4">
          <h5>Payment</h5>
        </div>
        <div class="card-body">
          <h1> ৳{{places.price}}</h1>
          <h5 class="text-muted"><small> per Day</small></h5>
        </div>
        <ul class="list-group list-group-flush">
          <div class="form-group" v-if="currentUser ? currentUser.roles[0] == 'user' : false">
    <label for="InputDate">Date:</label>
    <picker v-model="form.date" :minDate="new Date(new Date().setDate(new Date().getDate()-1))" /> <!-- yestarday -->
    <!-- <input type="date" class="form-control" id="InputDate" aria-describedby="DateHelp" placeholder="Select Date" v-model="form.date" @change="validation" > -->
     
             <p class="text-danger" v-if="errors" v-for="error in errors" :key="error">
            <span v-for="err in error" :key="err">{{err}}</span>
            </p>
  </div>

          <li class="list-group-item"><i class="fas fa-male text-success mx-2"></i>No Return</li>
          <li class="list-group-item"><i class="fas fa-venus text-success mx-2"></i>Pay only for what you will Get</li>
          <li class="list-group-item"><i class="fas fa-gavel text-success mx-2"></i> No  hidden fees</li>
        </ul>
        <div class="card-footer border-top-0 bg-warning" v-if="currentUser ? currentUser.roles[0] == 'user' : false">
          <a class="btn text-uppercase" @click="createBooking(currentUser.user_id,places.id)">Book Now <i class="fas fa-arrow-right"></i></a>
        </div>
      <div v-show="form.date">

        <form method="POST" class="needs-validation" novalidate >
          
          <hr class="mb-4">
          
            <button  @click="sslcommerz()" class="btn btn-primary btn-lg btn-block" id="sslczPayBtn"
            token="if you have any token validation"
            postdata="your javascript arrays or objects which requires in backend"
            order="If you already have the transaction generated for current order"
            endpoint="http://localhost:8000/api/pay-via-ajax"> Book & Pay Now
          </button>
        </form>
      </div>
      </div>
 <!--   {{new Date().toLocaleString()}}
   {{form.date}} -->

  </div>
</div>
</div>

 <div class="container-fluid-review px-0 py-5 mx-auto">
<div class="row justify-content-center mx-0 mx-md-auto">
 <div class="col-lg-10 col-md-11 px-1 px-sm-2">
   <div class="card border-0 px-3">
     <!-- top row -->
     <div class="d-flex row py-5 px-5 bg-light">
       <div class="green-tab p-2 px-3 mx-2">
         <p class="sm-text mb-0">OVERALL RATING</p>
         <h4 >{{places.rating}}</h4>
       </div>
       <div class="white-tab p-2 mx-2 text-muted">
         <p class="sm-text mb-0">ALL REVIEWS</p>
         <h4>124</h4>
       </div>
       <div class="white-tab p-2 mx-2">
         <p class="sm-text mb-0 text-muted">POSITIVE REVIEWS</p>
         <h4 class="green-text">93%</h4>
       </div>
       <div class="ml-md-auto p-2 mx-md-2 pt-4 pt-md-3">
         <button class="btn btn-red px-4" @click="addReview()">WRITE A REVIEW</button>
       </div>
     </div>
     <!-- middle row -->
    <!--  <div class="row bg-light">
       <div class="col-md-2 col-4 text-center block py-5">
         <div class="round-icon">
           <img src="https://i.imgur.com/8lJt6UN.png" width="50px" height="50px">
         </div>
         <p class="sm-text-1 grey-text mb-0">100</p>
         <div class="fa fa-circle green-dot"></div>
         <div class="fa fa-circle green-dot"></div>
         <div class="fa fa-circle green-dot"></div>
         <div class="fa fa-circle green-dot"></div>
         <div class="fa fa-circle green-dot"></div>
       </div>
       <div class="col-md-2 col-4 text-center block py-5">
         <div class="round-icon">
           <img src="https://i.imgur.com/Grjnbah.png" width="50px" height="50px">
         </div>
         <p class="sm-text-1 grey-text mb-0">100</p>
         <div class="fa fa-circle red-dot"></div>
         <div class="fa fa-circle red-dot"></div>
         <div class="fa fa-circle"></div>
         <div class="fa fa-circle"></div>
         <div class="fa fa-circle"></div>
       </div>
       <div class="col-md-2 col-4 text-center block py-5">
         <div class="round-icon">
           <img src="https://i.imgur.com/q2v8mqu.png" width="50px" height="50px">
         </div>
         <p class="sm-text-1 grey-text mb-0">100</p>
         <div class="fa fa-circle yellow-dot"></div>
         <div class="fa fa-circle yellow-dot"></div>
         <div class="fa fa-circle yellow-dot"></div>
         <div class="fa fa-circle"></div>
         <div class="fa fa-circle"></div>
       </div>
       <div class="col-md-2 col-4 text-center block py-5">
         <div class="round-icon">
           <img src="https://i.imgur.com/EkmVVM1.png" width="50px" height="50px">
         </div>
         <p class="sm-text-1 grey-text mb-0">100</p>
         <div class="fa fa-circle"></div>
         <div class="fa fa-circle"></div>
         <div class="fa fa-circle"></div>
         <div class="fa fa-circle"></div>
         <div class="fa fa-circle"></div>
       </div>
       <div class="col-md-2 col-4 text-center block py-5">
         <div class="round-icon">
           <img src="https://i.imgur.com/ZbZzavI.png" width="50px" height="50px">
         </div>
         <p class="sm-text-1 grey-text mb-0">100</p>
         <div class="fa fa-circle"></div>
         <div class="fa fa-circle"></div>
         <div class="fa fa-circle"></div>
         <div class="fa fa-circle"></div>
         <div class="fa fa-circle"></div>
       </div>
       <div class="col-md-2 col-4 text-center block py-5">
         <div class="round-icon">
           <img src="https://i.imgur.com/S6SGKFQ.png" width="50px" height="50px">
         </div>
         <p class="sm-text-1 grey-text mb-0">100</p>
         <div class="fa fa-circle"></div>
         <div class="fa fa-circle"></div>
         <div class="fa fa-circle"></div>
         <div class="fa fa-circle"></div>
         <div class="fa fa-circle"></div>
       </div>
     </div> -->
     <!-- Review by user -->
     <div class="review p-5">
       <div class="row d-flex">
         <div class="profile-pic"><img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" width="60px" height="60px"></div>
         <div class="d-flex flex-column pl-3">
           <h4>Emily</h4>
           <p class="grey-text">30 min ago</p>
         </div>
       </div>
       <div class="row pb-3">
       
         <i class="fa fa-star star-rating"></i>
         <i class="fa fa-star star-rating"></i>
         <i class="fa fa-star star-rating"></i>
         <i class="fa fa-star star-rating"></i>
         <i class="fa fa-star star-rating"></i>
         <div class="green-text">
           <h5 class="mb-0 pl-3">Excellent</h5>
         </div>
       </div>
       <div class="row pb-3">
         <p>This dive center is incredibly well organized and is at the top of its game.</p>
       </div>
       <div class="row ml-1">
         <div class="row bg-light via">
           <div class="px-2"><img src="https://i.imgur.com/8lJt6UN.png" width="18px" height="18px"></div>
           <!-- <p class="grey-text mb-0 px-3">via Google</p> -->
         </div>
       </div>
     </div>
   </div>
 </div>
</div>
</div>
</div>

<!-- <div>User {{ $route.params.id }}</div> -->
<!-- Model -->
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
  <div class="form" v-if='currentUser'>
    <div class="form-group ">
      <label for="FormControlSelect">Rating <i class=" fa fa-star star-rating"></i></label>
      <select v-model="review.rating" class="form-control" :class="reviewErrors.rating ? 'is-invalid' : '' " id="FormControlSelect">
      <option default>Choose...</option>
      <option value="1">
        1<i class=" fa fa-star star-rating"></i>
      </option>
      <option value="2">
       2 <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star star-rating"></i>
      </option>
      <option value="3">
        3<i class="fa fa-star star-rating"></i><i class="fa fa-star star-rating"></i><i class="fa fa-star star-rating"></i>
      </option>
      <option value="4">
       4 <i class="fa fa-star star-rating"></i><i class="fa fa-star star-rating"></i><i class="fa fa-star star-rating"></i><i class="fa fa-star star-rating"></i>
      </option>
      <option value="5">
       5<i class="fa fa-star star-rating"></i><i class="fa fa-star star-rating"></i><i class="fa fa-star star-rating"></i><i class="fa fa-star star-rating"></i><i class="fa fa-star star-rating"></i>
      </option>

    </select>
    <div class="text-danger" v-if="reviewErrors.description">
               <p v-for="error in reviewErrors.description">
                {{error}}
               </p>
             </div>
    </div>
    <div class="form-group ">
      <label for="inputReview">Review</label>
      <textarea type="text" class="form-control" :class="reviewErrors.description ? 'is-invalid' : '' " id="inputReview" placeholder="Review" v-model="review.description" col="10" rows="5"></textarea>
      <div class="text-danger" v-if="reviewErrors.description">
               <p v-for="error in reviewErrors.description">
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

    </div>
    </template>
    <script setup>
    
        import { onMounted,reactive,watchEffect,ref } from 'vue';
        import {useRouter,useRoute} from 'vue-router'
       import {UserStore} from '@/store/UserStore'
       import { PlaceStore } from '../store/place/PlaceStore';
       import { useToastr } from '@/pages/toaster';
        import {storeToRefs} from 'pinia'
        import axios from 'axios';

            const toastr = useToastr();
            const router = new useRouter();
            const route = new useRoute();
            const store = new UserStore();
            const {places,placeId,loading} = storeToRefs(PlaceStore())
            const {fetchPlace,getPlaces} = PlaceStore()
            const {currentUser} = UserStore()
            /* let currentUser; */
            let currentPlaceID = ref('');
           let form = reactive({
            date:'',
            user_id:'',
            place_id:''
           })
           let review = reactive({
            date:'',
            user_id:'',
            place_id:''
           })
           let reviewErrors = ref([]);
           let errors = ref([]);
           var today = new Date();
           var isvalid =  reactive(false);
// Get year, month, and day part from the date
        var year = today.toLocaleString("default", { year: "numeric" });
        var month = today.toLocaleString("default", { month: "numeric" });
        var day = today.toLocaleString("default", { day: "2-digit" });
        // Generate custom date string
        var formattedTodayDate = [day, month, year].join("-");
          let editing = ref(false)
        const compareDates = (d1, d2) => {
        let date1 = new Date(d1).getTime();
      let date2 = new Date(d2).getTime();

          if(form.date){
            if (date1 < date2) {
              isvalid = false
            } else if (date1 > date2) {
              isvalid = true
            } else {
              isvalid = true
            }
            
        
          }
          else{
            isvalid = false
          }
          console.log(isvalid)
};
          function formAction(){
            if(editing.value){
                updateReview()
               }else{
                createReview()
               }
          }
          function createReview(){
            review.user_id = currentUser.user_id
            axios.post('/api/review/place/'+places.id,review).then(res=>{
              if(res.success){
                console.log(res)
              }else{
                console.log(res)

              }
            })
          }
           function formatDate(){
           
            let convert = form.date.split('-')
            let year = convert[0];
            let month = convert[1];
            let day = convert[2];
           var formattedDate = [day, month, year].join("-");
        /*    form.date = formattedDate */
           
            console.log(compareDates(formattedDate ,formattedTodayDate))
           
           }

            function formReset(){
                form.date = ''
                form.user_id = ''
                form.place_id = ''
            }
            function createBooking(uid,pid){
              form.user_id = uid,
              form.place_id = pid,
                console.log(form)
                axios.post('/api/booking',form).then(res=>{
                  if(res.data.success){
                    errors.value = []
                    toastr.success(res.data.message)
                  }else{
                   errors.value = res.data[0].data
                  toastr.error(res.data[0].message)
                  }
                })
                formReset()
            }
            function logout(){
                store.removeToken();
                store.removeUser();
                router.push({name:'login'})
            }
            const addReview = ()=>{
              
              $('#exampleModalCenter').modal('show');
            }
          async  function script(){
              
              ( function (window, document) {
        var loader =  function () {
            var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
            // script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR LIVE
              script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR SANDBOX
                tag.parentNode.insertBefore(script, tag);
        };

        window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
    })(window, document);
            }

            function test(){
             /*  console.log(places.value.price) */
            }
           function sslcommerz(){
           /* if(createBooking(currentUser.user_id,currentPlaceID)){ */

           
              var obj = {};
    obj.cus_name = currentUser.name;
    /* obj.cus_name = $('#customer_name').val(); */
    obj.cus_phone =/*  $('#mobile').val() */ '017132312132';
    /* obj.cus_email = $('#email').val(); */
    obj.user_id = currentUser.user_id;
    obj.place_id = currentPlaceID;
    obj.date = form.date;
    obj.cus_email = currentUser.email;
    obj.cus_addr1 = /* $('#address').val() */ 'Tongi,Gazipur';
    console.log('place')
    console.log(places.value.price)
    obj.amount = places.value.price;
    /* obj.amount = $('#total_amount').val(); */

    $('#sslczPayBtn').prop('postdata', obj);

    
  
            }

            watchEffect(async ()=>{
              await fetchPlace(currentPlaceID); 
              /* script()  */
             /*  console.log(places); */
            /*  console.log(ref.)   */
              
            })
           async function setID(id){
            currentPlaceID = id ;
            }
            onMounted(async ()=>{
             /*  console.log(formattedDate); */
              /* window.axios.default.headers.common['Authorization'] = `Bearer ${store.getToken}` */
              script()
              await router.isReady();
              setID(route.params.id)
            
            
          fetchPlace(currentPlaceID);
      
          /*  sslcommerz() */
          /*  console.log(places); */

          })







    </script>
<style>
    .w-100{
        width: 100px;
        height: 70vh;
    }

    /* review */
    body {
	overflow-x: hidden;
}

.container-fluid-review {
	background-image: linear-gradient(to right, #7B1FA2, #E91E63);
}

.sm-text {
	font-size: 10px;
	letter-spacing: 1px;
}

.sm-text-1 {
	font-size: 14px;
}

.green-tab {
	background-color: #00C853;
	color: #fff;
	border-radius: 5px;
	padding: 5px 3px 5px 3px;
}

.btn-red {
	background-color: #E64A19;
	color: #fff;
	border-radius: 20px;
	border: none;
	outline: none;
}

.btn-red:hover {
	background-color: #BF360C;
}

.btn-red:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    outline-width: 0
}

.round-icon {
	font-size: 40px;
	padding-bottom: 10px;
}

/*Styling for dots*/
.fa-circle {
	font-size: 10px;
	color: #EEEEEF;
}

.green-dot {
	color: #4CAF50;
}

.red-dot {
	color: #E64A19;
}

.yellow-dot {
	color: #FFD54F;
}

.grey-text {
	color: #BDBDBD;
}

.green-text {
	color: #4CAF50;
}

/*border for block*/
.block {
	border-right: 1px solid #F5EEEE;
	border-top: 1px solid #F5EEEE;
	border-bottom: 1px solid #F5EEEE;
}

.profile-pic img {
	border-radius: 50%;
}

.rating-dot {
	letter-spacing: 5px;
}

.via {
	border-radius: 20px;
	height: 28px;
}
</style>
