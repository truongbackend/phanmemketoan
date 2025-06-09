// router/index.js
import { createRouter, createWebHistory } from 'vue-router';
import admin from './admin.js';
import Cookies from 'js-cookie';
import { useToast } from 'vue-toast-notification';

const routes = [...admin];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
  const token = Cookies.get('token');
  const isAuthenticated = !!token;

  const isAuthPage = to.name === 'login' || to.name === 'register';
  const isAdminRoute = to.path.startsWith('/admin');

  if (!isAuthenticated && isAdminRoute) {
    return next({ name: 'login' });
  }
  if (isAuthenticated && isAuthPage) {
    return next({ path: '/admin' });
  }

  next();
});

export default router;
