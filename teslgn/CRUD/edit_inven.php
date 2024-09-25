<?php
include "../koneksi.php";
if(isset($_GET['id'])){
    $id = mysqli_real_escape_string($kon, $_GET['id']);

    $sql = "SELECT * FROM inventory WHERE id = '$id'";
    $hsl = mysqli_query($kon, $sql);

    if(!$hsl){
        die("GAGAL" . mysqli_error($kon));
    }
    $data = mysqli_fetch_assoc($hsl);
}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = mysqli_real_escape_string($kon, $_POST['id']);
    $nama = mysqli_real_escape_string($kon, $_POST['nama']);
    $jenis = mysqli_real_escape_string($kon, $_POST['jenis']);
    $kuanti = mysqli_real_escape_string($kon, $_POST['kuan']);
    $lokasi = mysqli_real_escape_string($kon, $_POST['lokasi']);
    $seri = mysqli_real_escape_string($kon, $_POST['serial']);
    $harga = mysqli_real_escape_string($kon, $_POST['harga']);

    $sql = "UPDATE inventory SET
    nama_barang = '$nama',
    jenis_barang = '$jenis',
    kuantitas_stok = '$kuanti',
    lokasi_gudang = '$lokasi',
    serial_number = '$seri',
    harga = '$harga'
    WHERE id = '$id'";
    
    if(mysqli_query($kon, $sql)){
        echo "<script>
        alert('berhasil');
        location='../inventory.php';
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
    <link rel="stylesheet" href="../CSS/upd_inven.css">
</head>
<body>
    <form action="" method="post">
        <h1>Update Inventory</h1>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($data['id']); ?>">
        <label for="">Nama Barang</label><br>
        <select name="nama" id="">
            <option value="<?php echo htmlspecialchars($data['nama_barang']); ?>"><?php echo htmlspecialchars($data['nama_barang']); ?></option>
            <?php 
            $sql1 = "SELECT * FROM vendor";
            $hsl1 = mysqli_query($kon, $sql1);

            if(!$hsl1){
                die("GAGAL" . mysqli_error($kon));
            }

            if($hsl1){
                while($data1 = mysqli_fetch_assoc($hsl1)){
                    $sel = ($data1['id'] == $data1['nama_barang']) ? 'selected' : ''; 
                    echo "<option value='{$data1['id']}' $sel>{$data1['nama_barang']}</option>";
                }
            }
            ?>
        </select><br><br>
        <label for="">Jenis Barang</label><br>
        <input type="text" name="jenis" value="<?php echo htmlspecialchars($data['jenis_barang']); ?>"><br><br>
        <label for="">Kuantitas Stok</label><br>
        <input type="text" name="kuan" value="<?php echo htmlspecialchars($data['kuantitas_stok']); ?>"><br><br>
        <label for="">Lokasi Gudang</label><br>
        <select name="lokasi" id="">
            <option value="<?php echo htmlspecialchars($data['lokasi_gudang']); ?>"><?php echo htmlspecialchars($data['lokasi_gudang']); ?></option>
            <?php 
            $sql2 = "SELECT * FROM storage";
            $hsl2 = mysqli_query($kon, $sql2);

            if(!$hsl2){
                die("GAGAL" . mysqli_error($kon));
            }
            if($hsl2){
                while($data2 = mysqli_fetch_assoc($hsl2)){
                    echo "<option value='{$data2['id']}'>{$data2['lokasi']}</option>";
                }
            }
            ?>
        </select><br><br>
        <label for="">Serial Number</label><br>
        <input type="number" name="serial" value="<?php echo htmlspecialchars($data['serial_number']); ?>"><br><br>
        <label for="">Harga</label><br>
        <input type="text" name="harga" value="<?php echo htmlspecialchars($data['harga']); ?>"><br><br>
        <button type="submit">Update</button>
        <a href="../inventory.php">
            <button class="back">Back</button>
        </a>
    </form>
</body>
</html>