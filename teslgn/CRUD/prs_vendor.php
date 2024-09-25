<?php 
if($_POST){
    $nama = $_POST['nama'];
    $kontak = $_POST['kontak'];
    $barang = $_POST['barang'];
    $nomor = $_POST['nomor'];

    if(empty($nama) || empty($kontak) || empty($barang) || empty($nomor)){
        echo "<script>
        alert('data tdk lengkap');
        location='../vendor.php';
        </script>";
    }else{
        include "../koneksi.php";

        $sql = "INSERT INTO vendor (nama, kontak, nama_barang, nomor_invoice)
        VALUES ('$nama', '$kontak', '$barang', '$nomor')";
        $hsl = mysqli_query($kon, $sql);

        if($hsl){
            echo "<script>
            alert('berhasil');
            location='../vendor.php';
            </script>";
        }
    }
}
?>