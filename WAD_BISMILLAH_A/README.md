# Sistem Manajemen Kelas Gym

Sistem ini dirancang untuk mengelola kelas-kelas di gym dengan fitur lengkap untuk manajemen jadwal, instruktur, dan kapasitas kelas.

## Fitur Sistem

### 1. Manajemen Kelas
- **Tambah Kelas Baru**
  - Nama Kelas (contoh: Yoga, Zumba, Pilates)
  - Kapasitas Peserta
  - Ruangan
  - Instruktur
  - Jadwal (Hari dan Waktu)
  - Deskripsi Kelas

- **Lihat Data Kelas**
  - Tampilan tabel yang informatif
  - Nomor urut
  - Detail kelas lengkap
  - Status kapasitas
  - Jadwal terorganisir

- **Edit Kelas**
  - Pembaruan informasi kelas
  - Perubahan jadwal
  - Pengaturan kapasitas
  - Pergantian instruktur

- **Hapus Kelas**
  - Fitur konfirmasi sebelum penghapusan
  - Penghapusan aman dari database

### 2. Struktur Database
Tabel `classes` memiliki kolom-kolom berikut:
- `id` (Primary Key)
- `name` (Nama Kelas)
- `capacity` (Kapasitas Peserta)
- `room` (Ruangan)
- `instructor` (Nama Instruktur)
- `schedule_day` (Hari Jadwal)
- `start_time` (Waktu Mulai)
- `end_time` (Waktu Selesai)
- `description` (Deskripsi Kelas)
- `created_at` (Waktu Pembuatan)
- `updated_at` (Waktu Update)

### 3. Validasi Data
Sistem memiliki validasi untuk:
- Nama kelas wajib diisi
- Kapasitas harus berupa angka
- Ruangan wajib diisi
- Instruktur wajib diisi
- Jadwal harus valid
- Format waktu yang sesuai

### 4. Antarmuka Pengguna
- **Halaman Utama**
  - Daftar kelas dalam format tabel
  - Tombol tambah kelas baru
  - Aksi edit dan hapus untuk setiap kelas
  - Pesan sukses setelah aksi

- **Form Tambah/Edit**
  - Input yang mudah dipahami
  - Validasi real-time
  - Pesan error yang informatif
  - Tombol simpan dan kembali

### 5. Keamanan
- CSRF Protection
- Validasi input
- Konfirmasi sebelum penghapusan
- Sanitasi data

## Cara Penggunaan

### Menambah Kelas Baru
1. Klik tombol "Tambah Kelas Baru"
2. Isi formulir dengan data yang diperlukan:
   - Nama Kelas
   - Kapasitas
   - Ruangan
   - Instruktur
   - Pilih hari jadwal
   - Set waktu mulai dan selesai
   - Tambahkan deskripsi (opsional)
3. Klik "Simpan Kelas"

### Mengedit Kelas
1. Klik tombol "Edit" pada kelas yang ingin diubah
2. Ubah data yang diperlukan
3. Klik "Update Kelas" untuk menyimpan perubahan

### Menghapus Kelas
1. Klik tombol "Hapus" pada kelas yang ingin dihapus
2. Konfirmasi penghapusan pada dialog yang muncul

## Teknologi yang Digunakan
- Laravel Framework
- MySQL Database
- Bootstrap 5
- JavaScript
- HTML5 & CSS3

## Kebutuhan Sistem
- PHP >= 8.0
- MySQL
- Composer
- Node.js & NPM (untuk asset compilation)

## Instalasi
1. Clone repository
2. Install dependencies: `composer install`
3. Copy `.env.example` ke `.env`
4. Generate key: `php artisan key:generate`
5. Setting database di `.env`
6. Jalankan migrasi: `php artisan migrate`
7. Jalankan server: `php artisan serve`
