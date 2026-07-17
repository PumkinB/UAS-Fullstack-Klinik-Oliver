<template>
  <div>
    <h2>Dashboard Statistik</h2>
    <div style="display: flex; gap: 1rem">
      <div class="card" style="flex: 1; text-align: center">
        <h3>Total Pasien</h3>
        <h1>{{ stats.total_pasien }}</h1>
      </div>
      <div class="card" style="flex: 1; text-align: center">
        <h3>Total Dokter</h3>
        <h1>{{ stats.total_dokter }}</h1>
      </div>
      <div class="card" style="flex: 1; text-align: center">
        <h3>Total Jadwal Aktif</h3>
        <h1>{{ stats.total_jadwal }}</h1>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import api from '../api';

const stats = ref({ total_pasien: 0, total_dokter: 0, total_jadwal: 0 });

onMounted(async () => {
  try {
    const response = await api.get('/dashboard');
    stats.value = response.data.data;
  } catch (error) {
    console.error('Gagal mengambil data dashboard', error);
  }
});
</script>
