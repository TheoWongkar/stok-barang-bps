# 🌴 Website BPS Sulawesi Utara

**Website Resmi Badan Pusat Statistik Sulawesi Utara (BPS SULUT)**  
Aplikasi ini merupakan sistem manajemen stok barang berbasis web yang dirancang khusus untuk memudahkan admin dalam mengelola persediaan barang di gudang atau instansi.

---

## 📌 Deskripsi Proyek

Website ini dibangun menggunakan Laravel sebagai backend dan Tailwind CSS untuk frontend.  
Tujuannya adalah untuk manajemen stock barang guna meningkatkan efisiensi penggunaan barang. Aplikasi hanya dapat diakses oleh admin, sehingga keamanan dan kontrol data tetap terjaga.

---

## ⚙️ Teknologi

-   Laravel 12
-   PHP 8.3
-   Alpine JS
-   Tailwind CSS
-   MySQL

---

## 🛠️ Instalasi & Setup

1. Clone repository:

    ```bash
    git clone https://github.com/TheoWongkar/stok-barang-bps.git
    cd stok-barang-bps
    ```

2. Install dependency:

    ```bash
    composer install
    npm install && npm run build
    ```

3. Salin file `.env`:

    ```bash
    cp .env.example .env
    ```

4. Atur konfigurasi `.env` (database, mail, dsb)

5. Generate key dan migrasi database:

    ```bash
    php artisan key:generate
    php artisan storage:link
    php artisan migrate:fresh --seed
    ```

6. Jalankan server lokal:

    ```bash
    php artisan serve
    ```

7. Buka browser dan akses http://stok-barang-bps.test

---

## 👥 Role & Akses

| Role  | Akses                                                    |
| ----- | -------------------------------------------------------- |
| Admin | Akses dashboard, kelola data pegawai, kelola data barang |

---

## 📎 Catatan Tambahan

-   Pastikan folder `storage` dan `bootstrap/cache` writable.

---
