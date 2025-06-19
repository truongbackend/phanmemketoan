import './bootstrap';
import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import globalState from './api.js';
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
import '@bhplugin/vue3-datatable/dist/style.css';
// import PrimeVue from 'primevue/config';
// import DataTable from 'primevue/datatable';
// import Column from 'primevue/column';
// import 'primevue/resources/themes/lara-light-blue/theme.css';
// import 'primevue/resources/primevue.min.css';
// import 'primeicons/primeicons.css';

import { hasPermission } from '@/utils/permission';
const app = createApp(App);
app.config.globalProperties.hasPermission = hasPermission;
app.use(VueToast);
// app.use(PrimeVue);
// app.component('DataTable', DataTable);
// app.component('Column', Column);

app.provide('globalState', globalState);
app.use(router).mount('#app');

