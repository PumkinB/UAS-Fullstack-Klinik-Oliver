<template>
  <div>
    <h2>Kelola Data Dokter</h2>
    <div class="card">
      <form @submit.prevent="simpanData" style="display: flex; gap: 1rem; align-items: flex-end">
        <div class="form-group"><label>Nama Dokter</label><input v-model="form.nama" required /></div>
        <div class="form-group"><label>Spesialis</label><input v-model="form.spesialis" required /></div>
        <div class="form-group"><label>No HP</label><input v-model="form.no_hp" required /></div>
        <button type="submit" class="btn-primary" style="margin-bottom: 1rem">
          {{ isEdit ? 'Update' : 'Simpan' }}
        </button>
      </form>
    </div>

    <table>
      <thead>
        <tr>
          <th>Nama Dokter</th>
          <th>Spesialis</th>
          <th>No HP</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="d in dokters" :key="d.id">
          <td>{{ d.nama }}</td>
          <td>{{ d.spesialis }}</td>
          <td>{{ d.no_hp }}</td>
          <td>
            <button @click="editData(d)" class="btn-warning">Edit</button>
            <button @click="hapusData(d.id)" class="btn-danger">Hapus</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import api from '../api';

const dokters = ref([]);
const form = ref({ id: null, nama: '', spesialis: '', no_hp: '' });
const isEdit = ref(false);

const fetchData = async () => {
  const res = await api.get('/dokters');
  dokters.value = res.data.data;
};

const simpanData = async () => {
  if (isEdit.value) await api.put(`/dokters/${form.value.id}`, form.value);
  else await api.post('/dokters', form.value);
  form.value = { id: null, nama: '', spesialis: '', no_hp: '' };
  isEdit.value = false;
  fetchData();
};

const editData = (data) => {
  form.value = { ...data };
  isEdit.value = true;
};
const hapusData = async (id) => {
  if (confirm('Hapus?')) {
    await api.delete(`/dokters/${id}`);
    fetchData();
  }
};

onMounted(fetchData);
</script>
