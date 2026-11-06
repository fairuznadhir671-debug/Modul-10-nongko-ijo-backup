# 🌲 SIPATROLI HUTAN - Sistem Pelaporan Patroli Hutan Secara Real-Time

Repositori resmi untuk Proyek Berbasis Projek (PjBL) kelompok dalam membangun sistem web geospasial berbasis pemantauan kawasan hutan (studi kasus Hutan Pinus Nongko Ijo) yang dioptimasi menggunakan teknik denormalisasi basis data.

---

## 👥 Tim Pengembang (Kelas 1B - TRPL)
* **Ahmad Mujadid Musyafi'i** (264311031)
* **Fairuz Nadhir Rahmad** (264311040)
* **Nila Ayunisa** (264311053)

---

## 🚀 Fitur Utama
1. **Pemetaan Geospasial (GIS):** Integrasi peta interaktif menggunakan Leaflet untuk menandai titik koordinat laporan.
2. **Sistem Pelaporan Mandiri:** Formulir pelaporan warga/petugas terkait kondisi lapangan (kebakaran, penebangan liar, pencemaran sampah, dll.).
3. **Optimasi Basis Data (Denormalisasi):** Penerapan tabel `rekap_laporan` untuk mempercepat performa kueri analitik dan pelaporan tanpa membebani tabel transaksional utama.
4. **Notifikasi Otomatis:** Integrasi bot Telegram untuk pelaporan insiden darurat secara real-time.

---

## 🛠️ Struktur Basis Data & Optimasi
* **Tabel `laporan`:** Menyimpan data transaksi mentah (*raw data*) secara mendetail.
* **Tabel `rekap_laporan`:** Tabel hasil denormalisasi untuk meringkas jumlah laporan per jenis masalah dan waktu kejadian terakhir guna efisiensi performa kueri.

---

## ⚙️ Cara Menjalankan Proyek
1. Kloning repositori ini atau unduh kodenya.
2. Pindahkan folder proyek ke dalam direktori server lokal XAMPP Anda (`C:\xampp\htdocs\nongko_ijo`).
3. Impor berkas basis data **`nongko_ijo.sql`** melalui **phpMyAdmin** (`http://localhost/phpmyadmin/`).
4. Jalankan Apache dan MySQL melalui XAMPP Control Panel.
5. Akses melalui browser: `http://localhost/nongko_ijo/`.
