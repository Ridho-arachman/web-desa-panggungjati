# 🏛️ Web Kelurahan Panggungjati

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=flat&logo=laravel)
![Filament](https://img.shields.io/badge/Filament-3.x-FFB300?style=flat&logo=laravel)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-4.x-06B6D4?style=flat&logo=tailwindcss)
![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?style=flat&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat&logo=mysql)

**Web resmi Kelurahan Panggungjati, Kecamatan Taktakan, Kota Serang, Banten.**  
Dibangun untuk memudahkan pelayanan administrasi, penyebaran informasi, dan partisipasi warga secara digital.

---

## ✨ Fitur Utama

### 🔗 Halaman Publik

- **Beranda** – Hero dinamis, statistik real‑time, berita terbaru.
- **Tentang Kelurahan** – Sejarah, visi & misi, profil lengkap, peta Google Maps, alamat.
- **Layanan Surat** – Daftar surat aktif, pencarian, detail persyaratan, tautan Google Form.
- **Berita** – Daftar berita, detail artikel, galeri foto, berita terkait.
- **Struktur Organisasi** – Tampilan hierarkis perangkat kelurahan.
- **Masukan Warga** – Form aspirasi dengan notifikasi toast.

### 🛡️ Panel Admin (Filament)

- **Manajemen Surat** – CRUD jenis surat, deskripsi kaya, tautan Google Form.
- **Manajemen Berita** – CRUD berita, jadwal tayang, galeri gambar (maks. 5 foto).
- **Struktur Organisasi** – Atur hierarki perangkat kelurahan.
- **Masukan Warga** – Lihat, tanggapi, dan ubah status masukan.
- **Pengaturan** – Kelola nama kelurahan, visi, misi, sejarah, profil, peta, dll.
- **Autentikasi** – Login aman, reset password, profil akun.
- **Dashboard** – Statistik jumlah surat, berita, masukan, dan tabel ringkasan data terbaru.

---

## 🧰 Teknologi

| Bidang         | Teknologi                                 |
| -------------- | ----------------------------------------- |
| Backend        | Laravel 11, PHP 8.3                       |
| Frontend       | Blade, TailwindCSS 4, Alpine.js (minimal) |
| Admin Panel    | Filament 3 (Livewire + Alpine.js)         |
| Database       | MySQL / MariaDB                           |
| Maps           | Google Maps Embed                         |
| Form Eksternal | Google Forms                              |
| Deployment     | Nginx / Apache, Ngrok untuk testing       |

---

## 📋 Persyaratan Sistem

- PHP ≥ 8.1
- Composer 2
- Node.js ≥ 18 + NPM
- MySQL 8.0 / MariaDB 10.6
- Git
- (Opsional) Ngrok untuk testing sementara

---

## 🚀 Instalasi

### 1. Clone repositori

```bash
git clone https://github.com/username/kelurahan-panggungjati.git
cd kelurahan-panggungjati
```

### 2. Install dependensi PHP

```bash
composer install
```

### 3. Salin file environment

```bash
cp .env.example .env
```

### 4. Generate application key

```bash
php artisan key:generate
```

### 5. Konfigurasi database di `.env`

```
DB_DATABASE=kelurahan_panggungjati
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Jalankan migrasi dan seed data awal

```bash
php artisan migrate
```

### 7. Install dan kompilasi aset frontend

```bash
npm install
npm run build
```

### 8. Buat symbolic link untuk storage

```bash
php artisan storage:link
```

### 9. Buat user admin pertama

```bash
php artisan make:filament-user
```

### 10. Jalankan server lokal

```bash
php artisan serve
```

Akses **halaman publik**: [http://localhost:8000](http://localhost:8000)  
Akses **panel admin**: [http://localhost:8000/admin](http://localhost:8000/admin)

---

## ⚙️ Konfigurasi Tambahan

- **Reset Password**: Pastikan `.env` terisi kredensial SMTP (lihat komentar di `.env`).
- **Google Maps**: Dapatkan kode embed dari Google Maps, lalu tambahkan melalui panel admin (Pengaturan → key `gmaps_embed`).
- **Google Forms**: Setiap jenis surat memiliki kolom `gform_link` yang bisa diisi tautan formulir.

---

## 📁 Struktur Proyek (ringkasan)

```
├── app
│   ├── Filament/Resources    ← Admin resource (CRUD)
│   ├── Filament/Widgets      ← Widget dashboard
│   ├── Models/               ← Eloquent models
│   └── ...
├── database/migrations       ← Skema database
├── public/
│   └── images/               ← Logo, pattern, dll.
├── resources/
│   ├── views/
│   │   ├── layouts/          ← Layout publik
│   │   ├── partials/         ← Navbar, footer
│   │   └── public/           ← Halaman warga
│   └── css/app.css           ← Tailwind custom
└── routes/web.php            ← Routing publik & admin
```

---

## 🤝 Kontributor

- **Kepala Kelurahan** – Heruji, S.Pd.I, M.Si
- **Tim Pengembang** – [Nama Tim/Instansi]
- **Warga Panggungjati** – Masukan dan aspirasi Anda adalah fondasi proyek ini.

---

## 📄 Lisensi

Proyek ini dibangun untuk **Kelurahan Panggungjati** dan dapat digunakan sebagai referensi atau dasar pengembangan sistem informasi desa/kelurahan lainnya.  
Lisensi: **MIT** (bebas digunakan dengan tetap mencantumkan sumber).

---
