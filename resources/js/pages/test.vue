<template>

<div class="container">
   
    <!-- <div class="container">
	<div class="row">
	<div class="rating">
      <input type="radio" id="star10" name="rating" value="10" /><label for="star10" title="Rocks!">5 stars</label>
      <input type="radio" id="star9" name="rating" value="9" /><label for="star9" title="Rocks!">4 stars</label>
      <input type="radio" id="star8" name="rating" value="8" /><label for="star8" title="Pretty good">3 stars</label>
      <input type="radio" id="star7" name="rating" value="7" /><label for="star7" title="Pretty good">2 stars</label>
      <input type="radio" id="star6" name="rating" value="6" /><label for="star6" title="Meh">1 star</label>
      <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="Meh">5 stars</label>
      <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Kinda bad">4 stars</label>
      <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Kinda bad">3 stars</label>
      <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Sucks big tim">2 stars</label>
      <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Sucks big time">1 star</label>
    </div>
	</div>
</div> -->


<div class="container">
    <div class="container">
	
</div>
    <div class="py-5 text-center">
        <div class="rating">
    <ul class="list">
      <li :key="star" v-for="star in maxStars" :class="{ 'active': star <= stars }" @click="rate(star)" class="star">
        <icon scale="2" :name="star <= stars ? 'star' : 'star-o'"/>
      </li>
    </ul>
    <span v-if="hasCounter">{{ stars }} of {{ maxStars }}</span>
  </div>
        <h2>EasyCheckout (Popup) - SSLCommerz</h2>

        <p class="lead">Below is an example form built entirely with Bootstrap’s form controls. We have provided this
            sample form for understanding EasyCheckout (Popup) Payment integration with SSLCommerz.</p>
    </div>

    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>
                <span class="badge badge-secondary badge-pill">3</span>
            </h4>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Product name</h6>
                        <small class="text-muted">Brief description</small>
                    </div>
                    <span class="text-muted">1000</span>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Second product</h6>
                        <small class="text-muted">Brief description</small>
                    </div>
                    <span class="text-muted">50</span>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Third item</h6>
                        <small class="text-muted">Brief description</small>
                    </div>
                    <span class="text-muted">150</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (BDT)</span>
                    <strong>1200 TK</strong>
                </li>
            </ul>
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Billing address</h4>
        <form method="POST" class="needs-validation" novalidate>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="firstName">Full name</label>
                        <input type="text" name="customer_name" class="form-control" id="customer_name" placeholder=""
                               value="John Doe" required>
                        <div class="invalid-feedback">
                            Valid customer name is required.
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="mobile">Mobile</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">+88</span>
                        </div>
                        <input type="text" name="customer_mobile" class="form-control" id="mobile" placeholder="Mobile"
                               value="01711xxxxxx" required>
                        <div class="invalid-feedback" style="width: 100%;">
                            Your Mobile number is required.
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email">Email <span class="text-muted">(Optional)</span></label>
                    <input type="email" name="customer_email" class="form-control" id="email"
                           placeholder="you@example.com" value="you@example.com" required>
                    <div class="invalid-feedback">
                        Please enter a valid email address for shipping updates.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" placeholder="1234 Main St"
                           value="93 B, New Eskaton Road" required>
                    <div class="invalid-feedback">
                        Please enter your shipping address.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                    <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
                </div>

                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="country">Country</label>
                        <select class="custom-select " id="country" required>
                            <option value="">Choose...</option>
                            <option value="Bangladesh">Bangladesh</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid country.
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="state">State</label>
                        <select class="custom-select " id="state" required>
                            <option value="">Choose...</option>
                            <option value="Dhaka">Dhaka</option>
                        </select>
                        <div class="invalid-feedback">
                            Please provide a valid state.
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="zip">Zip</label>
                        <input type="text" class="form-control" id="zip" placeholder="" required>
                        <div class="invalid-feedback">
                            Zip code required.
                        </div>
                    </div>
                </div>
                <hr class="mb-4">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="same-address">
                    <input type="hidden" value="1200" name="amount" id="total_amount" required/>
                    <label class="custom-control-label" for="same-address">Shipping address is the same as my billing
                        address</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="save-info">
                    <label class="custom-control-label" for="save-info">Save this information for next time</label>
                </div>
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" id="sslczPayBtn"
                        token="if you have any token validation"
                        postdata="your javascript arrays or objects which requires in backend"
                        order="If you already have the transaction generated for current order"
                        endpoint="http://localhost:8000/api/pay-via-ajax"> Pay Now
                </button>
            </form>
        </div>
    </div>

    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2019 Company Name</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Privacy</a></li>
            <li class="list-inline-item"><a href="#">Terms</a></li>
            <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
    </footer>
</div>
{{getCurrentUser}}
<button class="btn btn-danger" @click="logout">Logout</button>
</div>
</template>
<script setup>
    import { onMounted,reactive } from 'vue';
    import { storeToRefs } from 'pinia';
    import {useRouter} from 'vue-router'
   import {UserStore} from '@/store/UserStore'
    import axios from 'axios';




        let maxStars = reactive(5)
        function rate(star){
            console.log(star)
        }
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
        /* axios.get('/api/user').then(res=>{

         console.log(res.data)
        }).catch((err)=>{
            console.log(err)
        }) */
        })





    var obj = {};
obj.cus_name = $('#customer_name').val();
obj.cus_phone = $('#mobile').val();
obj.cus_email = $('#email').val();
obj.cus_addr1 = $('#address').val();
obj.amount = $('#total_amount').val();

$('#sslczPayBtn').prop('postdata', obj);

(function (window, document) {
    var loader = function () {
        var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
        // script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR LIVE
        script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR SANDBOX
        tag.parentNode.insertBefore(script, tag);
    };

    window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
})(window, document);
</script>

<style>
body{
    margin-top:20px;
    background:#FAFAFA;
}
.order-card {
    color: #fff;
}

.bg-c-blue {
    background: linear-gradient(45deg,#4099ff,#73b4ff);
}

.bg-c-green {
    background: linear-gradient(45deg,#2ed8b6,#59e0c5);
}

.bg-c-yellow {
    background: linear-gradient(45deg,#FFB64D,#ffcb80);
}

.bg-c-pink {
    background: linear-gradient(45deg,#FF5370,#ff869a);
}


.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    border: none;
    margin-bottom: 30px;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}

.card .card-block {
    padding: 25px;
}

.order-card i {
    font-size: 26px;
}

.f-left {
    float: left;
}

.f-right {
    float: right;
}

/* rating */
.rating {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  font-size: 22px;
  color: #a7a8a8;
}
.list {
  margin: 0 0 5px 0;
  padding: 0;
  list-style-type: none;
}
.list:hover .star {
  color: #f3d23e;
}
.star {
  display: inline-block;
  cursor: pointer;
}
.star:hover ~ .star:not(.active) {
  color: inherit;
}
.active {
  color: #f3d23e;
}

</style>

