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

// Tombol reset kontak menghapus data kontak dari sesi.
if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && ($_POST['form_type'] ?? '') === 'reset_kontak'
) {
    unset($_SESSION['kontak'], $_SESSION['pesanBerhasil']);
    header('Location: ' . $_SERVER['PHP_SELF'] . '#contact');
    exit;
}

// Tombol reset peminjaman menghapus data peminjaman dari sesi.
if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && ($_POST['form_type'] ?? '') === 'reset_peminjaman'
) {
    unset($_SESSION['peminjaman'], $_SESSION['berhasilPeminjaman']);
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
    'namaPeminjam' => '',
    'nimPeminjam' => '',
    'emailPeminjam' => '',
    'fasilitas' => '',
    'tanggalPeminjaman' => '',
    'waktuMulai' => '',
    'waktuSelesai' => '',
    'jumlahPeserta' => '',
    'keperluan' => '',
];

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

    // Peladen formulir kontak.
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

    // Peladen formulir peminjaman fasilitas.
    if ($jenisForm === 'peminjaman') {
        $peminjaman = [
            'namaPeminjam' => trim((string) ($_POST['namaPeminjam'] ?? '')),
            'nimPeminjam' => trim((string) ($_POST['nimPeminjam'] ?? '')),
            'emailPeminjam' => trim((string) ($_POST['emailPeminjam'] ?? '')),
            'fasilitas' => trim((string) ($_POST['fasilitas'] ?? '')),
            'tanggalPeminjaman' => trim((string) ($_POST['tanggalPeminjaman'] ?? '')),
            'waktuMulai' => trim((string) ($_POST['waktuMulai'] ?? '')),
            'waktuSelesai' => trim((string) ($_POST['waktuSelesai'] ?? '')),
            'jumlahPeserta' => trim((string) ($_POST['jumlahPeserta'] ?? '')),
            'keperluan' => trim((string) ($_POST['keperluan'] ?? '')),
        ];

        $daftarFasilitas = [
            'Ruang Kelas',
            'Laboratorium Komputer',
            'Aula Kampus',
            'Ruang Seminar',
            'Lapangan Kampus',
        ];

        if (strlen($peminjaman['namaPeminjam']) < 3 || strlen($peminjaman['namaPeminjam']) > 50) {
            $kesalahanPeminjaman = 'Nama peminjam harus diisi 3 sampai 50 karakter.';
        } elseif ($peminjaman['nimPeminjam'] === '') {
            $kesalahanPeminjaman = 'NIM wajib diisi.';
        } elseif (!filter_var($peminjaman['emailPeminjam'], FILTER_VALIDATE_EMAIL)) {
            $kesalahanPeminjaman = 'Alamat email peminjam tidak valid.';
        } elseif (!in_array($peminjaman['fasilitas'], $daftarFasilitas, true)) {
            $kesalahanPeminjaman = 'Silakan pilih fasilitas kampus.';
        } elseif (!tanggalValid($peminjaman['tanggalPeminjaman'])) {
            $kesalahanPeminjaman = 'Tanggal peminjaman tidak valid.';
        } elseif ($peminjaman['tanggalPeminjaman'] < date('Y-m-d')) {
            $kesalahanPeminjaman = 'Tanggal peminjaman tidak boleh sebelum hari ini.';
        } elseif (
            !preg_match('/^\d{2}:\d{2}$/', $peminjaman['waktuMulai'])
            || !preg_match('/^\d{2}:\d{2}$/', $peminjaman['waktuSelesai'])
        ) {
            $kesalahanPeminjaman = 'Waktu mulai dan selesai wajib diisi dengan benar.';
        } elseif ($peminjaman['waktuSelesai'] <= $peminjaman['waktuMulai']) {
            $kesalahanPeminjaman = 'Waktu selesai harus setelah waktu mulai.';
        } elseif (
            filter_var($peminjaman['jumlahPeserta'], FILTER_VALIDATE_INT) === false
            || (int) $peminjaman['jumlahPeserta'] < 1
        ) {
            $kesalahanPeminjaman = 'Jumlah peserta minimal 1 orang.';
        } elseif (strlen($peminjaman['keperluan']) < 5) {
            $kesalahanPeminjaman = 'Keperluan peminjaman minimal 5 karakter.';
        } else {
            $_SESSION['peminjaman'] = $peminjaman;
            $_SESSION['berhasilPeminjaman'] = 'Permohonan peminjaman fasilitas berhasil dikirim.';
            header('Location: ' . $_SERVER['PHP_SELF'] . '#peminjaman');
            exit;
        }
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
                <button type="submit" form="resetKontakForm">Reset</button>
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

        <section id="peminjaman">
            <h2>Formulir Permohonan Peminjaman Fasilitas Kampus</h2>
            <p>Silakan isi data berikut untuk mengajukan permohonan peminjaman fasilitas kampus.</p>

            <form id="peminjamanForm" method="post" action="#peminjaman">
                <input type="hidden" name="form_type" value="peminjaman">

                <div class="form-group">
                    <label for="namaPeminjam">Nama Lengkap Peminjam</label>
                    <input type="text" id="namaPeminjam" name="namaPeminjam"
                        minlength="3" maxlength="50" value="<?= h($peminjaman['namaPeminjam']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="nimPeminjam">NIM</label>
                    <input type="text" id="nimPeminjam" name="nimPeminjam"
                        value="<?= h($peminjaman['nimPeminjam']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="emailPeminjam">Email</label>
                    <input type="email" id="emailPeminjam" name="emailPeminjam"
                        value="<?= h($peminjaman['emailPeminjam']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="fasilitas">Fasilitas yang Dipinjam</label>
                    <select id="fasilitas" name="fasilitas" required>
                        <option value="">-- Pilih Fasilitas --</option>
                        <?php foreach (['Ruang Kelas', 'Laboratorium Komputer', 'Aula Kampus', 'Ruang Seminar', 'Lapangan Kampus'] as $item): ?>
                            <option value="<?= h($item) ?>"
                                <?= $peminjaman['fasilitas'] === $item ? 'selected' : '' ?>>
                                <?= h($item) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="tanggalPeminjaman">Tanggal Peminjaman</label>
                    <input type="date" id="tanggalPeminjaman" name="tanggalPeminjaman"
                        min="<?= h(date('Y-m-d')) ?>"
                        value="<?= h($peminjaman['tanggalPeminjaman']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="waktuMulai">Waktu Mulai</label>
                    <input type="time" id="waktuMulai" name="waktuMulai"
                        value="<?= h($peminjaman['waktuMulai']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="waktuSelesai">Waktu Selesai</label>
                    <input type="time" id="waktuSelesai" name="waktuSelesai"
                        value="<?= h($peminjaman['waktuSelesai']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="jumlahPeserta">Jumlah Peserta</label>
                    <input type="number" id="jumlahPeserta" name="jumlahPeserta"
                        min="1" value="<?= h($peminjaman['jumlahPeserta']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="keperluan">Keperluan Peminjaman</label>
                    <textarea id="keperluan" name="keperluan" minlength="5" required><?= h($peminjaman['keperluan']) ?></textarea>
                </div>

                <p id="peminjamanFeedback" class="form-feedback-error" aria-live="polite">
                    <?= h($kesalahanPeminjaman) ?>
                </p>

                <?php if ($berhasilPeminjaman !== ''): ?>
                    <p class="form-feedback-success"><?= h($berhasilPeminjaman) ?></p>
                <?php endif; ?>

                <button type="submit">Kirim Permohonan</button>
                <button type="submit" form="resetPeminjamanForm">Reset Formulir</button>
            </form>

            <form id="resetPeminjamanForm" method="post" action="#peminjaman">
                <input type="hidden" name="form_type" value="reset_peminjaman">
            </form>

            <?php if ($peminjaman['namaPeminjam'] !== ''): ?>
                <h3>Data Permohonan yang Diterima Peladen</h3>
                <p>Nama: <?= h($peminjaman['namaPeminjam']) ?></p>
                <p>NIM: <?= h($peminjaman['nimPeminjam']) ?></p>
                <p>Email: <?= h($peminjaman['emailPeminjam']) ?></p>
                <p>Fasilitas: <?= h($peminjaman['fasilitas']) ?></p>
                <p>Tanggal: <?= h($peminjaman['tanggalPeminjaman']) ?></p>
                <p>Waktu: <?= h($peminjaman['waktuMulai']) ?>–<?= h($peminjaman['waktuSelesai']) ?></p>
                <p>Jumlah peserta: <?= h($peminjaman['jumlahPeserta']) ?></p>
                <p>Keperluan: <?= nl2br(h($peminjaman['keperluan'])) ?></p>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> <?= h($namaMahasiswa) ?> | <?= h(NAMA_MATA_KULIAH) ?></p>
    </footer>

    <script src="script.js"></script>
</body>

</html>