<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $pesan = htmlspecialchars($_POST['message']);

    // Koneksi ke database
$conn = new mysqli("localhost", "root", "", "portfolio");

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO user (Nama, email, pesan) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nama, $email, $pesan);

    if ($stmt->execute()) {
        echo "<script>alert('Pesan berhasil dikirim!'); window.location.href='kontak.html';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='kontak.html';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
