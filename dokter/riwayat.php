<?php
include 'koneksi.php';
session_start();

// Cek apakah dokter sudah login
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'dokter') {
    header("Location: login.php");
    exit();
}

$dokter_email = mysqli_real_escape_string($koneksi, $_SESSION['email']);
$nama_dokter = $_SESSION['nama'];

// Proses update dan hapus
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);

    if (isset($_POST['selesaikan'])) {
        $sql = "UPDATE konsultasi SET status = 'Selesai' WHERE id = $id AND dokter_email = '$dokter_email'";
        mysqli_query($koneksi, $sql);
    }

    if (isset($_POST['hapus'])) {
        $sql = "DELETE FROM konsultasi WHERE id = $id AND dokter_email = '$dokter_email'";
        mysqli_query($koneksi, $sql);
    }

    header("Location: riwayat.php");
    exit();
}

// Ambil data konsultasi untuk dokter yang login berdasarkan email
$sql = "SELECT * FROM konsultasi WHERE dokter_email = '$dokter_email' ORDER BY id DESC";
$result = mysqli_query($koneksi, $sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Riwayat Konsultasi | Vita Clinic</title>
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

  <header class="bg-teal-700 text-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
      <div class="flex items-center space-x-4">
        <img src="img/logo.png" alt="Logo Vita Clinic" class="w-20 h-20 object-contain" />
        <h1 class="text-2xl font-bold">Vita Clinic</h1>
      </div>
        <!-- Info User -->
        <div class="hidden md:flex items-center space-x-4 text-white font-semibold">
        👤 <?php echo $_SESSION['nama']; ?> (<?php echo ucfirst($_SESSION['role']); ?>)
      </div>
      <nav class="hidden md:flex space-x-6">
        <a href="index.php" class="relative group">Beranda</a>
        <a href="artikel.php" class="relative group">Artikel Kesehatan</a>
        <a href="obat.php" class="relative group">Obat & Suplemen</a>
        <a href="tentang.php" class="relative group">Tentang Kami</a>
        <a href="riwayat.php" class="relative group font-semibold underline">Riwayat</a>
        <a href="logout.php" class="bg-white text-teal-700 px-3 py-1 rounded hover:bg-gray-100 transition">Logout</a>
      </nav>
    </div>
  </header>

  <div class="container mx-auto px-6 py-12">
    <h1 class="text-3xl font-bold text-teal-700 mb-6">Riwayat Konsultasi -  <?= htmlspecialchars($nama_dokter) ?></h1>

    <div class="overflow-x-auto">
      <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow">
        <thead class="bg-teal-700 text-white">
          <tr>
            <th class="px-4 py-2 text-left">No</th>
            <th class="px-4 py-2 text-left">Nama</th>
            <th class="px-4 py-2 text-left">Email</th>
            <th class="px-4 py-2 text-left">Keluhan</th>
            <th class="px-4 py-2 text-left">Tanggal Konsultasi</th>
            <th class="px-4 py-2 text-left">Status</th>
            <th class="px-4 py-2 text-left">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($result && mysqli_num_rows($result) > 0) {
              $no = 1;
              while ($row = mysqli_fetch_assoc($result)) {
                  echo "<tr class='border-b'>";
                  echo "<td class='px-4 py-2'>{$no}</td>";
                  echo "<td class='px-4 py-2'>" . htmlspecialchars($row['nama']) . "</td>";
                  echo "<td class='px-4 py-2'>" . htmlspecialchars($row['email']) . "</td>";
                  echo "<td class='px-4 py-2'>" . htmlspecialchars($row['keluhan']) . "</td>";
                  echo "<td class='px-4 py-2'>" . htmlspecialchars($row['tanggal_booking']) . "</td>";
                  echo "<td class='px-4 py-2 font-semibold " . 
                       ($row['status'] === 'Pending' ? 'text-yellow-600' : 'text-green-600') . "'>" . 
                       $row['status'] . "</td>";

                  echo "<td class='px-4 py-2 space-y-1'>";
                  
                  if ($row['status'] === 'Pending') {
                      echo "<form method='POST' class='inline-block mr-1'>
                              <input type='hidden' name='id' value='" . $row["id"] . "'>
                              <button type='submit' name='selesaikan' class='bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-sm'>Selesaikan</button>
                            </form>";
                  }

                  echo "<form method='POST' class='inline-block' onsubmit=\"return confirm('Yakin ingin menghapus data ini?')\">
                          <input type='hidden' name='id' value='" . $row["id"] . "'>
                          <button type='submit' name='hapus' class='bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-sm'>Hapus</button>
                        </form>";

                  echo "</td></tr>";
                  $no++;
              }
          } else {
              echo "<tr><td colspan='7' class='text-center px-4 py-4 text-gray-500'>Belum ada data konsultasi.</td></tr>";
          }
          mysqli_close($koneksi);
          ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
