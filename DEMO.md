# Skenario Demo - Sistem Perpustakaan Digital Kampus

## Persiapan Sebelum Demo

1. Jalankan `php artisan migrate:fresh --seed` agar data bersih dan konsisten.
2. Nyalakan **dua server** di dua terminal:
   - `php artisan serve --port=8000` (server utama)
   - `php artisan serve --port=8011` (server API internal)
3. Buka browser di `http://127.0.0.1:8000` dan Postman (collection `app-perpustakaan`).
4. Siapkan akun: `admin@pens.ac.id` / `password`.

## Langkah Demo

### 1. Login sebagai admin
- Buka `/login`, masuk dengan `admin@pens.ac.id` / `password`.
- **Yang ditunjukkan:** redirect ke Dashboard, nama dan role tampil di navbar.
- **Yang dijelaskan:** login memakai `Auth::attempt()` dan session; halaman lain dilindungi middleware `auth`.

### 2. Tampilkan Dashboard statistik
- Tunjukkan 3 kartu: Total Buku, Total Anggota, Peminjaman Aktif.
- **Yang dijelaskan:** angka diambil lewat `Http::get()` ke `GET /api/stats`, bukan query langsung ke database.

### 3. Tambah kategori baru
- Menu Kategori → Tambah Kategori, isi nama dan deskripsi, simpan.
- **Yang ditunjukkan:** data muncul di daftar dengan flash message sukses.

### 4. Tambah buku dengan kategori
- Menu Buku → Tambah Buku, pilih kategori yang baru dibuat di dropdown.
- **Yang ditunjukkan:** buku tersimpan dan kolom kategori menampilkan **nama** kategori (bukan ID).
- **Yang dijelaskan:** nama kategori muncul berkat relasi `belongsTo` dan eager loading `with('category')`.

### 5. Tambah anggota baru
- Menu Anggota → Tambah Anggota.
- Coba kirim NIM atau email yang sudah ada.
- **Yang ditunjukkan:** validasi unik menolak data duplikat dengan pesan error.

### 6. Buat transaksi peminjaman
- Menu Peminjaman → Tambah Peminjaman, pilih anggota baru dan buku baru.
- **Yang ditunjukkan:** tidak ada dropdown Petugas; petugas terisi otomatis dari akun yang login.
- **Yang dijelaskan:** `user_id` diambil dari `auth()->id()`.

### 7. Lihat daftar peminjaman aktif
- Buka halaman Peminjaman.
- **Yang ditunjukkan:** transaksi baru berstatus `dipinjam`, lengkap dengan nama anggota, petugas, dan judul buku.

### 8. Proses pengembalian buku
- Proses pengembalian untuk transaksi yang baru dibuat.
- **Yang ditunjukkan:** status berubah menjadi `dikembalikan` dan `tanggal_dikembalikan` terisi.
- (Jika fitur web belum dikerjakan, gunakan Postman: `PUT /api/loans/{id}/kembalikan`.)

### 9. Tampilkan Laporan Peminjaman
- Buka menu Laporan (`/loans/report`).
- **Yang ditunjukkan:** seluruh transaksi tampil, termasuk yang baru diproses.
- **Yang dijelaskan:** data diambil dari `GET /api/loans`.

### 10. Demo API di Postman
- `GET /api/books` → response JSON terstruktur dengan pagination.
- `GET /api/stats` → `total_buku`, `total_anggota`, `peminjaman_aktif`.
- **Yang dijelaskan:** format response konsisten berkat API Resource.

### 11. (Opsional) Uji hak akses
- Logout, login sebagai `petugas1@pens.ac.id`.
- **Yang ditunjukkan:** menu Kategori tidak muncul; membuka `/categories` langsung menghasilkan 403.
- **Yang dijelaskan:** middleware `CheckAdminRole` (otorisasi) berbeda dari `auth` (autentikasi).

## Catatan Teknis

- Dashboard dan Laporan membutuhkan server kedua di port 8011. Jika kosong atau 0, periksa apakah server kedua sudah menyala.
- Dokumentasi endpoint API ada di `API.md`.