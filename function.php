<?php
// File ini hanya berisi fungsi. Jangan beri echo/spasi di luar tag PHP
// dan jangan tutup dengan  supaya header() di proses.php tidak gagal.

const DIR_GAMBAR = "src/img/";

function redirect($tujuan)
{
    header("Location: " . $tujuan);
    exit;
}

/* ---------- GAMBAR ---------- */

// Mengembalikan nama file baru, atau "" kalau tidak ada upload / tidak valid
function simpanGambar($file)
{
    if (!$file || $file["error"] !== UPLOAD_ERR_OK) {
        return "";
    }

    $ext = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
    if (!in_array($ext, ["jpg", "jpeg", "png"])) {
        return "";
    }

    $namaBaru = uniqid("produk_") . "." . $ext;
    if (!move_uploaded_file($file["tmp_name"], DIR_GAMBAR . $namaBaru)) {
        return "";
    }
    return $namaBaru;
}

function hapusGambar($nama)
{
    $path = DIR_GAMBAR . $nama;
    if ($nama !== "" && is_file($path)) {
        unlink($path);
    }
}

/* ---------- PRODUK ---------- */

function tambahProduct($koneksi, $data, $files)
{
    $nama      = trim($data["namaProduct"] ?? "");
    $harga     = (int) ($data["hargaProduct"] ?? 0);
    $deskripsi = trim($data["deskripsi"] ?? "");
    $stock     = (int) ($data["stockProduct"] ?? 0);
    $gambar    = simpanGambar($files["gambar"] ?? null);

    $stmt = mysqli_prepare($koneksi, "INSERT INTO products (nama_product, harga, description, stock, gambar) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sisis", $nama, $harga, $deskripsi, $stock, $gambar);
    return mysqli_stmt_execute($stmt);
}

function editProduct($koneksi, $data, $files)
{
    $id        = (int) ($data["idProduct"] ?? 0);
    $nama      = trim($data["namaProduct"] ?? "");
    $harga     = (int) ($data["hargaProduct"] ?? 0);
    $deskripsi = trim($data["deskripsi"] ?? "");
    $stock     = (int) ($data["stockProduct"] ?? 0);

    // Ambil gambar lama
    $stmt = mysqli_prepare($koneksi, "SELECT gambar FROM products WHERE id_product = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $lama = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    if (!$lama) {
        return false;
    }

    $gambar = $lama["gambar"];

    // Kalau ada gambar baru, pakai yang baru. Kalau tidak, gambar lama dipertahankan.
    $gambarBaru = simpanGambar($files["gambar"] ?? null);
    if ($gambarBaru !== "") {
        $gambar = $gambarBaru;
    }

    $stmt = mysqli_prepare($koneksi, "UPDATE products SET nama_product = ?, harga = ?, description = ?, stock = ?, gambar = ? WHERE id_product = ?");
    mysqli_stmt_bind_param($stmt, "sisisi", $nama, $harga, $deskripsi, $stock, $gambar, $id);
    $ok = mysqli_stmt_execute($stmt);

    // Gambar lama dihapus hanya setelah update berhasil
    if ($ok && $gambarBaru !== "") {
        hapusGambar($lama["gambar"]);
    }
    return $ok;
}

function hapusProduct($koneksi, $id)
{
    $stmt = mysqli_prepare($koneksi, "SELECT gambar FROM products WHERE id_product = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $produk = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    if (!$produk) {
        return false;
    }

    $stmt = mysqli_prepare($koneksi, "DELETE FROM products WHERE id_product = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    $ok = mysqli_stmt_execute($stmt);

    if ($ok) {
        hapusGambar($produk["gambar"]);
    }
    return $ok;
}

/* ---------- LOGIN ---------- */

// Mengembalikan data user kalau berhasil, atau null kalau gagal
function loginUser($koneksi, $username, $pass)
{
    $stmt = mysqli_prepare($koneksi, "SELECT * FROM users WHERE nama_user = ? OR email = ?");
    mysqli_stmt_bind_param($stmt, "ss", $username, $username);
    mysqli_stmt_execute($stmt);
    $user = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

    if (!$user) {
        return null;
    }

    // Password di-hash (disarankan) ATAU masih teks biasa (sementara untuk latihan).
    // Kalau semua password sudah di-hash, hapus pembanding teks biasa di bawah.
    $cocok = password_verify($pass, $user["password"]) || $pass === $user["password"];

    return $cocok ? $user : null;
}

/* ---------- KERANJANG ---------- */

function tambahKeChart($koneksi, $idUser, $idProduct)
{
    // Nama dan harga selalu diambil dari database, bukan dari browser
    $stmt = mysqli_prepare($koneksi, "SELECT nama_product, harga FROM products WHERE id_product = ?");
    mysqli_stmt_bind_param($stmt, "i", $idProduct);
    mysqli_stmt_execute($stmt);
    $produk = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    if (!$produk) {
        return false;
    }

    $nama  = $produk["nama_product"];
    $harga = (int) $produk["harga"];

    // Sudah ada di keranjang user ini? Kalau ya, tambah quantity-nya saja.
    $stmt = mysqli_prepare($koneksi, "SELECT id_chart, quantity FROM chart WHERE id_user = ? AND id_product = ?");
    mysqli_stmt_bind_param($stmt, "ii", $idUser, $idProduct);
    mysqli_stmt_execute($stmt);
    $ada = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

    if ($ada) {
        $qty   = (int) $ada["quantity"] + 1;
        $total = $harga * $qty;
        $stmt  = mysqli_prepare($koneksi, "UPDATE chart SET quantity = ?, total = ? WHERE id_chart = ?");
        mysqli_stmt_bind_param($stmt, "iii", $qty, $total, $ada["id_chart"]);
        return mysqli_stmt_execute($stmt);
    }

    $qty   = 1;
    $total = $harga * $qty;
    $stmt  = mysqli_prepare($koneksi, "INSERT INTO chart (id_product, id_user, product, harga, quantity, total) VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "iisiii", $idProduct, $idUser, $nama, $harga, $qty, $total);
    return mysqli_stmt_execute($stmt);
}

function hapusChart($koneksi, $idChart, $idUser){
    $query = mysqli_prepare($koneksi, "DELETE FROM chart WHERE id_chart = ? AND id_user = ?");
    mysqli_stmt_bind_param($query, "ii", $idChart, $idUser);
    mysqli_stmt_execute($query); 
    return mysqli_stmt_affected_rows($query) > 0;
}
?>