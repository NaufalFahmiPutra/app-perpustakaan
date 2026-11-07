# Sistem Perpustakaan Digital Kampus

Aplikasi manajemen perpustakaan berbasis Laravel 12 untuk mengelola buku, kategori, anggota, dan transaksi peminjaman. Dibangun bertahap selama satu semester sebagai project mata kuliah Pemrograman Framework.

## Fitur

- CRUD Kategori, Buku, dan Anggota
- Transaksi peminjaman dan pengembalian buku
- Login/logout petugas dengan proteksi route (middleware `auth`)
- Pembatasan akses berdasarkan role (menu Kategori khusus admin)
- REST API untuk buku, anggota, peminjaman, dan statistik
- Dashboard statistik dan laporan peminjaman yang mengonsumsi API internal

## Kebutuhan Sistem

- PHP >= 8.2
- Composer
- MySQL
- Git

## Cara Menjalankan di Komputer Lokal

### 1. Clone repository

```bash
git clone https://github.com/[USERNAME]/app-perpustakaan.git
cd app-perpustakaan
```

### 2. Install dependency

```bash
composer install
```

### 3. Siapkan file `.env`

```bash
copy .env.example .env
php artisan key:generate
```

(Di Mac/Linux, ganti `copy` dengan `cp`.)

Buka `.env`, lalu pastikan bagian ini sesuai:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_perpustakaan
DB_USERNAME=root
DB_PASSWORD=

APP_FAKER_LOCALE=id_ID
INTERNAL_API_URL=http://127.0.0.1:8011
```

### 4. Buat database

Buat database kosong bernama `db_perpustakaan` lewat phpMyAdmin atau MySQL.

### 5. Migrasi dan isi data dummy

```bash
php artisan migrate:fresh --seed
```

Perintah ini membuat seluruh tabel dan mengisi data contoh (5 kategori, 20 buku, 15 anggota, 10 peminjaman, 3 akun).

### 6. Jalankan DUA server

Project ini **wajib** menjalankan dua server sekaligus. Buka **dua terminal** di folder project:

Terminal 1 (server utama, dibuka lewat browser):

```bash
php artisan serve --port=8000
```

Terminal 2 (server khusus API internal):

```bash
php artisan serve --port=8011
```

**Kenapa dua?** Dashboard dan Laporan Peminjaman mengambil data lewat `Http::get()` ke `/api/...` milik aplikasi itu sendiri. Server `php artisan serve` hanya memproses satu request pada satu waktu. Kalau hanya ada satu server, request pertama menunggu balasan dari request kedua yang tidak pernah bisa diproses (deadlock). Server kedua di port 8011 menangani panggilan API itu. Jika server kedua tidak jalan, Dashboard menampilkan angka 0 dan Laporan tampil kosong.

### 7. Buka aplikasi

Buka `http://127.0.0.1:8000` di browser.

## Akun Login

| Role | Email | Password |
|---|---|---|
| Admin | admin@pens.ac.id | password |
| Petugas | petugas1@pens.ac.id | password |
| Petugas | petugas2@pens.ac.id | password |

Menu **Kategori** hanya tampil dan bisa diakses oleh admin.

## Endpoint REST API

Dokumentasi lengkap 11 endpoint (books, members, loans, stats) ada di [API.md](./API.md). Base URL: `http://127.0.0.1:8000/api`.

## Skenario Demo

Langkah-langkah demo aplikasi ada di [DEMO.md](./DEMO.md).

## Struktur Branch

- `main`: versi stabil (hasil akhir)
- `dev`: branch pengembangan harian