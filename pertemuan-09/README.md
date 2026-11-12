# Pertemuan 09 — Larik, Fungsi, dan Modularisasi PHP

## Ringkasan pengembangan

Pertemuan 09 mengembangkan bahan pertemuan 08 pada direktori `pertemuan-09/`. Fitur halaman dan formulir yang sudah ada dipertahankan; perubahan berfokus pada pengelolaan data PHP yang lebih terstruktur.

- Data formulir disimpan sebagai larik asosiatif pada `$_SESSION['formData']`.
- Daftar minat formulir menggunakan larik terindeks (`minat[]`), divalidasi, dan ditampilkan dengan `foreach`.
- Data formulir yang diterima dan data profil dirender menggunakan `foreach`.
- Validasi formulir dipindahkan ke fungsi `validasiFormulir($data)` yang menerima larik asosiatif dan mengembalikan pesan kesalahan.
- Fungsi `hitungSisaSemester()` dan `tentukanKategoriSemester()` menerima parameter dan mengembalikan nilai.
- Fungsi PHP dipisahkan pada `fungsi.php`, kemudian dimuat dari `index.php` dengan `include_once`.
- `script.js` dan `style.css` dipertahankan tanpa perubahan.

## Berkas utama

- `index.php` — halaman profil, pemrosesan dan validasi formulir, session, serta penyajian data.
- `fungsi.php` — fungsi pembersih teks, validasi formulir, penghitungan sisa semester, dan penentuan kategori semester.
- `script.js` — navigasi dan validasi sisi browser.
- `style.css` — tata letak dan tampilan halaman.

## Pengujian

### Pemeriksaan sintaks PHP

Pada 12 November 2026, PHP 8.3 menjalankan pemeriksaan sintaks berikut:

```text
php -l index.php
No syntax errors detected in index.php

php -l fungsi.php
No syntax errors detected in fungsi.php
```

### Pengujian browser lokal

Pengguna melaporkan sudah membuka dan menguji halaman lokal: tidak ada error yang terlihat dan tampilan halaman tampak sama seperti sebelumnya. Pengujian browser tersebut dilakukan sebelum validasi formulir terakhir dipindahkan ke `validasiFormulir()`. Karena itu, perilaku browser setelah refactoring terakhir belum diverifikasi ulang.

URL lokal yang digunakan:

http://localhost/pwd/2611500061-PWD-TI1J-26270/pertemuan-09/

## Galat dan perbaikan

- Pemeriksaan sintaks PHP tidak menemukan galat pada `index.php` maupun `fungsi.php`.
- Dalam pengujian browser yang dilaporkan pengguna, tidak ada error yang terlihat. Tampilan yang tetap sama sesuai karena pengembangan ini merapikan pemrosesan PHP tanpa mengubah desain halaman.
- Validasi formulir yang sebelumnya berada langsung di `index.php` dipindahkan ke `fungsi.php` agar pemrosesan data formulir modular dan dapat digunakan kembali.
