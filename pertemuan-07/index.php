
<?php
session_start();

// P7: menangkap nilai input form dan menyimpannya ke dalam session
if (isset($_POST['nama']) && isset($_POST['email']) && isset($_POST['semester'])) {
    $_SESSION['nama'] = $_POST['nama'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['semester'] = $_POST['semester'];
}

// P7: nilai dari session disimpan ke dalam variabel lokal
$nama = $_SESSION['nama'] ?? "";
$email = $_SESSION['email'] ?? "";
$semester = $_SESSION['semester'] ?? "";

// E.4: membaca data dari berbagai jenis input formulir
$email = $_POST['email'] ?? '';
$semesterForm = $_POST['semester'] ?? '';
$tanggal = $_POST['tanggal'] ?? '';
$jenisPesan = $_POST['jenis_pesan'] ?? '';
$prodi = $_POST['prodi'] ?? '';
$pesan = $_POST['pesan'] ?? '';
$minat = $_POST['minat'] ?? [];

// P6: PHP dasar dan pemrograman sisi peladen
// Bagian 1: Variabel dan konstanta
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

// Bagian 4: Nama program studi dengan operator ternary
$namaProdi = ($programStudi == "SI")
    ? "Sistem Informasi"
    : (($programStudi == "TI") ? "Teknik Informatika" : "Lainnya");

// Bagian 5: Percabangan switch-case-default
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

// Status mahasiswa dengan operator ternary
$teksStatus = $statusAktif ? "Aktif" : "Tidak aktif";
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
                Halo, saya <strong><?= htmlspecialchars($namaMahasiswa) ?></strong>.
                Saya sedang mempelajari mata kuliah
                <strong><?= htmlspecialchars(NAMA_MATA_KULIAH) ?></strong>
                pada tahun akademik <?= htmlspecialchars($tahunAkademik) ?>.
            </p>

            <img src="foto-profil.jpg" alt="Foto profil Cinta Bunda Feliani" />
        </section>

        <section id="about">
            <h2>Tentang Saya</h2>

            <article>
                <h3>Profil Singkat</h3>
                <p>Sisa semester hingga batas: <?= $sisaSemester ?></p>
                <p>Pemeriksaan rentang semester: <?= $statusSemester ?></p>
                <p>Semester: <?= $semester ?> (<?= $keteranganSemester ?>)</p>
                <p>Program Studi: <?= htmlspecialchars($namaProdi) ?> (<?= htmlspecialchars($programStudi) ?>)</p>
                <p>Status mahasiswa: <?= $teksStatus ?></p>
                <p>Fokus program studi: <?= htmlspecialchars($fokusProgramStudi) ?></p>
                <p>IPK: <?= number_format($ipk, 2, ',', '.') ?></p>
                <p>
                    Catatan tambahan:
                    <?= $catatanTambahan === null ? "Belum ada" : htmlspecialchars($catatanTambahan) ?>
                </p>

                <h3>Nama</h3>
                <p><?= htmlspecialchars($namaMahasiswa) ?></p>

                <h3>NIM</h3>
                <p><?= htmlspecialchars($nim) ?></p>

                <h3>Jurusan</h3>
                <p><?= htmlspecialchars($namaProdi) ?></p>

                <h3>Target Belajar (Perulangan for)</h3>
                <ol>
                    <?php
                    // Perulangan for tanpa array; materi larik dibahas pada P9.
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
                                echo "Belum dipetakan";
                                break;
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

            <p>
                Kunjungi
                <a
                    target="_blank"
                    rel="noopener noreferrer"
                    href="https://github.com/<?= rawurlencode(PROFIL_GITHUB) ?>">
                    profil GitHub saya
                </a>.
            </p>

            <form id="contactForm" action="index.php" method="post" novalidate>
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
                        required />
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
                        required />
                </div>

                <div class="form-group">
                    <label for="semester">Semester</label>
                    <input
                        class="input-form"
                        type="number"
                        id="semester"
                        name="semester"
                        value="<?= htmlspecialchars((string) $semesterForm, ENT_QUOTES, 'UTF-8') ?>"
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
                        value="<?= htmlspecialchars($tanggal, ENT_QUOTES, 'UTF-8') ?>"
                        required />
                </div>

                <fieldset class="form-group">
                    <legend>Jenis Pesan</legend>

                    <input
                        type="radio"
                        id="pertanyaan"
                        name="jenis_pesan"
                        value="pertanyaan"
                        <?= $jenisPesan === 'pertanyaan' ? 'checked' : '' ?>
                        required />
                    <label for="pertanyaan">Pertanyaan</label>

                    <input
                        type="radio"
                        id="saran"
                        name="jenis_pesan"
                        value="saran"
                        <?= $jenisPesan === 'saran' ? 'checked' : '' ?> />
                    <label for="saran">Saran</label>
                </fieldset>

                <fieldset class="form-group">
                    <legend>Topik yang Diminati</legend>

                    <input
                        type="checkbox"
                        id="minat-html"
                        name="minat[]"
                        value="HTML"
                        <?= in_array('HTML', $minat, true) ? 'checked' : '' ?> />
                    <label for="minat-html">HTML</label>

                    <input
                        type="checkbox"
                        id="minat-css"
                        name="minat[]"
                        value="CSS"
                        <?= in_array('CSS', $minat, true) ? 'checked' : '' ?> />
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
        </section>
    </main>

    <footer>
        <p>&copy; <?= date("Y") ?> <?= htmlspecialchars($namaMahasiswa) ?> [<?= htmlspecialchars($nim) ?>]</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>
