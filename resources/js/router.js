import {createWebHistory,createRouter} from 'vue-router';
/* landing pages */
import welcome from './pages/welcome.vue';
import dashboard from './pages/auth/user/dashboard.vue';
import place from './pages/place.vue';
import test from './pages/test.vue';
/* Authentication */

import login from './pages/login/login.vue';
import register from './pages/login/register.vue';
import posts from './pages/auth/posts.vue';
import user_profile from './pages/auth/profile.vue';

/* Management */
/* SuAdmin */
import suadmin_dashboard from './pages/auth/suadmin/dashboard.vue';
import manage_user from './pages/auth/suadmin/manage_user.vue';
import manage_roles from './pages/auth/suadmin/manage_roles.vue';

/* Admin */
import admin_dashboard from './pages/auth/admin/dashboard.vue';
import manage_place from './pages/auth/admin/Place/manage_place.vue';
/* Payment */
import invoice from './pages/auth/user/payment/invoice.vue'


import category from './pages/auth/suadmin/category.vue';     

/* Verify and Reset */

import verify_email from './pages/auth/verification/verify-email.vue';
import email_verified from './pages/auth/verification/email-verified.vue';
import reset_password from './pages/login/reset-password/reset-password.vue';
import password_reset_form from './pages/login/reset-password/password-reset-form.vue';

/* Stores */
import {UserStore} from '@/store/UserStore'

import { storeToRefs } from 'pinia';

/* Veriables */

const {currentUser} = storeToRefs(UserStore);


const routes = [

/*  Landing Pages */

    {
    path : '/test',
    name : 'test',
    component : test ,

},
    {
    path : '/',
    name : 'welcome',
    component : welcome ,
   
    
},
    {
    path : '/place/:id',
    name : 'place',
    component : place ,
    props: true

},
/*  Authentication */
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
/* Verification And Reset */


{
    path : '/auth/reset-password',
    name : 'reset_password',
    component : reset_password ,
    meta:{
        
    }
},

{
    path : '/reset-password',
    name : 'password_reset_form',
    component : password_reset_form ,
    meta:{
        requiresAuth: false,
    }
},

{
    path : '/verify/:url',
    name : 'email_verified',
    component : email_verified ,
    meta:{
        
    }
},
{
    path : '/api/email/verify/:id/:hash',
    name : 'verify_email_success',
    component : verify_email ,
    meta:{
        
    }
},
{
    path : '/auth/verify_email',
    name : 'verify_email',
    component : verify_email ,
    meta:{
        
    }
},


{
    path : '/auth/profile',
    name : 'user_profile',
    component : user_profile ,
    meta:{
        requiresAuth: true,
    }
},

/* User */

{
    path : '/user/dashboard',
    name : 'dashboard',
    component : dashboard ,
    meta:{
        requiresAuth: true,
    }
},
/* Admin */

{
    path : '/admin/dashboard',
    name : 'admin.dashboard',
    component : admin_dashboard ,
    meta:{
        requiresAuth: true,
    }
},
{
    path : '/manage/place',
    name : 'manage.place',
    component : manage_place ,
    meta:{
        requiresAuth: true,
    }
},

/* Super Admin */
{
    path : '/suadmin/dashboard',
    name : 'suadmin.dashboard',
    component : suadmin_dashboard ,
    meta:{
        requiresAuth: true,
    }
},
{
    path : '/suadmin/place/category',
    name : 'suadmin.place.category',
    component : category ,
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
/* Payment */
{
    path : '/payment/invoice/:id',
    name : 'payment.invoice',
    component : invoice ,
    meta:{
        requiresAuth: true,
    }
},

/* Others */
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
        /* if(to.meta.requiresAuth  && store.getToken != 0 && currentUser.email_verified == false){
            return {name:'verify_email'}
        } 
        else{ */

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
   /*  } */

    })
    export default router;
