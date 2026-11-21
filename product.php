<?php  
include "koneksi.php";

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
            <button type="button" id="btnTambah"
                class="cursor-pointer inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3 font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                    <path d="M12 5v14M5 12h14" />
                </svg>
                Tambah
            </button>
        </div>

        <!-- TABEL PRODUK -->
        <div class="mt-6 overflow-x-auto rounded-2xl border border-blue-100">
            <table class="w-full min-w-[640px] text-left">
                <thead class="bg-blue-950 text-white">
                    <tr>
                        <th class="px-6 py-4 font-semibold">No</th>
                        <th class="px-6 py-4 font-semibold">Nama</th>
                        <th class="px-6 py-4 font-semibold">Harga</th>
                        <th class="px-6 py-4 font-semibold">Deskripsi</th>
                        <th class="px-6 py-4 font-semibold">Stock</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-blue-100 bg-white">
                     <?php while($result = mysqli_fetch_assoc($sql)){ ?>
                    <!-- Ulangi baris <tr> ini untuk tiap produk (isi dengan perulangan PHP) -->
                    <tr class="hover:bg-blue-50/60">
                        <td class="px-6 py-4"><?php echo ++$no ?></td>
                        <td class="px-6 py-4 font-semibold text-blue-950"><?php echo $result["nama_product"]; ?></td>
                        <td class="whitespace-nowrap px-6 py-4"><?php echo $result["harga"]; ?></td>
                        <td class="px-6 py-4"><?php echo $result["description"]; ?>.</td>
                        <td class="px-6 py-4"><?php echo $result["stock"]; ?></td>
                    </tr>
                     <?php } ?>
                </tbody>
            </table>
           
        </div>
    </main>

    <!-- MODAL TAMBAH PRODUK -->
    <div id="modalTambah" class="fixed inset-0 z-50 hidden items-center justify-center bg-blue-950/60 p-4" aria-hidden="true">
        <div role="dialog" aria-modal="true" aria-labelledby="modalTambahTitle" class="relative max-h-[90vh] w-full max-w-md overflow-y-auto rounded-2xl bg-white p-6 shadow-xl [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
            <button id="modalTambahClose" type="button" aria-label="Tutup" class="absolute right-4 top-4 flex h-9 w-9 items-center justify-center rounded-full bg-blue-50 text-2xl leading-none text-blue-900 hover:bg-blue-100">&times;</button>

            <h2 id="modalTambahTitle" class="pr-12 text-2xl font-bold text-blue-950">Tambah Produk</h2>
            <p class="mt-1 text-sm text-slate-500">Isi data produk baru di bawah ini.</p>

            <form id="formProduct" method="POST" action="proses.php" class="mt-6 space-y-4">
                <input type="hidden" name="aksi" value="product">

                <div>
                    <label for="namaProduct" class="block text-sm font-medium text-slate-700">Nama Product</label>
                    <input type="text" name="namaProduct" id="namaProduct" placeholder="Isi nama produk disini" required
                        class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 placeholder:text-slate-400 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600/20">
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label for="hargaProduct" class="block text-sm font-medium text-slate-700">Harga Product</label>
                        <input type="number" name="hargaProduct" id="hargaProduct" min="0" placeholder="Isi harga produk" required
                            class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 placeholder:text-slate-400 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600/20">
                    </div>
                    <div>
                        <label for="stockProduct" class="block text-sm font-medium text-slate-700">Stock</label>
                        <input type="number" name="stockProduct" id="stockProduct" min="0" placeholder="Isi jumlah stock" required
                            class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 placeholder:text-slate-400 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600/20">
                    </div>
                </div>

                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-slate-700">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="3" placeholder="Isi deskripsi produk disini" required
                        class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 placeholder:text-slate-400 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600/20"></textarea>
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" id="modalTambahBatal" class="rounded-xl border border-slate-200 px-5 py-3 font-semibold text-slate-600 hover:bg-slate-50">Batal</button>
                    <button type="submit" class="rounded-xl bg-blue-600 px-5 py-3 font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>