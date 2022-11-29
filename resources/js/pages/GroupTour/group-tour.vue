


<script setup>
    import { onMounted,watchEffect,ref } from 'vue';
    import {useRouter} from 'vue-router'
    import { UserStore } from '@/store/UserStore';
   import { GroupTourStore } from '@/store/grouptour/GroupTour';
   import { storeToRefs } from 'pinia';

   import { useToastr } from '@/pages/toaster';
    import axios from 'axios';




    const router = new useRouter();

        const toastr = new useToastr();
        const store = new UserStore();
        const {grouptours,categories,loading} = storeToRefs(GroupTourStore())
        const {fetchGroupTours,fetchCategories,getGroupTours} = GroupTourStore();
        let categoryName = ref('')

        function formatDate(){

let convert = Date().split('-')
let year = convert[0];
let month = convert[1];
let day = convert[2];
var formattedDate = [day, month, year].join("-");


    return formattedDate;

}


        function setCategoryName(name){

         categoryName.value == name ?  categoryName.value = '' :  categoryName.value = name
           filteredGroupTours()

        }
       function filteredGroupTours(){
           if(categoryName.value){
               let alter =  grouptours.value.filter(grouptour => grouptour.category.name == categoryName.value)


               /* console.log(alter.length? alter : 'no') */
               return alter
            }else{
                return grouptours.value
            }

        }

        function logout(){
            store.removeToken();
            store.removeUser();
            router.push({name:'login'})
        }
        function categorySlider(){
            $('.toggle').click(function(){
$('.nav-fill').toggleClass("justify-content-end");
$('.toggle').toggleClass("text-light");
});
        }

       watchEffect(async ()=>{
       })
    onMounted(async ()=>{

        await fetchGroupTours()
       await fetchCategories()
          categorySlider()
       /*   createTour() */


})
        /* window.axios.default.headers.common['Authorization'] = `Bearer ${store.getToken}` */
        /*  this.store.fetchCurrentUser(); */
      /*   axios.get('/api/user').then(res=>{

        }).catch((err)=>{
            console.log(err);

  /*   }) */


</script>

<template>

    <div class="container">
        {{filteredGroupTours()}}
<!-- <modal/> -->
<div class="loader" v-if="loading"></div>
<!-- <button class="btn btn-primary" @click="createTour()">Click here</button> -->
    <div class="d-flex align-items-center">
        <div class="flex-shrink-0">
            <a href="#" class="btn-left btn-link p-2 toggle text-dark"><i class="fa fa-arrow-left"></i></a>
        </div>
        <div class="flex-grow-1  o-hidden">
            <ul class="nav nav-fill text-uppercase small position-relative flex-nowrap">
                <li class="nav-item" v-for="category in categories">
                  <a  @click="setCategoryName(category.name)" class="btn btn-outline-danger btn-rounded  " :class="category.name == categoryName ? 'active' : ''">{{category.name}}</a><!--  mr-md-3 mb-md-0 -->
                </li>

            </ul>
        </div>
        <div class="flex-shrink-0">
            <a href="#" class="btn-right btn-link toggle p-2 text-dark"><i class="fa fa-arrow-right"></i></a>
        </div>
    </div>
    <button class="btn btn-sm btn-outline-info btn-rounded "  @click="categoryName = ''" v-if="categoryName"> <i class="fa fa-times"></i> {{categoryName}}</button>
    <div class="container d-flex justify-content-center mt-5" >
        <h1 class="text-danger text-center" v-if="!filteredGroupTours().length">No Record Found</h1>
        <div class="row" v-if="filteredGroupTours().length">
           <!--  <Suspense>
                <template #default>

            </template>
            <template #fallback>
                Product is loading...
            </template>
        </Suspense> -->
            <div  :class="(filteredGroupTours().length == 1 ? 'col-md-12' : (filteredGroupTours().length == 2 ? 'col-md-6' : 'col-md-4'))"  v-for="place in filteredGroupTours()" @click="setPlaceId(place.id)" :key="place.id" >
         <div class="card">
          <router-link :to="/grouptour/+ place.id" class="text-dark text-decoration-none">
<img class="card-img-top"
:src="place.feature_image ? '/image/place/feature/'+place.feature_image : 'https://images.unsplash.com/photo-1587222318667-31212ce2828d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8Y294cyUyMGJhemFyfGVufDB8fDB8fA%3D%3D&w=1000&q=80'" width="340" height="340" alt="Card image cap" >  <!--   -->

             <p class="rating"> {{place.rating}}</p>
             <div class="card-body">
                 <h5 class="card-title">{{place.title}}</h5>
                 <p class="card-text text-success"><i class="fa fa-map-marker marker"></i>{{place.area}},{{place.district}},{{place.division}}</p>
                 <!-- <p class="card-text text-primary"> <strong>Category:</strong> {{place.category.name}}</p> -->
                 <p class="card-text">{{place.description}}</p>
                 <p class="card-text"><i  class="fa fa-star star-rating" v-for="rate in place.rating"></i></p>
                 <h4 class=" text-bold"><i class="fa fa-clock fa-1x text-info"></i>10-10-2022</h4>
                 <h4 class=" text-bold"><i class="fa fa-user fa-1x text-danger"></i>{{place.person}}</h4>
                 <h4 class=" text-bold"><i class="fa fa-sun fa-1x text-warning"></i>{{place.day}}</h4>
                 <p class="card-text">৳{{place.price}} - Per Person</p>
             </div>
             </router-link>
           <!--   <div class="card-footer">
      <small class="text-muted">Last updated 3 mins ago</small>
    </div> -->
         </div>
     </div>


</div>

 </div>
<!-- <picker v-model="date"/> -->


    </div>
    </template>
<style>
.o-hidden {
    overflow:hidden;
}

.nav-fill {
    transition: transform 0.4s;
    transform: translateX(50%);
    left: -50%;
}

.nav.justify-content-end {
    transform: translateX(0);
    left: 0;
}


@import url(http://fonts.googleapis.com/css?family=Lato:400,700);

body {
    background-color: #9C27B0
}

/* .container {
   margin-top: 100px
} */

.rating {
    position: relative;
    display: flex;
    width: 2.875rem;
    height: 2.875rem;
    margin-top: -1.75rem;
    margin-left: 0.75rem;
    justify-content: center;
    align-items: center;
    border: .25rem solid #fff;
    border-radius: 50%;
    color: #fff;
    background-color: rebeccapurple
}

.image {
    max-width: 100%
}

.card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: none;
    border-radius: .25rem
}

.card-title {
    font-family: 'Lato';
    font-style: normal;
    font-weight: 500;
    color: #653399
}

.card-text {
    font-family: 'Lato';
    font-style: normal;
    font-weight: 100;
    font-size: 13px
}

.marker {
    color: red
}

.star-rating {
    color: #f7b944
}
.btn-rounded{
    border-radius: 22.5px
}
</style>
