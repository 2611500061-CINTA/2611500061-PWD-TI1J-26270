# Pertemuan 6 — PHP Dasar dan Pemrograman Sisi Peladen

## Identitas

- Nama: Cinta Bunda Feliani
- NIM: 2611500061
- Program Studi: Teknik Informatika
- Mata Kuliah: Pemrograman Web Dasar
- Tahun Akademik: 2026/2027
- Pertemuan: 6

## Deskripsi

Pada Pertemuan 6, saya melanjutkan proyek dari Pertemuan 5 dengan menggunakan PHP. Saya menyalin proyek P5 ke folder `pertemuan-06/`, kemudian mengubah halaman utama dari `index.html` menjadi `index.php`.

Saya mempertahankan berkas pendukung yang masih digunakan, yaitu `style.css`, `script.js`, dan gambar profil. PHP digunakan untuk menghasilkan sebagian informasi profil secara dinamis. HTML tetap digunakan untuk menyusun halaman, CSS untuk mengatur tampilannya, dan JavaScript untuk interaksi sisi klien.

## Tujuan Pembelajaran

Pada tugas ini, saya mempelajari cara:

1. Menjalankan PHP melalui peladen lokal.
2. Menggunakan variabel, konstanta, dan tipe data dasar.
3. Menggunakan operator aritmetika, perbandingan, dan logika.
4. Membuat percabangan `if`, `elseif`, `else`, dan `switch`.
5. Menggunakan perulangan `for` dan `while`.
6. Menggunakan fungsi bawaan PHP dan sintaks keluaran singkat.
7. Menguji halaman melalui `localhost` dan mencatat hasilnya.
8. Mengelola perubahan proyek dengan Git dan GitHub.

## Struktur Folder

```text
pertemuan-06/
├── index.php
├── style.css
├── script.js
├── foto-profil.jpg
└── README.md

Perubahan yang Saya Kerjakan
1. Memindahkan dan menyiapkan proyek P5
Saya menggunakan proyek P5 sebagai dasar pengerjaan P6. Saya menyalin berkas proyek ke folder pertemuan-06/ dan mempertahankan berkas pendukung yang masih dibutuhkan.
Saya mengubah nama halaman utama dari index.html menjadi index.php.
2. Variabel dan konstanta
Saya menggunakan variabel untuk menyimpan data mahasiswa, seperti NIM, nama, program studi, tahun akademik, semester, IPK, status aktif, dan catatan tambahan.
Saya juga menggunakan konstanta untuk menyimpan nama mata kuliah dan username GitHub.
3. Operator
Saya menggunakan operator aritmetika untuk menghitung sisa semester dari batas delapan semester.
Saya menggunakan operator perbandingan untuk memeriksa apakah semester berada pada rentang 1 sampai 8. Hasil pemeriksaan tersebut digabungkan dengan status aktif menggunakan operator logika.
4. Percabangan
Saya menggunakan percabangan if, elseif, dan else untuk menentukan keterangan semester.
Saya menggunakan operator ternary untuk menentukan nama program studi dan status mahasiswa. Saya juga menggunakan switch, case, dan default untuk menentukan fokus program studi.
5. Perulangan
Saya menggunakan perulangan for untuk menampilkan lima target belajar. Saya menggunakan switch di dalam perulangan tersebut untuk menentukan teks setiap target.
Saya menggunakan perulangan while untuk menampilkan Semester 1, Semester 2, dan Semester 3.
6. Fungsi bawaan dan keluaran PHP
Saya menggunakan number_format() untuk menampilkan IPK dengan dua angka desimal.
Saya menggunakan pemeriksaan null untuk menampilkan keterangan catatan tambahan. Saya menggunakan date("Y") untuk menampilkan tahun pada footer.
Saya menggunakan sintaks keluaran PHP <?= ... ?> untuk menampilkan nilai ke dalam halaman HTML.
7. Tautan GitHub dan formulir
Tautan GitHub pada bagian Kontak menggunakan konstanta username GitHub dan mengarah ke:
https://github.com/satpamal
Saya mengubah atribut formulir menjadi action="index.php" karena halaman utama P6 menggunakan index.php. Pemrosesan data formulir dengan PHP tidak dilakukan pada P6.
Cara Menjalankan Proyek
1. Saya menyimpan folder pertemuan-06/ di dalam document root Laragon.
2. Saya membuka Laragon dan menjalankan layanan web melalui tombol Start All.
3. Saya memastikan Apache sudah berjalan.
4. Saya membuka alamat proyek melalui localhost sesuai nama folder dan lokasi proyek saya.
5. Saya memeriksa halaman melalui peramban.
PHP harus dijalankan melalui peladen lokal. Membuka berkas index.php langsung dari folder komputer tidak menjalankan kode PHP.
Pengujian
Saya menguji halaman melalui localhost, bukan dengan membuka berkas secara langsung.
Catat hasil setelah pengujian benar-benar dilakukan:
Pemeriksaan	Hasil aktual
Halaman dapat dibuka melalui localhost	[Isi hasil pengujian]
Informasi PHP tampil sebagai konten halaman	[Isi hasil pengujian]
Sisa semester saat semester bernilai 2	[Isi hasil pengujian]
Status rentang semester saat semester bernilai 2	[Isi hasil pengujian]
Keterangan semester saat semester bernilai 2	[Isi hasil pengujian]
Program studi dan fokus program studi	[Isi hasil pengujian]
Lima target belajar dari perulangan for	[Isi hasil pengujian]
Tiga nomor semester dari perulangan while	[Isi hasil pengujian]
IPK, catatan tambahan, tautan GitHub, dan footer	[Isi hasil pengujian]


Pengujian kondisi tambahan
Saat menguji kondisi alternatif, saya mengubah nilai sementara di index.php, menyimpan berkas, lalu memuat ulang halaman. Setelah selesai, saya mengembalikan nilai ke kondisi awal.
Perubahan sementara	Hasil yang diperiksa
$semester = 9	Status rentang menjadi “Perlu diperiksa”
$semester = 4	Keterangan menjadi “Semester menengah”
$semester = 7	Keterangan menjadi “Semester akhir”
$programStudi = "SI"	Nama dan fokus program studi sesuai cabang SI
$programStudi = "MI"	Fokus program studi menjadi “Belum ditentukan”
$statusAktif = false	Status mahasiswa menjadi “Tidak aktif”
$catatanTambahan = "Catatan praktik PHP"	Catatan tersebut tampil di halaman


Hasil Pengujian
Setelah menjalankan pengujian, saya mencatat hasil sebenarnya di sini:
- Tanggal pengujian: [Isi tanggal]
- Alamat localhost yang digunakan: [Isi alamat]
- Hasil pengujian: [Tuliskan hasil yang benar-benar terlihat]
- Galat yang ditemukan, jika ada: [Tuliskan galat atau “Tidak ada galat yang ditemukan”]
- Perbaikan yang dilakukan, jika ada: [Tuliskan perbaikan atau “Tidak ada perbaikan”]
Git dan GitHub
Setelah perubahan selesai dan hasil pengujian diperiksa, saya melihat perubahan menggunakan:
git status
Kemudian saya merekam perubahan dengan Git. Contoh perintah:
git add .
git commit -m "menyelesaikan latihan PHP pertemuan 6"
git push

Kesimpulan
Pada Pertemuan 6, saya mengembangkan kembali proyek P5 dengan PHP pada folder pertemuan-06/. Saya menerapkan variabel, konstanta, operator, percabangan, perulangan, dan fungsi bawaan PHP pada halaman profil mahasiswa.
Saya menjalankan proyek melalui Laragon dan localhost, lalu mencatat hasil pengujian berdasarkan hasil yang benar-benar saya lihat.

```
