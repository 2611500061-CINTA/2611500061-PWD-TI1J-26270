<?php
session_start();
require_once __DIR__ . '/fungsi.php';
require_once __DIR__ . '/koneksi.php';

// Mengambil data formulir dari session.
$formData = $_SESSION['formData'] ?? [];

$nama = $formData['nama'] ?? '';
$email = $formData['email'] ?? '';
$semesterForm = $formData['semester'] ?? '';
$tanggal = $formData['tanggal'] ?? '';
$jenisPesan = $formData['jenis_pesan'] ?? '';
$prodi = $formData['prodi'] ?? '';
$pesan = $formData['pesan'] ?? '';
$minat = $formData['minat'] ?? [];

if (!is_array($minat)) {
    $minat = [];
}

$pesanKesalahan = $_SESSION['pesanKesalahan'] ?? '';
unset($_SESSION['pesanKesalahan']);

// Memproses dan memvalidasi formulir.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim((string) ($_POST['nama'] ?? ''));
    $email = trim((string) ($_POST['email'] ?? ''));
    $semesterForm = trim((string) ($_POST['semester'] ?? ''));
    $tanggal = trim((string) ($_POST['tanggal'] ?? ''));
    $jenisPesan = trim((string) ($_POST['jenis_pesan'] ?? ''));
    $prodi = trim((string) ($_POST['prodi'] ?? ''));
    $pesan = trim((string) ($_POST['pesan'] ?? ''));

    // Checkbox dapat mengirimkan lebih dari satu nilai.
    $minat = $_POST['minat'] ?? [];

    if (!is_array($minat)) {
        $minat = [];
    }

    $dataFormulir = [
        'nama' => $nama,
        'email' => $email,
        'semester' => $semesterForm,
        'tanggal' => $tanggal,
        'jenis_pesan' => $jenisPesan,
        'prodi' => $prodi,
        'minat' => $minat,
        'pesan' => $pesan
    ];

    $pesanKesalahan = validasiFormulir($dataFormulir);

    $_SESSION['pesanKesalahan'] = $pesanKesalahan;
    $_SESSION['formData'] = $dataFormulir;

    // PRG: kembali ke halaman sebelum menghasilkan keluaran HTML.
    header('Location: index.php');
    exit;
}

// Mengambil kembali data formulir dari session.
$formData = $_SESSION['formData'] ?? [];

$nama = $formData['nama'] ?? '';
$email = $formData['email'] ?? '';
$semesterForm = $formData['semester'] ?? '';
$tanggal = $formData['tanggal'] ?? '';
$jenisPesan = $formData['jenis_pesan'] ?? '';
$prodi = $formData['prodi'] ?? '';
$pesan = $formData['pesan'] ?? '';
$minat = $formData['minat'] ?? [];

if (!is_array($minat)) {
    $minat = [];
}

// Data profil mahasiswa.
$nim = '2611500061';
$namaMahasiswa = 'Cinta bunda feliani';
$programStudi = 'TI';
$tahunAkademik = '2026/2027';
$semester = 2;
$ipk = 3.75;
$statusAktif = true;
$catatanTambahan = null;

const NAMA_MATA_KULIAH = 'Pemrograman Web Dasar';
const PROFIL_GITHUB = 'satpamal';

$batasSemester = 8;
$sisaSemester = hitungSisaSemester($semester, $batasSemester);
$semesterValid = $semester >= 1 && $semester <= $batasSemester;

$statusSemester = ($semesterValid && $statusAktif)
    ? 'Sesuai rentang'
    : 'Perlu diperiksa';

$keteranganSemester = tentukanKategoriSemester($semester);

$namaProdi = ($programStudi === 'SI')
    ? 'Sistem Informasi'
    : (($programStudi === 'TI') ? 'Teknik Informatika' : 'Lainnya');

switch ($programStudi) {
    case 'SI':
        $fokusProgramStudi = 'Sistem informasi dan proses bisnis';
        break;

    case 'TI':
        $fokusProgramStudi = 'Komputasi dan pengembangan perangkat lunak';
        break;

    default:
        $fokusProgramStudi = 'Belum ditentukan';
}

$teksStatus = $statusAktif ? 'Aktif' : 'Tidak aktif';

$dataProfil = [
    'Nama' => $namaMahasiswa,
    'NIM' => $nim,
    'Jurusan' => $namaProdi
];

// Mengambil data kontak dari tabel menggunakan operasi READ.
$sql = "SELECT * FROM tbl_kontak_2611500061";
$hasil = mysqli_query($koneksi, $sql);

if (!$hasil) {
    die("Kueri SELECT gagal dijalankan.");
}

// Mengambil seluruh hasil kueri sebagai larik asosiatif.
$dataKontak = [];

while ($baris = mysqli_fetch_assoc($hasil)) {
    $dataKontak[] = $baris;
}
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
                ☰
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
                Halo, saya
                <strong><?= bersihkan($namaMahasiswa) ?></strong>.
                Saya sedang mempelajari mata kuliah
                <strong><?= bersihkan(NAMA_MATA_KULIAH) ?></strong>
                pada tahun akademik
                <?= bersihkan($tahunAkademik) ?>.
            </p>

            <img
                src="img/foto-profil.jpg"
                alt="Foto profil Cinta Bunda Feliani">
        </section>

        <section id="about">
            <h2>Tentang Saya</h2>

            <article>
                <h3>Profil Singkat</h3>

                <p>
                    Sisa semester hingga batas:
                    <?= bersihkan($sisaSemester) ?>
                </p>

                <p>
                    Pemeriksaan rentang semester:
                    <?= bersihkan($statusSemester) ?>
                </p>

                <p>
                    Semester:
                    <?= bersihkan($semester) ?>
                    (<?= bersihkan($keteranganSemester) ?>)
                </p>

                <p>
                    Program Studi:
                    <?= bersihkan($namaProdi) ?>
                    (<?= bersihkan($programStudi) ?>)
                </p>

                <p>
                    Status mahasiswa:
                    <?= bersihkan($teksStatus) ?>
                </p>

                <p>
                    Fokus program studi:
                    <?= bersihkan($fokusProgramStudi) ?>
                </p>

                <p>
                    IPK:
                    <?= number_format($ipk, 2, ',', '.') ?>
                </p>

                <p>
                    Catatan tambahan:
                    <?= $catatanTambahan === null
                        ? 'Belum ada'
                        : bersihkan($catatanTambahan) ?>
                </p>

                <h3>Data Profil (Larik Asosiatif dan foreach)</h3>

                <table class="tabel-profil">
                    <?php foreach ($dataProfil as $label => $nilai): ?>
                        <tr>
                            <th><?= bersihkan($label) ?></th>
                            <td><?= bersihkan($nilai) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>

                <h3>Target Belajar (Perulangan for)</h3>

                <ol>
                    <?php
                    for ($i = 1; $i <= 5; $i++) {
                        echo '<li>Target belajar ke-' . $i . ': ';

                        switch ($i) {
                            case 1:
                                echo 'Memahami sintaks dasar PHP.';
                                break;

                            case 2:
                                echo 'Menggunakan variabel dan konstanta.';
                                break;

                            case 3:
                                echo 'Menerapkan operator dan percabangan.';
                                break;

                            case 4:
                                echo 'Menggunakan perulangan for dan while.';
                                break;

                            default:
                                echo 'Belum dipetakan.';
                        }

                        echo '</li>';
                    }
                    ?>
                </ol>

                <h3>Semester (Perulangan while)</h3>

                <ol>
                    <?php
                    $nomorSemester = 1;

                    while ($nomorSemester <= 3) {
                        echo '<li>Semester ' . $nomorSemester . '</li>';
                        $nomorSemester++;
                    }
                    ?>
                </ol>

                <h3>Contoh Fungsi PHP</h3>

                <p>
                    Menampilkan HTML:
                    <?= 'hai <b>sayang</b> kamu' ?>
                </p>

                <p>
                    Membersihkan teks:
                    <?= bersihkan('hai <b>sayang</b> kamu') ?>
                </p>

                <p>
                    Contoh array:
                    <?php
                    $contohArray = ['defi', 'cinta', 'bunda', 'feliani'];
                    echo bersihkan($contohArray[0]);
                    ?>
                </p>
            </article>
        </section>

        <section id="contact">
            <h2>Kontak</h2>

            <?php if ($pesanKesalahan !== ''): ?>
                <p class="form-feedback-error" role="alert">
                    <?= bersihkan($pesanKesalahan) ?>
                </p>
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
                class="js-contact-form"
                data-validation="contact"
                action="index.php"
                method="post"
                novalidate>

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
                        value="<?= bersihkan($nama) ?>"
                        required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        class="input-form"
                        type="email"
                        id="email"
                        name="email"
                        placeholder="nama@email.com"
                        value="<?= bersihkan($email) ?>"
                        required>
                </div>

                <div class="form-group">
                    <label for="semester">Semester</label>
                    <input
                        class="input-form"
                        type="number"
                        id="semester"
                        name="semester"
                        value="<?= bersihkan($semesterForm) ?>"
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
                        value="<?= bersihkan($tanggal) ?>"
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
                        <?= in_array('HTML', $minat, true) ? 'checked' : '' ?>>
                    <label for="minat-html">HTML</label>

                    <input
                        type="checkbox"
                        id="minat-css"
                        name="minat[]"
                        value="CSS"
                        <?= in_array('CSS', $minat, true) ? 'checked' : '' ?>>
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
                        required><?= bersihkan($pesan) ?></textarea>
                </div>

                <p
                    id="formFeedback"
                    class="form-feedback"
                    data-form-feedback
                    aria-live="polite"></p>

                <button type="submit">Kirim</button>
                <button type="reset">Batal</button>
            </form>

            <article
                id="hasilKontak"
                class="submission-result"
                aria-live="polite">

                <h3>Data Kontak dari Basis Data</h3>

                <?php if (count($dataKontak) > 0): ?>
                    <?php foreach ($dataKontak as $data): ?>
                        <section>
                            <p>
                                <strong>ID:</strong>
                                <?= bersihkan($data['id']) ?>
                            </p>
                            <p>
                                <strong>Nama:</strong>
                                <?= bersihkan($data['nama']) ?>
                            </p>
                            <p>
                                <strong>Email:</strong>
                                <?= bersihkan($data['email']) ?>
                            </p>
                            <p>
                                <strong>Semester:</strong>
                                <?= bersihkan($data['semester']) ?>
                            </p>
                            <p>
                                <strong>Tanggal Kunjungan:</strong>
                                <?= bersihkan($data['tanggal']) ?>
                            </p>
                            <p>
                                <strong>Jenis Pesan:</strong>
                                <?= bersihkan($data['jenis_pesan']) ?>
                            </p>
                            <p>
                                <strong>Topik yang Diminati:</strong>
                                <?= bersihkan($data['minat']) ?>
                            </p>
                            <p>
                                <strong>Program Studi:</strong>
                                <?= bersihkan($data['prodi']) ?>
                            </p>
                            <p>
                                <strong>Pesan:</strong>
                                <?= nl2br(bersihkan($data['pesan'])) ?>
                            </p>
                        </section>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Belum ada data kontak yang tersimpan.</p>
                <?php endif; ?>
            </article>
        </section>
    </main>

    <footer>
        <p>
            &copy; <?= date('Y') ?>
            <?= bersihkan($namaMahasiswa) ?>
            [<?= bersihkan($nim) ?>]
        </p>
    </footer>

    <script src="script.js"></script>
</body>

</html>