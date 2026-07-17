<template>
  <div class="login-container">
    <div class="login-card">
      <h2>Sistem Klinik</h2>
      <p class="subtitle">Silakan login untuk melanjutkan</p>
      <div><p>email:admin@klinik.com pass:12</p></div>

      <form @submit.prevent="handleLogin">
        <div class="form-group">
          <label>Email</label>
          <input type="email" v-model="email" required placeholder="Masukkan email" />
        </div>

        <div class="form-group">
          <label>Password</label>
          <input type="password" v-model="password" required placeholder="Masukkan password" />
        </div>

        <p v-if="errorMessage" class="error-message">{{ errorMessage }}</p>

        <button type="submit" :disabled="isLoading">
          {{ isLoading ? 'Memproses...' : 'Login' }}
        </button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import api from '../api'; // Memanggil konfigurasi axios yang sudah kita buat

const email = ref('');
const password = ref('');
const errorMessage = ref('');
const isLoading = ref(false);
const router = useRouter();

const handleLogin = async () => {
  isLoading.value = true;
  errorMessage.value = '';

  try {
    // Mengirim request POST ke endpoint /login di Laravel
    const response = await api.post('/login', {
      email: email.value,
      password: password.value,
    });

    // Jika berhasil, simpan token ke localStorage browser
    localStorage.setItem('token', response.data.access_token);
    localStorage.setItem('user', JSON.stringify(response.data.data));

    // Arahkan otomatis ke halaman dashboard
    router.push('/dashboard');
  } catch (error) {
    // Tangkap pesan error dari backend
    errorMessage.value = error.response?.data?.message || 'Gagal terhubung ke server.';
  } finally {
    isLoading.value = false;
  }
};
</script>

<style scoped>
.login-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

.login-card {
  background: white;
  padding: 2.5rem;
  border-radius: 12px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
  width: 100%;
  max-width: 380px;
}

h2 {
  text-align: center;
  margin: 0 0 0.5rem 0;
  color: #2c3e50;
}

.subtitle {
  text-align: center;
  color: #7f8c8d;
  font-size: 0.9rem;
  margin-bottom: 2rem;
}

.form-group {
  margin-bottom: 1.5rem;
}

label {
  display: block;
  margin-bottom: 0.5rem;
  color: #34495e;
  font-size: 0.9rem;
  font-weight: 500;
}

input {
  width: 100%;
  padding: 0.8rem;
  border: 1px solid #ddd;
  border-radius: 8px;
  box-sizing: border-box;
  font-size: 1rem;
  outline: none;
  transition: border-color 0.2s;
}

input:focus {
  border-color: #3498db;
}

button {
  width: 100%;
  padding: 0.9rem;
  background-color: #3498db;
  color: white;
  border: none;
  border-radius: 8px;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: background-color 0.2s;
}

button:hover:not(:disabled) {
  background-color: #2980b9;
}

button:disabled {
  background-color: #95a5a6;
  cursor: not-allowed;
}

.error-message {
  color: #e74c3c;
  font-size: 0.85rem;
  text-align: center;
  margin-bottom: 1rem;
}
</style>
