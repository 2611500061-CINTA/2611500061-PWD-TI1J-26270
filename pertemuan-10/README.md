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
   | pesan | VARCHAR(300) | Menyimpan isi pesan, maksimal 300 karakter. | 8. Primary Key dan AUTO_INCREMENT
   | Atribut | Tipe Data | Ketentuan | Keterangan |
   |---|---|---|---|
   | id | INT | PRIMARY KEY, AUTO_INCREMENT | Identitas unik setiap data kontak. | 9. Rancangan Akhir Struktur Tabel
   | No. | Atribut | Tipe Data | Ketentuan |
   | --: | ----------- | ------------ | --------------------------- |
   | 1 | id | INT | PRIMARY KEY, AUTO_INCREMENT |
   | 2 | nama | VARCHAR(50) | - |
   | 3 | email | VARCHAR(255) | - |
   | 4 | semester | TINYINT | - |
   | 5 | tanggal | DATE | - |
   | 6 | jenis_pesan | VARCHAR(20) | - |
   | 7 | minat | VARCHAR(50) | - |
   | 8 | prodi | VARCHAR(2) | - |
   | 9 | pesan | VARCHAR(300) | - |
8. Perintah DDL CREATE DATABASE dan CREATE TABLE
   CREATE DATABASE digunakan untuk membuat basis data. USE digunakan untuk memilih basis data.
   CREATE TABLE digunakan untuk membuat tabel beserta atributnya.
   Nama basis data yang diperiksa: db_pwd_2611500061
   Nama tabel yang diperiksa: tbl_kontak_2611500061
   Nama basis data, nama tabel, dan sembilan atribut pada rancangan SQL telah dicocokkan dengan struktur yang dibuat melalui phpMyAdmin.
