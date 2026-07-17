import { createRouter, createWebHistory } from 'vue-router';
import LoginView from '../views/LoginView.vue';
import DashboardView from '../views/DashboardView.vue';
import PasienView from '../views/PasienView.vue';
import DokterView from '../views/DokterView.vue';
import JadwalView from '../views/JadwalView.vue';
import PendaftaranView from '../views/PendaftaranView.vue';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    { path: '/', redirect: '/login' },
    { path: '/login', name: 'login', component: LoginView },
    { path: '/dashboard', name: 'dashboard', component: DashboardView, meta: { requiresAuth: true } },
    { path: '/pasien', name: 'pasien', component: PasienView, meta: { requiresAuth: true } },
    { path: '/dokter', name: 'dokter', component: DokterView, meta: { requiresAuth: true } },
    { path: '/jadwal', name: 'jadwal', component: JadwalView, meta: { requiresAuth: true } },
    { path: '/pendaftaran', name: 'pendaftaran', component: PendaftaranView, meta: { requiresAuth: true } },
  ],
});

router.beforeEach((to, from, next) => {
  const token = localStorage.getItem('token');
  if (to.meta.requiresAuth && !token) next('/login');
  else if (to.name === 'login' && token) next('/dashboard');
  else next();
});

export default router;
