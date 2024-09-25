<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/vendor.css">
</head>
<body>
    <form action="prs_vendor.php" method="post">
        <h1>Tambah Vendor</h1>
        <label>Nama Vendor</label><br>
        <input type="text" name="nama" required><br><br>
        <label>Kontak Vendor</label><br>
        <input type="text" name="kontak" required><br><br>
        <label>Nama Barang</label><br>
        <input type="text" name="barang" required><br><br>
        <label for="nomor">Nomor Invoice</label><br>
        <input type="number" name="nomor" required><br><br>
        <button>Tambah</button><br>
    </form>
    
</body>
</html>