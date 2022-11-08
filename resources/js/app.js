import './bootstrap';
import 'admin-lte/plugins/jquery/jquery.min.js';
import 'admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js';
import 'admin-lte/dist/js/adminlte.min.js';

import {createApp} from 'vue'

import router from './router'
import {createPinia} from 'pinia'
import app from './layouts/app.vue'
/* import HotelDatePicker from 'vue-hotel-datepicker'
import 'vue-hotel-datepicker/dist/vueHotelDatepicker.css'; */
createApp(app)
/* .component('HotelDatePicker',HotelDatePicker) */
.use(router)
.use(createPinia())
.mount("#app")

/* router.isReady().then(()=>{
}) */