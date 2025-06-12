import { createRouter, createWebHistory } from 'vue-router';
import admin from './admin.js';
import Cookies from 'js-cookie';
import axios from 'axios';
import globalState from '@/api';

const routes = [...admin];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach(async (to, from, next) => {
  const token = Cookies.get('token');
  const isAuthenticated = !!token;
  const isAuthPage = to.name === 'login' || to.name === 'register';
  const isAdminRoute = to.path.startsWith('/admin');

  if (token) {
    if (!globalState.permissions.length) {
      try {
        const { data } = await axios.get('/api/profile');
        globalState.currentUser = data.user;
        globalState.permissions = data.permissions;
      } catch (err) {
        Cookies.remove('token');
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
