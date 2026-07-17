<template>
  <div id="app">
    <nav v-if="$route.name !== 'login'" class="navbar">
      <div class="nav-brand">🏥 Sistem Klinik</div>
      <div class="nav-links">
        <router-link to="/dashboard">Dashboard</router-link>
        <router-link to="/pasien">Pasien</router-link>
        <router-link to="/dokter">Dokter</router-link>
        <router-link to="/jadwal">Jadwal</router-link>
        <router-link to="/pendaftaran">Pendaftaran</router-link>
        <button @click="handleLogout" class="btn-logout">Logout</button>
      </div>
    </nav>

    <div class="container">
      <router-view />
    </div>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router';
import api from './api';

const router = useRouter();

const handleLogout = async () => {
  try {
    await api.post('/logout'); // Beritahu backend untuk hapus token
  } catch (error) {
    console.error(error);
  } finally {
    localStorage.removeItem('token');
    localStorage.removeItem('user');
    router.push('/login');
  }
};
</script>

<style>
/* CSS Global agar rapi dan ringkas */
body {
  margin: 0;
  font-family: 'Segoe UI', sans-serif;
  background-color: #f4f7f6;
}
.navbar {
  display: flex;
  justify-content: space-between;
  padding: 1rem 2rem;
  background: #2c3e50;
  color: white;
  align-items: center;
}
.nav-links a {
  color: white;
  text-decoration: none;
  margin-right: 1.5rem;
  font-weight: 500;
}
.nav-links a.router-link-active {
  color: #3498db;
}
.btn-logout {
  background: #e74c3c;
  color: white;
  border: none;
  padding: 0.5rem 1rem;
  border-radius: 5px;
  cursor: pointer;
}
.container {
  padding: 2rem;
  max-width: 1200px;
  margin: auto;
}
.card {
  background: white;
  padding: 1.5rem;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
  margin-bottom: 1.5rem;
}
.form-group {
  margin-bottom: 1rem;
  display: flex;
  flex-direction: column;
}
.form-group input,
.form-group select {
  padding: 0.5rem;
  border: 1px solid #ccc;
  border-radius: 4px;
  margin-top: 0.3rem;
}
.btn-primary {
  background: #3498db;
  color: white;
  border: none;
  padding: 0.6rem 1.2rem;
  border-radius: 4px;
  cursor: pointer;
}
.btn-danger {
  background: #e74c3c;
  color: white;
  border: none;
  padding: 0.4rem 0.8rem;
  border-radius: 4px;
  cursor: pointer;
}
.btn-warning {
  background: #f1c40f;
  border: none;
  padding: 0.4rem 0.8rem;
  border-radius: 4px;
  cursor: pointer;
  margin-right: 0.5rem;
}
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 1rem;
  background: white;
}
th,
td {
  padding: 0.8rem;
  text-align: left;
  border-bottom: 1px solid #eee;
}
th {
  background: #34495e;
  color: white;
}
</style>
