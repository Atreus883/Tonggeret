# Tonggeret - Website Ulasan Film

![Demo Tonggeret](https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExaTNrcmxkZ2I4eHlmc2Q2ZzR0bTNnMmViN3B0aG56bTNwZTNkbTZrZCZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/L1R1tvI9svkIWwpY2b/giphy.gif)

Tonggeret adalah sebuah website ulasan film yang dibangun sebagai proyek untuk menerapkan dan memperdalam kemampuan pengembangan web. Platform ini memungkinkan pengguna untuk menemukan informasi mengenai film, membaca ulasan, dan memberikan rating. [cite_start]Proyek ini dibangun dengan framework CodeIgniter 4[cite: 25].

---

## 🚀 Fitur Utama

* **🎬 Katalog Film:** Menampilkan daftar film populer dan terbaru.
* **🔍 Pencarian Cepat:** Memungkinkan pengguna mencari film berdasarkan judul.
* **⭐ Halaman Detail:** Menampilkan informasi lengkap film seperti sinopsis, sutradara, aktor, dan rating.
* **✍️ Sistem Ulasan:** Pengguna (yang sudah login) dapat memberikan rating dan menulis ulasan untuk sebuah film.
* **👤 Manajemen Pengguna:** Fitur untuk register dan login pengguna.

---

## 🛠️ Teknologi yang Digunakan

* [cite_start]**Framework:** CodeIgniter 4 [cite: 25]
* [cite_start]**Bahasa:** PHP, JavaScript [cite: 33][cite_start], HTML5 [cite: 34][cite_start], CSS3 [cite: 34]
* **Database:** MySQL / MariaDB *(pilih salah satu)*
* **Server Lokal:** XAMPP / WAMP

---

## 👨‍💻 Peran dan Tanggung Jawab Saya

[cite_start]Sebagai **Frontend dan Partial Backend Developer**[cite: 24], tanggung jawab utama saya dalam proyek ini meliputi:

* [cite_start]Membangun seluruh antarmuka pengguna (UI) dari awal menggunakan Blade Template Engine pada CodeIgniter 4[cite: 25].
* [cite_start]Merancang dan mengimplementasikan tampilan website agar intuitif, responsif, dan menarik bagi pengguna[cite: 26].
* [cite_start]Menangani sebagian logika backend, termasuk membuat skema database, mengelola proses CRUD (Create, Read, Update, Delete) untuk data film dan ulasan, serta mengimplementasikan sistem autentikasi pengguna[cite: 25].

---

## ⚙️ Instalasi dan Setup Lokal

Untuk menjalankan proyek ini di lingkungan lokal, ikuti langkah-langkah berikut:

1.  **Clone repository ini:**
    ```bash
    git clone [https://github.com/NAMA_USER_ANDA/NAMA_REPO_ANDA.git](https://github.com/NAMA_USER_ANDA/NAMA_REPO_ANDA.git)
    cd NAMA_REPO_ANDA
    ```

2.  **Install dependencies Composer:**
    ```bash
    composer install
    ```

3.  **Setup file `.env`:**
    * Salin atau ubah nama file `env` (tanpa titik di depan) menjadi `.env`.
    * Sesuaikan konfigurasi database (hostname, username, password, dan nama database) di dalam file `.env`.

4.  **Jalankan migrasi database:**
    * Buat database baru di MySQL/MariaDB sesuai nama yang Anda atur di `.env`.
    * Jalankan perintah berikut untuk membuat tabel-tabel yang dibutuhkan:
    ```bash
    php spark migrate
    ```

5.  **Jalankan server pengembangan:**
    ```bash
    php spark serve
    ```
    Aplikasi akan berjalan di `http://localhost:8080`.

---

## 📞 Kontak

[cite_start]Dibuat oleh **Miftah Rijallul Aziz** [cite: 1]

* [cite_start]**Email:** miftahrijallul88@gmail.com [cite: 3]
* [cite_start]**LinkedIn:** [linkedin.com/in/miftah-rijallul-aziz](https://www.linkedin.com/in/miftah-rijallul-aziz/) [cite: 3]