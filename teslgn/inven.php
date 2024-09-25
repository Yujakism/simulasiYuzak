<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <?php 
    include "header.php";
    include "sidebar.php";
    include "koneksi.php";

    $sql = "SELECT inventory.id AS inventory_id, inventory.nama_barang, inventory.jenis_barang, inventory.kuantitas_stok, inventory.lokasi_gudang, inventory.serial_number, inventory.harga,
    storage.id AS storage_id, storage.nama_gudang, storage.lokasi,
    vendor.id AS vendor_id, vendor.nama, vendor.kontak, vendor.nama_barang, vendor.nomor_invoice
    FROM inventory
    INNER JOIN vendor ON inventory.nama_barang = vendor.id
    INNER JOIN storage ON inventory.lokasi_gudang = storage.id";
    $hsl = mysqli_query($kon, $sql);

    if(!$hsl){
        die("GAGAL" . mysqli_error($kon));
    }
    $alert = false;
    if($hsl -> num_rows > 0 ){
        while($data = mysqli_fetch_assoc($hsl)){
            if($data['kuantitas_stok'] == 0 ){
                $alert = true;
                break;
            }
        }
        mysqli_data_seek($hsl, 0);
    }
    ?>

    <?php if($alert): ?>
        <div class="alert">Stok Anda Habis, Harap diperbarui</div>
    <?php endif ?>
    <div class="content">
        <h1>Data Inventory</h1>
        <table border="1">
            <tr>
                <th>I D</th>
                <th>Nama Barang</th>
                <th>Jenis Barang</th>
                <th>Kuantitas Stok</th>
                <th>Lokasi Gudang</th>
                <th>Serial Number</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
            <?php 
            if($hsl -> num_rows > 0 ){
                while($data = mysqli_fetch_assoc($hsl)){
                    // $alert = $data['kuantitas_stok'] == 0 ? 'alert' : '';
                    echo "<tr>";
                    echo "<td>{$data['inventory_id']}</td>";
                    echo "<td class='$alert'>{$data['nama_barang']}</td>";
                    echo "<td>{$data['jenis_barang']}</td>";
                    echo "<td class='$alert'>{$data['kuantitas_stok']}</td>";
                    echo "<td>{$data['lokasi']}</td>";
                    echo "<td>{$data['serial_number']}</td>";
                    echo "<td>{$data['harga']}</td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>
    </div>
</body>
</html>