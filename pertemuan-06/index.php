<?php
// P6: PHP dasar dan pemrograman sisi peladen

// Bagian 1: Variabel dan konstanta
$nim = "2611500061";
$namaMahasiswa = "Cinta Bunda Feliani";
$programStudi = "TI";
$tahunAkademik = "2026/2027";
$semester = 2;
$ipk = 3.75;
$statusAktif = true;
$catatanTambahan = null;

const NAMA_MATA_KULIAH = "Pemrograman Web Dasar";
const PROFIL_GITHUB = "satpamal";

// Bagian 2: Operator
$batasSemester = 8;
$sisaSemester = $batasSemester - $semester;
$semesterValid = $semester >= 1 && $semester <= $batasSemester;
$statusSemester = ($semesterValid && $statusAktif)
    ? "Sesuai rentang"
    : "Perlu diperiksa";

// Bagian 3: Percabangan if-elseif-else
if ($semester < 3) {
    $keteranganSemester = "Semester awal";
} elseif ($semester <= 6) {
    $keteranganSemester = "Semester menengah";
} else {
    $keteranganSemester = "Semester akhir";
}

// Bagian 4: Nama program studi
$namaProdi = ($programStudi == "SI")
    ? "Sistem Informasi"
    : (($programStudi == "TI") ? "Teknik Informatika" : "Lainnya");
?>

<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profil Mahasiswa</title>
    <link rel="stylesheet" href="style.css" />
  </head>

  <body>
    <header>
      <div class="header-top">
        <h1>Profil Mahasiswa</h1>

        <button
          class="nav-toggle"
          id="navToggle"
          type="button"
          aria-label="Buka navigasi"
          aria-controls="navMenu"
          aria-expanded="false">
          &#9776;
        </button>
      </div>

      <nav aria-label="Navigasi utama">
        <ul id="navMenu">
          <li><a href="#home">Beranda</a></li>
          <li><a href="#about">Tentang</a></li>
          <li><a href="#contact">Kontak</a></li>
        </ul>
      </nav>
    </header>

    <main>
      <section id="home">
        <h2>Selamat Datang</h2>
        <p>
          Halo, saya <strong><?= $namaMahasiswa ?></strong>. Saya sedang
          mempelajari mata kuliah
          <strong><?= NAMA_MATA_KULIAH ?></strong>
          pada tahun akademik <?= $tahunAkademik ?>.
        </p>

        <img src="foto-profil.jpg" alt="Foto profil Cinta Bunda Feliani" />
      </section>

      <section id="about">
        <h2>Tentang Saya</h2>

        <article>
          <h3>Profil Singkat</h3>
          <p>Sisa semester hingga batas: <?= $sisaSemester ?></p>
          <p>Pemeriksaan rentang semester: <?= $statusSemester ?></p>
          <p>
            Semester: <?= $semester ?> (<?= $keteranganSemester ?>)
          </p>
          <p>Program Studi: <?= $namaProdi ?> (<?= $programStudi ?>)</p>
          <p>Status mahasiswa: <?= $statusAktif ? "Aktif" : "Tidak aktif" ?></p>
          <p>IPK: <?= number_format($ipk, 2, ',', '.') ?></p>
          <p>
            Catatan tambahan:
            <?= $catatanTambahan === null ? "Belum ada" : $catatanTambahan ?>
          </p>

          <h3>Nama</h3>
          <p><?= $namaMahasiswa ?></p>

          <h3>NIM</h3>
          <p><?= $nim ?></p>

          <h3>Jurusan</h3>
          <p><?= $namaProdi ?></p>

          <h3>Target Belajar</h3>
          <ol>
            <li>Memahami struktur HTML5.</li>
            <li>Menyusun halaman web semantik.</li>
            <li>Memvalidasi dokumen HTML5.</li>
          </ol>
        </article>
      </section>

      <section id="contact">
        <h2>Kontak</h2>

        <p>
          Kunjungi
          <a
            target="_blank"
            rel="noopener noreferrer"
            href="https://github.com/<?= PROFIL_GITHUB ?>">
            profil GitHub saya
          </a>.
        </p>

        <form id="contactForm" action="index.php" method="get" novalidate>
          <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input
              class="input-form"
              type="text"
              id="nama"
              name="nama"
              placeholder="Masukkan nama lengkap"
              minlength="3"
              maxlength="50"
              required />
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input
              class="input-form"
              type="email"
              id="email"
              name="email"
              placeholder="nama@email.com"
              required />
          </div>

          <div class="form-group">
            <label for="semester">Semester</label>
            <input
              class="input-form"
              type="number"
              id="semester"
              name="semester"
              min="1"
              max="14"
              required />
          </div>

          <div class="form-group">
            <label for="tanggal">Tanggal Kunjungan</label>
            <input
              class="input-form"
              type="date"
              id="tanggal"
              name="tanggal"
              required />
          </div>

          <fieldset class="form-group">
            <legend>Jenis Pesan</legend>

            <input
              type="radio"
              id="pertanyaan"
              name="jenis_pesan"
              value="pertanyaan"
              required />
            <label for="pertanyaan">Pertanyaan</label>

            <input
              type="radio"
              id="saran"
              name="jenis_pesan"
              value="saran" />
            <label for="saran">Saran</label>
          </fieldset>

          <fieldset class="form-group">
            <legend>Topik yang Diminati</legend>

            <input
              type="checkbox"
              id="minat-html"
              name="minat"
              value="HTML" />
            <label for="minat-html">HTML</label>

            <input
              type="checkbox"
              id="minat-css"
              name="minat"
              value="CSS" />
            <label for="minat-css">CSS</label>
          </fieldset>

          <div class="form-group">
            <label for="prodi">Program Studi</label>
            <select class="input-form" id="prodi" name="prodi" required>
              <option value="">-- Pilih Program Studi --</option>
              <option value="SI">Sistem Informasi</option>
              <option value="TI">Teknik Informatika</option>
            </select>
          </div>

          <div class="form-group">
            <label for="pesan">Pesan</label>
            <textarea
              class="input-form"
              id="pesan"
              name="pesan"
              maxlength="300"
              placeholder="Tulis pesan Anda"
              required></textarea>
          </div>

          <p id="formFeedback" aria-live="polite"></p>

          <button type="submit">Kirim</button>
          <button type="reset">Batal</button>
        </form>
      </section>
    </main>

    <footer>
      <p>&copy; <?= date("Y") ?> <?= $namaMahasiswa ?> (<?= $nim ?>)</p>
    </footer>

    <script src="script.js"></script>
  </body>
</html>