<?php 
include "../koneksi.php";
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "DELETE FROM vendor WHERE id ='$id'";
    $hsl = mysqli_query($kon, $sql);
    var_dump($hsl);

    if($hsl){
        echo "<script>
        alert('Data Berhasil Dihapus');
        location='../vendor.php';
        </script>";
    }else{
        echo "<script>
        alert('Data Gagal Dihapus: ". mysqli_error($kon) ."');
        location='../vendor.php';
        </script>";
    }
}else{
    echo "<script>
    alert('ID Tidak Ditemukan');
    location='../vendor.php';
    </script>";
}
?>