import './bootstrap';
import 'admin-lte/plugins/jquery/jquery.min.js';
import 'admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js';
import 'admin-lte/dist/js/adminlte.min.js';

import {createApp} from 'vue'

import router from './router'
import {createPinia} from 'pinia'
import app from './layouts/app.vue'
import modal from './components/modal.vue'
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'


createApp(app)
.component('picker',Datepicker)
.component('modal',modal)

.use(router)
.use(createPinia())
.mount("#app")

/* router.isReady().then(()=>{
}) */