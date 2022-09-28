<template>

    <div class="container">




        <div class="scrollmenu  " >



      <router-link v-for="category in (index,categories)" :to="{name:'place'}" href="#home" class="btn btn-outline-warning active scroll-item">{{category.name}}</router-link>




    </div>
    <div class="row mt-5">


  <div class="card col-md-4" v-for="place in ($index,places)" @click="setId(place.id)">
    <router-link :to="{name:'place'}" class="text-dark text-decoration-none">
    <img class="card-img-top" src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b3/Dark_Small-branded_Swift.jpg/250px-Dark_Small-branded_Swift.jpg" alt="Card image cap">
    <div class="card-body d-flex justify-content-between">
      <h5 class="card-title">{{place.name}}</h5>
     <p>
        {{place.rating}} <i class="fas fa-star text-warning"></i>
     </p>
    </div>
    <div class="container">

        <p class="card-text">{{place.description}}</p>
    </div>
    <div class="card-footer">
      <small class="text-muted">Last updated 3 mins ago</small>
    </div>
</router-link>
  </div>









</div>

    </div>
    </template>
    <script setup>
        import { onMounted } from 'vue';
        import {useRouter} from 'vue-router'
        import { UserStore } from '../store/UserStore';
       import { PlaceStore } from '../store/place/PlaceStore';
       import { storeToRefs } from 'pinia';





            const router = new useRouter();
            const store = new UserStore();
            const {places,placeId,categories} = storeToRefs(PlaceStore())
            const {fetchPlaces,fetchCategories} = PlaceStore();

            function setId(id){
                placeId = id
            }
            function logout(){
                store.removeToken();
                store.removeUser();
                router.push({name:'login'})
            }




        onMounted(()=>{
            fetchPlaces()
            fetchCategories()
            /* window.axios.default.headers.common['Authorization'] = `Bearer ${store.getToken}` */
            /*  this.store.fetchCurrentUser(); */
          /*   axios.get('/api/user').then(res=>{

            }).catch((err)=>{
                console.log(err);
            }) */
        })


    </script>
