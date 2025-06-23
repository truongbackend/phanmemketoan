import { createRouter, createWebHistory } from 'vue-router';
import admin from './admin.js';
import Cookies from 'js-cookie';
import axios from 'axios';
import globalState from '@/api';
import { useToast } from 'vue-toast-notification';
const toast = useToast();
const routes = [...admin];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

axios.interceptors.response.use(
  response => response,
  error => {
    if (error.response && error.response.status === 401) {
      Cookies.remove('token');
      globalState.currentUser = null;
      globalState.permissions = [];
       toast.warning('Thiết bị của bạn đã được đăng nhập ở nơi khác!');
      router.push({ name: 'login' });
    }
    return Promise.reject(error);
  }
);

router.beforeEach(async (to, from, next) => {
  const token = Cookies.get('token');
  const isAuthenticated = !!token;
  const isAuthPage = to.name === 'login' || to.name === 'register';
  const isAdminRoute = to.path.startsWith('/admin');

  if (isAuthenticated) {
    if (!globalState.permissions.length) {
      try {
        const { data } = await axios.get('/api/profile');
        globalState.currentUser = data.user;
        globalState.permissions = data.permissions;
      } catch (err) {
        Cookies.remove('token');
        globalState.currentUser = null;
        globalState.permissions = [];
        return next({ name: 'login' });
      }
    }
  }

  if (!isAuthenticated && isAdminRoute) {
    return next({ name: 'login' });
  }

  if (isAuthenticated && isAuthPage) {
    return next({ path: '/admin' });
  }

  next();
});

export default router;
