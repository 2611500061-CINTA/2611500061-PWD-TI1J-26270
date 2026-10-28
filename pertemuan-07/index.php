
<?php
session_start();

// G.2: mengambil data session untuk ditampilkan kembali
$nama = trim((string) ($_POST['nama'] ?? ($_SESSION['nama'] ?? '')));
$email = trim((string) ($_POST['email'] ?? ($_SESSION['email'] ?? '')));
$semesterForm = trim((string) ($_POST['semester'] ?? ($_SESSION['semester'] ?? '')));
$tanggal = trim((string) ($_POST['tanggal'] ?? ($_SESSION['tanggal'] ?? '')));
$jenisPesan = trim((string) ($_POST['jenis_pesan'] ?? ($_SESSION['jenis_pesan'] ?? '')));
$prodi = trim((string) ($_POST['prodi'] ?? ($_SESSION['prodi'] ?? '')));
$pesan = trim((string) ($_POST['pesan'] ?? ($_SESSION['pesan'] ?? '')));
$minat = $_POST['minat'] ?? ($_SESSION['minat'] ?? []);

$pesanKesalahan = '';

// F.2–F.4: validasi data formulir
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
        if ($semesterValid === false || $semesterValid < 1 || $semesterValid > 14) {
            $pesanKesalahan .= 'Semester harus berupa bilangan bulat antara 1 dan 14. ';
        }
    }

    if ($tanggal === '') {
        $pesanKesalahan .= 'Tanggal kunjungan wajib diisi. ';
    } else {
        $tanggalValid = DateTime::createFromFormat('!Y-m-d', $tanggal);
        if (!$tanggalValid || $tanggalValid->format('Y-m-d') !== $tanggal) {
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
            if (!is_string($topik) || !in_array($topik, $minatDiizinkan, true)) {
                $pesanKesalahan .= 'Pilihan topik tidak valid. ';
                break;
            }
        }
    }

    // G.2: simpan data dan pesan kesalahan ke session
    $_SESSION['pesanKesalahan'] = $pesanKesalahan;

    $_SESSION['nama'] = $nama;
    $_SESSION['email'] = $email;
    $_SESSION['semester'] = $semesterForm;
    $_SESSION['tanggal'] = $tanggal;
    $_SESSION['jenis_pesan'] = $jenisPesan;
    $_SESSION['prodi'] = $prodi;
    $_SESSION['minat'] = $minat;
    $_SESSION['pesan'] = $pesan;

    // Redirect dari POST ke GET
    header('Location: index.php');
    exit;
}

// Mengambil pesan kesalahan setelah redirect
$pesanKesalahan = $_SESSION['pesanKesalahan'] ?? '';

// P6: PHP dasar dan pemrograman sisi peladen
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

<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <div class="header-top">
        <h1>Profil Mahasiswa</h1>
        <button class="nav-toggle" id="navToggle" type="button"
            aria-label="Buka navigasi" aria-controls="navMenu"
            aria-expanded="false">&#9776;</button>
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
        Halo, saya <strong><?= htmlspecialchars($namaMahasiswa, ENT_QUOTES, 'UTF-8') ?></strong>.
        Saya sedang mempelajari mata kuliah
        <strong><?= htmlspecialchars(NAMA_MATA_KULIAH, ENT_QUOTES, 'UTF-8') ?></strong>
        pada tahun akademik <?= htmlspecialchars($tahunAkademik, ENT_QUOTES, 'UTF-8') ?>.
    </p>
    <img src="foto-profil.jpg" alt="Foto profil Cinta Bunda Feliani">
</section>

<section id="about">
    <h2>Tentang Saya</h2>
    <article>
        <h3>Profil Singkat</h3>
        <p>Sisa semester hingga batas: <?= $sisaSemester ?></p>
        <p>Pemeriksaan rentang semester: <?= $statusSemester ?></p>
        <p>Semester: <?= $semester ?> (<?= $keteranganSemester ?>)</p>
        <p>Program Studi: <?= htmlspecialchars($namaProdi, ENT_QUOTES, 'UTF-8') ?> (<?= htmlspecialchars($programStudi, ENT_QUOTES, 'UTF-8') ?>)</p>
        <p>Status mahasiswa: <?= $teksStatus ?></p>
        <p>Fokus program studi: <?= htmlspecialchars($fokusProgramStudi, ENT_QUOTES, 'UTF-8') ?></p>
        <p>IPK: <?= number_format($ipk, 2, ',', '.') ?></p>
        <p>Catatan tambahan: <?= $catatanTambahan === null ? "Belum ada" : htmlspecialchars($catatanTambahan, ENT_QUOTES, 'UTF-8') ?></p>

        <h3>Nama</h3>
        <p><?= htmlspecialchars($namaMahasiswa, ENT_QUOTES, 'UTF-8') ?></p>
        <h3>NIM</h3>
        <p><?= htmlspecialchars($nim, ENT_QUOTES, 'UTF-8') ?></p>
        <h3>Jurusan</h3>
        <p><?= htmlspecialchars($namaProdi, ENT_QUOTES, 'UTF-8') ?></p>

        <h3>Target Belajar (Perulangan for)</h3>
        <ol>
        <?php
        for ($i = 1; $i <= 5; $i++) {
            echo "<li>Target belajar ke-" . $i . ": ";
            switch ($i) {
                case 1: echo "Memahami sintaks dasar PHP."; break;
                case 2: echo "Menggunakan variabel dan konstanta."; break;
                case 3: echo "Menerapkan operator dan percabangan."; break;
                case 4: echo "Menggunakan perulangan for dan while."; break;
                default: echo "Belum dipetakan.";
            }
            echo "</li>";
        }
        ?>
        </ol>

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
        <a target="_blank" rel="noopener noreferrer"
            href="https://github.com/<?= rawurlencode(PROFIL_GITHUB) ?>">
            profil GitHub saya
        </a>.
    </p>

    <form id="contactForm" action="index.php" method="post" novalidate>
        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input class="input-form" type="text" id="nama" name="nama"
                placeholder="Masukkan nama lengkap" minlength="3" maxlength="50"
                value="<?= htmlspecialchars($nama, ENT_QUOTES, 'UTF-8') ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input class="input-form" type="email" id="email" name="email"
                value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>"
                placeholder="nama@email.com" required>
        </div>

        <div class="form-group">
            <label for="semester">Semester</label>
            <input class="input-form" type="number" id="semester" name="semester"
                value="<?= htmlspecialchars($semesterForm, ENT_QUOTES, 'UTF-8') ?>"
                min="1" max="14" required>
        </div>

        <div class="form-group">
            <label for="tanggal">Tanggal Kunjungan</label>
            <input class="input-form" type="date" id="tanggal" name="tanggal"
                value="<?= htmlspecialchars($tanggal, ENT_QUOTES, 'UTF-8') ?>" required>
        </div>

        <fieldset class="form-group">
            <legend>Jenis Pesan</legend>
            <input type="radio" id="pertanyaan" name="jenis_pesan"
                value="pertanyaan" <?= $jenisPesan === 'pertanyaan' ? 'checked' : '' ?> required>
            <label for="pertanyaan">Pertanyaan</label>

            <input type="radio" id="saran" name="jenis_pesan"
                value="saran" <?= $jenisPesan === 'saran' ? 'checked' : '' ?>>
            <label for="saran">Saran</label>
        </fieldset>

        <fieldset class="form-group">
            <legend>Topik yang Diminati</legend>
            <input type="checkbox" id="minat-html" name="minat[]" value="HTML"
                <?= is_array($minat) && in_array('HTML', $minat, true) ? 'checked' : '' ?>>
            <label for="minat-html">HTML</label>

            <input type="checkbox" id="minat-css" name="minat[]" value="CSS"
                <?= is_array($minat) && in_array('CSS', $minat, true) ? 'checked' : '' ?>>
            <label for="minat-css">CSS</label>
        </fieldset>

        <div class="form-group">
            <label for="prodi">Program Studi</label>
            <select class="input-form" id="prodi" name="prodi" required>
                <option value="">-- Pilih Program Studi --</option>
                <option value="SI" <?= $prodi === 'SI' ? 'selected' : '' ?>>Sistem Informasi</option>
                <option value="TI" <?= $prodi === 'TI' ? 'selected' : '' ?>>Teknik Informatika</option>
            </select>
        </div>

        <div class="form-group">
            <label for="pesan">Pesan</label>
            <textarea class="input-form" id="pesan" name="pesan"
                maxlength="300" placeholder="Tulis pesan Anda"
                required><?= htmlspecialchars($pesan, ENT_QUOTES, 'UTF-8') ?></textarea>
        </div>

        <p id="formFeedback" aria-live="polite"></p>
        <button type="submit">Kirim</button>
        <button type="reset">Batal</button>
    </form>

    <?php if (!empty($nama)): ?>
        <h3>Data yang Diterima Peladen</h3>
        <p>Nama: <?= htmlspecialchars($nama, ENT_QUOTES, 'UTF-8') ?></p>
        <p>Email: <?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?></p>
        <p>Semester: <?= htmlspecialchars($semesterForm, ENT_QUOTES, 'UTF-8') ?></p>
        <p>Tanggal kunjungan: <?= htmlspecialchars($tanggal, ENT_QUOTES, 'UTF-8') ?></p>
        <p>Jenis pesan: <?= htmlspecialchars($jenisPesan, ENT_QUOTES, 'UTF-8') ?></p>
        <p>Program studi: <?= htmlspecialchars($prodi, ENT_QUOTES, 'UTF-8') ?></p>

        <p>Minat:</p>
        <?php if (is_array($minat) && count($minat) > 0): ?>
            <ul>
            <?php foreach ($minat as $topik): ?>
                <li><?= htmlspecialchars((string) $topik, ENT_QUOTES, 'UTF-8') ?></li>
            <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Tidak ada minat yang dipilih.</p>
        <?php endif; ?>

        <p>Pesan:</p>
        <p><?= nl2br(htmlspecialchars($pesan, ENT_QUOTES, 'UTF-8')) ?></p>
    <?php endif; ?>
</section>
</main>

<footer>
    <p>&copy; <?= date("Y") ?> <?= htmlspecialchars($namaMahasiswa, ENT_QUOTES, 'UTF-8') ?> [<?= htmlspecialchars($nim, ENT_QUOTES, 'UTF-8') ?>]</p>
</footer>

<script src="script.js"></script>
</body>
</html>
