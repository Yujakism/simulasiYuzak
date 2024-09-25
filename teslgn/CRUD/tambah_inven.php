<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/inven.css">
</head>
<body>
    <form action="prs_inven.php" method="post">
        <h1 class="hed">Tambah Inventory</h1>
        <label for="nama">Nama Barang</label><br>
        <select name="nama_brg" required>
            <option value=""></option>
            <?php 
            include "../koneksi.php";

            $sql = "SELECT * FROM vendor";
            $hsl = mysqli_query($kon, $sql);

            if(!$hsl){
                die("gagal" . mysqli_connect_error($kon) . mysqli_connect_erno($kon));
            }
            if($hsl -> num_rows > 0 ){
                while($data = mysqli_fetch_assoc($hsl)){
                    echo "<option value='{$data['id']}'>{$data['nama_barang']}</option>";
                }
            }
            ?>
        </select><br>
        <label for="">Jenis Barang</label><br>
        <input type="text" name="jenis" required><br>
        <label for="">Kuantitas Stok</label><br>
        <input type="number" name="kuantitas" required><br>
        <label for="">Lokasi Gudang</label><br>
        <select name="lokasi" required>
            <option value=""></option>
            <?php 
            include "../koneksi.php";

            $sql = "SELECT * FROM storage";
            $hsl = mysqli_query($kon, $sql);

            if(!$hsl){
                die("gagal" . mysqli_connect_error($kon) . mysqli_connect_erno($kon));
            }
            if($hsl -> num_rows > 0 ){
                while($data = mysqli_fetch_assoc($hsl)){
                    echo "<option value='{$data['id']}'>{$data['nama_gudang']} Di {$data['lokasi']}</option>";
                }
            }
            ?>
        </select><br>
        <label for="">Serial Number</label><br>
        <input type="number" name="serial" required><br>
        <label for="">Harga</label><br>
        <input type="text" name="harga" required><br>
        <button>Tambah</button>
        
    </form>
    
</body>
</html>