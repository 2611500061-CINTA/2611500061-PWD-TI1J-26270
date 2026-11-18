# pertemuan-10

1. menyalin artefak pertemuan-09 untuk baseline pertemuan-10
2. memeriksa kesiapan phpMyAdmin dan repositori pertemuan-10
3. Identifikasi Data Formulir Kontak P9 Pemeriksaan pada `index.php` menunjukkan delapan data formulir Kontak:nama (Text), email (Email), semester (Number), tanggal (Date),jenis_pesan (Radio), minat[] (Checkbox), prodi (Select), dan pesan (Textarea).Checkbox `minat[]` memiliki pilihan HTML dan CSS.
4. Data yang Disimpan ke Basis Data Data formulir Kontak yang akan disimpan: nama lengkap, email, semester,tanggal kunjungan, jenis pesan, topik yang diminati, program studi, dan pesan.Data profil mahasiswa seperti NIM, nama mahasiswa, dan program studi pada bagian profil tidak termasuk data formulir Kontak.
5. Representasi Data Pilihan Minat Checkbox `minat[]` memungkinkan pengguna memilih HTML, CSS, atau keduanya. Pada satu kolom tabel, pilihan disimpan sebagai teks yang dipisahkan koma:HTML, CSS.
6. Nama basis data: db_pwd_2611500061
   Nama tabel: tbl_kontak_2611500061
7. Atribut dan Tipe Data
   | Atribut | Tipe Data | Keterangan |
   |---|---|---|
   | nama | VARCHAR(50) | Menyimpan nama lengkap, maksimal 50 karakter. |
   | email | VARCHAR(255) | Menyimpan alamat email. |
   | semester | TINYINT | Menyimpan nomor semester. |
   | tanggal | DATE | Menyimpan tanggal kunjungan. |
   | jenis_pesan | VARCHAR(20) | Menyimpan jenis pesan, seperti pertanyaan atau saran. |
   | minat | VARCHAR(50) | Menyimpan satu atau beberapa pilihan minat sebagai teks. |
   | prodi | VARCHAR(2) | Menyimpan kode program studi, yaitu SI atau TI. |
   | pesan | VARCHAR(300) | Menyimpan isi pesan, maksimal 300 karakter. |
