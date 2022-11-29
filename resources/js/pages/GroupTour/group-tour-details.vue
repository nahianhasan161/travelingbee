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


    <div  class="carousel-item " v-for="(image,count) in places.images" :key="image.id"  :class="count == 0 ? 'active' : '' ">

      <!--   {{image}} -->

      <img class="d-block w-100" :src="'/image/place/more/'+image.name" data-color="lightblue" alt="First Image">
      <div class="carousel-caption d-md-block">

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
          <div class="form-group" v-if="currentUser  ? currentUser.roles[0] == 'user' : false">
    <label for="InputDate">Date:</label>
    <picker modelType="dd-MM-yyyy"

    :state="errors.date ? false : true" v-model="form.date"
    :minDate="new Date(new Date().setDate(new Date().getDate()-1))"
    :highlight="bookedDates"
    :disabledDates="bookedDates"
                highlightDisabledDays
     />
    <!-- <input type="date" class="form-control" id="InputDate" aria-describedby="DateHelp" placeholder="Select Date" v-model="form.date" @change="validation" > -->

             <p class="text-danger" v-if="errors" v-for="error in errors" :key="error">
            <span v-for="err in error" :key="err">{{err}}</span>
            </p>
  </div>

          <li class="list-group-item"><i class="fas fa-male text-success mx-2"></i>No Return</li>
          <li class="list-group-item"><i class="fas fa-venus text-success mx-2"></i>Pay only for what you will Get</li>
          <li class="list-group-item"><i class="fas fa-gavel text-success mx-2"></i> No  hidden fees</li>
        </ul>
        <div class="card-footer border-top-0 bg-warning" v-if="currentUser  ? currentUser.roles[0] == 'user' : false">
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
       <!--  {{currentUserReview? 'true' : false}} -->
         <button class="btn btn-red px-4" @click="addReview()" v-if="(currentUser ? !currentUser.length : false) && (currentUserReview ? false : true )">WRITE A REVIEW</button>
       </div>
     </div>
     <!-- middle row -->
    <!--  <div class="row bg-light">
       <div class="col-md-2 col-4 text-center block py-5">
         <div class="round-icon">
           <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" width="50px" height="50px">
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
     <!-- {{currentUserReview}} -->
     <h5 class="text-center text-success">Your Review</h5>
     <hr>
     <div class="review p-5"   v-if="currentUserReview ? (currentUserReview.length == null ? true : currentUserReview.length) : false">
       <div class="row d-flex">
         <div class="profile-pic">
            <img name="profile-pic"  class="profile-user-img img-fluid img-circle img-bordered-lg" :src="currentUserReview.user.image ? '/image/profile/'+ currentUserReview.user.image :  'https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg'" alt="profile_img">

        </div>

         <div class="d-flex flex-column pl-3">

           <h4>{{currentUserReview.user.name}}</h4>
           <p class="grey-text">30 min ago</p>
         </div>
         <div class="ml-auto">

<button class="btn btn-warning m-1" @click="editReview(currentUserReview)"><i class="fa fa-pen" ></i></button>
<button class="btn btn-danger m-1"  @click="deleteReview(currentUserReview.id)"><i class="fa fa-trash"></i></button>
</div>
       </div>
       <div class="row pb-3">

         <i class="fa fa-star star-rating" v-for="index in currentUserReview.rating" :key="index" ></i> <!-- :class="form.rating? (index <= form.rating ? 'star-rating' : '') : '' "  -->

         <div class="green-text" v-if="currentUserReview.rating > 3">
           <h5 class="mb-0 pl-3">Excellent</h5>
         </div>
         <div class="text-danger" v-else>
           <h5 class="mb-0 pl-3">Poor</h5>
         </div>
       </div>
       <div class="row pb-3">
         <p>{{currentUserReview.description}}</p>

       </div>
       <div class="row ml-1">
         <div class="row bg-light via">
           <div class="px-2"><img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" width="18px" height="18px"></div>

           <!-- <p class="grey-text mb-0 px-3">via Google</p> -->
         </div>
       </div>
     </div>
     <hr>
     <h5 class="text-center text-success">All Reviews</h5>
     <hr>

     <div class="review p-5" v-for="(rev,index) in reviews" :key="rev" v-if="reviews.length">
       <div class="row d-flex">
         <div class="profile-pic">
            <img name="profile-pic"  class="profile-user-img img-fluid img-circle img-bordered-lg" :src="rev.user.image? '/image/profile/'+ rev.user.image :  'https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg'" alt="profile_img">
        </div>
         <div class="d-flex flex-column pl-3">
           <h4>{{rev.user.name}}</h4>
           <p class="grey-text">30 min ago</p>
         </div>
       </div>
       <div class="row pb-3">

         <i class="fa fa-star star-rating" v-for="index in rev.rating" :key="index" ></i> <!-- :class="form.rating? (index <= form.rating ? 'star-rating' : '') : '' "  -->

         <div class="green-text" v-if="rev.rating > 3">
           <h5 class="mb-0 pl-3">Excellent</h5>
         </div>
         <div class="text-danger" v-else>
           <h5 class="mb-0 pl-3">Poor</h5>
         </div>
       </div>
       <div class="row pb-3">
         <p>{{rev.description}}</p>
       </div>
       <div class="row ml-1">
         <div class="row bg-light via">
           <div class="px-2"><img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" width="18px" height="18px"></div>
           <!-- <p class="grey-text mb-0 px-3">via Google</p> -->
         </div>
       </div>
     </div>

   </div>
 </div>
</div>
</div>
</div>
<!-- {{review}} -->
<!-- <div>User {{ $route.params.id }}</div> -->
<!-- Model -->
<div class="modal fade" id="ModalCenter" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <form @submit.prevent="formAction">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle" v-if="editing">Edit User</h5>
        <h5 class="modal-title" id="exampleModalLongTitle" v-else>Your Review </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  <div class="form" v-if='currentUser'>


    <inputRating
v-model:rating="review.rating"
v-model:errors="reviewErrors.rating"
 />

    <div class="form-group ">
      <label for="inputReview">Review</label>
      <textarea type="text" class="form-control" :class="reviewErrors.description ? 'is-invalid' : '' " id="inputReview" placeholder="Review"
      v-model="review.description" col="10" rows="5"></textarea>
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
  <!--   <script>
    export default{
        mounted(){
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
    }
</script> -->
    <script setup>

        import { onMounted,reactive,watchEffect,ref } from 'vue';
        import {useRouter,useRoute} from 'vue-router'
        import {UserStore} from '@/store/UserStore'
        import { PlaceStore } from '@/store/place/PlaceStore';
        import { useToastr } from '@/pages/toaster';
        import {storeToRefs} from 'pinia'
        import axios from 'axios';
        import { GroupTourStore } from '@/store/grouptour/GroupTour';
        import inputRating from '@/pages/component/input/inputRating.vue'
        import addDays from 'date-fns/addDays';
            const toastr = useToastr();
            const router = new useRouter();
            const route = new useRoute();
            const store = new UserStore();
            const {grouptours} = storeToRefs(GroupTourStore())
            const {places,placeId,loading} = storeToRefs(PlaceStore())
            const {fetchPlace,getPlaces} = PlaceStore()
            const {fetchGroupTour,getGroupTour} = GroupTourStore()
            const {currentUser} = UserStore()
            /* let currentUser; */
            let currentPlaceID = ref('');
            let currentUserReview = ref([]);
           let form = ref({
            date:'',
            user_id:'',
            place_id:''
           })
          /*  let rating = reactive('') */
           let reviews = ref('')
           let review = reactive({
            rating:'',
            description:'',
            user_id:'',

           })
           let bookedDates = ref([
            addDays(new Date(), 0),
        ])
           let reviewErrors = ref([]);

           let errors = ref([]);
           var today = new Date();
           var isvalid =  ref(false);
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


        /* Date */

        function formatDate(){

            let convert = form.date.split('-')
            let year = convert[0];
            let month = convert[1];
            let day = convert[2];
            var formattedDate = [day, month, year].join("-");


            console.log(compareDates(formattedDate ,formattedTodayDate))

            }
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
                /* Review */

                function getReviews(placeID){
                    if(currentUser){
                        axios.get('/api/review/'+placeID+'?user_id='+currentUser.user_id).then(res=>{
                            console.log('getRs')

               if(res.data.success){
                   console.log(res)
                reviews.value = res.data.data
                currentUserReview.value = reviews.value.find(review=>review.user.id == currentUser.user_id)
                /*  let index = reviews.value.findIndex(review=>review.user.id == currentUser.user_id)
                 reviews.splice(index,1)
                 console.log(reviews) */

                /* reviews.value.splice(index,1); */
                console.log(res)
            }else{
                console.log(res)

                reviewErrors.value = res.data[0].data

            }
            console.log(res.data.data)
           /*  reviews = res.data */
            });
        }

                        axios.get('/api/review/'+placeID).then(res=>{




                        console.log('getRs')

               if(res.data.success){
                   console.log(res)
                reviews.value = res.data.data
                console.log(res)
            }else{
                console.log(res)

                reviewErrors.value = res.data[0].data

            }
            console.log(res.data.data)
           /*  reviews = res.data */
            });

                }
                const addReview = ()=>{

                $('#ModalCenter').modal('show');
                }
          function formAction(){
            if(editing.value){
                updateReview()
               }else{
                createReview(currentUser.user_id,places.value.id)
               }
          }

       /*    function inputRating(rating){
            console.log(rating)

            review.rating = rating
          } */
          function createReview(userID,placeID){
            review.user_id = userID
            axios.post('/api/review/place/'+placeID,review).then(res=>{

              if(res.data.success){
                  $('#ModalCenter').modal('hide');
                toastr.success(res.data.message)
              }else{
               /*  console.log(res.data[0]) */
                reviewErrors.value = res.data[0].data

              }
            })
          }
          function deleteReview(id){
            axios.delete('/api/review/'+id).then(res=>{
                if(res.data.success){
                    toastr.success(res.data.message);
                    getReviews(currentPlaceID)
                }else{
                    toastr.error('fail to delete the review');
                    console.log(res)
                }
            })
          }
          function editReview(review){
            editing.value = true
          }

           /* End Reviews */
           /* Resets */
            function formReview(){
                review.rating = ''
                review.description = ''
                review.user_id = ''
                review.place_id = ''
            }
            function formReset(){
                form.date = ''
                form.user_id = ''
                form.place_id = ''
            }
            /* Bookings */
            function createBooking(uid,pid){
              form.user_id = uid,
              form.place_id = pid,
                console.log(form)
                axios.post('/api/booking',{user_id:form.user_id,place_id:form.place_id,date:form.value.date}).then(res=>{
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
            /* User Logout */
            function logout(){
                store.removeToken();
                store.removeUser();
                router.push({name:'login'})
            }

            /* ssl */
          async  function script(){
              // script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR LIVE

              ( function (window, document) {
        var loader =  function () {
            var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
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
    obj.date = form.value.date;
    obj.cus_email = currentUser.email;
    obj.cus_addr1 = /* $('#address').val() */ 'Tongi,Gazipur';
    console.log(places.value.price)
    obj.amount = places.value.price;
    /* obj.amount = $('#total_amount').val(); */
    console.log(obj)
    console.log(form)

    $('#sslczPayBtn').prop('postdata', obj);



            }
            function getBookedDates(){
            console.log('places')
            console.log(places.value.bookings)
           }


            watchEffect(async ()=>{
              await fetchPlace(currentPlaceID);
              await fetchGroupTour(currentPlaceID);
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
                getReviews(currentPlaceID);
                getBookedDates()
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
