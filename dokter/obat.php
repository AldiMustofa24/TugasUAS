<?php
session_start();
if (!isset($_SESSION['nama'])) {
  header("Location: login.php");
  exit();
}
?>
<!DOCTYPE php>
<php lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Beranda | Vita Clinic</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />

  <!-- AOS (Animate on Scroll) -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

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
      <!-- Logo -->
      <div class="flex items-center space-x-4">
        <img src="img/logo.png" alt="Logo Vita Clinic" class="w-20 h-20 object-contain" />
        <h1 class="text-2xl font-bold">Vita Clinic</h1>
      </div>
      <!-- Navigasi -->
      <nav class="hidden md:flex space-x-6">
        <a href="index.php" class="relative group">
          <span>Beranda</span>
          <span class="absolute left-0 bottom-0 w-0 h-0.5 bg-white transition-all duration-300 group-hover:w-full"></span>
        </a>
        <a href="artikel.php" class="relative group">
          <span>Artikel Kesehatan</span>
          <span class="absolute left-0 bottom-0 w-0 h-0.5 bg-white transition-all duration-300 group-hover:w-full"></span>
        </a>
        <a href="obat.php" class="relative group">
          <span>Obat & Suplemen</span>
          <span class="absolute left-0 bottom-0 w-0 h-0.5 bg-white transition-all duration-300 group-hover:w-full"></span>
        </a>
        <a href="tentang.php" class="relative group">
          <span>Tentang Kami</span>
          <span class="absolute left-0 bottom-0 w-0 h-0.5 bg-white transition-all duration-300 group-hover:w-full"></span>
        </a>
        <a href="riwayat.php" class="relative group">
          <span>Riwayat</span>
          <span class="absolute left-0 bottom-0 w-0 h-0.5 bg-white transition-all duration-300 group-hover:w-full"></span>
        </a>
        <a href="logout.php" class="bg-white text-teal-700 px-3 py-1 rounded hover:bg-gray-100 transition">Logout</a>
      </nav>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="text-center py-12">
    <div class="container mx-auto px-6 max-w-4xl">
      <h2 class="text-3xl font-bold text-teal-800 mb-4">Obat & Suplemen</h2>
      <p class="text-gray-600">Informasi lengkap tentang berbagai obat dan suplemen yang umum digunakan di rumah sakit.</p>
    </div>
  </section>

  <!-- Obat List -->
  <section class="py-10 bg-teal-50">
    <div class="container mx-auto px-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

      <!-- Obat Cards -->
      <!-- Template: tambahkan efek hover -->
      <!-- Ganti src sesuai file yang kamu punya -->

      <article class="bg-white p-4 rounded-lg shadow hover:shadow-lg hover:-translate-y-1 transition transform duration-300">
        <img src="img/paracetamol.jpeg" alt="Paracetamol" class="w-20 h-20 object-contain mb-3 mx-auto">
        <h3 class="text-lg font-semibold text-teal-700">Paracetamol</h3>
        <p><strong>Manfaat:</strong> Meredakan demam dan nyeri ringan hingga sedang.</p>
        <p><strong>Dosis:</strong> 500–1000 mg tiap 4–6 jam; maks. 4 g/hari.</p>
      </article>

      <article class="bg-white p-4 rounded-lg shadow hover:shadow-lg hover:-translate-y-1 transition transform duration-300">
        <img src="img/Amoxicillin.png" alt="Amoxicillin" class="w-20 h-20 object-contain mb-3 mx-auto">
        <h3 class="text-lg font-semibold text-teal-700">Amoxicillin</h3>
        <p><strong>Manfaat:</strong> Antibiotik untuk ISPA, infeksi kulit, dan saluran kemih.</p>
        <p><strong>Dosis:</strong> 500 mg tiap 8 jam atau sesuai resep.</p>
      </article>

      <article class="bg-white p-4 rounded-lg shadow hover:shadow-lg hover:-translate-y-1 transition transform duration-300">
        <img src="img/Omeprazole.jpg" alt="Omeprazole" class="w-20 h-20 object-contain mb-3 mx-auto">
        <h3 class="text-lg font-semibold text-teal-700">Omeprazole</h3>
        <p><strong>Manfaat:</strong> GERD, asam lambung, tukak lambung.</p>
        <p><strong>Dosis:</strong> 20–40 mg sekali sehari sebelum makan.</p>
      </article>

      <article class="bg-white p-4 rounded-lg shadow hover:shadow-lg hover:-translate-y-1 transition transform duration-300">
        <img src="img/Simvastatin.jpg" alt="Simvastatin" class="w-20 h-20 object-contain mb-3 mx-auto">
        <h3 class="text-lg font-semibold text-teal-700">Simvastatin</h3>
        <p><strong>Manfaat:</strong> Menurunkan kolesterol dan LDL.</p>
        <p><strong>Dosis:</strong> 10–40 mg sekali sehari di malam hari.</p>
      </article>

      <article class="bg-white p-4 rounded-lg shadow hover:shadow-lg hover:-translate-y-1 transition transform duration-300">
        <img src="img/VitaminC_Asam_Askorbat.jpg" alt="Vitamin C" class="w-20 h-20 object-contain mb-3 mx-auto">
        <h3 class="text-lg font-semibold text-teal-700">Vitamin C</h3>
        <p><strong>Manfaat:</strong> Meningkatkan imunitas, penyembuhan luka.</p>
        <p><strong>Dosis:</strong> 500–1000 mg per hari.</p>
      </article>

      <article class="bg-white p-4 rounded-lg shadow hover:shadow-lg hover:-translate-y-1 transition transform duration-300">
        <img src="img/Ibuprofen.jpg" alt="Ibuprofen" class="w-20 h-20 object-contain mb-3 mx-auto">
        <h3 class="text-lg font-semibold text-teal-700">Ibuprofen</h3>
        <p><strong>Manfaat:</strong> Meredakan nyeri, demam, inflamasi.</p>
        <p><strong>Dosis:</strong> 200–400 mg tiap 4–6 jam; maks. 2400 mg/hari.</p>
      </article>

      <article class="bg-white p-4 rounded-lg shadow hover:shadow-lg hover:-translate-y-1 transition transform duration-300">
        <img src="img/Metformin.jpg" alt="Metformin" class="w-20 h-20 object-contain mb-3 mx-auto">
        <h3 class="text-lg font-semibold text-teal-700">Metformin</h3>
        <p><strong>Manfaat:</strong> Mengontrol gula darah (diabetes tipe 2).</p>
        <p><strong>Dosis:</strong> 500–2000 mg/hari terbagi; XR 1x sehari.</p>
      </article>

      <article class="bg-white p-4 rounded-lg shadow hover:shadow-lg hover:-translate-y-1 transition transform duration-300">
        <img src="img/Losartan.jpg" alt="Losartan" class="w-20 h-20 object-contain mb-3 mx-auto">
        <h3 class="text-lg font-semibold text-teal-700">Losartan</h3>
        <p><strong>Manfaat:</strong> Hipertensi, gagal jantung, ginjal.</p>
        <p><strong>Dosis:</strong> 25–100 mg sekali sehari.</p>
      </article>

      <article class="bg-white p-4 rounded-lg shadow hover:shadow-lg hover:-translate-y-1 transition transform duration-300">
        <img src="img/Cefixime.jpeg" alt="Cefixime" class="w-20 h-20 object-contain mb-3 mx-auto">
        <h3 class="text-lg font-semibold text-teal-700">Cefixime</h3>
        <p><strong>Manfaat:</strong> Antibiotik untuk infeksi pernapasan, THT, saluran kemih.</p>
        <p><strong>Dosis:</strong> 200–400 mg/hari.</p>
      </article>

      <article class="bg-white p-4 rounded-lg shadow hover:shadow-lg hover:-translate-y-1 transition transform duration-300">
        <img src="img/Lansoprazole.jpg" alt="Lansoprazole" class="w-20 h-20 object-contain mb-3 mx-auto">
        <h3 class="text-lg font-semibold text-teal-700">Lansoprazole</h3>
        <p><strong>Manfaat:</strong> Tukak lambung, GERD, refluks asam.</p>
        <p><strong>Dosis:</strong> 15–30 mg sekali sehari sebelum makan.</p>
      </article>

      <article class="bg-white p-4 rounded-lg shadow hover:shadow-lg hover:-translate-y-1 transition transform duration-300">
        <img src="img/Suplemen_Zinc.jpeg" alt="Zinc" class="w-20 h-20 object-contain mb-3 mx-auto">
        <h3 class="text-lg font-semibold text-teal-700">Suplemen Zinc</h3>
        <p><strong>Manfaat:</strong> Daya tahan tubuh dan penyembuhan luka.</p>
        <p><strong>Dosis:</strong> 10–30 mg/hari.</p>
      </article>

      <article class="bg-white p-4 rounded-lg shadow hover:shadow-lg hover:-translate-y-1 transition transform duration-300">
        <img src="img/VitaminD3.png" alt="Vitamin D3" class="w-20 h-20 object-contain mb-3 mx-auto">
        <h3 class="text-lg font-semibold text-teal-700">Vitamin D3</h3>
        <p><strong>Manfaat:</strong> Menjaga tulang dan kekebalan tubuh.</p>
        <p><strong>Dosis:</strong> 400–1000 IU/hari atau sesuai dokter.</p>
      </article>

    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-teal-900 text-white text-center py-6 mt-10">
  <p>&copy; TEKNIK INFORMATIKA, UNIVERSITAS PUTERA BATAM 2025</p>
  </footer>

</body>
</php>
