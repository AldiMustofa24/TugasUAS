<?php
// Koneksi ke database
$host = "localhost";
$user = "root";      // sesuaikan dengan username Anda
$pass = "";          // sesuaikan dengan password Anda
$db   = "vitaclinic";

$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$nama    = $_POST['nama'];
$email   = $_POST['email'];
$keluhan = $_POST['keluhan'];
$dokter  = $_POST['dokter'];

// Simpan ke database
$sql = "INSERT INTO konsultasi (nama, email, keluhan, dokter)
        VALUES ('$nama', '$email', '$keluhan', '$dokter')";

if ($conn->query($sql) === TRUE) {
    echo "<script>
        alert('Data berhasil dikirim!');
        window.location.href = 'konsultasi.html';
    </script>";
} else {
    echo "Gagal menyimpan data: " . $conn->error;
}

$conn->close();
?>
