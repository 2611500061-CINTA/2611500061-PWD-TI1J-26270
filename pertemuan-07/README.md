# pertemuan 7

1. menyalin artefak pertemuan-06 untuk digunakan baseline pertemuan-07
2. event.preventDefault(); menghalangi eksekusi submit
3. mencoba superglobal $\_GET untuk nama,email, semester.
4. mencoba superglobal $\_POST untuk nama,email, semester.
5. menggunakan session untuk meyimpan hasil post formulir dan menulis output session pada input value.
6. Menambahkan pembacaan data dari berbagai jenis input formulir menggunakan superglobal $\_POST, meliputi email, semester, tanggal kunjungan, jenis pesan, program studi, dan pesan.
7. Mengubah atribut name pada checkbox minat menjadi minat[] agar pengguna dapat memilih lebih dari satu topik, yaitu HTML dan CSS.
8. Menyesuaikan selector JavaScript pada script.js agar validasi pilihan minat mendukung formulir POST dengan name="minat[]" dan 9. 9. formulir demonstrasi GET dengan name="minat".
9. Menambahkan validasi sisi peladen menggunakan PHP untuk memeriksa kelengkapan data formulir, termasuk nama, email, semester, tanggal kunjungan, jenis pesan, program studi, pesan, dan pilihan minat.
10. Memvalidasi format email menggunakan filter_var() dengan FILTER_VALIDATE_EMAIL serta memvalidasi semester sebagai bilangan bulat antara 1 dan 14 menggunakan FILTER_VALIDATE_INT.
    Memvalidasi nilai pilihan jenis pesan, program studi, dan topik minat agar sesuai dengan nilai yang diizinkan.
11. Melakukan normalisasi data masukan menggunakan trim() sebelum validasi untuk menghapus spasi di awal dan akhir teks.
    Mengamankan keluaran data menggunakan htmlspecialchars() dengan ENT_QUOTES dan UTF-8 ketika menampilkan data formulir pada halaman HTML.
12. Menampilkan pesan kesalahan validasi PHP pada bagian Kontak apabila data formulir tidak memenuhi aturan yang ditentukan.
    Menambahkan bagian Data yang Diterima Peladen setelah formulir untuk menampilkan data yang dikirim melalui metode POST, termasuk daftar topik minat dan isi pesan dengan format pergantian baris.
    Melakukan pengujian formulir untuk memeriksa validasi sisi klien, validasi sisi peladen, serta tampilan data yang diterima setelah formulir dikirim.
