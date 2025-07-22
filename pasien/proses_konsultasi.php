<?php
include '../koneksi.php'; // Sesuaikan dengan struktur folder

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama             = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email            = mysqli_real_escape_string($koneksi, $_POST['email']);
    $keluhan          = mysqli_real_escape_string($koneksi, $_POST['keluhan']);
    $dokter           = mysqli_real_escape_string($koneksi, $_POST['dokter']);
    $dokter_email     = mysqli_real_escape_string($koneksi, $_POST['dokter_email']); // tambahkan ini
    $tanggal_booking  = mysqli_real_escape_string($koneksi, $_POST['tanggal_booking']);

    // Masukkan ke database dengan status default 'Pending'
    $query = "INSERT INTO konsultasi (nama, email, keluhan, dokter, dokter_email, tanggal_booking, status)
              VALUES ('$nama', '$email', '$keluhan', '$dokter', '$dokter_email', '$tanggal_booking', 'Pending')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Konsultasi berhasil dikirim!');
                window.location.href = '../pasien/index.php'; // Arahkan kembali ke halaman pasien
              </script>";
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($koneksi);
    }
} else {
    echo "Akses tidak valid.";
}
?>
