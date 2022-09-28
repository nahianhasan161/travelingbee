import './bootstrap';
import 'admin-lte/plugins/jquery/jquery.min.js';
import 'admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js';
import 'admin-lte/dist/js/adminlte.min.js';

import {createApp} from 'vue'

import router from './router'
import {createPinia} from 'pinia'
import app from './layouts/app.vue'

createApp(app)
.use(router)
.use(createPinia())
.mount("#app")
