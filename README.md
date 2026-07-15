# 🌿 Eco Track — Sistem Monitoring Proyek Lingkungan

**Eco Track** adalah aplikasi berbasis web untuk memantau dan mengelola proyek-proyek lingkungan seperti Instalasi Pengolahan Air Limbah (IPAL), WTP, STP, jasa konstruksi umum, konsultasi & perizinan, serta desain teknis (DED). Aplikasi ini dikembangkan menggunakan **Laravel 13** dengan **Tailwind CSS**.

---

## ✨ Fitur Utama

- **Manajemen Proyek** — Tambah, edit, hapus, dan pantau proyek lingkungan
- **Manajemen Klien** — Kelola data klien dan akun login klien
- **Kategori Proyek** — Kategorisasi proyek yang menentukan visibilitas per role:
  - `Pembangunan IPAL/WTP/STP` → Civil Engineer & Perizinan
  - `Jasa Konstruksi Umum` → Civil Engineer & Perizinan
  - `Konsultasi & Perizinan` → Hanya Perizinan
  - `Desain Teknis (DED)` → Hanya Civil Engineer
- **Catatan Progres** — Timeline pekerjaan proyek dengan dokumentasi gambar
- **Dokumen Proyek** — Unggah, unduh, dan kelola dokumen per proyek
- **Dashboard** — Statistik total proyek, proyek aktif, proyek selesai, dan total klien
- **Role-Based Access Control (RBAC)** — 5 role dengan hak akses berbeda
- **Pencarian** — Cari proyek atau klien dengan cepat

---

## 🔐 Role & Hak Akses

| Role | Proyek | Klien | Progres | Dokumen |
|------|--------|-------|---------|---------|
| **Admin** | ✅ CRUD | ✅ CRUD | ❌ | ❌ |
| **Direktur** | 👁️ Lihat saja | 👁️ Lihat saja | 👁️ Lihat | 👁️ Lihat |
| **Civil Engineer** | 👁️ Lihat + ✏️ Edit | 👁️ Lihat (sesuai proyek) | ✅ CRUD | ✅ Unggah + Hapus |
| **Perizinan Lingkungan** | 👁️ Lihat + ✏️ Edit | 👁️ Lihat (sesuai proyek) | ✅ Tambah + Edit | ✅ Unggah + Hapus |
| **Klien** | 👁️ Lihat (milik sendiri) | 👁️ Lihat (milik sendiri) | 👁️ Lihat | ✅ Unggah + Unduh |

> **Keterangan:** ✅ = Bisa, 👁️ = Lihat saja, ✏️ = Edit saja, ❌ = Tidak bisa

---

## ⚙️ Persyaratan Sistem

- **PHP** ≥ 8.3
- **Composer** ≥ 2.x
- **MySQL** ≥ 8.0 / **MariaDB** ≥ 10.4
- **Node.js** ≥ 20.x (untuk development)
- **Laragon** / **XAMPP** / **WAMP** (untuk lokal)

---

## 🚀 Instalasi Lokal (Laragon)

### 1. Clone Repository

```bash
git clone https://github.com/username/eco-track.git
cd eco-track
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Environment Setup

```bash
cp .env.example .env
```

Edit `.env` sesuaikan database:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=eco_track
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Key & Migrate

```bash
php artisan key:generate
php artisan migrate
```

### 5. Seeder Data Awal

```bash
php artisan db:seed
```

Ini akan membuat:
- 1 data klien
- 1 proyek contoh
- 5 akun user (lihat tabel di bawah)

### 6. Storage Link

```bash
php artisan storage:link
```

### 7. Build Frontend

```bash
npm run build
```

### 8. Jalankan Server

```bash
php artisan serve
```

Buka **http://127.0.0.1:8000**

---

## 👥 Akun Default (Development)

| Role | Email | Password |
|------|-------|----------|
| **Admin** | `admin@ecotrack.test` | `password` |
| **Direktur** | `direktur@ecotrack.test` | `password` |
| **Civil Engineer** | `civil@ecotrack.test` | `password` |
| **Perizinan Lingkungan** | `perizinan@ecotrack.test` | `password` |
| **Klien** | `klien@ecotrack.test` | `password` |

### Buat Admin Baru (Command)

```bash
php artisan admin:create --email=admin@email.com --password=rahasia
```

---

## 📁 Struktur Database

### Tabel Utama

| Tabel | Deskripsi |
|-------|-----------|
| `users` | Akun user (admin, direktur, civil, perizinan, klien) |
| `kliens` | Data klien perusahaan |
| `proyeks` | Data proyek (dengan kategori, deskripsi, assigned_to) |
| `progres_proyeks` | Riwayat progres pekerjaan |
| `dokumen_proyeks` | File dokumen yang diunggah |

---

## 🖥️ Panduan Penggunaan

### Admin

1. **Login** sebagai admin (`admin@ecotrack.test`)
2. **Tambah Proyek Baru** → Klik "Tambah Proyek" → Isi form:
   - Kode & Nama Proyek
   - **Kategori Proyek** (menentukan siapa yang bisa melihat)
   - Klien, Lokasi, Deskripsi, Tanggal, Status
3. **Edit/Hapus Proyek** → Tombol aksi di tabel
4. **Kelola Klien** → Menu "Data Klien"
5. **Tambah Klien Baru** → Otomatis membuat akun login untuk klien

### Civil Engineer & Perizinan

1. **Lihat proyek** yang sesuai kategori (ditentukan admin)
2. **Edit proyek** — mengubah data proyek (tidak bisa hapus/tambah)
3. **Catat Progres** → Timeline pekerjaan + upload dokumentasi
4. **Unggah Dokumen** → File terkait proyek
5. **Lihat data klien** — hanya klien yang terkait dengan proyek mereka

### Klien

1. **Lihat proyek** milik sendiri
2. **Lihat progres & dokumen**
3. **Unggah dokumen** yang diperlukan

---

## 🌐 Deployment ke Hosting (Infinity Free / cPanel)

Tanpa terminal SSH, ikuti langkah berikut:

### 1. Persiapan File

```bash
# Di lokal, jalankan:
composer install --optimize-autoloader --no-dev
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 2. Upload via File Manager

Upload folder dan file berikut ke `public_html/`:
- `app/`, `bootstrap/`, `config/`, `database/`, `public/`, `resources/`, `routes/`, `storage/`, `vendor/`
- `artisan`, `composer.json`, `composer.lock`

### 3. Setup .env

```env
APP_NAME="Eco Track"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://domain-anda.com
APP_KEY=base64:... (generate di https://laravel-key-generator.vercel.app/)

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=user_database
DB_PASSWORD=password_database
```

### 4. Import Database

Export dari Laragon → Import via phpMyAdmin hosting.

### 5. Permission

Set `storage/` dan `bootstrap/cache/` ke **755**.

---

## 🛠️ Maintenance

### Backup Database

```bash
# Laragon
mysqldump -u root eco_track > backup_$(date +%Y%m%d).sql
```

### Melihat Log Error

```bash
tail -f storage/logs/laravel.log
```

### Bersihkan Cache

```bash
php artisan optimize:clear
```

---

## 📄 Lisensi

**Eco Track** dikembangkan untuk kebutuhan monitoring proyek lingkungan. Silakan gunakan dan modifikasi sesuai kebutuhan.

---

*Dibuat dengan ❤️ menggunakan Laravel & Tailwind CSS*
