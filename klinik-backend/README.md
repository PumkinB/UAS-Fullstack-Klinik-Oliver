# Sistem Manajemen Klinik Full-Stack (UAS)

Aplikasi Sistem Manajemen Klinik berbasis web terintegrasi yang dibangun menggunakan arsitektur Decoupled (Frontend terpisah dari Backend) untuk memenuhi Ujian Akhir Semester.

## 🚀 Teknologi yang Digunakan
* **Frontend:** Vue 3 (Vite), Vue Router, Axios
* **Backend:** Laravel 11, Sanctum (Token-based Auth)
* **Database:** MySQL
* **Deployment:** Vercel (Frontend) & [Nama Hosting Anda] (Backend)

## 🔗 URL Akses Aplikasi (Live)
* **Frontend (Aplikasi Web):** [Masukkan URL Deployment Frontend di sini]
* **Backend (REST API):** [Masukkan URL Deployment Backend di sini]

## 🛠️ Langkah Instalasi di Localhost

### 1. Konfigurasi Backend (Laravel)
1. Clone repository backend ini.
2. Buka terminal dan jalankan `composer install`.
3. Copy file `.env.example` menjadi `.env` dan isi kredensial database (buat database `klinik_db` di MySQL).
4. Jalankan `php artisan key:generate`.
5. Jalankan `php artisan migrate` untuk merakit tabel database.
6. Jalankan server lokal dengan perintah `php artisan serve`.

### 2. Konfigurasi Frontend (Vue 3)
1. Clone repository frontend.
2. Buka terminal dan jalankan `npm install` untuk mengunduh dependencies.
3. Buka file `src/api.js` dan pastikan `baseURL` mengarah ke endpoint backend lokal Anda (contoh: `http://localhost:8000/api`).
4. Jalankan aplikasi frontend dengan perintah `npm run dev`.
5. Buka URL lokal (biasanya http://localhost:5173) di browser.

## 👥 Hak Akses (Testing)
Gunakan kredensial berikut untuk masuk ke dalam sistem:
* **Email:** admin@klinik.com
* **Password:** 12
*(Atau buat akun baru menggunakan fitur Tinker Laravel `php artisan tinker`)*