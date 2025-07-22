<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = $_POST['role'];
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = md5(mysqli_real_escape_string($koneksi, $_POST['password'])); // hash MD5

    // Cek apakah email sudah terdaftar
    $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Email sudah digunakan!'); window.location.href='register.php';</script>";
        exit;
    }

    $query = "INSERT INTO users (role, email, password, nama) VALUES ('$role', '$email', '$password', '$nama')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Pendaftaran berhasil! Silakan login.'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Pendaftaran gagal: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Pengguna | Vita Clinic</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to bottom, #e0f7fa, #ffffff);
    }
  </style>
</head>
<body class="text-gray-800">
  <main class="flex items-center justify-center min-h-screen px-4">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
      <h2 class="text-2xl font-bold text-teal-700 mb-4 text-center">Daftar Akun</h2>
      <p class="text-gray-600 mb-6 text-center">Isi form untuk mendaftar sebagai pasien atau dokter</p>

      <form action="register.php" method="POST" class="space-y-4">
        <div>
          <label for="role" class="block font-medium">Daftar Sebagai</label>
          <select id="role" name="role" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-teal-400">
            <option value="">-- Pilih Peran --</option>
            <option value="pasien">Pasien</option>
          </select>
        </div>

        <div>
          <label for="nama" class="block font-medium">Nama Lengkap</label>
          <input type="text" id="nama" name="nama" required
                 class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-teal-400" />
        </div>

        <div>
          <label for="email" class="block font-medium">Email</label>
          <input type="email" id="email" name="email" required
                 class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-teal-400" />
        </div>

        <div>
          <label for="password" class="block font-medium">Kata Sandi</label>
          <input type="password" id="password" name="password" required
                 class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-teal-400" />
        </div>

        <button type="submit"
                class="w-full bg-teal-600 text-white py-2 rounded-lg hover:bg-teal-700 transition">
          Daftar
        </button>
      </form>
    </div>
  </main>
</body>
</html>
