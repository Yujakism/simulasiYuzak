<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <?php include 'sidebar.php'; ?> 
    <?php include 'header.php'; ?> 

    
    <div class="content">
        <h1>Data Inventory</h1>
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Cari nama barang..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button type="submit">Cari</button>
        </form><br>
        <table border="1">
            <thead>
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
            </thead>
            <tbody>
            <?php 
include "koneksi.php";


$search = isset($_GET['search']) ? mysqli_real_escape_string($kon, $_GET['search']) : '';


$sql = "SELECT inventory.id AS inventory_id, inventory.nama_barang, inventory.jenis_barang, inventory.kuantitas_stok, inventory.lokasi_gudang, inventory.serial_number, inventory.harga,
        storage.id AS storage_id, storage.nama_gudang, storage.lokasi,
        vendor.id AS vendor_id, vendor.nama AS vendor_nama, vendor.kontak, vendor.nama_barang AS vendor_barang, vendor.nomor_invoice
        FROM inventory 
        INNER JOIN vendor ON inventory.nama_barang = vendor.id 
        INNER JOIN storage ON inventory.lokasi_gudang = storage.id
        WHERE vendor.nama_barang LIKE '%$search%' 
        ORDER BY inventory.id";

$hsl = mysqli_query($kon, $sql);

if(!$hsl){
    die("GAGAL" . mysqli_error($kon));
}

$alert = false;
if($hsl){
    while($data = mysqli_fetch_assoc($hsl)){
        if($data['kuantitas_stok'] == 0 ){
            $alert = true;
            break;
        }
    }
    mysqli_data_seek($hsl, 0); // Reset pointer query hasil
}
?>



                <?php if ($alert): ?>

                    <div class="alert">Stok anda habis, harap perbarui jika kuantitas stok 0.</div>
                
                <?php endif; ?>
                <?php

                if($hsl -> num_rows > 0){
                    while($data = mysqli_fetch_assoc($hsl)){
                        $alert = $data['kuantitas_stok'] == 0 ? 'alert' : '';
                        echo "<tr>";
                        echo "<td>{$data['inventory_id']}";
                        echo "<td class='$alert'>{$data['vendor_barang']}";
                        echo "<td>{$data['jenis_barang']}";
                        echo "<td class='$alert'>{$data['kuantitas_stok']}";
                        echo "<td>{$data['lokasi']}";
                        echo "<td>{$data['serial_number']}";
                        echo "<td>{$data['harga']}";
                        echo "<td><a href='CRUD/dlt_inven.php?id={$data['inventory_id']}' onclick='return confirm(\"Yakin Dihapus?\")'><button>Hapus</button></a>
                        <a href='CRUD/edit_inven.php?id={$data['inventory_id']}'><button>Edit</button></a></td>";
                        
                        
                        echo "</tr>";
                    }
                }
                ?>
               
            </tbody>
            <a href="CRUD/tambah_inven.php">
               <button>Tambah</button>
            </a> 
        </table>
    </div>
</body>
</html>
