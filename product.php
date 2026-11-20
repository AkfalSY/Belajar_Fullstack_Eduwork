<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Document</title>
    </head>
    <body>
        <form id="formProduct" method="POST" id="formProduct" action="proses.php">
            <label for="namaProduct">Nama Product</label>
            <input type="text" name="namaProduct" id="namaProduct" placeholder="Isi nama produk disini" /><br>
            <label for="hargaProduct">Harga Product</label>
            <input type="text" name="hargaProduct" id="hargaProduct" placeholder="Isi harga produk disini" /><br>
            <label for="Deskripsi">Deskripsi</label>
            <input type="text" name="deskripsi" id="deskripsi" placeholder="Isi deskripsi produk disini" /><br>
            <button type="submit" form="formProduct">Submit</button>
        </form>
    </body>
</html>
