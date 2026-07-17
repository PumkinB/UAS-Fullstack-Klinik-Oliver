import axios from 'axios';

// Ganti URL ini jika port backend Laravel kamu berbeda (default XAMPP/Artisan serve biasanya 8000)
const apiClient = axios.create({
  baseURL: 'http://localhost:8000/api',
  headers: {
    'Content-Type': 'application/json',
    Accept: 'application/json',
  },
});

// Interceptor: Otomatis menyisipkan token ke setiap request jika token tersedia di localStorage
apiClient.interceptors.request.use((config) => {
  const token = localStorage.getItem('token');
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
});

export default apiClient;
