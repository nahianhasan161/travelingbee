
<template>

    <div class="container">
        <div class="loader" v-if="loading"></div>
    <div class="d-flex align-items-center">
        <div class="flex-shrink-0">
            <a href="#" class="btn-left btn-link p-2 toggle text-dark"><i class="fa fa-arrow-left"></i></a>
        </div>
        <div class="flex-grow-1  o-hidden">
            <ul class="nav nav-fill text-uppercase small position-relative flex-nowrap">
                <li class="nav-item" v-for="category in categories">
                  <router-link  to="/place/1" class="btn btn-outline-danger btn-round mr-md-3 mb-md-0 mb-2" :class="category.id == '1'? 'active' : ''">{{category.name}}</router-link>
                </li>
              
            </ul>
        </div>
        <div class="flex-shrink-0">
            <a href="#" class="btn-right btn-link toggle p-2 text-dark"><i class="fa fa-arrow-right"></i></a>
        </div>
    </div>

    <div class="container d-flex justify-content-center mt-5" >
     <div class="row" >
         
         <div class="col-md-4"  v-for="place in places" @click="setPlaceId(place.id)" :key="place.id" >
             <div class="card">
              <router-link :to="/place/+ place.id" class="text-dark text-decoration-none">
 <img class="card-img-top" 
    :src="place.feature_image ? '/image/place/feature/'+place.feature_image : 'https://images.unsplash.com/photo-1587222318667-31212ce2828d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8Y294cyUyMGJhemFyfGVufDB8fDB8fA%3D%3D&w=1000&q=80'" width="340" height="340" alt="Card image cap" >  <!--   -->

                 <p class="rating">{{place.rating}}</p>
                 <div class="card-body">
                     <h5 class="card-title">{{place.name}}</h5>
                     <p class="card-text"><i class="fa fa-map-marker marker"></i> {{place.description}}</p>
                     <p class="card-text"><i class="fa fa-star star-rating"></i><i class="fa fa-star star-rating"></i><i class="fa fa-star star-rating"></i><i class="fa fa-star star-rating"></i><i class="fa fa-star star-rating"></i></p>
                     <p class="card-text">৳{{place.price}}</p>
                 </div>
                 </router-link>
                 <div class="card-footer">
          <small class="text-muted">Last updated 3 mins ago</small>
        </div>
             </div>
         </div>
       
     </div>
 </div>



    </div>
    </template>
    <script setup>
        import { onMounted,watchEffect } from 'vue';
        import {useRouter} from 'vue-router'
        import { UserStore } from '../store/UserStore';
       import { PlaceStore } from '../store/place/PlaceStore';
       import { storeToRefs } from 'pinia';
        /* import {useVirtualList} from '@vueuse/core ' */

        /* const {list,containerProps,wraperProps} = useVirtualList(categories,{
            itemHeight : 200
        }) */


            const router = new useRouter();
            const store = new UserStore();
            const {places,placeId,categories,loading} = storeToRefs(PlaceStore())
            const {fetchPlaces,fetchCategories,setPlaceId,getPlaces} = PlaceStore();
            function filtedplaces(){
                return places
            } 
            /* function setId(id){
                placeId = id
            } */
            function logout(){
                store.removeToken();
                store.removeUser();
                router.push({name:'login'})
            }

           watchEffect(()=>{
            fetchPlaces() 
           })
       

        onMounted(async ()=>{
          
         await   fetchPlaces()
            fetchCategories()
            
            
           $('.toggle').click(function(){
    $('.nav-fill').toggleClass("justify-content-end");
    $('.toggle').toggleClass("text-light"); 
});
}) 
            /* window.axios.default.headers.common['Authorization'] = `Bearer ${store.getToken}` */
            /*  this.store.fetchCurrentUser(); */
          /*   axios.get('/api/user').then(res=>{

            }).catch((err)=>{
                console.log(err);
            
      /*   }) */

   
    </script>
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
</style>