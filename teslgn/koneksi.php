<?php 
$kon = mysqli_connect("localhost", "root", "", "lgn");

if(!$kon){
    die("gagal" . mysqli_connect_error() . mysqli_connect_erno());
}
?>