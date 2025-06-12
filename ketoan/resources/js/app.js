import './bootstrap';
import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import globalState from './api.js';
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
import { hasPermission } from '@/utils/permission';
const app = createApp(App);
app.config.globalProperties.hasPermission = hasPermission;
app.use(VueToast);
app.provide('globalState', globalState);
app.use(router).mount('#app');

