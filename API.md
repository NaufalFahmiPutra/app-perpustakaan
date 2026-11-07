# Dokumentasi API - app-perpustakaan

Base URL: `http://127.0.0.1:8000/api`

Header yang dipakai di semua request: `Accept: application/json`

Catatan: seluruh endpoint bersifat publik (tanpa autentikasi), sesuai cakupan Pertemuan 9.

## Ringkasan Endpoint

| No | Method | URL | Body | Status Sukses | Status Gagal |
|---|---|---|---|---|---|
| 1 | GET | `/api/books` | - | 200 OK | - |
| 2 | GET | `/api/books/{id}` | - | 200 OK | 404 |
| 3 | POST | `/api/books` | JSON buku | 201 Created | 422 |
| 4 | PUT | `/api/books/{id}` | JSON buku | 200 OK | 422, 404 |
| 5 | DELETE | `/api/books/{id}` | - | 200 OK | 404 |
| 6 | GET | `/api/members` | - | 200 OK | - |
| 7 | GET | `/api/members/{id}` | - | 200 OK | 404 |
| 8 | GET | `/api/loans` | - | 200 OK | - |
| 9 | POST | `/api/loans` | JSON peminjaman | 201 Created | 422 |
| 10 | PUT | `/api/loans/{id}/kembalikan` | - | 200 OK | 404 |
| 11 | GET | `/api/stats` | - | 200 OK | - |

---

## 1. GET /api/books

Mengambil daftar buku (10 per halaman, dengan pagination).

**Body:** -

**Status Sukses:** 200 OK

**Response (dipersingkat: 2 dari 10 item):**

```json
{
    "data": [
        {
            "id": 1,
            "judul": "Bumi Manusia",
            "penulis": "Farah Dewi Rahayu S.Pt",
            "penerbit": "Bentang Pustaka",
            "tahun_terbit": 2025,
            "isbn": "9792084647714",
            "stok": 1,
            "sampul": null,
            "category": {
                "id": 1,
                "nama_kategori": "Novel"
            },
            "created_at": "2026-10-30T08:30:32.000000Z",
            "updated_at": "2026-10-30T08:30:32.000000Z"
        },
        {
            "id": 2,
            "judul": "Algoritma dan Struktur Data",
            "penulis": "Uchita Rahimah S.E.",
            "penerbit": "Rajawali Pers",
            "tahun_terbit": 2005,
            "isbn": "9798678266170",
            "stok": 4,
            "sampul": null,
            "category": {
                "id": 4,
                "nama_kategori": "Teknologi"
            },
            "created_at": "2026-10-30T08:30:32.000000Z",
            "updated_at": "2026-10-30T08:30:32.000000Z"
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/books?page=1",
        "last": "http://127.0.0.1:8000/api/books?page=2",
        "prev": null,
        "next": "http://127.0.0.1:8000/api/books?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 2,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "page": null,
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/books?page=1",
                "label": "1",
                "page": 1,
                "active": true
            },
            {
                "url": "http://127.0.0.1:8000/api/books?page=2",
                "label": "2",
                "page": 2,
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/books?page=2",
                "label": "Next &raquo;",
                "page": 2,
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8000/api/books",
        "per_page": 10,
        "to": 10,
        "total": 20
    }
}
```

---

## 2. GET /api/books/{id}

Mengambil detail satu buku.

**Body:** -

**Status sukses:** 200 OK
**Status gagal:** 404 (buku dengan id tersebut tidak ada)

**Response sukses (contoh: `/api/books/1`):**

```json
{
    "data": {
        "id": 1,
        "judul": "Bumi Manusia",
        "penulis": "Farah Dewi Rahayu S.Pt",
        "penerbit": "Bentang Pustaka",
        "tahun_terbit": 2025,
        "isbn": "9792084647714",
        "stok": 1,
        "sampul": null,
        "category": {
            "id": 1,
            "nama_kategori": "Novel"
        },
        "created_at": "2026-10-30T08:30:32.000000Z",
        "updated_at": "2026-10-30T08:30:32.000000Z"
    }
}
```

**Response gagal (404), contoh `/api/books/200`:**

```json
{
    "message": "No query results for model [App\\Models\\Book] 200",
    "exception": "Symfony\\Component\\HttpKernel\\Exception\\NotFoundHttpException"
}
```

---

## 3. POST /api/books

Menambah buku baru.

**Status sukses:** 201 Created
**Status gagal:** 422 (data tidak valid)

**Body:**

```json
{
  "judul": "Belajar Laravel",
  "penulis": "Titanio",
  "penerbit": "Informatika",
  "tahun_terbit": 2024,
  "isbn": "9781234567890",
  "stok": 5,
  "category_id": 1
}
```

**Response sukses (201):**

```json
{
    "data": {
        "id": 21,
        "judul": "Belajar Laravel",
        "penulis": "Titanio",
        "penerbit": "Informatika",
        "tahun_terbit": 2024,
        "isbn": "9781234567890",
        "stok": 5,
        "sampul": null,
        "category": {
            "id": 1,
            "nama_kategori": "Novel"
        },
        "created_at": "2026-11-05T04:15:19.000000Z",
        "updated_at": "2026-11-05T04:15:19.000000Z"
    }
}
```

**Response gagal (422), body `{}`:**

```json
{
    "message": "Judul buku wajib diisi. (and 5 more errors)",
    "errors": {
        "judul": [
            "Judul buku wajib diisi."
        ],
        "penulis": [
            "Nama penulis wajib diisi."
        ],
        "penerbit": [
            "Nama penerbit wajib diisi."
        ],
        "tahun_terbit": [
            "Tahun terbit wajib diisi."
        ],
        "stok": [
            "Stok wajib diisi."
        ],
        "category_id": [
            "Kategori wajib dipilih."
        ]
    }
}
```

---

## 4. PUT /api/books/{id}

Mengubah data buku. Semua field wajib dikirim ulang.

**Status sukses:** 200 OK
**Status gagal:** 422 (data tidak valid), 404 (buku tidak ada)

**Body (contoh: `/api/books/21`):**

```json
{
  "judul": "Belajar Laravel untuk Pemula (Edisi Revisi)",
  "penulis": "Titanio",
  "penerbit": "Informatika",
  "tahun_terbit": 2025,
  "isbn": "9781234567891",
  "stok": 10,
  "category_id": 1
}
```

**Response sukses (200):**

```json
{
    "data": {
        "id": 21,
        "judul": "Belajar Laravel untuk Pemula (Edisi Revisi)",
        "penulis": "Titanio",
        "penerbit": "Informatika",
        "tahun_terbit": 2025,
        "isbn": "9781234567891",
        "stok": 10,
        "sampul": null,
        "category": {
            "id": 1,
            "nama_kategori": "Novel"
        },
        "created_at": "2026-11-05T04:15:19.000000Z",
        "updated_at": "2026-11-05T04:20:08.000000Z"
    }
}
```

**Response gagal (422), body `{}`:**

```json
{
    "message": "The judul field is required. (and 5 more errors)",
    "errors": {
        "judul": [
            "The judul field is required."
        ],
        "penulis": [
            "The penulis field is required."
        ],
        "penerbit": [
            "The penerbit field is required."
        ],
        "tahun_terbit": [
            "The tahun terbit field is required."
        ],
        "stok": [
            "The stok field is required."
        ],
        "category_id": [
            "The category id field is required."
        ]
    }
}
```

---

## 5. DELETE /api/books/{id}

Menghapus buku.

**Body:** -

**Status sukses:** 200 OK
**Status gagal:** 404 (buku tidak ada)

**Response sukses:**

```json
{
    "message": "Buku berhasil dihapus."
}
```

**Response gagal (404):**

```json
{
    "message": "No query results for model [App\\Models\\Book] 200",
    "exception": "Symfony\\Component\\HttpKernel\\Exception\\NotFoundHttpException"
}
```

---

## 6. GET /api/members

Mengambil daftar anggota (10 per halaman, dengan pagination).

**Body:** -

**Status:** 200 OK

**Response (dipersingkat: 2 dari 10 item):**

```json
{
    "data": [
        {
            "id": 1,
            "nama": "Wani Tampubolon",
            "nim": "4542560119",
            "email": "wani.tampubolon816@pens.ac.id",
            "nomor_telepon": "082570357036",
            "alamat": "Jln. Ekonomi No. 437, Jayapura 15845, Jateng",
            "status": "aktif",
            "created_at": "2026-10-30T08:30:32.000000Z",
            "updated_at": "2026-10-30T08:30:32.000000Z"
        },
        {
            "id": 2,
            "nama": "Zalindra Laksita",
            "nim": "3781533440",
            "email": "zalindra.laksita822@pens.ac.id",
            "nomor_telepon": "083019434663",
            "alamat": "Gg. Salatiga No. 42, Makassar 12695, Jabar",
            "status": "nonaktif",
            "created_at": "2026-10-30T08:30:32.000000Z",
            "updated_at": "2026-10-30T08:30:32.000000Z"
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/members?page=1",
        "last": "http://127.0.0.1:8000/api/members?page=2",
        "prev": null,
        "next": "http://127.0.0.1:8000/api/members?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 2,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "page": null,
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/members?page=1",
                "label": "1",
                "page": 1,
                "active": true
            },
            {
                "url": "http://127.0.0.1:8000/api/members?page=2",
                "label": "2",
                "page": 2,
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/members?page=2",
                "label": "Next &raquo;",
                "page": 2,
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8000/api/members",
        "per_page": 10,
        "to": 10,
        "total": 15
    }
}
```

---

## 7. GET /api/members/{id}

Mengambil detail satu anggota.

**Body:** -

**Status sukses:** 200 OK
**Status gagal:** 404 (anggota tidak ada)

**Response sukses (contoh: `/api/members/1`):**

```json
{
    "data": {
        "id": 1,
        "nama": "Wani Tampubolon",
        "nim": "4542560119",
        "email": "wani.tampubolon816@pens.ac.id",
        "nomor_telepon": "082570357036",
        "alamat": "Jln. Ekonomi No. 437, Jayapura 15845, Jateng",
        "status": "aktif",
        "created_at": "2026-10-30T08:30:32.000000Z",
        "updated_at": "2026-10-30T08:30:32.000000Z"
    }
}
```

**Response gagal (404):**

```json
{
    "message": "No query results for model [App\\Models\\Member] 200",
    "exception": "Symfony\\Component\\HttpKernel\\Exception\\NotFoundHttpException"
}
```

---

## 8. GET /api/loans

Mengambil daftar transaksi peminjaman beserta anggota, petugas, dan buku yang dipinjam (10 per halaman).

**Body:** -

**Status:** 200 OK

**Response (dipersingkat: 2 dari 10 item):**

```json
{
    "data": [
        {
            "id": 1,
            "member": {
                "id": 13,
                "nama": "Darmana Napitupulu"
            },
            "petugas": {
                "id": 2,
                "name": "Siti Rahmawati"
            },
            "tanggal_pinjam": "2026-10-29",
            "tanggal_kembali": "2026-11-05",
            "tanggal_dikembalikan": null,
            "status": "dipinjam",
            "books": [
                {
                    "id": 6,
                    "judul": "Tuti and Friends"
                }
            ]
        },
        {
            "id": 2,
            "member": {
                "id": 14,
                "nama": "Luis Sihombing"
            },
            "petugas": {
                "id": 3,
                "name": "Ahmad Fauzi"
            },
            "tanggal_pinjam": "2026-10-27",
            "tanggal_kembali": "2026-11-03",
            "tanggal_dikembalikan": "2026-11-02",
            "status": "dikembalikan",
            "books": [
                {
                    "id": 12,
                    "judul": "Pengantar Basis Data"
                },
                {
                    "id": 20,
                    "judul": "Nusantaranger"
                },
                {
                    "id": 3,
                    "judul": "Negeri 5 Menara"
                }
            ]
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/loans?page=1",
        "last": "http://127.0.0.1:8000/api/loans?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "page": null,
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/loans?page=1",
                "label": "1",
                "page": 1,
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "page": null,
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8000/api/loans",
        "per_page": 10,
        "to": 10,
        "total": 10
    }
}
```

---

## 9. POST /api/loans

Membuat transaksi peminjaman baru. Satu transaksi bisa berisi banyak buku lewat `book_ids`.

**Status sukses:** 201 Created
**Status gagal:** 422 (data tidak valid)

**Body:**

```json
{
  "member_id": 1,
  "user_id": 1,
  "tanggal_pinjam": "2026-11-05",
  "tanggal_kembali": "2026-11-12",
  "book_ids": [1, 2]
}
```

**Response sukses (201):**

```json
{
    "data": {
        "id": 11,
        "member": {
            "id": 1,
            "nama": "Wani Tampubolon"
        },
        "petugas": {
            "id": 1,
            "name": "Bambang Sutrisno"
        },
        "tanggal_pinjam": "2026-11-05",
        "tanggal_kembali": "2026-11-12",
        "tanggal_dikembalikan": null,
        "status": "dipinjam",
        "books": [
            {
                "id": 1,
                "judul": "Bumi Manusia"
            },
            {
                "id": 2,
                "judul": "Algoritma dan Struktur Data"
            }
        ]
    }
}
```

**Response gagal (422), body `{}`:**

```json
{
    "message": "Anggota wajib dipilih. (and 4 more errors)",
    "errors": {
        "member_id": [
            "Anggota wajib dipilih."
        ],
        "user_id": [
            "Petugas (user_id) wajib diisi."
        ],
        "tanggal_pinjam": [
            "Tanggal pinjam wajib diisi."
        ],
        "tanggal_kembali": [
            "Tanggal kembali wajib diisi."
        ],
        "book_ids": [
            "Pilih minimal satu buku."
        ]
    }
}
```

---

## 10. PUT /api/loans/{id}/kembalikan

Menandai peminjaman sebagai sudah dikembalikan. Status berubah menjadi `dikembalikan` dan `tanggal_dikembalikan` diisi tanggal hari ini.

**Body:** -

**Status sukses:** 200 OK
**Status gagal:** 404 (transaksi tidak ada)

**Response sukses (contoh: `/api/loans/1/kembalikan`):**

```json
{
    "data": {
        "id": 1,
        "member": {
            "id": 13,
            "nama": "Darmana Napitupulu"
        },
        "petugas": {
            "id": 2,
            "name": "Siti Rahmawati"
        },
        "tanggal_pinjam": "2026-10-29",
        "tanggal_kembali": "2026-11-05",
        "tanggal_dikembalikan": "2026-11-05",
        "status": "dikembalikan",
        "books": [
            {
                "id": 6,
                "judul": "Tuti and Friends"
            }
        ]
    }
}
```

**Response gagal (404):**

```json
{
    "message": "No query results for model [App\\Models\\Loan] 200",
    "exception": "Symfony\\Component\\HttpKernel\\Exception\\NotFoundHttpException"
}
```

---

## 11. GET /api/stats

Mengambil ringkasan statistik perpustakaan.

**Body:** -

**Status:** 200 OK

**Response:**

```json
{
    "total_buku": 20,
    "total_anggota": 15,
    "peminjaman_aktif": 3
}
```