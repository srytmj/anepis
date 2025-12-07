# SIPENA

Sistem Informasi Pendaftaran Asprak berbasis Laravel yang mendukung login menggunakan email atau username, dan mendukung beberapa role pengguna:

- Student
- Lecture (Dosen)
- Admin

Proyek ini menggunakan Laravel Breeze untuk scaffolding autentikasi dan Tailwind CSS untuk tampilan antarmuka yang modern dan responsif.

---

## Instalasi 

### Clone Repository

```bash
git clone https://github.com/username/repo-name.git
cd repo-name
```

### Install Dependencies

```bash
composer install
npm install
```

### Setup Environment

Copy file .env.example menjadi .env

```bash
cp .env.example .env
```

Generate application key

```bash
php artisan key:generate
```

### Konfigurasi Database

Edit file .env lalu sesuaikan dengan konfigurasi database

```env
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

### Migrasi Database

```bash
php artisan migrate
```

### Link folder storage
```bash
php artisan storage:link
```

### Build Frontend

```bash
npm run dev
```

Untuk mode production

```bash
npm run build
```

### Jalankan Aplikasi

```bash
php artisan serve
```

Aplikasi dapat diakses melalui

```
http://localhost:8000
```

## Technology Stack

| Teknologi | Deskripsi |
|----------|-----------|
| Laravel 11 | Backend utama |
| Laravel Breeze | Autentikasi |
| Tailwind CSS | UI Styling |
| Blade Components | Reusable UI |
| MySQL / PostgreSQL | Database |

---

## Documentation

Dokumentasi lengkap akan ditambahkan seiring pengembangan aplikasi.  

---

<!-- ## Lessons Learned -->

Proyek ini menjadi pembelajaran dalam:

- Customisasi autentikasi Laravel (LoginRequest) agar mendukung email/username
- Penerapan role-based user login

---
<!-- 
## Authors

Dikembangkan oleh:

- Surya Atmaja  
  GitHub: https://github.com/srytmj  

--- -->

## License

Open Source — Dapat digunakan untuk pembelajaran dan pengembangan lebih lanjut.
