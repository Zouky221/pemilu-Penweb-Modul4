<!DOCTYPE html>
<html>
<head>
    <title>PEMILU</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Form Pemilihan Umum</h2>
    <form action="vote.php" method="post">
        ...
    </form>
</body>
<body>
    <h2>Form Pemilihan</h2>
    <form action="vote.php" method="post">
        NIK: <input type="text" name="nik" required><br>
        Nama: <input type="text" name="nama" required><br>
        Pilih Calon:
        <select name="calon" required>
            <option value="Calon 1">Calon 1</option>
            <option value="Calon 2">Calon 2</option>
            <option value="Calon 3">Calon 3</option>
            <option value="Calon 4">Calon 4</option>
            <option value="Calon 5">Calon 5</option>
        </select><br>
        <input type="submit" value="Kirim Suara">
    </form>
</body>
</html>
