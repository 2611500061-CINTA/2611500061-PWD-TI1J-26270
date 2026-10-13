const navToggle = document.getElementById("navToggle");
const navMenu = document.getElementById("navMenu");

navToggle.addEventListener("click", () => {
  const isOpen = navMenu.classList.toggle("nav-open");

  navToggle.setAttribute("aria-expanded", isOpen);
  navToggle.setAttribute(
    "aria-label",
<<<<<<< HEAD
    isOpen ? "Tutup navigasi" : "Buka navigasi"
=======
    isOpen ? "Tutup navigasi" : "Buka navigasi",
>>>>>>> c5245ea (Hubungkan JavaScript eksternal ke HTML)
  );
});

const contactForm = document.getElementById("contactForm");
const formFeedback = document.getElementById("formFeedback");
<<<<<<< HEAD

=======
>>>>>>> c5245ea (Hubungkan JavaScript eksternal ke HTML)
const namaInput = document.getElementById("nama");
const emailInput = document.getElementById("email");
const semesterInput = document.getElementById("semester");
const tanggalInput = document.getElementById("tanggal");
const prodiInput = document.getElementById("prodi");
const pesanInput = document.getElementById("pesan");

contactForm.addEventListener("submit", (event) => {
  event.preventDefault();

  formFeedback.className = "form-feedback-error";

  const nama = namaInput.value.trim();
  if (nama.length < 3 || nama.length > 50) {
    formFeedback.textContent =
      "Nama lengkap harus diisi 3 sampai 50 karakter.";
    return;
  }

  const email = emailInput.value.trim();
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailPattern.test(email)) {
    formFeedback.textContent = "Masukkan alamat email yang valid.";
    return;
  }

  const semester = Number(semesterInput.value);
  if (semesterInput.value === "" || semester < 1 || semester > 14) {
    formFeedback.textContent =
      "Semester harus diisi dengan angka 1 sampai 14.";
    return;
  }

  if (tanggalInput.value === "") {
    formFeedback.textContent = "Tanggal kunjungan harus diisi.";
    return;
  }

  const jenisPesan = document.querySelector(
<<<<<<< HEAD
    'input[name="jenis_pesan"]:checked'
=======
    'input[name="jenis_pesan"]:checked',
>>>>>>> c5245ea (Hubungkan JavaScript eksternal ke HTML)
  );
  if (!jenisPesan) {
    formFeedback.textContent = "Pilih jenis pesan.";
    return;
  }

  const topikDipilih = document.querySelectorAll(
<<<<<<< HEAD
    'input[name="minat"]:checked'
  );
  if (topikDipilih.length === 0) {
    formFeedback.textContent =
      "Pilih minimal satu topik yang diminati.";
=======
    'input[name="minat"]:checked',
  );
  if (topikDipilih.length === 0) {
    formFeedback.textContent = "Pilih minimal satu topik yang diminati.";
>>>>>>> c5245ea (Hubungkan JavaScript eksternal ke HTML)
    return;
  }

  if (prodiInput.value === "") {
    formFeedback.textContent = "Pilih program studi.";
    return;
  }

  const pesan = pesanInput.value.trim();
  if (pesan.length === 0) {
    formFeedback.textContent = "Pesan harus diisi.";
    return;
  }

  if (pesan.length > 300) {
    formFeedback.textContent = "Pesan maksimal 300 karakter.";
    return;
  }

  formFeedback.textContent = "Form berhasil divalidasi.";
  formFeedback.className = "form-feedback-success";
});

contactForm.addEventListener("reset", () => {
  formFeedback.textContent = "";
});

contactForm.addEventListener("input", () => {
  formFeedback.textContent = "";
});