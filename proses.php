<?php
include "koneksi.php";

$aksi = $_POST["aksi"];

if($aksi == "product"){
    $nama = $_POST['namaProduct'] ?? "";
    $harga = $_POST['hargaProduct'] ?? "";
    $deskripsi = $_POST['deskripsi'] ?? "";
    $stock = $_POST['stock'] ?? "";
    
    $query = "INSERT INTO products(nama_product, harga, description, stock) VALUES ('$nama', '$harga', '$deskripsi', '$stock');";
    $sql = mysqli_query($koneksi, $query);
    if ($sql){
        echo "data Berhasil di simpan <a href='product.php'>back</a>";
        
    }
    
} else if ($aksi == "login"){
$role = $_POST["username"];

    switch($role){
        case 'admin':
            if($_POST["password"] == "admin123"){
                header("location: index.html");
            }else{
                echo "Akun salah silahkan gunakan akun yang sudah terdaftar <a href='login.php'>Back</a>";
            }
        break;
        case 'AkfalShamid':
            if($_POST["password"] == "akfalShamid123"){
                header("location: product.php");
            }else{
                echo "Akun salah silahkan gunakan akun yang sudah terdaftar <a href='login.php'>Back</a>";
            }
            break;
        default:
            echo "Akun salah silahkan gunakan akun yang sudah terdaftar <a href='login.php'>Back</a>";
            break;
    }
}


?>