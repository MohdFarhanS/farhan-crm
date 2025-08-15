#### Deskripsi Proyek

Ini adalah aplikasi Customer Relationship Management (CRM) berbasis web yang dibuat dengan framework Laravel. Aplikasi ini membantu mengelola calon pelanggan (leads), produk, dan pelanggan yang sudah berlangganan. Sistem ini memiliki dua peran pengguna utama: **Sales** dan **Manager**.

* **Sales**: Bertugas mengelola daftar calon pelanggan dan memprosesnya menjadi proyek. Setelah proyek disetujui, calon pelanggan akan menjadi pelanggan resmi.
* **Manager**: Bertugas mengelola master produk, menyetujui atau menolak proyek yang diajukan oleh Sales, dan melihat daftar semua pelanggan.

---

### Alur Kerja Aplikasi (Workflow)

Aplikasi ini mengikuti alur kerja yang jelas untuk mengelola calon pelanggan (leads) hingga menjadi pelanggan aktif. Berikut adalah ringkasan alurnya:

1.  **Pengguna Login**
    * Pengguna (dengan peran **Sales** atau **Manager**) masuk ke dalam sistem. Alur yang akan mereka lihat setelah login bergantung pada peran mereka.

2.  **Peran Sales**
    * **Mengelola Leads**: Sales dapat melihat, menambahkan, dan mengedit data calon pelanggan (leads) baru.
    * **Mengajukan Proyek**: Sales mengajukan `Project` baru berdasarkan `Lead` yang ada. Proyek ini akan memiliki status awal 'Pending' dan akan menunggu persetujuan dari Manager.
    * **Proyek Disetujui**: Jika proyek disetujui oleh Manager, data `Lead` yang bersangkutan secara otomatis akan dipindahkan dan menjadi `Customer` resmi.

3.  **Peran Manager**
    * **Manajemen Produk**: Manager memiliki akses untuk melihat, menambahkan, mengedit, atau menghapus produk/layanan yang ditawarkan oleh perusahaan.
    * **Persetujuan Proyek**: Manager dapat melihat daftar semua `Project` yang diajukan oleh Sales. Mereka bertanggung jawab untuk menyetujui atau menolak proyek tersebut.
    * **Mengelola Pelanggan**: Manager dapat melihat daftar semua `Customers` yang sudah ada di sistem.

4.  **Menjadi Pelanggan Aktif**
    * Setelah sebuah `Project` disetujui, `Lead` yang terkait secara otomatis dikonversi menjadi `Customer`.
    * `Customer` dapat dikaitkan dengan satu atau lebih `Product` yang mereka beli, yang dicatat di dalam tabel perantara (`customer_product`).

#### Struktur Database (.sql)

Berikut adalah tabel-tabel utama yang relevan:

* **`users`**: Menyimpan data pengguna aplikasi. Kolom-kolom pentingnya adalah `name`, `email`, `password`, dan `role` (dengan nilai default 'sales').
* **`leads`**: Menyimpan informasi calon pelanggan (leads). Kolom-kolomnya meliputi `nama`, `email`, `telepon`, `alamat`, dan `status` (default 'Baru').
* **`products`**: Menyimpan daftar layanan atau produk yang ditawarkan. Kolomnya termasuk `nama_layanan`, `deskripsi`, `harga`, dan `is_active`.
* **`projects`**: Menyimpan data pengajuan proyek oleh sales. Tabel ini memiliki relasi dengan `leads` dan `users` melalui `lead_id` dan `user_id`. Status proyek bisa berupa 'Pending', 'Approved', atau 'Rejected'.
* **`customers`**: Menyimpan data pelanggan yang sudah disetujui dari `leads`. Kolomnya mirip dengan tabel `leads` (nama, email, telepon, alamat).
* **`customer_product`**: Tabel perantara (pivot table) yang menghubungkan pelanggan (`customers`) dengan layanan/produk (`products`) yang mereka beli.

---

#### Data Dictionary (Kamus Data)

Berikut adalah kamus data sederhana untuk tabel-tabel utama:

* **Tabel `users`**
    * `id`: `bigint`, Kunci utama.
    * `name`: `varchar(255)`, Nama pengguna.
    * `email`: `varchar(255)`, Alamat email unik.
    * `role`: `varchar(255)`, Peran pengguna ('sales' atau 'manager').
    * `password`: `varchar(255)`, Hash password.
    * `created_at`, `updated_at`: `timestamp`, Waktu pembuatan dan pembaruan data.
* **Tabel `leads`**
    * `id`: `bigint`, Kunci utama.
    * `nama`: `varchar(255)`, Nama calon pelanggan.
    * `email`: `varchar(255)`, Email calon pelanggan (opsional, unik).
    * `telepon`: `varchar(255)`, Nomor telepon calon pelanggan (opsional).
    * `alamat`: `text`, Alamat calon pelanggan (opsional).
    * `status`: `varchar(255)`, Status lead ('Baru', 'Diproses', 'Disetujui', 'Ditolak').
    * `created_at`, `updated_at`: `timestamp`.
* **Tabel `products`**
    * `id`: `bigint`, Kunci utama.
    * `nama_layanan`: `varchar(255)`, Nama produk/layanan.
    * `deskripsi`: `text`, Deskripsi produk/layanan (opsional).
    * `harga`: `numeric(10,2)`, Harga produk/layanan.
    * `is_active`: `boolean`, Status aktif produk/layanan.
    * `created_at`, `updated_at`: `timestamp`.
* **Tabel `projects`**
    * `id`: `bigint`, Kunci utama.
    * `lead_id`: `bigint`, Kunci asing ke tabel `leads`.
    * `user_id`: `bigint`, Kunci asing ke tabel `users` (sales yang mengajukan).
    * `status`: `varchar(255)`, Status proyek ('Pending', 'Approved', 'Rejected').
    * `created_at`, `updated_at`: `timestamp`.
* **Tabel `customers`**
    * `id`: `bigint`, Kunci utama.
    * `nama`: `varchar(255)`.
    * `email`: `varchar(255)`.
    * `telepon`: `varchar(255)`.
    * `alamat`: `text`.
    * `created_at`, `updated_at`: `timestamp`.
* **Tabel `customer_product`**
    * `id`: `bigint`, Kunci utama.
    * `customer_id`: `bigint`, Kunci asing ke tabel `customers`.
    * `product_id`: `bigint`, Kunci asing ke tabel `products`.
    * `created_at`, `updated_at`: `timestamp`.

---

Ini adalah link ERD https://dbdiagram.io/d/689f93bf1d75ee360acb67ba

### Panduan Instalasi dan Menjalankan Aplikasi

Ikuti langkah-langkah di bawah ini untuk menginstal dan menjalankan aplikasi CRM ini di lingkungan lokal Anda.

#### 1. Persiapan Awal

Pastikan Anda memiliki perangkat lunak berikut terinstal di sistem Anda:

  * **PHP:** Versi 8.2 atau lebih tinggi.
  * **Composer:** Pengelola paket PHP.
  * **Node.js & npm:** Untuk mengelola dependensi JavaScript.
  * **Git:** Untuk mengkloning repositori.
  * **PostgreSQL:** Database yang digunakan oleh aplikasi ini.

#### 2. Mengkloning Repositori

Buka terminal atau command prompt Anda, lalu jalankan perintah berikut untuk mengkloning repositori:

```bash
git clone https://github.com/mohdfarhans/farhan-crm.git
cd farhan-crm
```

#### 3. Konfigurasi Lingkungan

Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasinya:

```bash
cp .env.example .env
```

Buka file `.env` yang baru saja dibuat dan ubah detail database sesuai dengan server PostgreSQL lokal Anda.

```ini
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=nama_database_anda
DB_USERNAME=nama_pengguna_anda
DB_PASSWORD=kata_sandi_anda
```

#### 4. Instalasi Dependensi

Jalankan perintah berikut untuk menginstal semua dependensi PHP dan JavaScript:

```bash
composer install
npm install
```

#### 5. Generate Key dan Migrasi Database

Jalankan perintah di bawah ini untuk membuat *application key* dan menjalankan migrasi database, yang akan membuat semua tabel yang diperlukan.

```bash
php artisan key:generate
php artisan migrate
```

Jika Anda ingin mengisi database dengan data dummy, Anda bisa menjalankan perintah seeder:

```bash
php artisan db:seed
```

-----

### Menjalankan Aplikasi

Setelah semua langkah di atas selesai, Anda dapat menjalankan server pengembangan lokal dengan perintah berikut:

```bash
php artisan serve
npm run dev
```

Aplikasi kini dapat diakses di browser Anda di alamat: `http://127.0.0.1:8000`

Anda bisa masuk dengan kredensial dari `UserSeeder`:

  * **Email:** `manager@gmail.com`
  * **Password:** `password`