<?php
session_start();
include "koneksi.php";
include "function.php";

$aksi    = $_POST["aksi"] ?? "";
$isAdmin = ($_SESSION["role"] ?? "") === "admin";

// Tambah, edit, dan hapus produk hanya untuk admin
$butuhAdmin = in_array($aksi, ["tambah", "edit"]) || isset($_GET["hapus"]);
if ($butuhAdmin && !$isAdmin) {
    redirect("login.php");
}

try {
    // ===== LOGIN =====
    if ($aksi === "login") {
        $user = loginUser($koneksi, trim($_POST["username"] ?? ""), $_POST["password"] ?? "");

        if (!$user) {
            echo "Akun salah, silakan gunakan akun yang sudah terdaftar. <a href='login.php'>Kembali</a>";
            exit;
        }

        session_regenerate_id(true);
        $_SESSION["id_user"] = $user["id_user"];
        $_SESSION["role"]    = $user["role"];
        $_SESSION["nama"]    = $user["nama_user"];

        if ($user["role"] === "admin") {
            redirect("admin.php");
        } elseif ($user["role"] === "user") {
            redirect("product.php");
        }
        echo "Role tidak dikenal. <a href='login.php'>Kembali</a>";
        exit;
    }

    // ===== TAMBAH PRODUK =====
    if ($aksi === "tambah") {
        if (tambahProduct($koneksi, $_POST, $_FILES)) {
            redirect("admin.php");
        }
        echo "Gagal menambah produk. <a href='admin.php'>Kembali</a>";
        exit;
    }

    // ===== EDIT PRODUK =====
    if ($aksi === "edit") {
        if (editProduct($koneksi, $_POST, $_FILES)) {
            redirect("admin.php");
        }
        echo "Gagal mengubah produk. <a href='admin.php'>Kembali</a>";
        exit;
    }

    // ===== HAPUS PRODUK =====
    if (isset($_GET["hapus"])) {
        if (hapusProduct($koneksi, (int) $_GET["hapus"])) {
            redirect("admin.php");
        }
        echo "Gagal menghapus produk. <a href='admin.php'>Kembali</a>";
        exit;
    }

    // ===== TAMBAH KE KERANJANG =====
    if (isset($_GET["id_product"])) {
        if (!isset($_SESSION["id_user"])) {
            redirect("login.php");
        }

        if (tambahKeChart($koneksi, (int) $_SESSION["id_user"], (int) $_GET["id_product"])) {
            redirect("chart.php");
        }
        echo "Produk tidak ditemukan. <a href='product.php'>Kembali</a>";
        exit;
    }

    if (isset($_GET["hapusChart"])){
        if (!isset($_SESSION["id_user"])) {
        redirect("login.php");
    }

        if(hapusChart($koneksi, (int) $_GET["hapusChart"], (int) $_SESSION["id_user"])){
            redirect("chart.php");
        }
        echo "Gagal menghapus produk. <a href='chart.php'>Kembali</a>";
        exit;
    }

} catch (mysqli_sql_exception $e) {
    // Untuk belajar: tampilkan pesan aslinya. Di aplikasi sungguhan, catat ke log saja.
    echo "Terjadi kesalahan database: " . $e->getMessage();
    exit;
}

redirect("login.php");