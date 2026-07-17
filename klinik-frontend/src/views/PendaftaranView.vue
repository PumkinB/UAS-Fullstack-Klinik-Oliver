<template>
  <div>
    <h2>Pendaftaran & Riwayat Pemeriksaan</h2>
    <div class="card">
      <form @submit.prevent="simpanData" style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem">
        <div class="form-group">
          <label>Pasien</label>
          <select v-model="form.pasien_id" required>
            <option v-for="p in pasiens" :key="p.id" :value="p.id">{{ p.nama }}</option>
          </select>
        </div>
        <div class="form-group">
          <label>Jadwal Dokter</label>
          <select v-model="form.jadwal_id" required>
            <option v-for="j in jadwals" :key="j.id" :value="j.id">{{ j.dokter?.nama }} ({{ j.hari }})</option>
          </select>
        </div>
        <div class="form-group">
          <label>Tanggal Periksa</label><input type="date" v-model="form.tanggal_periksa" required />
        </div>
        <div class="form-group" style="grid-column: span 3">
          <label>Keluhan</label><input v-model="form.keluhan" required />
        </div>
        <button type="submit" class="btn-primary">Daftarkan Antrean</button>
      </form>
    </div>

    <table>
      <thead>
        <tr>
          <th>Tgl</th>
          <th>Pasien</th>
          <th>Dokter</th>
          <th>Keluhan</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="r in riwayats" :key="r.id">
          <td>{{ r.tanggal_periksa }}</td>
          <td>{{ r.pasien?.nama }}</td>
          <td>{{ r.jadwal?.dokter?.nama }}</td>
          <td>{{ r.keluhan }}</td>
          <td>
            <span :style="{ color: r.status === 'Antre' ? 'orange' : 'green', fontWeight: 'bold' }">{{
              r.status
            }}</span>
            <button
              v-if="r.status === 'Antre'"
              @click="tandaiSelesai(r.id)"
              class="btn-primary"
              style="margin-left: 1rem; padding: 0.2rem 0.5rem"
            >
              Selesai
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import api from '../api';

const riwayats = ref([]);
const pasiens = ref([]);
const jadwals = ref([]);
const form = ref({ pasien_id: '', jadwal_id: '', tanggal_periksa: '', keluhan: '' });

const fetchData = async () => {
  const [resRiwayat, resPasien, resJadwal] = await Promise.all([
    api.get('/pendaftarans'),
    api.get('/pasiens'),
    api.get('/jadwals'),
  ]);
  riwayats.value = resRiwayat.data.data;
  pasiens.value = resPasien.data.data;
  jadwals.value = resJadwal.data.data;
};

const simpanData = async () => {
  await api.post('/pendaftarans', form.value);
  form.value = { pasien_id: '', jadwal_id: '', tanggal_periksa: '', keluhan: '' };
  fetchData();
};

const tandaiSelesai = async (id) => {
  if (confirm('Tandai periksa selesai?')) {
    await api.put(`/pendaftarans/${id}`, { status: 'Selesai' });
    fetchData();
  }
};

onMounted(fetchData);
</script>
