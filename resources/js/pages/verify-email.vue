<template>
  
  <div class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-dark text-white" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">
  
              <div class="mb-md-5 mt-md-4 pb-5">
  
                <h2 class="fw-bold mb-2 text-uppercase">Verification Email Has Been Sent</h2>
                <p class="text-white-50 mb-5">Please Check inbox and spam for verification mail!</p>
                <p class="text-danger mb-5" v-if="errmsg">{{errmsg}}</p>
  
               
                <div class="d-flex justify-content-center text-center mt-4 pt-1">
                    <i class="fa fa-check text-success" aria-hidden="true" style="font-size:100px"></i>
               <!--    <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                  <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                  <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a> -->
                </div>
  
              </div>
  
              <div>
               
                <p class="mb-0">Did't receive the mail Yet?  <a @click="sendLink" class="text-white-50 fw-bold btn btn-outline-danger" >Send Again</a>
                </p>
              </div>
  
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </template>
  
  <script setup>
  
      import axios from 'axios';
  import {reactive,ref} from 'vue';
  import { useRouter } from 'vue-router';
  import {UserStore } from '@/store/UserStore';

  import { useToastr } from './toaster';
  
    
   
    
          const toaster = useToastr();
          const router = new useRouter();
          const store = new UserStore();
          const {token} = UserStore();
          let errmsg = ref('');
          
          function sendLink(){
            console.log(token)
        axios.post('/api/email/verification-notification',token).then(res=>{
            console.log(res)
        })
     }
          let form = reactive({
              email:'',
              password:'',
          });
          let errors = ref([]);
          /* return {
              form,
              login,
              errors,
              errmsg
  
  
          }; */
      
  
  
  </script>
  <style>
  
  .gradient-custom {
  /* fallback for old browsers */
  background: #6a11cb;
  
  /* Chrome 10-25, Safari 5.1-6 */
  background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));
  
  /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
  background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
  }
  
  </style>
  