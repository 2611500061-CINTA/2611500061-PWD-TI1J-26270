<?php
session_start();

function h($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function tanggalValid(string $tanggal): bool
{
    $hasil = DateTime::createFromFormat('!Y-m-d', $tanggal);
    return $hasil !== false && $hasil->format('Y-m-d') === $tanggal;
}

$nim = '2611500061';
$namaMahasiswa = 'Cinta Bunda Feliani';
$programStudi = 'TI';
$tahunAkademik = '2026/2027';
$semesterMahasiswa = 2;
$ipk = 3.75;
$statusAktif = true;

const NAMA_MATA_KULIAH = 'Pemrograman Web Dasar';
const PROFIL_GITHUB = 'satpamal';

$pesanKesalahan = '';
$pesanBerhasil = '';
$kesalahanPeminjaman = '';
$berhasilPeminjaman = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['form_type'] ?? '') === 'reset_kontak') {
    unset($_SESSION['kontak'], $_SESSION['pesanBerhasil']);
    header('Location: ' . $_SERVER['PHP_SELF'] . '#contact');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['form_type'] ?? '') === 'reset_peminjaman') {
    unset(
        $_SESSION['peminjaman'],
        $_SESSION['berhasilPeminjaman'],
        $_SESSION['dataPeminjamanSementara'],
        $_SESSION['kesalahanPeminjaman']
    );
    header('Location: ' . $_SERVER['PHP_SELF'] . '#peminjaman');
    exit;
}

$kontak = $_SESSION['kontak'] ?? [
    'nama' => '',
    'email' => '',
    'semester' => '',
    'tanggal' => '',
    'jenis_pesan' => '',
    'minat' => [],
    'prodi' => '',
    'pesan' => '',
];

$peminjaman = $_SESSION['peminjaman'] ?? [
    'namaPenanggungJawab' => '',
    'jenisFasilitas' => '',
    'tanggalPeminjaman' => '',
    'durasiPeminjaman' => '',
    'keperluanPeminjaman' => '',
];

if (isset($_SESSION['dataPeminjamanSementara'])) {
    $peminjaman = $_SESSION['dataPeminjamanSementara'];
    unset($_SESSION['dataPeminjamanSementara']);
}

if (isset($_SESSION['kesalahanPeminjaman'])) {
    $kesalahanPeminjaman = $_SESSION['kesalahanPeminjaman'];
    unset($_SESSION['kesalahanPeminjaman']);
}

if (isset($_SESSION['pesanBerhasil'])) {
    $pesanBerhasil = $_SESSION['pesanBerhasil'];
    unset($_SESSION['pesanBerhasil']);
}

if (isset($_SESSION['berhasilPeminjaman'])) {
    $berhasilPeminjaman = $_SESSION['berhasilPeminjaman'];
    unset($_SESSION['berhasilPeminjaman']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jenisForm = $_POST['form_type'] ?? '';

    // Pemrosesan peladen formulir Kontak.
    if ($jenisForm === 'contact') {
        $kontak = [
            'nama' => trim((string) ($_POST['nama'] ?? '')),
            'email' => trim((string) ($_POST['email'] ?? '')),
            'semester' => trim((string) ($_POST['semester'] ?? '')),
            'tanggal' => trim((string) ($_POST['tanggal'] ?? '')),
            'jenis_pesan' => trim((string) ($_POST['jenis_pesan'] ?? '')),
            'minat' => $_POST['minat'] ?? [],
            'prodi' => trim((string) ($_POST['prodi'] ?? '')),
            'pesan' => trim((string) ($_POST['pesan'] ?? '')),
        ];

        if (!is_array($kontak['minat'])) {
            $kontak['minat'] = [];
            $pesanKesalahan = 'Format pilihan minat tidak valid.';
        }

        if ($pesanKesalahan === '') {
            if (strlen($kontak['nama']) < 3 || strlen($kontak['nama']) > 50) {
                $pesanKesalahan = 'Nama harus diisi 3 sampai 50 karakter.';
            } elseif (!filter_var($kontak['email'], FILTER_VALIDATE_EMAIL)) {
                $pesanKesalahan = 'Alamat email tidak valid.';
            } elseif (
                filter_var($kontak['semester'], FILTER_VALIDATE_INT) === false
                || (int) $kontak['semester'] < 1
                || (int) $kontak['semester'] > 14
            ) {
                $pesanKesalahan = 'Semester harus berupa bilangan bulat antara 1 sampai 14.';
            } elseif (!tanggalValid($kontak['tanggal'])) {
                $pesanKesalahan = 'Tanggal kunjungan tidak valid.';
            } elseif (!in_array($kontak['jenis_pesan'], ['Pertanyaan', 'Saran', 'Kritik'], true)) {
                $pesanKesalahan = 'Pilih jenis pesan yang valid.';
            } elseif (!in_array($kontak['prodi'], ['TI', 'SI', 'MI'], true)) {
                $pesanKesalahan = 'Pilih program studi yang valid.';
            } elseif ($kontak['pesan'] === '') {
                $pesanKesalahan = 'Pesan harus diisi.';
            } elseif (strlen($kontak['pesan']) > 300) {
                $pesanKesalahan = 'Pesan maksimal 300 karakter.';
            } elseif (count($kontak['minat']) === 0) {
                $pesanKesalahan = 'Pilih minimal satu topik yang diminati.';
            } else {
                foreach ($kontak['minat'] as $topik) {
                    if (
                        !is_string($topik)
                        || !in_array($topik, ['HTML', 'CSS', 'JavaScript', 'PHP'], true)
                    ) {
                        $pesanKesalahan = 'Pilihan topik tidak valid.';
                        break;
                    }
                }
            }
        }

        if ($pesanKesalahan === '') {
            $_SESSION['kontak'] = $kontak;
            $_SESSION['pesanBerhasil'] = 'Terima kasih! Formulir kontak berhasil dikirim.';
            header('Location: ' . $_SERVER['PHP_SELF'] . '#contact');
            exit;
        }
    }

    // Pemrosesan peladen formulir peminjaman fasilitas.
    if ($jenisForm === 'peminjaman') {
        $peminjaman = [
            'namaPenanggungJawab' => trim((string) ($_POST['namaPenanggungJawab'] ?? '')),
            'jenisFasilitas' => trim((string) ($_POST['jenisFasilitas'] ?? '')),
            'tanggalPeminjaman' => trim((string) ($_POST['tanggalPeminjaman'] ?? '')),
            'durasiPeminjaman' => trim((string) ($_POST['durasiPeminjaman'] ?? '')),
            'keperluanPeminjaman' => trim((string) ($_POST['keperluanPeminjaman'] ?? '')),
        ];

        $fasilitasDiizinkan = [
            'Ruang Kelas',
            'Aula',
            'Laboratorium Komputer',
            'Proyektor',
        ];

        if (
            strlen($peminjaman['namaPenanggungJawab']) < 3
            || strlen($peminjaman['namaPenanggungJawab']) > 50
        ) {
            $kesalahanPeminjaman = 'Nama penanggung jawab harus 3 sampai 50 karakter.';
        } elseif (!in_array($peminjaman['jenisFasilitas'], $fasilitasDiizinkan, true)) {
            $kesalahanPeminjaman = 'Pilih jenis fasilitas yang tersedia.';
        } elseif (!tanggalValid($peminjaman['tanggalPeminjaman'])) {
            $kesalahanPeminjaman = 'Tanggal peminjaman tidak valid.';
        } elseif (
            filter_var($peminjaman['durasiPeminjaman'], FILTER_VALIDATE_INT) === false
            || (int) $peminjaman['durasiPeminjaman'] < 1
        ) {
            $kesalahanPeminjaman = 'Durasi peminjaman minimal 1 jam.';
        } elseif ($peminjaman['keperluanPeminjaman'] === '') {
            $kesalahanPeminjaman = 'Keperluan peminjaman wajib diisi.';
        }

        if ($kesalahanPeminjaman === '') {
            $_SESSION['peminjaman'] = $peminjaman;
            $_SESSION['berhasilPeminjaman'] = 'Permohonan peminjaman fasilitas berhasil dikirim.';
            header('Location: ' . $_SERVER['PHP_SELF'] . '#peminjaman');
            exit;
        }

        // Simpan data dan pesan validasi supaya tetap tampil setelah redirect.
        $_SESSION['dataPeminjamanSementara'] = $peminjaman;
        $_SESSION['kesalahanPeminjaman'] = $kesalahanPeminjaman;
        header('Location: ' . $_SERVER['PHP_SELF'] . '#peminjaman');
        exit;
    }
}

$minatKontak = is_array($kontak['minat']) ? $kontak['minat'] : [];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pertemuan 08 - Pemrograman Web Dasar</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <div class="header-top">
            <h1>Pemrograman Web Dasar</h1>
            <button type="button" class="nav-toggle" id="navToggle"
                aria-label="Buka navigasi" aria-expanded="false" aria-controls="navMenu">☰</button>
        </div>

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
        <section id="home">
            <h2>Selamat Datang</h2>
            <p>
                Halo, saya <strong><?= h($namaMahasiswa) ?></strong>.
                Saya sedang mempelajari pemrograman web dasar.
            </p>
            <img src="img/foto-profil.jpg" alt="Foto profil mahasiswa">
        </section>

        <section id="about">
            <h2>Tentang Saya</h2>
            <h3>Data Mahasiswa</h3>
            <p><strong>NIM:</strong> <?= h($nim) ?></p>
            <p><strong>Nama:</strong> <?= h($namaMahasiswa) ?></p>
            <p><strong>Program Studi:</strong> <?= h($programStudi) ?></p>
            <p><strong>Tahun Akademik:</strong> <?= h($tahunAkademik) ?></p>
            <p><strong>Semester:</strong> <?= h($semesterMahasiswa) ?></p>
            <p><strong>IPK:</strong> <?= number_format($ipk, 2, ',', '.') ?></p>
            <p><strong>Status Mahasiswa:</strong> <?= $statusAktif ? 'Aktif' : 'Tidak Aktif' ?></p>
            <p><strong>Mata Kuliah:</strong> <?= h(NAMA_MATA_KULIAH) ?></p>
            <p><strong>GitHub:</strong> <?= h(PROFIL_GITHUB) ?></p>

            <h3>Daftar Kegiatan</h3>
            <ol>
                <li>Mempelajari HTML</li>
                <li>Mempelajari CSS</li>
                <li>Mempelajari JavaScript</li>
                <li>Mempelajari PHP</li>
            </ol>
        </section>

        <section id="peminjaman">
            <h2>Permohonan Peminjaman Fasilitas Kampus</h2>

            <form id="peminjamanForm" method="post" action="#peminjaman">
                <input type="hidden" name="form_type" value="peminjaman">

                <div class="form-group">
                    <label for="namaPenanggungJawab">Nama Penanggung Jawab</label>
                    <input class="input-form" type="text" id="namaPenanggungJawab"
                        name="namaPenanggungJawab" minlength="3" maxlength="50"
                        value="<?= h($peminjaman['namaPenanggungJawab']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="jenisFasilitas">Jenis Fasilitas</label>
                    <select class="input-form" id="jenisFasilitas" name="jenisFasilitas" required>
                        <option value="">-- Pilih Fasilitas --</option>
                        <?php foreach (['Ruang Kelas', 'Aula', 'Laboratorium Komputer', 'Proyektor'] as $fasilitas): ?>
                            <option value="<?= h($fasilitas) ?>"
                                <?= $peminjaman['jenisFasilitas'] === $fasilitas ? 'selected' : '' ?>>
                                <?= h($fasilitas) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="tanggalPeminjaman">Tanggal Peminjaman</label>
                    <input class="input-form" type="date" id="tanggalPeminjaman"
                        name="tanggalPeminjaman" value="<?= h($peminjaman['tanggalPeminjaman']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="durasiPeminjaman">Durasi Peminjaman (jam)</label>
                    <input class="input-form" type="number" id="durasiPeminjaman"
                        name="durasiPeminjaman" min="1"
                        value="<?= h($peminjaman['durasiPeminjaman']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="keperluanPeminjaman">Keperluan Peminjaman</label>
                    <textarea class="input-form" id="keperluanPeminjaman"
                        name="keperluanPeminjaman" required><?= h($peminjaman['keperluanPeminjaman']) ?></textarea>
                </div>

                <p id="peminjamanFeedback" class="form-feedback-error" aria-live="polite">
                    <?= h($kesalahanPeminjaman) ?>
                </p>

                <?php if ($berhasilPeminjaman !== ''): ?>
                    <p class="form-feedback-success"><?= h($berhasilPeminjaman) ?></p>
                <?php endif; ?>

                <button type="submit">Kirim</button>
                <button type="submit" form="resetPeminjamanForm">Batal</button>
            </form>

            <form id="resetPeminjamanForm" method="post" action="#peminjaman">
                <input type="hidden" name="form_type" value="reset_peminjaman">
            </form>

            <?php if ($peminjaman['namaPenanggungJawab'] !== ''): ?>
                <h3>Data Permohonan yang Diterima Peladen</h3>
                <p>Nama Penanggung Jawab: <?= h($peminjaman['namaPenanggungJawab']) ?></p>
                <p>Jenis Fasilitas: <?= h($peminjaman['jenisFasilitas']) ?></p>
                <p>Tanggal Peminjaman: <?= h($peminjaman['tanggalPeminjaman']) ?></p>
                <p>Durasi Peminjaman: <?= h($peminjaman['durasiPeminjaman']) ?> jam</p>
                <p>Keperluan: <?= nl2br(h($peminjaman['keperluanPeminjaman'])) ?></p>
            <?php endif; ?>
        </section>

        <section id="contact">
            <h2>Kontak</h2>
            <p>Silakan isi formulir berikut untuk mengirim pesan.</p>
            <p>
                Kunjungi
                <a href="https://github.com/<?= rawurlencode(PROFIL_GITHUB) ?>"
                    target="_blank" rel="noopener noreferrer">profil GitHub saya</a>.
            </p>

            <form id="contactForm" method="post" action="#contact">
                <input type="hidden" name="form_type" value="contact">

                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input class="input-form" type="text" id="nama" name="nama"
                        minlength="3" maxlength="50" value="<?= h($kontak['nama']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="input-form" type="email" id="email" name="email"
                        value="<?= h($kontak['email']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="semester">Semester</label>
                    <input class="input-form" type="number" id="semester" name="semester"
                        min="1" max="14" value="<?= h($kontak['semester']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="tanggal">Tanggal Kunjungan</label>
                    <input class="input-form" type="date" id="tanggal" name="tanggal"
                        value="<?= h($kontak['tanggal']) ?>" required>
                </div>

                <fieldset class="form-group">
                    <legend>Jenis Pesan</legend>
                    <?php foreach (['Pertanyaan', 'Saran', 'Kritik'] as $jenis): ?>
                        <label>
                            <input type="radio" name="jenis_pesan" value="<?= h($jenis) ?>"
                                <?= $kontak['jenis_pesan'] === $jenis ? 'checked' : '' ?> required>
                            <?= h($jenis) ?>
                        </label>
                    <?php endforeach; ?>
                </fieldset>

                <fieldset class="form-group">
                    <legend>Topik yang Diminati</legend>
                    <?php foreach (['HTML', 'CSS', 'JavaScript', 'PHP'] as $topik): ?>
                        <label>
                            <input type="checkbox" name="minat[]" value="<?= h($topik) ?>"
                                <?= in_array($topik, $minatKontak, true) ? 'checked' : '' ?>>
                            <?= h($topik) ?>
                        </label>
                    <?php endforeach; ?>
                </fieldset>

                <div class="form-group">
                    <label for="prodi">Program Studi</label>
                    <select class="input-form" id="prodi" name="prodi" required>
                        <option value="">-- Pilih Program Studi --</option>
                        <?php foreach (['TI' => 'Teknik Informatika', 'SI' => 'Sistem Informasi', 'MI' => 'Manajemen Informatika'] as $kode => $label): ?>
                            <option value="<?= h($kode) ?>"
                                <?= $kontak['prodi'] === $kode ? 'selected' : '' ?>>
                                <?= h($label) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="pesan">Pesan</label>
                    <textarea class="input-form" id="pesan" name="pesan"
                        maxlength="300" required><?= h($kontak['pesan']) ?></textarea>
                </div>

                <p id="formFeedback" class="form-feedback-error" aria-live="polite">
                    <?= h($pesanKesalahan) ?>
                </p>

                <?php if ($pesanBerhasil !== ''): ?>
                    <p class="form-feedback-success"><?= h($pesanBerhasil) ?></p>
                <?php endif; ?>

                <button type="submit">Kirim Pesan</button>
                <button type="submit" form="resetKontakForm">Batal</button>
            </form>

            <form id="resetKontakForm" method="post" action="#contact">
                <input type="hidden" name="form_type" value="reset_kontak">
            </form>

            <?php if ($kontak['nama'] !== ''): ?>
                <h3>Data Kontak yang Diterima Peladen</h3>
                <p>Nama: <?= h($kontak['nama']) ?></p>
                <p>Email: <?= h($kontak['email']) ?></p>
                <p>Semester: <?= h($kontak['semester']) ?></p>
                <p>Tanggal kunjungan: <?= h($kontak['tanggal']) ?></p>
                <p>Jenis pesan: <?= h($kontak['jenis_pesan']) ?></p>
                <p>Program studi: <?= h($kontak['prodi']) ?></p>
                <p>Minat: <?= h(implode(', ', $minatKontak)) ?></p>
                <p>Pesan: <?= nl2br(h($kontak['pesan'])) ?></p>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> <?= h($namaMahasiswa) ?> | <?= h(NAMA_MATA_KULIAH) ?></p>
    </footer>

    <script src="script.js"></script>
</body>

</html>