<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$database   = "vitaclinic"; // Ganti sesuai nama database kamu

$conn = new mysqli($servername, $username, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
<?php
$koneksi = mysqli_connect("localhost", "root", "", "vitaclinic");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
