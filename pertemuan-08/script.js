/* Navigasi hamburger */
const navToggle = document.getElementById("navToggle");
const navMenu = document.getElementById("navMenu");

if (navToggle && navMenu) {
  navToggle.addEventListener("click", () => {
    const terbuka = navMenu.classList.toggle("nav-open");

    navToggle.setAttribute("aria-expanded", String(terbuka));
    navToggle.setAttribute(
      "aria-label",
      terbuka ? "Tutup navigasi" : "Buka navigasi"
    );
  });

  navMenu.querySelectorAll("a").forEach((link) => {
    link.addEventListener("click", () => {
      navMenu.classList.remove("nav-open");
      navToggle.setAttribute("aria-expanded", "false");
      navToggle.setAttribute("aria-label", "Buka navigasi");
    });
  });
}

/* Validasi formulir kontak */
const contactForm = document.getElementById("contactForm");
const formFeedback = document.getElementById("formFeedback");

if (contactForm && formFeedback) {
  contactForm.addEventListener("submit", (event) => {
    formFeedback.textContent = "";
    formFeedback.className = "form-feedback-error";

    const nama = document.getElementById("nama").value.trim();
    const email = document.getElementById("email").value.trim();
    const semester = Number(document.getElementById("semester").value);
    const tanggal = document.getElementById("tanggal").value;
    const jenisPesan = document.querySelector(
      'input[name="jenis_pesan"]:checked'
    );
    const minat = document.querySelectorAll('input[name="minat[]"]:checked');
    const prodi = document.getElementById("prodi").value;
    const pesan = document.getElementById("pesan").value.trim();

    let kesalahan = "";

    if (nama.length < 3 || nama.length > 50) {
      kesalahan = "Nama harus diisi 3 sampai 50 karakter.";
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
      kesalahan = "Masukkan alamat email yang valid.";
    } else if (!Number.isInteger(semester) || semester < 1 || semester > 14) {
      kesalahan = "Semester harus bilangan bulat antara 1 sampai 14.";
    } else if (!tanggal) {
      kesalahan = "Tanggal kunjungan harus diisi.";
    } else if (!jenisPesan) {
      kesalahan = "Pilih jenis pesan.";
    } else if (minat.length === 0) {
      kesalahan = "Pilih minimal satu topik yang diminati.";
    } else if (!prodi) {
      kesalahan = "Pilih program studi.";
    } else if (!pesan) {
      kesalahan = "Pesan harus diisi.";
    } else if (pesan.length > 300) {
      kesalahan = "Pesan maksimal 300 karakter.";
    }

    if (kesalahan) {
      event.preventDefault();
      formFeedback.textContent = kesalahan;
    }
  });
}

/* Validasi formulir peminjaman fasilitas */
const peminjamanForm = document.getElementById("peminjamanForm");
const peminjamanFeedback = document.getElementById("peminjamanFeedback");

if (peminjamanForm && peminjamanFeedback) {
  peminjamanForm.addEventListener("submit", (event) => {
    peminjamanFeedback.textContent = "";
    peminjamanFeedback.className = "form-feedback-error";

    const nama = document.getElementById("namaPeminjam").value.trim();
    const nim = document.getElementById("nimPeminjam").value.trim();
    const email = document.getElementById("emailPeminjam").value.trim();
    const fasilitas = document.getElementById("fasilitas").value;
    const tanggal = document.getElementById("tanggalPeminjaman").value;
    const waktuMulai = document.getElementById("waktuMulai").value;
    const waktuSelesai = document.getElementById("waktuSelesai").value;
    const jumlahPeserta = Number(
      document.getElementById("jumlahPeserta").value
    );
    const keperluan = document.getElementById("keperluan").value.trim();

    const sekarang = new Date();
    const hariIni = new Date(
      sekarang.getTime() - sekarang.getTimezoneOffset() * 60000
    )
      .toISOString()
      .slice(0, 10);

    let kesalahan = "";

    if (nama.length < 3 || nama.length > 50) {
      kesalahan = "Nama peminjam harus diisi 3 sampai 50 karakter.";
    } else if (!nim) {
      kesalahan = "NIM wajib diisi.";
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
      kesalahan = "Masukkan alamat email peminjam yang valid.";
    } else if (!fasilitas) {
      kesalahan = "Silakan pilih fasilitas kampus.";
    } else if (!tanggal || tanggal < hariIni) {
      kesalahan = "Pilih tanggal hari ini atau setelahnya.";
    } else if (!waktuMulai || !waktuSelesai) {
      kesalahan = "Waktu mulai dan selesai wajib diisi.";
    } else if (waktuSelesai <= waktuMulai) {
      kesalahan = "Waktu selesai harus setelah waktu mulai.";
    } else if (!Number.isInteger(jumlahPeserta) || jumlahPeserta < 1) {
      kesalahan = "Jumlah peserta minimal 1 orang.";
    } else if (keperluan.length < 5) {
      kesalahan = "Keperluan peminjaman minimal 5 karakter.";
    }

    if (kesalahan) {
      event.preventDefault();
      peminjamanFeedback.textContent = kesalahan;
    }
  });
}