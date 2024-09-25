<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include "sidebar.php";?>
    <?php include "header.php";?>
    <div class="content">
        <h1>Data Vendor</h1>
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Cari nama vendor..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button type="submit">Cari</button>
        </form><br>
        <table border="1">
            <thead>
                <tr>
                    <th>I D</th>
                    <th>Nama Vendor</th>
                    <th>Kontak Vendor</th>
                    <th>Nama Barang</th>
                    <th>Nomor Invoice</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                include "koneksi.php";
                $search = isset($_GET['search']) ? mysqli_real_escape_string($kon, $_GET['search']) : '';
                $sql = "SELECT * FROM vendor
                WHERE vendor.nama LIKE '%$search%'
                ORDER BY vendor.id";
                $hsl = mysqli_query($kon, $sql);

                if(!$hsl){
                    die("GAGAL" . mysqli_connect_erno($kon) . mysqli_connect_error($kon));
                }

                if($hsl -> num_rows > 0 ){
                    while($data = mysqli_fetch_assoc($hsl)){
                        echo "<tr>";
                        echo "<td>{$data['id']}</td>";
                        echo "<td>{$data['nama']}</td>";
                        echo "<td>{$data['kontak']}</td>";
                        echo "<td>{$data['nama_barang']}</td>";
                        echo "<td>{$data['nomor_invoice']}</td>";
                        echo "<td><a href='CRUD/dlt_vendor.php?id={$data['id']}' onclick='return confirm(\"Yakin Hapus?\")'><button>Hapus</button></a>
                        <a href='CRUD/edit_vendor.php?id={$data['id']}'><button>Edit</button</a></td>";
                        echo "</tr>";
                    }
                }
                ?>
                <!-- Data lainnya -->
            </tbody>
            <a href="CRUD/tambah_vendor.php">
                <button>Tambah</button>
            </a>
        </table>
    </div>
</body>
</html>