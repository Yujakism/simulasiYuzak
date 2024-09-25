<?php 
include "../koneksi.php";
if(isset($_GET['id'])){
    $id = mysqli_real_escape_string($kon, $_GET['id']);

    $sql = "SELECT * FROM storage WHERE id = '$id'";
    $hsl = mysqli_query($kon, $sql);

    if(!$hsl){
        die("GAGAL" . mysqli_error($kon));
    }
    $data = mysqli_fetch_assoc($hsl);
}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = mysqli_real_escape_string($kon, $_POST['id']);
    $gudang = mysqli_real_escape_string($kon, $_POST['nama']);
    $lokasi = mysqli_real_escape_string($kon, $_POST['lokasi']);

    $sql1 = "UPDATE storage SET
    nama_gudang = '$gudang',
    lokasi = '$lokasi'
    WHERE id = '$id'";
    $hsl1 = mysqli_query($kon, $sql1);

    if($hsl1){
        echo "<script>
        alert('Data Berhasil Diupdate');
        location='../storage.php';
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
    <link rel="stylesheet" href="../CSS/upd_storage.css">
</head>
<body>
    <form action="" method="post">
        <h1>Edit Gudang</h1>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($data['id']); ?>">
        <label for="">Nama Gudang</label><br>
        <input type="text" name="nama" value="<?php echo htmlspecialchars($data['nama_gudang']); ?>"><br>
        <label for="">Lokasi</label><br>
        <input type="text" name="lokasi" value="<?php echo htmlspecialchars($data['lokasi']); ?>"><br><br>
        <button>Edit</button>
    </form> 
</body>
</html>