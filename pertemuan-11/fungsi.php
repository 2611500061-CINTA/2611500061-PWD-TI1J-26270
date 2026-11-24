<?php

function bersihkan($teks)
{
  return htmlspecialchars($teks ?? "", ENT_QUOTES, "UTF-8");
}

function tebal($teks)
{
  return "<strong>" . bersihkan($teks) . "</strong>";
}

/** Menghitung sisa semester hingga batas yang ditentukan. */
function hitungSisaSemester(int $semesterSaatIni, int $batasSemester): int
{
  return $batasSemester - $semesterSaatIni;
}

/** Mengelompokkan semester menjadi awal, menengah, atau akhir. */
function tentukanKategoriSemester(int $semester): string
{
  if ($semester < 3) {
    return 'Semester awal';
  }

  if ($semester <= 6) {
    return 'Semester menengah';
  }

  return 'Semester akhir';
}

/** Memvalidasi data formulir yang disimpan sebagai larik asosiatif. */
function validasiFormulir(array $data): string
{
  $pesanKesalahan = '';
  $nama = $data['nama'] ?? '';
  $email = $data['email'] ?? '';
  $semester = $data['semester'] ?? '';
  $tanggal = $data['tanggal'] ?? '';
  $jenisPesan = $data['jenis_pesan'] ?? '';
  $prodi = $data['prodi'] ?? '';
  $pesan = $data['pesan'] ?? '';
  $minat = $data['minat'] ?? [];

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

  if ($semester === '') {
    $pesanKesalahan .= 'Semester wajib diisi. ';
  } else {
    $semesterValid = filter_var($semester, FILTER_VALIDATE_INT);

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

  return $pesanKesalahan;
}
