import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

import VueFeather from 'vue-feather';
import 'bootstrap'
import 'bootstrap-table/dist/bootstrap-table.js'
import 'bootstrap-table/dist/themes/materialize/bootstrap-table-materialize.js'
import 'bootstrap-table/dist/extensions/export/bootstrap-table-export.js'
import 'bootstrap-table/dist/bootstrap-table.min.css'
import slimscroll from 'jquery-slimscroll'

const app = createApp(App);
app.component(VueFeather.name, VueFeather);
app.use(slimscroll);
app.use(store).use(router).mount('#app');
