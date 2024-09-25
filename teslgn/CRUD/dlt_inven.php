<?php 
include "../koneksi.php";
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "DELETE FROM inventory WHERE id ='$id'";
    $hsl = mysqli_query($kon, $sql);
    var_dump($hsl);

    if($hsl){
        echo "<script>
        alert('Data Berhasil Dihapus');
        location='../inventory.php';
        </script>";
    }else{
        echo "<script>
        alert('Data Gagal Dihapus: ". mysqli_error($kon) ."');
        location='../inventory.php';
        </script>";
    }
}else{
    echo "<script>
    alert('ID Tidak Ditemukan');
    location='../inventory.php';
    </script>";
}
?>