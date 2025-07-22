<?php
session_start();
if (!isset($_SESSION['nama'])) {
  header("Location: login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Konsultasi Dokter | Vita Clinic</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to bottom, #e0f7fa, #ffffff);
    }
  </style>
</head>
<body class="text-gray-800">

  <!-- Header -->
  <header class="bg-teal-700 text-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
      <div class="flex items-center space-x-4">
        <img src="../img/logo.png" alt="Logo Vita Clinic" class="w-20 h-20 object-contain" />
        <h1 class="text-2xl font-bold">Vita Clinic</h1>
      </div>
      <!-- Info User -->
      <div class="hidden md:flex items-center space-x-4 text-white font-semibold">
        👤 <?php echo $_SESSION['nama']; ?> (<?php echo ucfirst($_SESSION['role']); ?>)
      </div>
      <nav class="hidden md:flex space-x-6">
        <a href="index.php">Beranda</a>
        <a href="artikel.php">Artikel Kesehatan</a>
        <a href="obat.php">Obat & Suplemen</a>
        <a href="konsultasi.php">Konsultasi Dokter</a>
        <a href="tentang.php">Tentang Kami</a>
        <a href="logout.php" class="bg-white text-teal-700 px-3 py-1 rounded hover:bg-gray-100">Logout</a>
      </nav>
    </div>
  </header>

  <!-- Hero -->
  <section class="bg-teal-100 py-12 text-center">
    <h2 class="text-3xl font-bold text-teal-800 mb-2">Konsultasi Dokter Online</h2>
    <p class="text-gray-700 text-lg">Isi formulir untuk konsultasi dengan dokter pilihan Anda.</p>
  </section>

  <!-- Form -->
  <section class="container mx-auto px-6 py-12 bg-white rounded-xl shadow-lg mt-12">
    <h3 class="text-2xl font-bold text-teal-700 mb-6 text-center">Form Konsultasi + Jadwal Dokter</h3>
    <form class="grid grid-cols-1 md:grid-cols-2 gap-6" action="proses_konsultasi.php" method="POST" onsubmit="return validasiForm()">
      
      <div>
        <label class="block text-sm font-semibold text-gray-700">Nama</label>
        <input type="text" name="nama" required class="w-full mt-1 px-4 py-2 border rounded-lg" />
      </div>
      <div>
        <label class="block text-sm font-semibold text-gray-700">Email</label>
        <input type="email" name="email" required class="w-full mt-1 px-4 py-2 border rounded-lg" />
      </div>
      <div class="md:col-span-2">
        <label class="block text-sm font-semibold text-gray-700">Keluhan</label>
        <textarea name="keluhan" rows="4" required class="w-full mt-1 px-4 py-2 border rounded-lg"></textarea>
      </div>

      <div class="md:col-span-2">
        <label class="block text-sm font-semibold text-gray-700">Pilih Dokter</label>
        <select id="dokterSelect" name="dokter" onchange="tampilkanDokter()" required class="w-full mt-1 px-4 py-2 border rounded-lg">
          <option value="">-- Pilih Dokter --</option>
          <option value="dr-Tomi">dr. Tomi Sp.PD - Spesialis Penyakit Dalam</option>
          <option value="dr-Alfajri">dr. Alfajri Sp.KJ - Spesialis Kejiwaan</option>
          <option value="dr-Aldi">dr. Aldi Sp.THT - Spesialis THT</option>
          <option value="dr-Afta">dr. Afta Umum - Dokter Umum</option>
          <option value="dr-Charles">dr. Charles Sp.OG - Spesialis Kandungan</option>
        </select>
      </div>

      <input type="hidden" name="spesialis" id="inputSpesialis" />
      <input type="hidden" name="dokter_email" id="inputEmailDokter" />

      <div class="md:col-span-2 hidden" id="previewDokter">
        <div class="flex items-center space-x-4 mt-2">
          <img id="previewFoto" src="" alt="Foto Dokter" class="w-16 h-16 rounded-full object-cover border" />
          <div>
            <h4 id="previewNama" class="text-lg font-semibold text-teal-700"></h4>
            <p id="previewSpesialis" class="text-sm text-gray-600"></p>
          </div>
        </div>
      </div>

      <div class="md:col-span-2 hidden" id="jadwalBox">
        <label class="block text-sm font-semibold text-gray-700">Jadwal Konsultasi</label>
        <div id="jadwalTeks" class="mt-2 text-teal-700 font-medium"></div>
      </div>

      <div class="md:col-span-2 hidden" id="tanggalBox">
        <label class="block text-sm font-semibold text-gray-700">Pilih Tanggal Konsultasi</label>
        <input type="date" id="tanggalBooking" name="tanggal_booking" class="w-full mt-1 px-4 py-2 border rounded-lg" />
        <p class="text-sm text-red-600 mt-1 hidden" id="pesanTanggal">Tanggal tidak sesuai dengan jadwal dokter.</p>
      </div>

      <div class="md:col-span-2 text-right">
        <button type="submit" id="kirimBtn" class="bg-teal-600 text-white px-6 py-2 rounded-lg hover:bg-teal-700 transition">Kirim</button>
      </div>
    </form>
  </section>

  <!-- Footer -->
  <footer class="bg-teal-900 text-white text-center py-6 mt-10">
  <p>&copy; TEKNIK INFORMATIKA, UNIVERSITAS PUTERA BATAM 2025</p>
  </footer>

  <!-- Script -->
  <script>
    const dokterData = {
      "dr-Tomi": {
        nama: "dr. Tomi Sp.PD",
        spesialis: "Spesialis Penyakit Dalam",
        email: "tomi@vita.com",
        foto: "../img/dr_tomi.jpg",
        hari: [1, 3],
        teks: "Senin & Rabu, 08:00 - 12:00"
      },
      "dr-Alfajri": {
        nama: "dr. Alfajri Sp.KJ",
        spesialis: "Spesialis Kejiwaan",
        email: "alfajri@vita.com",
        foto: "../img/dr_alfajri.jpg",
        hari: [2, 4],
        teks: "Selasa & Kamis, 13:00 - 17:00"
      },
      "dr-Aldi": {
        nama: "dr. Aldi Sp.THT",
        spesialis: "Spesialis THT",
        email: "aldi@vita.com",
        foto: "../img/dr_aldi.jpg",
        hari: [3, 5],
        teks: "Rabu & Jumat, 09:00 - 14:00"
      },
      "dr-Afta": {
        nama: "dr. Afta Umum",
        spesialis: "Dokter Umum",
        email: "afta@vita.com",
        foto: "../img/dr_afta.jpg",
        hari: [0,1,2,3,4,5,6],
        teks: "Setiap Hari, 10:00 - 16:00"
      },
      "dr-Charles": {
        nama: "dr. Charles Sp.OG",
        spesialis: "Spesialis Kandungan",
        email: "charles@vita.com",
        foto: "../img/dr_charles.jpg",
        hari: [1, 3, 5],
        teks: "Senin, Rabu & Jumat, 08:00 - 11:00"
      }
    };

    function tampilkanDokter() {
      const value = document.getElementById("dokterSelect").value;
      const data = dokterData[value];
      const preview = document.getElementById("previewDokter");
      const foto = document.getElementById("previewFoto");
      const nama = document.getElementById("previewNama");
      const spesialis = document.getElementById("previewSpesialis");
      const inputSpesialis = document.getElementById("inputSpesialis");
      const inputEmailDokter = document.getElementById("inputEmailDokter");
      const jadwalBox = document.getElementById("jadwalBox");
      const jadwalTeks = document.getElementById("jadwalTeks");
      const tanggalBox = document.getElementById("tanggalBox");
      const tanggalInput = document.getElementById("tanggalBooking");
      const pesan = document.getElementById("pesanTanggal");

      if (data) {
        preview.classList.remove("hidden");
        foto.src = data.foto;
        nama.textContent = data.nama;
        spesialis.textContent = data.spesialis;
        inputSpesialis.value = data.spesialis;
        inputEmailDokter.value = data.email;
        jadwalBox.classList.remove("hidden");
        jadwalTeks.textContent = data.teks;
        tanggalBox.classList.remove("hidden");

        const today = new Date().toISOString().split('T')[0];
        tanggalInput.setAttribute("min", today);
        tanggalInput.value = "";

        tanggalInput.onchange = function () {
          const dipilih = new Date(this.value);
          const hari = dipilih.getDay();
          if (!data.hari.includes(hari)) {
            pesan.classList.remove("hidden");
            this.value = "";
          } else {
            pesan.classList.add("hidden");
          }
        };
      } else {
        preview.classList.add("hidden");
        jadwalBox.classList.add("hidden");
        tanggalBox.classList.add("hidden");
      }
    }

    function validasiForm() {
      const tanggal = document.getElementById("tanggalBooking").value;
      if (!tanggal) {
        alert("Silakan pilih tanggal konsultasi yang sesuai.");
        return false;
      }

      const btn = document.getElementById("kirimBtn");
      btn.disabled = true;
      btn.textContent = "Mengirim...";
      return true;
    }
  </script>
</body>
</html>
