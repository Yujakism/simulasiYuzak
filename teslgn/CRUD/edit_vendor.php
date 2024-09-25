<?php 
include "../koneksi.php";
if(isset($_GET['id'])){
    $id = mysqli_real_escape_string($kon, $_GET['id']);

    $sql = "SELECT * FROM vendor WHERE id = '$id'";
    $hsl = mysqli_query($kon, $sql);

    if(!$hsl){
        die("GAGAL" .mysqli_error($kon));
    }

    $data = mysqli_fetch_assoc($hsl);
}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = mysqli_real_escape_string($kon, $_POST['id']);
    $nama = mysqli_real_escape_string($kon, $_POST['nama']);
    $kontak = mysqli_real_escape_string($kon, $_POST['kontak']);
    $nama_brg = mysqli_real_escape_string($kon, $_POST['barang']);
    $nomor = mysqli_real_escape_string($kon, $_POST['nomor']);

    $sql1 =  "UPDATE vendor SET
    nama = '$nama',
    kontak = '$kontak',
    nama_barang = '$nama_brg',
    nomor_invoice = '$nomor'
    WHERE id = '$id'";
    $hsl1 = mysqli_query($kon, $sql1);

    if($hsl1){
        echo "<script>
        alert('Berhasil Diupdate');
        location='../vendor.php';
        </script>";
        exit();
    }else{
        die("GAGAL" . mysqli_error($kon));
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/upd_vendor.css">
</head>
<body>
    <form action="" method="post">
        <h1>Edit Vendor</h1>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($data['id']); ?>">
        <label for="">Nama Vendor</label><br>
        <input type="text" name="nama" value="<?php echo htmlspecialchars($data['nama']); ?>"><br>
        <label for="">kontak</label><br>
        <input type="text" name="kontak" value="<?php echo htmlspecialchars($data['kontak']); ?>"><br>
        <label for="">Nama Barang</label><br>
        <input type="text" name="barang" value="<?php echo htmlspecialchars($data['nama_barang']); ?>"><br>
        <label for="">Nomor Invoice</label><br>
        <input type="number" name="nomor" value="<?php echo htmlspecialchars($data['nomor_invoice']); ?>"><br>
        <button>Edit</button>
    </form>
</body>
</html>