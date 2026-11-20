<?php
    $nama = $_POST['namaProduct'] ?? "";
    $harga = $_POST['hargaProduct'] ?? "";
    $deskripsi = $_POST['deskripsi'] ?? "";

    if($nama === "" || $harga === "" || $deskripsi === ""){
        echo "Terdapat data yang blm di isi silahkan ketik ulang <a href='Product.php'>Back</a>";
        } else {
        echo $nama . " || " . $harga . " || " . $deskripsi;
    }

?>