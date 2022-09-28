import {createWebHistory,createRouter} from 'vue-router';

import welcome from './pages/welcome.vue';
import dashboard from './pages/dashboard.vue';
import place from './pages/place.vue';

import login from './pages/login.vue';
import register from './pages/register.vue';
import posts from './pages/posts.vue';

import manage_user from './pages/suadmin/manage_user.vue';
import manage_roles from './pages/suadmin/manage_roles.vue';


import {UserStore} from '@/store/UserStore'
import { storeToRefs } from 'pinia';
const {currentUser} = storeToRefs(UserStore);

const routes = [


    {
    path : '/',
    name : 'welcome',
    component : welcome ,

},
    {
    path : '/place',
    name : 'place',
    component : place ,
    props: true

},
    {
    path : '/login',
    name : 'login',
    component : login ,
    meta:{
        requiresAuth: false,
    }
},
    {
    path : '/register',
    name : 'register',
    component : register ,
    meta:{
        requiresAuth: false,
    }


},
{
    path : '/user/dashboard',
    name : 'dashboard',
    component : dashboard ,
    meta:{
        requiresAuth: true,
    }
},
{
    path : '/admin/dashboard',
    name : 'admin.dashboard',
    component : dashboard ,
    meta:{
        requiresAuth: true,
    }
},
{
    path : '/suadmin/dashboard',
    name : 'suadmin.dashboard',
    component : dashboard ,
    meta:{
        requiresAuth: true,
    }
},
{
    path : '/suadmin/users',
    name : 'suadmin.manage.user',
    component : manage_user ,
    meta:{
        requiresAuth: true,
    }
},
{
    path : '/suadmin/users/roles',
    name : 'suadmin.manage.roles',
    component : manage_roles ,
    meta:{
        requiresAuth: true,
    }
},

{
    path : '/posts',
    name: 'posts',
    component : posts,
    meta : {
        requiresAuth : true
    }
}


];

const router = createRouter({
    history : createWebHistory(),
    routes
});

    router.beforeEach((to,from)=>{
        const store = new UserStore();
        /* JSON.parse() */

        var currentUser = store.getCurrentUser;

         console.log(currentUser);
        if(to.meta.requiresAuth && store.getToken == 0){

            return {name:'login'}

        }
        if(to.meta.requiresAuth == false && store.getToken != 0 ){
            return {name:'posts'}
        }
        if(to.meta.requiresAuth == false && store.getToken != 0 ){

          /*   if(store.getCurrentUser.roles[0] =='user'){
                return {name:'posts'}
            }else{ */
           /*  console.log(store.getCurrentUser) */
                return {name:'dashboard'}
            /* } */


        }

    })
    export default router;
