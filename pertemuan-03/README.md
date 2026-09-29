# pertemuan-03

# Pertemuan 3 - Formulir HTML dan CSS Dasar

## Baseline

- Menggunakan hasil P2 sebagai dasar pengembangan P3.
- Menyalin `index.html` dan `img/foto-profil.jpg` ke `pertemuan-03/`.

Elemen form yang digunakan:`<form>`, `<label>`, `<input>`, `<select>`, `<option>`, `<textarea>`, dan `<button>`.

## Implementasi Formulir

- Elemen form yang digunakan: `<form>`, `<label>`, `<input>`, `<select>`, `<option>`, `<textarea>`, dan `<button>`.
- Tipe input yang digunakan: `text`, `email`, `number`, `date`, `radio`, dan `checkbox`.
- Atribut validasi yang digunakan: `required`, `minlength`, `maxlength`, `min`, dan `max`.

## Pengujian GET dan POST

- Hasil pengujian GET: Form berhasil dikirim dan data muncul pada URL setelah tanda `?`.
- Contoh URL encoding yang ditemukan: Spasi pada nama menjadi `+`, dan tanda `@` pada email menjadi `%40`.
- Hasil pengujian POST: Form dikirim, tetapi halaman yang sama muncul kembali tanpa menampilkan data. Halaman HTML statis tidak memproses data POST.

## CSS Dasar

- Selector elemen: Tidak ada selector elemen langsung; ada selector turunan seperti `#about h2`, `#about h3`, `#about p`, `#about ol`, `#contact h2`, `#contact label`, dan `#contact button`.
- Selector class: `.form-group` dan `.input-form`.
- Selector ID: `#about` dan `#contact`.
- Properti CSS dasar yang digunakan: `background-color`, `border`, `padding`, `margin`, `font-family`, `color`, `border-bottom`, `margin-bottom`, `font-weight`, dan `font-size`.

## Pengujian dan Perbaikan

- Galat yang ditemukan: ID `contact` digunakan pada dua section.
- Penyebab galat: Ada section Kontak duplikat dengan `id="contact"`.
- Perbaikan yang dilakukan: Menghapus section Kontak duplikat dan menggabungkan tautan GitHub serta formulir dalam satu section dengan `id="contact"`.
- Hasil pengujian ulang: Validasi HTML dijalankan kembali dan galat ID duplikat sudah tidak muncul.
