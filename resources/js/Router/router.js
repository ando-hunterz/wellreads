import { createRouter, createWebHistory } from 'vue-router';
import Home from '../Page/Home.vue';
import About from '../Page/About.vue';

const routes = [
  { path: '/', component: Home },
  { path: '/about', component: About },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;