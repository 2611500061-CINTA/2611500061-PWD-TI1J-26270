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
13. Menambahkan validasi sisi peladen menggunakan PHP untuk memeriksa data formulir yang dikirim melalui metode POST karena validasi JavaScript saja tidak cukup untuk memastikan data yang dikirim sudah benar.
14. Memeriksa kelengkapan data formulir menggunakan $\_SERVER['REQUEST_METHOD'], trim(), dan kondisi PHP untuk memastikan nama, email, semester, tanggal kunjungan, jenis pesan, program studi, pesan, dan pilihan minat sudah diisi.
15. Memvalidasi format email menggunakan filter_var() dengan FILTER_VALIDATE_EMAIL dan memvalidasi semester menggunakan FILTER_VALIDATE_INT agar nilainya berupa bilangan bulat antara 1 sampai 14.
16. Memvalidasi nilai jenis pesan, program studi, dan pilihan minat menggunakan in_array(), is_array(), serta foreach agar data yang diterima sesuai dengan pilihan yang diizinkan.
17. Melakukan normalisasi data masukan menggunakan trim() sebelum validasi dan mengamankan keluaran data menggunakan htmlspecialchars() dengan ENT_QUOTES dan UTF-8 ketika ditampilkan pada halaman HTML.
    Menampilkan pesan kesalahan validasi PHP pada bagian Kontak apabila data formulir belum lengkap atau tidak sesuai dengan aturan yang ditentukan.
18. Menambahkan bagian Data yang Diterima Peladen setelah formulir untuk menampilkan data yang dikirim melalui POST, meliputi nama, email, semester, tanggal kunjungan, jenis pesan, program studi, pilihan minat, dan isi pesan.
19. Menggunakan nl2br() bersama htmlspecialchars() untuk menampilkan isi pesan dengan format pergantian baris dan memastikan masukan pengguna ditampilkan sebagai teks biasa, bukan sebagai kode HTML.
    Melakukan pengujian validasi sisi peladen dengan mencoba mengirim formulir kosong, memasukkan email dengan format yang salah, dan mengirim formulir tanpa memilih minat.
20. Melakukan pengujian tampilan data yang diterima peladen dengan mengirim formulir dan memeriksa apakah data ditampilkan dengan benar serta teks HTML yang dimasukkan pengguna tidak dijalankan sebagai markup.
21. Menggunakan session PHP dengan session_start() untuk menyimpan pesan kesalahan dan data formulir agar data tersebut dapat digunakan kembali setelah halaman dialihkan.
22. Menerapkan pola Post-Redirect-Get (PRG) dengan menyimpan hasil pemrosesan formulir ke dalam $\_SESSION, kemudian mengalihkan halaman menggunakan header('Location: index.php') dan menghentikan proses menggunakan exit.
23. Mengambil kembali data formulir dari session setelah pengalihan agar nilai input dan data yang diterima peladen tetap ditampilkan tanpa harus mengirim ulang formulir.
24. Menggunakan unset() untuk menghapus pesan kesalahan dari session setelah ditampilkan agar pesan tidak terus muncul ketika halaman dibuka kembali.
25. Melakukan pengujian session dan PRG dengan mengirim formulir, memeriksa hasil data setelah pengalihan, dan memuat ulang halaman untuk memastikan peramban tidak meminta pengiriman ulang data POST.
    Menjalankan proyek melalui localhost untuk memeriksa hasil pemrosesan PHP, pesan validasi, data yang diterima peladen, serta hasil penerapan session dan PRG.
26. Melakukan debugging apabila ditemukan galat dengan memeriksa penyebabnya, memperbaiki kode yang bermasalah, dan melakukan pengujian ulang.
27. Mendokumentasikan perubahan kode, cara menjalankan proyek, dan hasil pengujian pada file pertemuan-07/README.md.
    Memeriksa perubahan kode menggunakan Git, melakukan commit setelah tahap pengerjaan dan pengujian yang relevan selesai, kemudian melakukan push perubahan ke GitHub.
28. Menyiapkan artefak atau URL repositori untuk dikumpulkan melalui LMS sesuai instruksi perkuliahan.

## Kesimpulan

Pada pertemuan 7 ini, saya melanjutkan proyek dari pertemuan 6 dengan menambahkan pemrosesan formulir menggunakan PHP, validasi sisi peladen, normalisasi data, pengamanan keluaran HTML, serta penggunaan session dan pola Post-Redirect-Get (PRG). Saya juga mempelajari cara menguji dan memperbaiki kesalahan melalui localhost serta mengelola perubahan proyek menggunakan Git dan GitHub.
