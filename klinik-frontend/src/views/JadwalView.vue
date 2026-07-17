<template>
  <div>
    <h2>Jadwal Dokter</h2>
    <div class="card">
      <form
        @submit.prevent="simpanData"
        style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr auto; gap: 1rem; align-items: end"
      >
        <div class="form-group">
          <label>Dokter</label>
          <select v-model="form.dokter_id" required>
            <option v-for="d in dokters" :key="d.id" :value="d.id">{{ d.nama }} ({{ d.spesialis }})</option>
          </select>
        </div>
        <div class="form-group"><label>Hari</label><input v-model="form.hari" required placeholder="Cth: Senin" /></div>
        <div class="form-group"><label>Jam Mulai</label><input type="time" v-model="form.jam_mulai" required /></div>
        <div class="form-group">
          <label>Jam Selesai</label><input type="time" v-model="form.jam_selesai" required />
        </div>
        <button type="submit" class="btn-primary" style="margin-bottom: 1rem">Simpan</button>
      </form>
    </div>

    <table>
      <thead>
        <tr>
          <th>Dokter</th>
          <th>Hari</th>
          <th>Jam Praktik</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="j in jadwals" :key="j.id">
          <td>{{ j.dokter?.nama }}</td>
          <td>{{ j.hari }}</td>
          <td>{{ j.jam_mulai }} - {{ j.jam_selesai }}</td>
          <td><button @click="hapusData(j.id)" class="btn-danger">Hapus</button></td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import api from '../api';

const jadwals = ref([]);
const dokters = ref([]);
const form = ref({ dokter_id: '', hari: '', jam_mulai: '', jam_selesai: '' });

const fetchData = async () => {
  const [resJadwal, resDokter] = await Promise.all([api.get('/jadwals'), api.get('/dokters')]);
  jadwals.value = resJadwal.data.data;
  dokters.value = resDokter.data.data;
};

const simpanData = async () => {
  await api.post('/jadwals', form.value);
  form.value = { dokter_id: '', hari: '', jam_mulai: '', jam_selesai: '' };
  fetchData();
};
const hapusData = async (id) => {
  if (confirm('Hapus jadwal ini?')) {
    await api.delete(`/jadwals/${id}`);
    fetchData();
  }
};

onMounted(fetchData);
</script>
