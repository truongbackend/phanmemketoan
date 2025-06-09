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
    const toast = useToast();
    const token = Cookies.get('token');
    const user = localStorage.getItem('user');
    if (to.path.startsWith('/admin') && (!token || !user)) {
        toast.error('Bạn cần đăng nhập để truy cập trang này');
        next({ name: 'login' });
    } else {
        next();
    }
});

export default router;
