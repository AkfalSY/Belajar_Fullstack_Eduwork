<?php  
session_start();
include "koneksi.php";
$id_user = $_SESSION['id_user'];
$nama = $_SESSION['nama'];

$query = "SELECT * FROM chart WHERE id_user = '$id_user';";
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
        <div class="flex flex-col-gap-y-1">
            <p class="text-lg font-medium text-blue-950"><span class="text-base font-normal text-blue-400"><a href="Product.php">Product</a></span><span> / </span>CHART</p>
        </div>
        <!-- JUDUL + LOGOUT -->
        <div class="flex items-start justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-blue-950">Chart Produk</h1>
                <p class="mt-2 text-slate-500">Kelola daftar produk yang tersedia.</p>
            </div>
            <a href="login.php" class="shrink-0 rounded-xl border border-blue-200 px-4 py-2 text-sm font-semibold text-blue-700 hover:bg-blue-50">Logout</a>
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
        <div class="mt-6 overflow-x-auto rounded-2xl border border-blue-100">
            <table class="w-full min-w-[640px] text-left">
                <thead class="bg-blue-950 text-white">
                    <tr>
                        <th class="px-6 py-4 font-semibold">No</th>
                        <th class="px-6 py-4 font-semibold">Nama Product</th>
                        <th class="px-6 py-4 font-semibold">Harga</th>
                        <th class="px-6 py-4 font-semibold">Quantity</th>
                        <th class="px-6 py-4 font-semibold">Total</th>
                        <th class="px-6 py-4 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-blue-100 bg-white">
                     <?php while($result = mysqli_fetch_assoc($sql)){ ?>
                    <!-- Ulangi baris <tr> ini untuk tiap produk (isi dengan perulangan PHP) -->
                    <tr class="hover:bg-blue-50/60">
                        <td class="px-6 py-4"><?php echo ++$no; ?></td>
                        <td class="px-6 py-4 font-semibold text-blue-950"><?= $result["product"]; ?></td>
                        <td class="whitespace-nowrap px-6 py-4"><?= $result["harga"]; ?></td>
                        <td class="px-6 py-4"><?= $result["quantity"]; ?></td>
                        <td class="px-6 py-4"><?= $result["total"]; ?></td>
                        <td class="flex gap-x-2 px-6 py-4">
                            <a href="proses.php?hapusChart=<?= $result["id_chart"] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus product ini dari keranjang?')" class="bg-white border-1 border-red-700 rounded-2xl text-red-700 font-medium px-2 py-1">Hapus</a>
                        </td>
                    </tr>
                     <?php } ?>
                </tbody>
            </table>
           
        </div>
    </main>

    <script src="script.js"></script>
</body>
</html>