<?php
$servername = "localhost";
$username = "root";  
$password = ""; 
$dbname = "contact_form_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$jenis_pesan = filter_input(INPUT_POST, 'jenis_pesan', FILTER_SANITIZE_STRING);
$kelas = filter_input(INPUT_POST, 'kelas', FILTER_SANITIZE_STRING);
$pesan = filter_input(INPUT_POST, 'pesan', FILTER_SANITIZE_STRING);

$stmt = $conn->prepare("INSERT INTO contacts (name, email, message_type, class, message) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $nama, $email, $jenis_pesan, $kelas, $pesan);

if ($stmt->execute()) {
    echo "Terima kasih atas pesan Anda!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
