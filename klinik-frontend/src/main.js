import { createApp } from 'vue';
import App from './App.vue';
import router from './router'; // Memanggil konfigurasi router

const app = createApp(App);

app.use(router); // Memasang router ke dalam aplikasi
app.mount('#app');
