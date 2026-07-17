<template>
  <div>
    <h2>Kelola Data Pasien</h2>

    <div class="card">
      <form @submit.prevent="simpanData" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem">
        <div class="form-group"><label>Nama</label><input v-model="form.nama" required /></div>
        <div class="form-group">
          <label>Tanggal Lahir</label><input type="date" v-model="form.tanggal_lahir" required />
        </div>
        <div class="form-group"><label>No HP</label><input v-model="form.no_hp" required /></div>
        <div class="form-group"><label>Alamat</label><input v-model="form.alamat" required /></div>
        <div style="grid-column: span 2">
          <button type="submit" class="btn-primary">{{ isEdit ? 'Update' : 'Simpan' }}</button>
          <button type="button" @click="resetForm" style="margin-left: 1rem">Batal</button>
        </div>
      </form>
    </div>

    <div style="margin-bottom: 1rem; display: flex; align-items: center; gap: 1rem">
      <input
        v-model="searchQuery"
        @input="cariData"
        placeholder="🔍 Cari nama pasien di sini..."
        style="padding: 0.6rem; width: 300px; border-radius: 4px; border: 1px solid #ccc"
      />
      <span v-if="isSearching" style="color: #7f8c8d; font-size: 0.9rem">Mencari...</span>
    </div>

    <table>
      <thead>
        <tr>
          <th>Nama</th>
          <th>Tanggal Lahir</th>
          <th>No HP</th>
          <th>Alamat</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr v-if="pasiens.length === 0">
          <td colspan="5" style="text-align: center">Data tidak ditemukan.</td>
        </tr>
        <tr v-for="p in pasiens" :key="p.id">
          <td>{{ p.nama }}</td>
          <td>{{ p.tanggal_lahir }}</td>
          <td>{{ p.no_hp }}</td>
          <td>{{ p.alamat }}</td>
          <td>
            <button @click="editData(p)" class="btn-warning">Edit</button>
            <button @click="hapusData(p.id)" class="btn-danger">Hapus</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import api from '../api';

const pasiens = ref([]);
const form = ref({ id: null, nama: '', tanggal_lahir: '', no_hp: '', alamat: '' });
const isEdit = ref(false);

// State untuk fitur pencarian
const searchQuery = ref('');
const isSearching = ref(false);

// Fungsi Ambil Data (Sekarang mendukung keyword pencarian)
const fetchData = async () => {
  try {
    const res = await api.get(`/pasiens?keyword=${searchQuery.value}`);
    pasiens.value = res.data.data;
  } catch (error) {
    console.error('Gagal mengambil data', error);
  }
};

// Fungsi yang dipanggil setiap kali mengetik di kotak pencarian
const cariData = () => {
  isSearching.value = true;
  // Gunakan setTimeout kecil (debounce sederhana) agar tidak terlalu sering hit API
  setTimeout(() => {
    fetchData();
    isSearching.value = false;
  }, 300);
};

const simpanData = async () => {
  try {
    if (isEdit.value) await api.put(`/pasiens/${form.value.id}`, form.value);
    else await api.post('/pasiens', form.value);

    resetForm();
    fetchData();
    alert('Data pasien berhasil disimpan!'); // Muncul notifikasi sukses
  } catch (error) {
    // Memunculkan pesan error jika gagal
    alert('Gagal menyimpan data: ' + (error.response?.data?.message || 'Terjadi kesalahan server'));
    console.error(error);
  }
};

const editData = (data) => {
  form.value = { ...data };
  isEdit.value = true;
};
const hapusData = async (id) => {
  if (confirm('Hapus?')) {
    await api.delete(`/pasiens/${id}`);
    fetchData();
  }
};
const resetForm = () => {
  form.value = { id: null, nama: '', tanggal_lahir: '', no_hp: '', alamat: '' };
  isEdit.value = false;
};

onMounted(fetchData);
</script>
