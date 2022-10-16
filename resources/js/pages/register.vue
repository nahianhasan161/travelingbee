<template>
 <!--    <div>

        <h1 class="text-danger" v-for="error in errors" :key="error">
            <span v-for="err in error" :key="err">{{err}}</span>
        </h1>
        <div class="container row  justify-content-center mt-5">

            <form class=" container  col-md-8 p-5 bg-light" @submit.prevent="register">
                <div class="mb-3 ">
                    <label for="InputName" class="form-label">Name</label>
                    <input type="text" class="form-control" id="InputName" aria-describedby="nameHelp" v-model="form.name">
                    <div id="NameHelp" class="form-text">Your Full Name</div>
                </div>
      <div class="mb-3 ">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="form.email">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" v-model="form.password">
      </div>
      <div class="mb-3">
          <label for="ConfirmPassword" class="form-label">Password</label>
        <input type="password" class="form-control" id="ConfirmPassword" v-model="form.password_confirmation">
    </div>

    <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
</div> -->

<div class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">

              <h2 class="fw-bold mb-2 text-uppercase">Register</h2>
              <p class="text-white-50 mb-5">Please enter your Real Name and Strong Password!</p>
              <!-- <p class="text-danger mb-5" v-if="error">{{error}}</p> -->
              <!-- <p class="text-danger" v-for="error in errors" :key="error">
            <span v-for="err in error" :key="err">{{err}}</span>
        </p> -->
        <!-- {{errors.email}} -->

                <form @submit.prevent="register">
              <div class="form-outline form-white mb-4">
                <input type="Name" id="typeNameX" class="form-control form-control-lg" :class="errors.name ? 'is-invalid' : '' " placeholder="Name" v-model="form.name"/>
                <div class="text-danger" v-if="errors.name">
               <p v-for="error in errors.name">
                {{error}}
               </p>
             </div>
              </div>
              <div class="form-outline form-white mb-4">
                <input type="email" id="typeEmailX" class="form-control form-control-lg " :class="errors.email ? 'is-invalid' : '' " placeholder="Email" v-model="form.email"/>
              <!--   <label class="form-label" for="typeEmailX">Email</label> -->

             <div class="text-danger" v-if="errors.email">
               <p v-for="error in errors.email">
                {{error}}
               </p>
             </div>

              </div>


              <div class="form-outline form-white mb-4">
                <input type="password" id="typePasswordX" class="form-control form-control-lg" placeholder="Password" v-model="form.password" :class="errors.password ? 'is-invalid' : '' "/>

             <div class="text-danger" v-if="errors.password">
               <p v-for="error in errors.password">
                {{error}}
               </p>
             </div>
              </div>
              <div class="form-outline form-white mb-4">
                <input type="password" id="ConfirmPassword" class="form-control form-control-lg" placeholder="Password" v-model="form.password_confirmation" :class="errors.password ? 'is-invalid' : '' " />
               <!--  <label class="form-label" for="typePasswordX">Password</label> -->
              </div>

              <!-- <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p> -->

              <button class="btn btn-outline-light btn-lg px-5" type="submit">Sign Up</button>
            </form>
             <!--  <div class="d-flex justify-content-center text-center mt-4 pt-1">
                <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
              </div> -->

            </div>

            <div>
                <p class="mb-0">Already have an account? <router-link to="/login" class="text-white-50 fw-bold" >Login Now</router-link>
              </p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</template>

    <script>

    import axios from 'axios';
    import {reactive,ref} from 'vue';
    import { useRouter } from 'vue-router';
    import {UserStore} from '@/store/UserStore'
    export default{
        setup(){

            const router = new useRouter();
            const store = new UserStore();
            const register = async()=>{


try{
  await axios.post('/api/register',form).then(res=>{
    /* if(!res.data[0].success){
      errors.value =  res.data[0].data
    } */
    if(res.data.success){

       store.setToken(res.data.data.token)
       store.setCurrentUser(res.data.data)
         console.log(res.data.data.roles[0])
        errors.value = res.data.message
        var role = res.data.data.roles[0]
        if(role == 'user'){
            console.log(res.data.data.roles[0]+'user')
            router.push({name:'dashboard'})
        }
        else if(role == 'admin'){
            console.log(role == 'admin'? 'admin' :'notadmin')
            router.push({name:'admin.dashboard'})
        }
        else if(role == 'suadmin'){
            console.log(res.data.data.roles[0]+'suadmin')
            router.push({name:'suadmin.dashboard'})
        }
        else{
            console.log(role == 'admin'? 'admin' :'notadmin')

            router.push({name:'dashboard'})
        }
    }
    else{
        toaster.info('success')
        errmsg.value =  res.data.message
        console.log(errmsg)
        errors.value =  res.data[0].data
           }
})
}catch(e){
console.log(e.data)
/* error.value = e.data.message */
}
}

         
            let form = reactive({
                name:'',
                email:'',
                password:'',
                password_confirmation:'',
            });
            let errors = ref([]);

            return {
                form,
                register,
                errors


            };
        }
    }

    </script>
