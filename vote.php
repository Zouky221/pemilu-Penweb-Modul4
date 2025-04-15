<?php
include 'db.php';

$nik = $_POST['nik'];
$nama = $_POST['nama'];
$calon = $_POST['calon'];

$cek = $conn->query("SELECT * FROM pemilih WHERE nik = '$nik'");
if ($cek->num_rows > 0) {
    $row = $cek->fetch_assoc();
    if ($row['sudah_memilih']) {
        echo "<link rel='stylesheet' href='css/style.css'>";
        echo "<div style='background: #fff; padding: 20px; border-radius: 10px; width: 400px'>";
        echo "<h2>Anda sudah memilih!</h2>";
        echo "<a href='index.php' style='display:inline-block; margin-top:10px; text-decoration:none; background:#007bff; color:white; padding:8px 12px; border-radius:5px;'>Kembali</a>";
        echo "</div>";
        exit;
    } else {
        $id = $row['id'];
    }
} else {
    $conn->query("INSERT INTO pemilih (nik, nama) VALUES ('$nik', '$nama')");
    $id = $conn->insert_id;
}

$conn->query("INSERT INTO suara (id_pemilih, calon) VALUES ($id, '$calon')");
$conn->query("UPDATE pemilih SET sudah_memilih = 1 WHERE id = $id");

// Ambil hasil pemilu untuk grafik
$result = $conn->query("SELECT calon, COUNT(*) as jumlah FROM suara GROUP BY calon");

$labels = [];
$data = [];

while ($row = $result->fetch_assoc()) {
    $labels[] = $row['calon'];
    $data[] = $row['jumlah'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hasil Pemilu</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div style="background: #fff; padding: 20px; border-radius: 10px; width: 600px">
        <h2>Terima Kasih Telah Memilih!</h2>
        <p>Hasil Sementara Pemilu:</p>
        <canvas id="pemiluChart" width="400" height="200"></canvas>
        <a href="index.php" style="display:inline-block; margin-top:20px; text-decoration:none; background:#007bff; color:white; padding:8px 12px; border-radius:5px;">Kembali ke Halaman Pemilu</a>
    </div>

    <script>
    const ctx = document.getElementById('pemiluChart').getContext('2d');
    const pemiluChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($labels) ?>,
            datasets: [{
                label: 'Jumlah Suara',
                data: <?= json_encode($data) ?>,
                backgroundColor: [
                    '#007bff', '#28a745', '#ffc107', '#dc3545', '#17a2b8'
                ],
                borderColor: '#ccc',
                borderWidth: 1
            }]
        }
    });
    </script>
</body>
</html>
