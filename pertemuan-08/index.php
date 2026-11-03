<?php
session_start();

// ==========================================
// P8: PEMROSESAN FORMULIR PEMINJAMAN FASILITAS
// ==========================================

if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    ($_POST['form_type'] ?? '') === 'peminjaman'
) {
    $namaPeminjam = trim((string) ($_POST['nama_peminjam'] ?? ''));
    $emailPeminjam = trim((string) ($_POST['email_peminjam'] ?? ''));
    $nimPeminjam = trim((string) ($_POST['nim_peminjam'] ?? ''));
    $fasilitas = trim((string) ($_POST['fasilitas'] ?? ''));
    $tanggalPinjam = trim((string) ($_POST['tanggal_pinjam'] ?? ''));
    $waktuMulai = trim((string) ($_POST['waktu_mulai'] ?? ''));
    $waktuSelesai = trim((string) ($_POST['waktu_selesai'] ?? ''));
    $jumlahPeserta = trim((string) ($_POST['jumlah_peserta'] ?? ''));
    $keperluan = trim((string) ($_POST['keperluan'] ?? ''));

    $kesalahanPeminjaman = '';

    if ($namaPeminjam === '') {
        $kesalahanPeminjaman .= 'Nama peminjam wajib diisi. ';
    } elseif (strlen($namaPeminjam) < 3 || strlen($namaPeminjam) > 50) {
        $kesalahanPeminjaman .= 'Nama harus 3 sampai 50 karakter. ';
    }

    if ($emailPeminjam === '') {
        $kesalahanPeminjaman .= 'Email wajib diisi. ';
    } elseif (!filter_var($emailPeminjam, FILTER_VALIDATE_EMAIL)) {
        $kesalahanPeminjaman .= 'Format email tidak valid. ';
    }

    if ($nimPeminjam === '') {
        $kesalahanPeminjaman .= 'NIM wajib diisi. ';
    }

    $fasilitasDiizinkan = [
        'Aula Kampus',
        'Ruang Kelas',
        'Laboratorium Komputer',
        'Lapangan Kampus',
        'Ruang Seminar',
        'Proyektor'
    ];

    if (!in_array($fasilitas, $fasilitasDiizinkan, true)) {
        $kesalahanPeminjaman .= 'Fasilitas tidak valid. ';
    }

    $tanggalValid = DateTime::createFromFormat('!Y-m-d', $tanggalPinjam);

    if (
        !$tanggalValid ||
        $tanggalValid->format('Y-m-d') !== $tanggalPinjam
    ) {
        $kesalahanPeminjaman .= 'Tanggal peminjaman tidak valid. ';
    }

    if ($waktuMulai === '' || $waktuSelesai === '') {
        $kesalahanPeminjaman .= 'Waktu peminjaman wajib diisi. ';
    } elseif ($waktuSelesai <= $waktuMulai) {
        $kesalahanPeminjaman .= 'Waktu selesai harus setelah waktu mulai. ';
    }

    $jumlahValid = filter_var($jumlahPeserta, FILTER_VALIDATE_INT);

    if ($jumlahValid === false || $jumlahValid < 1) {
        $kesalahanPeminjaman .= 'Jumlah peserta minimal 1 orang. ';
    }

    if ($keperluan === '') {
        $kesalahanPeminjaman .= 'Keperluan peminjaman wajib diisi. ';
    } elseif (strlen($keperluan) > 500) {
        $kesalahanPeminjaman .= 'Keperluan maksimal 500 karakter. ';
    }

    // Menyimpan data ke session
    $_SESSION['namaPeminjam'] = $namaPeminjam;
    $_SESSION['emailPeminjam'] = $emailPeminjam;
    $_SESSION['nimPeminjam'] = $nimPeminjam;
    $_SESSION['fasilitas'] = $fasilitas;
    $_SESSION['tanggalPinjam'] = $tanggalPinjam;
    $_SESSION['waktuMulai'] = $waktuMulai;
    $_SESSION['waktuSelesai'] = $waktuSelesai;
    $_SESSION['jumlahPeserta'] = $jumlahPeserta;
    $_SESSION['keperluan'] = $keperluan;

    $_SESSION['kesalahanPeminjaman'] = $kesalahanPeminjaman;

    if ($kesalahanPeminjaman === '') {
        $_SESSION['statusPeminjaman'] =
            'Permohonan peminjaman berhasil dikirim!';
    } else {
        unset($_SESSION['statusPeminjaman']);
    }

    header('Location: index.php#peminjaman');
    exit;
}

// Mengambil data formulir peminjaman dari session
$namaPeminjam = $_SESSION['namaPeminjam'] ?? '';
$emailPeminjam = $_SESSION['emailPeminjam'] ?? '';
$nimPeminjam = $_SESSION['nimPeminjam'] ?? '';
$fasilitas = $_SESSION['fasilitas'] ?? '';
$tanggalPinjam = $_SESSION['tanggalPinjam'] ?? '';
$waktuMulai = $_SESSION['waktuMulai'] ?? '';
$waktuSelesai = $_SESSION['waktuSelesai'] ?? '';
$jumlahPeserta = $_SESSION['jumlahPeserta'] ?? '';
$keperluan = $_SESSION['keperluan'] ?? '';

$kesalahanPeminjaman = $_SESSION['kesalahanPeminjaman'] ?? '';
$statusPeminjaman = $_SESSION['statusPeminjaman'] ?? '';


// ==========================================
// G.2: MENGAMBIL DATA SESSION FORMULIR KONTAK
// ==========================================

$nama = trim((string) ($_POST['nama'] ?? ($_SESSION['nama'] ?? '')));
$email = trim((string) ($_POST['email'] ?? ($_SESSION['email'] ?? '')));
$semesterForm = trim((string) ($_POST['semester'] ?? ($_SESSION['semester'] ?? '')));
$tanggal = trim((string) ($_POST['tanggal'] ?? ($_SESSION['tanggal'] ?? '')));
$jenisPesan = trim((string) ($_POST['jenis_pesan'] ?? ($_SESSION['jenis_pesan'] ?? '')));
$prodi = trim((string) ($_POST['prodi'] ?? ($_SESSION['prodi'] ?? '')));
$pesan = trim((string) ($_POST['pesan'] ?? ($_SESSION['pesan'] ?? '')));
$minat = $_POST['minat'] ?? ($_SESSION['minat'] ?? []);

$pesanKesalahan = '';


// ==========================================
// F.2-F.4: VALIDASI FORMULIR KONTAK
// ==========================================

if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    ($_POST['form_type'] ?? '') === 'contact'
) {
    if ($nama === '') {
        $pesanKesalahan .= 'Nama lengkap wajib diisi. ';
    } elseif (strlen($nama) < 3 || strlen($nama) > 50) {
        $pesanKesalahan .= 'Nama lengkap harus 3 sampai 50 karakter. ';
    }

    if ($email === '') {
        $pesanKesalahan .= 'Email wajib diisi. ';
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $pesanKesalahan .= 'Format email tidak valid. ';
    }

    if ($semesterForm === '') {
        $pesanKesalahan .= 'Semester wajib diisi. ';
    } else {
        $semesterValid = filter_var($semesterForm, FILTER_VALIDATE_INT);

        if (
            $semesterValid === false ||
            $semesterValid < 1 ||
            $semesterValid > 14
        ) {
            $pesanKesalahan .= 'Semester harus berupa bilangan bulat antara 1 dan 14. ';
        }
    }

    if ($tanggal === '') {
        $pesanKesalahan .= 'Tanggal kunjungan wajib diisi. ';
    } else {
        $tanggalValid = DateTime::createFromFormat('!Y-m-d', $tanggal);

        if (
            !$tanggalValid ||
            $tanggalValid->format('Y-m-d') !== $tanggal
        ) {
            $pesanKesalahan .= 'Format tanggal kunjungan tidak valid. ';
        }
    }

    if (!in_array($jenisPesan, ['pertanyaan', 'saran'], true)) {
        $pesanKesalahan .= 'Jenis pesan tidak valid. ';
    }

    if (!in_array($prodi, ['SI', 'TI'], true)) {
        $pesanKesalahan .= 'Program studi tidak valid. ';
    }

    if ($pesan === '') {
        $pesanKesalahan .= 'Pesan wajib diisi. ';
    } elseif (strlen($pesan) > 300) {
        $pesanKesalahan .= 'Pesan maksimal 300 karakter. ';
    }

    $minatDiizinkan = ['HTML', 'CSS'];

    if (!is_array($minat)) {
        $pesanKesalahan .= 'Format pilihan topik tidak valid. ';
        $minat = [];
    } else {
        if (count($minat) === 0) {
            $pesanKesalahan .= 'Minat wajib dipilih minimal satu. ';
        }

        foreach ($minat as $topik) {
            if (
                !is_string($topik) ||
                !in_array($topik, $minatDiizinkan, true)
            ) {
                $pesanKesalahan .= 'Pilihan topik tidak valid. ';
                break;
            }
        }
    }

    // Menyimpan data kontak ke session
    $_SESSION['pesanKesalahan'] = $pesanKesalahan;

    $_SESSION['nama'] = $nama;
    $_SESSION['email'] = $email;
    $_SESSION['semester'] = $semesterForm;
    $_SESSION['tanggal'] = $tanggal;
    $_SESSION['jenis_pesan'] = $jenisPesan;
    $_SESSION['prodi'] = $prodi;
    $_SESSION['minat'] = $minat;
    $_SESSION['pesan'] = $pesan;

    header('Location: index.php#contact');
    exit;
}

// Mengambil pesan kesalahan setelah redirect
$pesanKesalahan = $_SESSION['pesanKesalahan'] ?? '';


// ==========================================
// P6: PHP DASAR DAN PEMROGRAMAN SISI PELADEN
// ==========================================

$nim = "2611500061";
$namaMahasiswa = "Cinta bunda feliani";
$programStudi = "TI";
$tahunAkademik = "2026/2027";
$semester = 2;
$ipk = 3.75;
$statusAktif = true;
$catatanTambahan = null;

const NAMA_MATA_KULIAH = "Pemrograman Web Dasar";
const PROFIL_GITHUB = "satpamal";

$batasSemester = 8;
$sisaSemester = $batasSemester - $semester;
$semesterValid = $semester >= 1 && $semester <= $batasSemester;

$statusSemester = ($semesterValid && $statusAktif)
    ? "Sesuai rentang"
    : "Perlu diperiksa";

if ($semester < 3) {
    $keteranganSemester = "Semester awal";
} elseif ($semester <= 6) {
    $keteranganSemester = "Semester menengah";
} else {
    $keteranganSemester = "Semester akhir";
}

$namaProdi = ($programStudi == "SI")
    ? "Sistem Informasi"
    : (($programStudi == "TI") ? "Teknik Informatika" : "Lainnya");

switch ($programStudi) {
    case "SI":
        $fokusProgramStudi = "Sistem informasi dan proses bisnis";
        break;

    case "TI":
        $fokusProgramStudi = "Komputasi dan pengembangan perangkat lunak";
        break;

    default:
        $fokusProgramStudi = "Belum ditentukan";
}

$teksStatus = $statusAktif ? "Aktif" : "Tidak aktif";

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profil Mahasiswa</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- HEADER -->
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

        <!-- NAVIGASI -->
        <nav aria-label="Navigasi utama">

            <ul id="navMenu">

                <li><a href="#home">Beranda</a></li>

                <li><a href="#about">Tentang</a></li>

                <li><a href="#contact">Kontak</a></li>

                <li><a href="#peminjaman">Peminjaman Fasilitas</a></li>

            </ul>

        </nav>

    </header>


    <main>

        <!-- ================================= -->
        <!-- SECTION BERANDA -->
        <!-- ================================= -->

        <section id="home">

            <h2>Selamat Datang</h2>

            <p>
                Halo, saya
                <strong>
                    <?= htmlspecialchars($namaMahasiswa, ENT_QUOTES, 'UTF-8') ?>
                </strong>.

                Saya sedang mempelajari mata kuliah

                <strong>
                    <?= htmlspecialchars(NAMA_MATA_KULIAH, ENT_QUOTES, 'UTF-8') ?>
                </strong>

                pada tahun akademik
                <?= htmlspecialchars($tahunAkademik, ENT_QUOTES, 'UTF-8') ?>.
            </p>

            <img
                src="img/foto-profil.jpg"
                alt="Foto profil Cinta Bunda Feliani">

        </section>


        <!-- ================================= -->
        <!-- SECTION TENTANG SAYA -->
        <!-- ================================= -->

        <section id="about">

            <h2>Tentang Saya</h2>

            <article>

                <h3>Profil Singkat</h3>

                <p>Sisa semester hingga batas: <?= $sisaSemester ?></p>

                <p>Pemeriksaan rentang semester: <?= $statusSemester ?></p>

                <p>
                    Semester:
                    <?= $semester ?>
                    (<?= $keteranganSemester ?>)
                </p>

                <p>
                    Program Studi:
                    <?= htmlspecialchars($namaProdi, ENT_QUOTES, 'UTF-8') ?>
                    (<?= htmlspecialchars($programStudi, ENT_QUOTES, 'UTF-8') ?>)
                </p>

                <p>Status mahasiswa: <?= $teksStatus ?></p>

                <p>
                    Fokus program studi:
                    <?= htmlspecialchars($fokusProgramStudi, ENT_QUOTES, 'UTF-8') ?>
                </p>

                <p>IPK: <?= number_format($ipk, 2, ',', '.') ?></p>

                <p>
                    Catatan tambahan:
                    <?= $catatanTambahan === null
                        ? "Belum ada"
                        : htmlspecialchars($catatanTambahan, ENT_QUOTES, 'UTF-8') ?>
                </p>


                <h3>Nama</h3>

                <p>
                    <?= htmlspecialchars($namaMahasiswa, ENT_QUOTES, 'UTF-8') ?>
                </p>


                <h3>NIM</h3>

                <p>
                    <?= htmlspecialchars($nim, ENT_QUOTES, 'UTF-8') ?>
                </p>


                <h3>Jurusan</h3>

                <p>
                    <?= htmlspecialchars($namaProdi, ENT_QUOTES, 'UTF-8') ?>
                </p>


                <!-- PERULANGAN FOR -->

                <h3>Target Belajar (Perulangan for)</h3>

                <ol>

                    <?php

                    for ($i = 1; $i <= 5; $i++) {

                        echo "<li>Target belajar ke-" . $i . ": ";

                        switch ($i) {

                            case 1:
                                echo "Memahami sintaks dasar PHP.";
                                break;

                            case 2:
                                echo "Menggunakan variabel dan konstanta.";
                                break;

                            case 3:
                                echo "Menerapkan operator dan percabangan.";
                                break;

                            case 4:
                                echo "Menggunakan perulangan for dan while.";
                                break;

                            default:
                                echo "Belum dipetakan.";
                        }

                        echo "</li>";
                    }

                    ?>

                </ol>


                <!-- PERULANGAN WHILE -->

                <h3>Semester (Perulangan while)</h3>

                <ol>

                    <?php

                    $nomorSemester = 1;

                    while ($nomorSemester <= 3) {

                        echo "<li>Semester " . $nomorSemester . "</li>";

                        $nomorSemester++;
                    }

                    ?>

                </ol>

            </article>

        </section>


        <!-- ================================= -->
        <!-- SECTION KONTAK -->
        <!-- ================================= -->

        <section id="contact">

            <h2>Kontak</h2>

            <?php if ($pesanKesalahan !== ''): ?>

                <p class="form-feedback-error">
                    <?= htmlspecialchars($pesanKesalahan, ENT_QUOTES, 'UTF-8') ?>
                </p>

                <?php unset($_SESSION['pesanKesalahan']); ?>

            <?php endif; ?>


            <p>

                Kunjungi

                <a
                    target="_blank"
                    rel="noopener noreferrer"
                    href="https://github.com/<?= rawurlencode(PROFIL_GITHUB) ?>">

                    profil GitHub saya

                </a>.

            </p>


            <form
                id="contactForm"
                action="index.php#contact"
                method="post"
                novalidate>

                <input type="hidden" name="form_type" value="contact">


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
                        value="<?= htmlspecialchars($nama, ENT_QUOTES, 'UTF-8') ?>"
                        required>

                </div>


                <div class="form-group">

                    <label for="email">Email</label>

                    <input
                        class="input-form"
                        type="email"
                        id="email"
                        name="email"
                        value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>"
                        placeholder="nama@email.com"
                        required>

                </div>


                <div class="form-group">

                    <label for="semester">Semester</label>

                    <input
                        class="input-form"
                        type="number"
                        id="semester"
                        name="semester"
                        value="<?= htmlspecialchars($semesterForm, ENT_QUOTES, 'UTF-8') ?>"
                        min="1"
                        max="14"
                        required>

                </div>


                <div class="form-group">

                    <label for="tanggal">Tanggal Kunjungan</label>

                    <input
                        class="input-form"
                        type="date"
                        id="tanggal"
                        name="tanggal"
                        value="<?= htmlspecialchars($tanggal, ENT_QUOTES, 'UTF-8') ?>"
                        required>

                </div>


                <fieldset class="form-group">

                    <legend>Jenis Pesan</legend>

                    <input
                        type="radio"
                        id="pertanyaan"
                        name="jenis_pesan"
                        value="pertanyaan"
                        <?= $jenisPesan === 'pertanyaan' ? 'checked' : '' ?>
                        required>

                    <label for="pertanyaan">Pertanyaan</label>


                    <input
                        type="radio"
                        id="saran"
                        name="jenis_pesan"
                        value="saran"
                        <?= $jenisPesan === 'saran' ? 'checked' : '' ?>>

                    <label for="saran">Saran</label>

                </fieldset>


                <fieldset class="form-group">

                    <legend>Topik yang Diminati</legend>

                    <input
                        type="checkbox"
                        id="minat-html"
                        name="minat[]"
                        value="HTML"
                        <?= is_array($minat) && in_array('HTML', $minat, true) ? 'checked' : '' ?>>

                    <label for="minat-html">HTML</label>


                    <input
                        type="checkbox"
                        id="minat-css"
                        name="minat[]"
                        value="CSS"
                        <?= is_array($minat) && in_array('CSS', $minat, true) ? 'checked' : '' ?>>

                    <label for="minat-css">CSS</label>

                </fieldset>


                <div class="form-group">

                    <label for="prodi">Program Studi</label>

                    <select
                        class="input-form"
                        id="prodi"
                        name="prodi"
                        required>

                        <option value="">-- Pilih Program Studi --</option>

                        <option
                            value="SI"
                            <?= $prodi === 'SI' ? 'selected' : '' ?>>
                            Sistem Informasi
                        </option>

                        <option
                            value="TI"
                            <?= $prodi === 'TI' ? 'selected' : '' ?>>
                            Teknik Informatika
                        </option>

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
                        required><?= htmlspecialchars($pesan, ENT_QUOTES, 'UTF-8') ?></textarea>

                </div>


                <p id="formFeedback" aria-live="polite"></p>

                <button type="submit">Kirim</button>

                <button type="reset">Batal</button>

            </form>


            <?php if (!empty($nama)): ?>

                <h3>Data yang Diterima Peladen</h3>

                <p>
                    Nama:
                    <?= htmlspecialchars($nama, ENT_QUOTES, 'UTF-8') ?>
                </p>

                <p>
                    Email:
                    <?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>
                </p>

                <p>
                    Semester:
                    <?= htmlspecialchars($semesterForm, ENT_QUOTES, 'UTF-8') ?>
                </p>

                <p>
                    Tanggal kunjungan:
                    <?= htmlspecialchars($tanggal, ENT_QUOTES, 'UTF-8') ?>
                </p>

                <p>
                    Jenis pesan:
                    <?= htmlspecialchars($jenisPesan, ENT_QUOTES, 'UTF-8') ?>
                </p>

                <p>
                    Program studi:
                    <?= htmlspecialchars($prodi, ENT_QUOTES, 'UTF-8') ?>
                </p>


                <p>Minat:</p>

                <?php if (is_array($minat) && count($minat) > 0): ?>

                    <ul>

                        <?php foreach ($minat as $topik): ?>

                            <li>
                                <?= htmlspecialchars((string) $topik, ENT_QUOTES, 'UTF-8') ?>
                            </li>

                        <?php endforeach; ?>

                    </ul>

                <?php else: ?>

                    <p>Tidak ada minat yang dipilih.</p>

                <?php endif; ?>


                <p>Pesan:</p>

                <p>
                    <?= nl2br(htmlspecialchars($pesan, ENT_QUOTES, 'UTF-8')) ?>
                </p>

            <?php endif; ?>

        </section>


        <!-- ========================================= -->
        <!-- P8: SECTION PEMINJAMAN FASILITAS KAMPUS -->
        <!-- ========================================= -->

        <section id="peminjaman">

            <h2>Formulir Permohonan Peminjaman Fasilitas Kampus</h2>

            <p>
                Silakan lengkapi formulir berikut untuk mengajukan
                permohonan peminjaman fasilitas kampus.
            </p>


            <?php if ($kesalahanPeminjaman !== ''): ?>

                <p class="form-feedback-error">
                    <?= htmlspecialchars($kesalahanPeminjaman, ENT_QUOTES, 'UTF-8') ?>
                </p>

            <?php endif; ?>


            <?php if ($statusPeminjaman !== ''): ?>

                <p class="form-feedback-success">
                    <?= htmlspecialchars($statusPeminjaman, ENT_QUOTES, 'UTF-8') ?>
                </p>

            <?php endif; ?>


            <form
                id="peminjamanForm"
                action="index.php#peminjaman"
                method="post">

                <input type="hidden" name="form_type" value="peminjaman">


                <div class="form-group">

                    <label for="nama_peminjam">Nama Lengkap Peminjam</label>

                    <input
                        class="input-form"
                        type="text"
                        id="nama_peminjam"
                        name="nama_peminjam"
                        minlength="3"
                        maxlength="50"
                        placeholder="Masukkan nama lengkap"
                        value="<?= htmlspecialchars($namaPeminjam, ENT_QUOTES, 'UTF-8') ?>"
                        required>

                </div>


                <div class="form-group">

                    <label for="email_peminjam">Email</label>

                    <input
                        class="input-form"
                        type="email"
                        id="email_peminjam"
                        name="email_peminjam"
                        placeholder="nama@email.com"
                        value="<?= htmlspecialchars($emailPeminjam, ENT_QUOTES, 'UTF-8') ?>"
                        required>

                </div>


                <div class="form-group">

                    <label for="nim_peminjam">NIM</label>

                    <input
                        class="input-form"
                        type="text"
                        id="nim_peminjam"
                        name="nim_peminjam"
                        placeholder="Masukkan NIM"
                        value="<?= htmlspecialchars($nimPeminjam, ENT_QUOTES, 'UTF-8') ?>"
                        required>

                </div>


                <div class="form-group">

                    <label for="fasilitas">Jenis Fasilitas Kampus</label>

                    <select
                        class="input-form"
                        id="fasilitas"
                        name="fasilitas"
                        required>

                        <option value="">-- Pilih Fasilitas --</option>

                        <option
                            value="Aula Kampus"
                            <?= $fasilitas === 'Aula Kampus' ? 'selected' : '' ?>>
                            Aula Kampus
                        </option>

                        <option
                            value="Ruang Kelas"
                            <?= $fasilitas === 'Ruang Kelas' ? 'selected' : '' ?>>
                            Ruang Kelas
                        </option>

                        <option
                            value="Laboratorium Komputer"
                            <?= $fasilitas === 'Laboratorium Komputer' ? 'selected' : '' ?>>
                            Laboratorium Komputer
                        </option>

                        <option
                            value="Lapangan Kampus"
                            <?= $fasilitas === 'Lapangan Kampus' ? 'selected' : '' ?>>
                            Lapangan Kampus
                        </option>

                        <option
                            value="Ruang Seminar"
                            <?= $fasilitas === 'Ruang Seminar' ? 'selected' : '' ?>>
                            Ruang Seminar
                        </option>

                        <option
                            value="Proyektor"
                            <?= $fasilitas === 'Proyektor' ? 'selected' : '' ?>>
                            Proyektor
                        </option>

                    </select>

                </div>


                <div class="form-group">

                    <label for="tanggal_pinjam">Tanggal Peminjaman</label>

                    <input
                        class="input-form"
                        type="date"
                        id="tanggal_pinjam"
                        name="tanggal_pinjam"
                        value="<?= htmlspecialchars($tanggalPinjam, ENT_QUOTES, 'UTF-8') ?>"
                        required>

                </div>


                <div class="form-group">

                    <label for="waktu_mulai">Waktu Mulai</label>

                    <input
                        class="input-form"
                        type="time"
                        id="waktu_mulai"
                        name="waktu_mulai"
                        value="<?= htmlspecialchars($waktuMulai, ENT_QUOTES, 'UTF-8') ?>"
                        required>

                </div>


                <div class="form-group">

                    <label for="waktu_selesai">Waktu Selesai</label>

                    <input
                        class="input-form"
                        type="time"
                        id="waktu_selesai"
                        name="waktu_selesai"
                        value="<?= htmlspecialchars($waktuSelesai, ENT_QUOTES, 'UTF-8') ?>"
                        required>

                </div>


                <div class="form-group">

                    <label for="jumlah_peserta">Jumlah Peserta</label>

                    <input
                        class="input-form"
                        type="number"
                        id="jumlah_peserta"
                        name="jumlah_peserta"
                        min="1"
                        placeholder="Masukkan jumlah peserta"
                        value="<?= htmlspecialchars($jumlahPeserta, ENT_QUOTES, 'UTF-8') ?>"
                        required>

                </div>


                <div class="form-group">

                    <label for="keperluan">Keperluan Peminjaman</label>

                    <textarea
                        class="input-form"
                        id="keperluan"
                        name="keperluan"
                        rows="5"
                        maxlength="500"
                        placeholder="Jelaskan tujuan peminjaman fasilitas kampus"
                        required><?= htmlspecialchars($keperluan, ENT_QUOTES, 'UTF-8') ?></textarea>

                </div>


                <p id="peminjamanFeedback" aria-live="polite"></p>

                <button type="submit">Kirim Permohonan</button>

                <button type="reset">Batal</button>

            </form>


            <!-- MENAMPILKAN DATA PERMOHONAN -->

            <?php if ($statusPeminjaman !== ''): ?>

                <h3>Data Permohonan Peminjaman</h3>

                <p>
                    Nama:
                    <?= htmlspecialchars($namaPeminjam, ENT_QUOTES, 'UTF-8') ?>
                </p>

                <p>
                    Email:
                    <?= htmlspecialchars($emailPeminjam, ENT_QUOTES, 'UTF-8') ?>
                </p>

                <p>
                    NIM:
                    <?= htmlspecialchars($nimPeminjam, ENT_QUOTES, 'UTF-8') ?>
                </p>

                <p>
                    Fasilitas:
                    <?= htmlspecialchars($fasilitas, ENT_QUOTES, 'UTF-8') ?>
                </p>

                <p>
                    Tanggal:
                    <?= htmlspecialchars($tanggalPinjam, ENT_QUOTES, 'UTF-8') ?>
                </p>

                <p>
                    Waktu:
                    <?= htmlspecialchars($waktuMulai, ENT_QUOTES, 'UTF-8') ?>
                    -
                    <?= htmlspecialchars($waktuSelesai, ENT_QUOTES, 'UTF-8') ?>
                </p>

                <p>
                    Jumlah peserta:
                    <?= htmlspecialchars($jumlahPeserta, ENT_QUOTES, 'UTF-8') ?>
                </p>

                <p>
                    Keperluan:
                    <?= htmlspecialchars($keperluan, ENT_QUOTES, 'UTF-8') ?>
                </p>

            <?php endif; ?>

        </section>

    </main>


    <!-- FOOTER -->

    <footer>

        <p>
            &copy; <?= date("Y") ?>

            <?= htmlspecialchars($namaMahasiswa, ENT_QUOTES, 'UTF-8') ?>

            [<?= htmlspecialchars($nim, ENT_QUOTES, 'UTF-8') ?>]
        </p>

    </footer>


    <script src="script.js"></script>

</body>

</html>