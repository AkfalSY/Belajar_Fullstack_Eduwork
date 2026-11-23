<?php
/* ------------------------------------------------------------------
   DATA DUMMY — nanti ganti dengan isi keranjang dari session/database.
   Field: id, name, category, variant, price, qty, image, selected
------------------------------------------------------------------- */
$cart = [['id' => 1, 'name' => 'Headphone Nirkabel ANC Pro', 'category' => 'Audio', 'variant' => 'Hitam', 'price' => 899000, 'qty' => 1, 'image' => '', 'selected' => true], ['id' => 3, 'name' => 'Keyboard Mekanikal 60% RGB', 'category' => 'Gaming', 'variant' => 'Putih / Switch Merah', 'price' => 549000, 'qty' => 1, 'image' => '', 'selected' => true], ['id' => 6, 'name' => 'Tas Ransel Laptop 15 inci', 'category' => 'Fashion', 'variant' => 'Abu-abu', 'price' => 279000, 'qty' => 2, 'image' => '', 'selected' => false], ['id' => 7, 'name' => 'Earbuds TWS Mini', 'category' => 'Audio', 'variant' => 'Hitam', 'price' => 249000, 'qty' => 1, 'image' => '', 'selected' => true]];
$shipping = 15000; // ongkir estimasi flat, ganti sesuai logika ekspedisi

function rupiah($n)
{
    return 'Rp' . number_format($n, 0, ',', '.');
}

// Hitung ringkasan awal (hanya item yang dicentang)
$items = 0;
$subtotal = 0;
foreach ($cart as $c) {
    if ($c['selected']) {
        $items += $c['qty'];
        $subtotal += $c['price'] * $c['qty'];
    }
}
$ship = $items > 0 ? $shipping : 0;
?>
@extends('layout')
@section('title', 'cart - eccomerce jingga')
@section('content')

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8 sm:py-10">
        <!-- Breadcrumb -->
        <nav class="text-xs text-neutral-500" aria-label="Breadcrumb">
            <a href="index" class="hover:text-ink">Beranda</a> <span class="mx-1">/</span> <span
                class="text-ink font-medium">Keranjang</span>
        </nav>

        <?php if (empty($cart)): ?>
        <!-- KERANJANG KOSONG -->
        <div class="mt-16 flex flex-col items-center text-center">
            <span class="grid h-20 w-20 place-items-center rounded-full bg-brand-soft">
                <svg class="h-9 w-9" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                    <path d="M6 7h12l-1 12H7L6 7Z" />
                    <path d="M9 7a3 3 0 0 1 6 0" />
                </svg>
            </span>
            <h1 class="mt-6 text-2xl font-extrabold">Keranjang kamu masih kosong</h1>
            <p class="mt-2 text-sm text-neutral-500">Tambahkan produk dulu, lalu kembali ke sini untuk checkout.</p>
            <a href="index.php#produk"
                class="mt-6 rounded-full bg-ink px-7 py-3.5 text-sm font-semibold text-white hover:bg-neutral-800 transition-colors">Mulai
                belanja</a>
        </div>

        <?php else: ?>
        <div class="mt-4 grid gap-10 lg:grid-cols-[1fr_380px] lg:gap-12">

            <!-- DAFTAR ITEM -->
            <section aria-labelledby="cartTitle">
                <div class="flex flex-wrap items-center justify-between gap-3 border-b border-neutral-100 pb-4">
                    <div class="flex items-center gap-3">
                        <input id="selectAll" type="checkbox" class="h-5 w-5 rounded" aria-label="Pilih semua">
                        <h1 id="cartTitle" class="text-2xl font-extrabold tracking-tight sm:text-3xl">
                            Keranjang <span class="ml-1 align-middle rounded-full bg-brand px-2.5 py-0.5 text-sm font-bold"
                                id="cartCount"><?= count($cart) ?></span>
                        </h1>
                    </div>
                    <form action="cart_clear.php" method="post">
                        <button class="text-sm font-semibold text-red-600 hover:underline">Hapus semua</button>
                    </form>
                </div>

                <ul id="cartList" class="divide-y divide-neutral-100">
                    <?php foreach ($cart as $c): ?>
                    <li class="cart-item flex gap-4 py-6 sm:gap-6" data-price="<?= (int) $c['price'] ?>"
                        data-id="<?= (int) $c['id'] ?>">

                        <input type="checkbox" class="item-check mt-1 h-5 w-5 shrink-0 rounded"
                            aria-label="Pilih <?= htmlspecialchars($c['name']) ?>" <?= $c['selected'] ? 'checked' : '' ?>>

                        <a href="product.php?id=<?= (int) $c['id'] ?>"
                            class="block h-24 w-24 shrink-0 overflow-hidden rounded-2xl bg-neutral-100 sm:h-28 sm:w-28">
                            <?php if (!empty($c['image'])): ?>
                            <img src="<?= htmlspecialchars($c['image']) ?>" alt="<?= htmlspecialchars($c['name']) ?>"
                                class="h-full w-full object-cover">
                            <?php else: ?>
                            <span class="grid h-full w-full place-items-center text-neutral-300">
                                <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="1.2">
                                    <rect x="3" y="4" width="18" height="16" rx="2" />
                                    <circle cx="9" cy="10" r="1.6" />
                                    <path d="m21 16-5-5-8 8" />
                                </svg>
                            </span>
                            <?php endif; ?>
                        </a>

                        <div class="flex min-w-0 flex-1 flex-col justify-between gap-3 sm:flex-row sm:items-start">
                            <div class="min-w-0">
                                <span
                                    class="inline-block rounded-full bg-neutral-100 px-2.5 py-0.5 text-xs font-medium text-neutral-600"><?= htmlspecialchars($c['category']) ?></span>
                                <h2 class="mt-1.5 text-sm font-semibold leading-snug sm:text-base">
                                    <a href="product.php?id=<?= (int) $c['id'] ?>"
                                        class="hover:underline"><?= htmlspecialchars($c['name']) ?></a>
                                </h2>
                                <p class="mt-1 text-xs text-neutral-500">Varian: <?= htmlspecialchars($c['variant']) ?>
                                </p>

                                <div class="mt-3 flex items-center gap-4">
                                    <div class="inline-flex items-center rounded-full border border-neutral-200">
                                        <button type="button"
                                            class="qty-minus grid h-9 w-9 place-items-center rounded-full hover:bg-neutral-100"
                                            aria-label="Kurangi jumlah">−</button>
                                        <span class="qty w-8 text-center text-sm font-semibold"
                                            aria-live="polite"><?= (int) $c['qty'] ?></span>
                                        <button type="button"
                                            class="qty-plus grid h-9 w-9 place-items-center rounded-full hover:bg-neutral-100"
                                            aria-label="Tambah jumlah">+</button>
                                    </div>
                                    <button type="button"
                                        class="item-remove text-xs font-semibold text-neutral-500 hover:text-red-600">Hapus</button>
                                    <button type="button"
                                        class="hidden text-xs font-semibold text-neutral-500 hover:text-ink sm:inline">Simpan
                                        ke wishlist</button>
                                </div>
                            </div>

                            <p class="item-total shrink-0 text-base font-extrabold sm:text-right">
                                <?= rupiah($c['price'] * $c['qty']) ?></p>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>

                <a href="index.php#produk"
                    class="mt-2 inline-flex items-center gap-2 text-sm font-semibold hover:underline">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M15 6l-6 6 6 6" />
                    </svg>
                    Lanjut belanja
                </a>
            </section>

            <!-- RINGKASAN -->
            <aside class="lg:sticky lg:top-24 lg:self-start" aria-labelledby="sumTitle">
                <div class="rounded-3xl border border-neutral-200 bg-white p-6">
                    <h2 id="sumTitle" class="text-xl font-extrabold">Ringkasan belanja</h2>

                    <dl class="mt-5 space-y-3 text-sm">
                        <div class="flex justify-between">
                            <dt class="text-neutral-500">Total barang</dt>
                            <dd id="sumItems" class="font-semibold"><?= $items ?> barang</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-neutral-500">Subtotal</dt>
                            <dd id="sumSub" class="font-semibold"><?= rupiah($subtotal) ?></dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-neutral-500">Estimasi ongkir</dt>
                            <dd id="sumShip" class="font-semibold"><?= rupiah($ship) ?></dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-neutral-500">Diskon</dt>
                            <dd class="font-semibold text-green-600">−Rp0</dd>
                        </div>
                    </dl>

                    <div class="mt-5 flex items-baseline justify-between border-t border-neutral-100 pt-5">
                        <span class="font-semibold">Total bayar</span>
                        <span id="sumTotal" class="text-2xl font-extrabold"><?= rupiah($subtotal + $ship) ?></span>
                    </div>

                    <form action="promo_apply.php" method="post"
                        class="mt-5 flex rounded-full border border-neutral-200 p-1 focus-within:ring-2 focus-within:ring-ink">
                        <label for="promo" class="sr-only">Kode promo</label>
                        <input id="promo" name="promo" type="text" placeholder="Masukkan kode promo"
                            class="w-full bg-transparent px-4 text-sm outline-none placeholder:text-neutral-400">
                        <button
                            class="rounded-full bg-ink px-5 py-2.5 text-sm font-semibold text-white hover:bg-neutral-800 transition-colors">Pakai</button>
                    </form>

                    <form action="checkout.php" method="post" class="mt-5">
                        <button id="checkoutBtn"
                            class="w-full rounded-full bg-brand py-4 text-sm font-bold text-ink transition-colors hover:bg-brand-dark disabled:cursor-not-allowed disabled:opacity-40">
                            Checkout
                        </button>
                    </form>
                    <p class="mt-3 text-center text-xs text-neutral-500">Pajak dan ongkir final dihitung saat checkout.
                    </p>
                </div>

                <ul class="mt-4 space-y-3 text-sm text-neutral-600">
                    <li class="flex items-center gap-3"><span
                            class="grid h-8 w-8 place-items-center rounded-full bg-brand-soft"><svg class="h-4 w-4"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="m5 12 5 5L20 7" />
                            </svg></span>Pembayaran aman &amp; terenkripsi</li>
                    <li class="flex items-center gap-3"><span
                            class="grid h-8 w-8 place-items-center rounded-full bg-brand-soft"><svg class="h-4 w-4"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="m5 12 5 5L20 7" />
                            </svg></span>Gratis pengembalian 7 hari</li>
                    <li class="flex items-center gap-3"><span
                            class="grid h-8 w-8 place-items-center rounded-full bg-brand-soft"><svg class="h-4 w-4"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="m5 12 5 5L20 7" />
                            </svg></span>Bantuan chat 24/7</li>
                </ul>
            </aside>
        </div>
        <?php endif; ?>
    </div>

    @push('scripts')
        <script>
            // Menu mobile
            const menu = document.getElementById('mobileMenu');
            if (menuBtn && menu) {
                menuBtn.addEventListener('click', () => {
                    const open = menu.classList.toggle('hidden') === false;
                    menuBtn.setAttribute('aria-expanded', open);
                });
            }

            // Keranjang: hitung ulang ringkasan di sisi klien
            const SHIPPING = <?= (int) $shipping ?>;
            const rp = n => 'Rp' + n.toLocaleString('id-ID');
            const list = document.getElementById('cartList');
            const selectAll = document.getElementById('selectAll');
            const checkoutBtn = document.getElementById('checkoutBtn');

            function recalc() {
                if (!list) return;
                let items = 0,
                    sub = 0;
                const rows = [...list.querySelectorAll('.cart-item')];
                rows.forEach(li => {
                    const qty = parseInt(li.querySelector('.qty').textContent, 10);
                    const price = parseInt(li.dataset.price, 10);
                    li.querySelector('.item-total').textContent = rp(price * qty);
                    if (li.querySelector('.item-check').checked) {
                        items += qty;
                        sub += price * qty;
                    }
                });
                const ship = items > 0 ? SHIPPING : 0;
                document.getElementById('sumItems').textContent = items + ' barang';
                document.getElementById('sumSub').textContent = rp(sub);
                document.getElementById('sumShip').textContent = rp(ship);
                document.getElementById('sumTotal').textContent = rp(sub + ship);
                document.getElementById('cartCount').textContent = rows.length;
                checkoutBtn.disabled = items === 0;
                selectAll.checked = rows.length > 0 && rows.every(li => li.querySelector('.item-check').checked);
            }

            if (list) {
                list.addEventListener('click', e => {
                    const li = e.target.closest('.cart-item');
                    if (!li) return;
                    const q = li.querySelector('.qty');
                    if (e.target.closest('.qty-plus')) q.textContent = Math.min(99, +q.textContent + 1);
                    if (e.target.closest('.qty-minus')) q.textContent = Math.max(1, +q.textContent - 1);
                    if (e.target.closest('.item-remove')) li.remove();
                    recalc();
                });
                list.addEventListener('change', e => {
                    if (e.target.matches('.item-check')) recalc();
                });
                selectAll.addEventListener('change', () => {
                    list.querySelectorAll('.item-check').forEach(c => c.checked = selectAll.checked);
                    recalc();
                });
                recalc();
            }
        </script>
    @endpush
@endsection
