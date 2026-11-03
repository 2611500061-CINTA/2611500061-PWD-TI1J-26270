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

/* Validasi JavaScript formulir Kontak */
const contactForm = document.getElementById("contactForm");
const formFeedback = document.getElementById("formFeedback");

if (contactForm && formFeedback) {
  contactForm.addEventListener("submit", (event) => {
    const tombol = event.submitter;

    // Tombol Batal punya form tersendiri dan tidak menjalankan validasi kontak.
    if (tombol && tombol.form && tombol.form.id === "resetKontakForm") {
      return;
    }

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

/* Validasi JavaScript formulir peminjaman fasilitas */
const peminjamanForm = document.getElementById("peminjamanForm");
const peminjamanFeedback = document.getElementById("peminjamanFeedback");

if (peminjamanForm && peminjamanFeedback) {
  peminjamanForm.addEventListener("submit", (event) => {
    const tombol = event.submitter;

    // Tombol Batal tidak menjalankan validasi peminjaman.
    if (tombol && tombol.form && tombol.form.id === "resetPeminjamanForm") {
      return;
    }

    peminjamanFeedback.textContent = "";
    peminjamanFeedback.className = "form-feedback-error";

    const nama = document.getElementById("namaPenanggungJawab").value.trim();
    const fasilitas = document.getElementById("jenisFasilitas").value;
    const tanggal = document.getElementById("tanggalPeminjaman").value;
    const durasi = Number(document.getElementById("durasiPeminjaman").value);
    const keperluan = document
      .getElementById("keperluanPeminjaman")
      .value.trim();

    let kesalahan = "";

    if (nama.length < 3 || nama.length > 50) {
      kesalahan = "Nama penanggung jawab harus 3 sampai 50 karakter.";
    } else if (!fasilitas) {
      kesalahan = "Pilih jenis fasilitas.";
    } else if (!tanggal) {
      kesalahan = "Tanggal peminjaman wajib diisi.";
    } else if (!Number.isInteger(durasi) || durasi < 1) {
      kesalahan = "Durasi peminjaman minimal 1 jam.";
    } else if (!keperluan) {
      kesalahan = "Keperluan peminjaman wajib diisi.";
    }

    if (kesalahan) {
      event.preventDefault();
      peminjamanFeedback.textContent = kesalahan;
    }
  });
}