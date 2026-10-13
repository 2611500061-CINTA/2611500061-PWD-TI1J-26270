# Pertemuan 05: P5 - JavaScript Dasar, DOM, Event, dan Validasi Sisi Klien

## Tujuan

Pada P5, saya belajar menghubungkan JavaScript dengan HTML. Saya juga belajar memakai DOM dan event untuk membuat navigasi dan formulir menjadi interaktif.

## Berkas yang digunakan

- `index.html`: berisi halaman Profil Mahasiswa dan memanggil berkas JavaScript.
- `script.js`: mengatur tombol navigasi dan memeriksa isian formulir.
- `style.css`: mengatur tampilan halaman dan navigasi.
- `foto-profil.jpg`: foto profil yang ditampilkan di halaman.
- `img/`: folder gambar pendukung.

## Cara menjalankan halaman

1. Buka folder `pertemuan-05` di VS Code.
2. Jalankan `index.html` dengan Live Server atau buka berkas tersebut di browser.
3. Jika menggunakan Live Server, halaman akan terbuka di browser. Untuk melihat tampilan layar kecil, gunakan mode responsif di DevTools.

## Perubahan

- Pada `index.html`, elemen navigasi diberi ID `navMenu`, formulir diberi ID `contactForm`, dan elemen `formFeedback` ditambahkan untuk menampilkan pesan hasil pemeriksaan.
- Pada bagian akhir `index.html`, sebelum `</body>`, ditambahkan `<script src="script.js"></script>`.
- Berkas `script.js` dibuat untuk mengatur tombol buka/tutup navigasi serta memeriksa isian formulir.
- Path `script.js` bersifat relatif. Berkas `script.js` berada satu folder dengan `index.html`, jadi nama dan lokasinya sudah sesuai.

## Pengujian dan hasil

- **Pemeriksaan pemanggilan JavaScript:** atribut `src` dan lokasi `script.js` sudah diperiksa dan sesuai.
- **Pemeriksaan sintaks:** perintah `node --check pertemuan-05/script.js` dijalankan. Tidak ada pesan galat.
- **Pengujian fungsi JavaScript:** skrip dijalankan dengan DOM tiruan melalui Node. Tombol navigasi mengubah status dan labelnya, formulir valid menampilkan “Form berhasil divalidasi.”, email tidak valid menampilkan pesan kesalahan, dan tombol reset menghapus pesan. Semua pemeriksaan tersebut lulus.
- **Pemeriksaan di browser:** screenshot Microsoft Edge menunjukkan halaman terbuka pada ukuran responsif 400 × 501 piksel. Menu navigasi terbuka dan tautan Beranda, Tentang, serta Kontak terlihat. Ini menunjukkan event tombol navigasi berjalan.
- **Pengujian formulir di browser:** belum dilakukan. Hasil formulir yang dicatat di atas berasal dari pengujian DOM tiruan, bukan dari pengiriman formulir di browser.
- Kode pengujian sementara dijalankan langsung melalui Node dan tidak disimpan di berkas proyek.

## Galat dan perbaikan

Saat pengecekan awal, JavaScript membutuhkan ID `navMenu`, `contactForm`, dan `formFeedback`. ID tersebut sudah ditambahkan ke HTML. Tidak ditemukan masalah pada nama atau lokasi `script.js`, atribut `src`, maupun penempatan tag `<script>`.

## Riwayat Pengembangan

- **Hubungkan JavaScript eksternal ke HTML:** menghubungkan `index.html` dengan `script.js`, menambahkan elemen untuk pesan validasi, dan memperbarui dokumentasi. Pemeriksaan sintaks dan uji fungsi JavaScript dengan DOM tiruan lulus; menu navigasi juga terlihat berjalan pada screenshot browser.
