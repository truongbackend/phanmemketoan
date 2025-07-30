import './bootstrap';
import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import globalState from './api.js';
import VueToast from 'vue-toast-notification';
import { DatePicker, ConfigProvider } from 'ant-design-vue';
import 'vue-toast-notification/dist/theme-sugar.css';
import '@bhplugin/vue3-datatable/dist/style.css';
import viVN from 'ant-design-vue/es/locale/vi_VN';
import { hasPermission } from '@/utils/permission';

const app = createApp(App);

app.config.globalProperties.hasPermission = hasPermission;
app.use(VueToast);
app.use(ConfigProvider, { locale: viVN });
app.use(DatePicker);
app.provide('globalState', globalState);
app.use(router).mount('#app');
