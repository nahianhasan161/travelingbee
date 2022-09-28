<template>

<div class="container">

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
        axios.get('/api/user').then(res=>{

         console.log(res.data)
        }).catch((err)=>{
            console.log(err)
        })
        })






</script>

