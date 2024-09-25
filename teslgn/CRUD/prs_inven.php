<?php 
if($_POST){
    $nama = $_POST['nama_brg'];
    $jenis = $_POST['jenis'];
    $kuan = $_POST['kuantitas'];
    $loka = $_POST['lokasi'];
    $seri = $_POST['serial'];
    $harga = $_POST['harga'];

    if(empty($nama) || empty($jenis) || empty($kuan) || empty($loka) || empty($seri) || empty($harga)){
        echo "<script>
        alert('Harap Diisi');
        location='../inventory.php';
        </script>";
    }else{
        include "../koneksi.php";

        $sql = "INSERT INTO inventory (nama_barang, jenis_barang, kuantitas_stok, lokasi_gudang, serial_number, harga)
        VALUES ('$nama', '$jenis', '$kuan', '$loka', '$seri', '$harga')";
        $hsl = mysqli_query($kon, $sql);

        if($hsl){
            echo "<script>
            alert('Berhasil coy');
            location='../inventory.php';
            </script>";
        }
    }
}
?>