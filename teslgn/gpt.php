<?php 
session_start();
include "koneksi.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Mengamankan input dari serangan SQL Injection
    $user = mysqli_real_escape_string($kon, $user);
    $pass = mysqli_real_escape_string($kon, $pass);
    
    // Query untuk mendapatkan user berdasarkan username dan password
    $sql = "SELECT * FROM user WHERE username='$user' AND password='$pass'";
    $hsl = mysqli_query($kon, $sql);

    if($hsl -> num_rows > 0){
        // Mengambil data user
        while($data = mysqli_fetch_assoc($hsl)){
            // Menyimpan data ke sesi
            $_SESSION['username'] = $user;
            $_SESSION['level'] = $data['level'];

            // Redirect sesuai level user
            if($data['level'] == 'admin'){
                header("location:admin.php");
            } else if($data['level'] == 'user'){
                header("location:user.php");
            }
        }
    } else {
        echo "Login gagal, periksa username dan password.";
    }
}
?>
