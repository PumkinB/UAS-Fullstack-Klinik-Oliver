\# Sistem Manajemen Klinik Full-Stack (UAS)



Aplikasi Sistem Manajemen Klinik berbasis web terintegrasi yang dibangun menggunakan arsitektur Decoupled (Frontend terpisah dari Backend) untuk memenuhi Ujian Akhir Semester.



\*\*Oleh:\*\* Oliver Chin



\## 🚀 Teknologi yang Digunakan

\* \*\*Frontend:\*\* Vue 3 (Vite), Vue Router, Axios

\* \*\*Backend:\*\* Laravel 11, Sanctum (Token-based Auth)

\* \*\*Database:\*\* MySQL



\## 📂 Struktur Folder

\* `/klinik-backend` : Berisi source code API (Laravel).

\* `/klinik-frontend` : Berisi source code antarmuka (Vue 3).



\## 🛠️ Langkah Instalasi di Localhost (Komputer Dosen)



\### 1. Menjalankan Backend (Laravel)

1\. Buka terminal, masuk ke folder `klinik-backend` (`cd klinik-backend`).

2\. Jalankan `composer install`.

3\. Copy file `.env.example` menjadi `.env`.

4\. Buat database baru di MySQL (phpMyAdmin) dengan nama `klinik\_db`.

5\. Sesuaikan `DB\_DATABASE=klinik\_db` di dalam file `.env`.

6\. Jalankan `php artisan key:generate`.

7\. Jalankan `php artisan migrate` untuk membuat tabel.

8\. Jalankan server lokal dengan perintah `php artisan serve`.



\### 2. Menjalankan Frontend (Vue 3)

1\. Buka terminal baru, masuk ke folder `klinik-frontend` (`cd klinik-frontend`).

2\. Jalankan `npm install` untuk mengunduh dependencies.

3\. Jalankan aplikasi dengan perintah `npm run dev`.

4\. Buka URL lokal (biasanya http://localhost:5173) di browser.



\## 👥 Hak Akses Login

Untuk mencoba aplikasi, silakan buat akun admin menggunakan Tinker. Buka terminal di folder backend dan jalankan:

1\. `php artisan tinker`

2\. `App\\Models\\User::create(\['name' => 'Admin Klinik', 'email' => 'admin@klinik.com', 'password' => Hash::make('12')])`



Setelah itu, login di halaman frontend menggunakan email: \*\*admin@klinik.com\*\* dan password: \*\*12\*\*.

