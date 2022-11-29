import {createWebHistory,createRouter} from 'vue-router';
/* landing pages */
import welcome from './pages/welcome.vue';
import about from './pages/about.vue';
/* GroupTOur */
import grouptour from './pages/GroupTour/group-tour.vue';
import groutourDetails from './pages/GroupTour/group-tour-details.vue';
/* GroupTOur */
import dashboard from './pages/auth/user/dashboard.vue';
import place from './pages/place.vue';
import test from './pages/test.vue';
/* Authentication */

import login from './pages/login/login.vue';
import register from './pages/login/register.vue';
import posts from './pages/auth/posts.vue';
import user_profile from './pages/auth/profile.vue';

/* SuAdmin */
/* Management */
import suadmin_dashboard from './pages/auth/suadmin/dashboard.vue';
import manage_user from './pages/auth/suadmin/manage/manage_user.vue';
import manage_roles from './pages/auth/suadmin/manage/manage_roles.vue';
import manage_place_booking from './pages/auth/suadmin/manage/manage_booking.vue';

import manage_group_tour from './pages/auth/suadmin/manage/manage_group_tour.vue';
/* Management Address*/
import manage_division from '@/pages/auth/suadmin/manage/address/manage_division.vue';
import manage_district from '@/pages/auth/suadmin/manage/address/manage_district.vue';
import manage_area from '@/pages/auth/suadmin/manage/address/manage_area.vue';

/* Admin */
import admin_dashboard from './pages/auth/admin/dashboard.vue';
import manage_place from './pages/auth/admin/Place/manage_place.vue';
import manage_place_images from './pages/auth/admin/Place/manage_place_images.vue';
/* Payment */
import invoice from './pages/auth/user/payment/invoice.vue'


import category from './pages/auth/suadmin/manage/manage_category.vue';

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

props : ['id']
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
    path : '/about',
    name : 'about',
    component : about ,


},
    {
    path : '/group-tour',
    name : 'group-tour',
    component : grouptour ,


},

    {
    path : '/grouptour/:id',
    name : 'group-tour-detials',
    component : groutourDetails ,
    props: true

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
{
    path : '/manage/place/:id/images',
    name : 'place_images',
    component : manage_place_images ,
    props: true

},
{
    path : '/manage/group_tour',
    name : 'manage.group_tour',
    component : manage_group_tour ,
    meta:{
        requiresAuth: true,
    }
},
{
    path : '/manage/place/:id/booking',
    name : 'manage.place.booking',
    component : manage_place_booking ,

    meta:{
        requiresAuth: true,
        props: true
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
/* Manage */
{
    path : '/manage/division',
    name : 'manage.division',
    component : manage_division ,
    meta:{
        requiresAuth: true,
    }
},
{
    path : '/manage/district/:id',
    name : 'manage.district.divisonID',
    component : manage_district,
    meta:{
        requiresAuth: true,
    }
},

{
    path : '/manage/area/:id',
    name : 'manage.area.areaID',
    component : manage_area ,
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
