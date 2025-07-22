<?php
// Aktifkan error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = $_POST['role'];
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = md5(mysqli_real_escape_string($koneksi, $_POST['password'])); // hash md5

    $query = "SELECT * FROM users WHERE email='$email' AND role='$role' LIMIT 1";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die("Query error: " . mysqli_error($koneksi));
    }

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        if ($user['password'] === $password) {
            $_SESSION['email'] = $user['email'];
            $_SESSION['role']  = $user['role'];
            $_SESSION['nama']  = $user['nama'];

            if ($user['role'] === 'dokter') {
                $_SESSION['nama_dokter'] = $user['nama']; // Untuk filter riwayat
                header("Location: dokter/index.php");
            } elseif ($user['role'] === 'pasien') {
                header("Location: pasien/index.php");
            } else {
                echo "<script>alert('Role tidak valid'); window.location.href='login.php';</script>";
            }
            exit;
        } else {
            echo "<script>alert('Kata sandi salah!'); window.location.href='login.php';</script>";
        }
    } else {
        echo "<script>alert('Akun tidak ditemukan!'); window.location.href='login.php';</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | Vita Clinic</title>
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
  <main class="flex items-center justify-center min-h-screen px-4">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
      <h2 class="text-2xl font-bold text-teal-700 mb-4 text-center">Login Pengguna</h2>
      <p class="text-gray-600 mb-6 text-center">Masuk sebagai pasien atau dokter</p>

      <form action="login.php" method="POST" class="space-y-4">
        <div>
          <label for="role" class="block font-medium">Login Sebagai</label>
          <select id="role" name="role" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-teal-400">
            <option value="">-- Pilih Peran --</option>
            <option value="pasien">Pasien</option>
            <option value="dokter">Dokter</option>
          </select>
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
          Login
        </button>

        <p class="text-center mt-4 text-sm text-gray-600">
          Belum punya akun?
          <a href="register.php" class="text-teal-600 hover:underline font-semibold">Daftar di sini</a>
        </p>
      </form>
    </div>
  </main>
</body>
</html>
