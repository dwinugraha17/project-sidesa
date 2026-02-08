# 🚀 Panduan Hosting Laravel ke InfinityFree (Gratis Selamanya)

Panduan ini ditujukan untuk menghosting project Laravel (SiDesa) sebagai portofolio tanpa memerlukan kartu kredit.

---

## 📋 Prasyarat
1. Project Laravel sudah berjalan normal di lokal.
2. Akun [InfinityFree](https://www.infinityfree.com/) (Gratis).
3. Aplikasi FTP seperti **FileZilla** (Opsional, tapi sangat disarankan untuk upload file besar).

---

## 🛠 Langkah 1: Persiapan Project di Lokal

Sebelum diupload, kita harus menyiapkan file agar siap untuk lingkungan *production*.

1. **Build Assets (Vite):**
   Buka terminal di folder project kamu, lalu jalankan:
   ```bash
   npm install
   npm run build
   ```
   *Pastikan folder `public/build` sudah tercipta.*

2. **Optimasi Composer:**
   Hapus folder `vendor` yang lama (opsional) dan install ulang dengan optimasi:
   ```bash
   composer install --no-dev --optimize-autoloader
   ```

3. **Buat File `.htaccess` di Root Folder:**
   Buat file baru bernama `.htaccess` (sejajar dengan folder `app`, `bootstrap`, dll) agar website langsung mengarah ke folder `public`. Isi dengan:
   ```apache
   <IfModule mod_rewrite.c>
       RewriteEngine On
       RewriteRule ^(.*)$ public/$1 [L]
   </IfModule>
   ```

---

## ☁️ Langkah 2: Konfigurasi di InfinityFree

1. **Daftar & Buat Akun:**
   - Masuk ke dashboard InfinityFree.
   - Klik **Create Account**.
   - Pilih **Subdomain** (misal: `sidesa.infy.uk`).
   - Selesaikan proses sampai kamu mendapatkan detail **Hosting Account**.

2. **Siapkan Database:**
   - Di Control Panel (Softaculous/VistaPanel), cari menu **MySQL Databases**.
   - Buat database baru (catat nama database, username, dan host yang diberikan).
   - Klik **phpMyAdmin** pada database tersebut.
   - Pilih tab **Import**, lalu masukkan file `.sql` database kamu (hasil export dari phpMyAdmin lokal).

---

## 📤 Langkah 3: Mengunggah File (Metode ZIP)

Karena hosting gratis sering gagal jika upload ribuan file kecil via browser, gunakan metode ZIP:

1. **Compress Project:**
   - Di komputer kamu, blok semua file di dalam folder project (termasuk folder `vendor`, `public`, dll).
   - Klik kanan > **Send to Compressed (zipped) folder**. Beri nama `project.zip`.

2. **Upload & Extract:**
   - Masuk ke **Online File Manager** di dashboard InfinityFree.
   - Buka folder `htdocs`. Hapus file `index2.html` bawaan.
   - Klik tombol **Upload** dan pilih file `project.zip`.
   - Setelah selesai, klik kanan pada `project.zip` dan pilih **Extract**.

---

## ⚙️ Langkah 4: Konfigurasi Akhir (File .env)

Di dalam File Manager InfinityFree, cari file `.env` dan edit isinya:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=http://domain-kamu.infy.uk

# Isikan sesuai detail dari menu MySQL Databases di InfinityFree
DB_CONNECTION=mysql
DB_HOST=sqlxxx.infinityfree.com
DB_PORT=3306
DB_DATABASE=if0_xxxxxxxx_nama_db
DB_USERNAME=if0_xxxxxxxx
DB_PASSWORD=password_akun_hosting_kamu
```

---

## ⚠️ Troubleshooting (Masalah Umum)

1. **Error 500:**
   - Biasanya karena versi PHP tidak cocok. Masuk ke Control Panel > **PHP Config**, lalu ubah versi PHP ke **8.2** atau **8.3**.
   - Pastikan folder `storage` dan `bootstrap/cache` memiliki izin akses (permission) **775** atau **777**.

2. **Gambar/CSS Tidak Muncul:**
   - Jika kamu menggunakan `asset()` di Laravel, pastikan `APP_URL` di `.env` sudah benar.
   - Jika menggunakan `Storage::url()`, kamu mungkin perlu menjalankan `php artisan storage:link` di lokal sebelum di-ZIP, atau manual memindahkan isi `storage/app/public` ke `public/storage`.

3. **Limit Upload File Manager:**
   - Jika file ZIP kamu terlalu besar (>20MB), kamu **wajib** menggunakan **FileZilla** untuk upload folder satu per satu via FTP.

---

## 💡 Tips untuk Portofolio
Karena ini hosting gratis, server akan "tidur" jika tidak ada pengunjung. Saat pertama kali dibuka setelah lama tidak diakses, proses loading akan sedikit lambat. Ini normal. Sertakan link ini di CV atau LinkedIn kamu!
