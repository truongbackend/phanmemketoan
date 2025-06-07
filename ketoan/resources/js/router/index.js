import { createRouter, createWebHistory } from 'vue-router';
import process from 'process';
import Home from '../views/home.vue'; // Replace with your actual component path

const routes = [
  { path: '/', component: Home },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
});

export default router;
