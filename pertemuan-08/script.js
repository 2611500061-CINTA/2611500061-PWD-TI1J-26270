// ==================================================
// TAMBAHAN P8: VALIDASI FORMULIR PEMINJAMAN FASILITAS
// Kode JavaScript lama tetap dipertahankan.
// ==================================================

const peminjamanForm = document.getElementById("peminjamanForm");
const peminjamanFeedback = document.getElementById("peminjamanFeedback");

if (peminjamanForm && peminjamanFeedback) {
  peminjamanForm.addEventListener("submit", (event) => {
    peminjamanFeedback.className = "form-feedback-error";
    peminjamanFeedback.textContent = "";

    // Ambil nilai input formulir
    const namaPeminjam = document
      .getElementById("namaPeminjam")
      .value.trim();

    const nimPeminjam = document
      .getElementById("nimPeminjam")
      .value.trim();

    const emailPeminjam = document
      .getElementById("emailPeminjam")
      .value.trim();

    const fasilitas = document.getElementById("fasilitas");
    const tanggalPeminjaman = document.getElementById("tanggalPeminjaman");
    const waktuMulai = document.getElementById("waktuMulai");
    const waktuSelesai = document.getElementById("waktuSelesai");
    const jumlahPeserta = document.getElementById("jumlahPeserta");

    const keperluan = document
      .getElementById("keperluan")
      .value.trim();

    // Validasi nama peminjam
    if (namaPeminjam.length < 3 || namaPeminjam.length > 50) {
      event.preventDefault();
      peminjamanFeedback.textContent =
        "Nama peminjam harus diisi 3 sampai 50 karakter.";
      return;
    }

    // Validasi NIM
    if (nimPeminjam === "") {
      event.preventDefault();
      peminjamanFeedback.textContent = "NIM harus diisi.";
      return;
    }

    // Validasi email
    const polaEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!polaEmail.test(emailPeminjam)) {
      event.preventDefault();
      peminjamanFeedback.textContent =
        "Masukkan alamat email yang valid.";
      return;
    }

    // Validasi fasilitas
    if (fasilitas.value === "") {
      event.preventDefault();
      peminjamanFeedback.textContent =
        "Silakan pilih fasilitas kampus yang ingin dipinjam.";
      return;
    }

    // Validasi tanggal
    if (tanggalPeminjaman.value === "") {
      event.preventDefault();
      peminjamanFeedback.textContent =
        "Tanggal peminjaman harus diisi.";
      return;
    }

    // Validasi waktu
    if (waktuMulai.value === "" || waktuSelesai.value === "") {
      event.preventDefault();
      peminjamanFeedback.textContent =
        "Waktu mulai dan waktu selesai harus diisi.";
      return;
    }

    if (waktuSelesai.value <= waktuMulai.value) {
      event.preventDefault();
      peminjamanFeedback.textContent =
        "Waktu selesai harus lebih besar daripada waktu mulai.";
      return;
    }

    // Validasi jumlah peserta
    const jumlah = Number(jumlahPeserta.value);

    if (
      jumlahPeserta.value === "" ||
      !Number.isInteger(jumlah) ||
      jumlah < 1
    ) {
      event.preventDefault();
      peminjamanFeedback.textContent =
        "Jumlah peserta harus diisi minimal 1 orang.";
      return;
    }

    // Validasi keperluan peminjaman
    if (keperluan.length < 5) {
      event.preventDefault();
      peminjamanFeedback.textContent =
        "Keperluan peminjaman harus diisi minimal 5 karakter.";
      return;
    }

    // Jika semua validasi berhasil
    peminjamanFeedback.textContent =
      "Formulir peminjaman berhasil divalidasi dan siap dikirim.";
    peminjamanFeedback.className = "form-feedback-success";
  });

  // Bersihkan pesan ketika formulir direset
  peminjamanForm.addEventListener("reset", () => {
    peminjamanFeedback.textContent = "";
    peminjamanFeedback.className = "";
  });

  // Bersihkan pesan ketika pengguna mengubah isian
  peminjamanForm.addEventListener("input", () => {
    peminjamanFeedback.textContent = "";
    peminjamanFeedback.className = "";
  });

  peminjamanForm.addEventListener("change", () => {
    peminjamanFeedback.textContent = "";
    peminjamanFeedback.className = "";
  });
}
