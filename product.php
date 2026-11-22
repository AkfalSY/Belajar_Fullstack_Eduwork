<?php  
session_start();
include "koneksi.php";

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$nama = $_SESSION['nama'];

$query = "SELECT * FROM products";
$sql = mysqli_query($koneksi, $query);
$no = 0

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/output.css">
    <title>Data Produk</title>
</head>
<body class="min-h-screen bg-white text-slate-700 antialiased">
    <main class="mx-auto max-w-6xl px-4 py-10 sm:px-6">

        <!-- JUDUL + LOGOUT -->
        <div class="flex items-start justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-blue-950">Data Produk</h1>
                <p class="mt-2 text-slate-500">Kelola daftar produk yang tersedia.</p>
            </div>
            <div class="flex gap-x-2">
                <a href="chart.php?id_user=<?= $id_user ?>" class="shrink-0 rounded-xl border bg-blue-700 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-50">Chart</a>
                <a href="login.php" class="shrink-0 rounded-xl border border-blue-200 px-4 py-2 text-sm font-semibold text-blue-700 hover:bg-blue-50">Logout</a>
            </div>
        </div>

        <!-- SEARCH BAR + TOMBOL TAMBAH -->
        <div class="mt-8 flex flex-col gap-3 sm:flex-row">
            <form action="" method="GET" class="relative flex-1">
                <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <circle cx="11" cy="11" r="7" />
                    <path d="m20 20-3.5-3.5" />
                </svg>
                <input type="text" name="cari" placeholder="Cari nama produk..."
                    class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-4 text-slate-900 placeholder:text-slate-400 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600/20">
            </form>
        </div>

        <!-- TABEL PRODUK -->
        <div class="mt-8 grid grid-cols-3 gap-4">
            <?php while($result = mysqli_fetch_assoc($sql)) { ?>
            <div class="flex flex-col bg-white border-1 border-gray-100 rounded-2xl gap-y-4 p-4 shadow">
                <img src="src/img/<?= $result['gambar'] ?>" alt="keyboard" class="w-full h-[250px] object-cover rounded-2xl">
                <div class="flex justify-between gap-y-1">
                    <p class="font-semibold text-blue-950"><?= $result['nama_product'] ?></p>
                    <p class="whitespace-nowrap"><?= $result['harga'] ?></p>
                </div>
                <p><?= $result['description'] ?></p>
                <div class="flex justify-between gap-x-2">
                    <button class="w-full bg-blue-700 rounded-full py-2 px-1 text-white">Buy</button>
                    <a href="proses.php?id_product=<?= $result['id_product'] ?>" class="w-full border-2 border-blue-700 rounded-full py-2 px-1 text-blue-700 text-center">Add chart</a>
                </div>
            </div>
            <?php } ?>
        </div>
    </main>

    <script src="script.js"></script>
</body>
</html>