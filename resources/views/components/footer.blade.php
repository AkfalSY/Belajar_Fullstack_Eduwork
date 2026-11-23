<footer class="border-t border-neutral-100 bg-neutral-50">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-14">
        <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-5">
            <div class="lg:col-span-2">
                <a href="index.php" class="flex items-center gap-2 text-xl font-extrabold tracking-tight">
                    <span class="grid h-8 w-8 place-items-center rounded-lg bg-brand text-white">J</span> Jingga
                </a>
                <p class="mt-4 max-w-sm text-sm leading-relaxed text-neutral-500">
                    Toko online untuk gadget dan kebutuhan harian. Produk original, harga jelas, pengiriman ke
                    seluruh Indonesia.
                </p>
                <form action="subscribe.php" method="post"
                    class="mt-6 flex max-w-sm rounded-full border border-neutral-200 bg-white p-1 focus-within:ring-2 focus-within:ring-brand">
                    <label for="email" class="sr-only">Email</label>
                    <input id="email" name="email" type="email" placeholder="Email kamu"
                        class="w-full bg-transparent px-4 text-sm outline-none">
                    <button
                        class="rounded-full bg-ink px-5 py-2.5 text-sm font-semibold text-white hover:bg-brand transition-colors">Langganan</button>
                </form>
            </div>

            <div>
                <h3 class="text-sm font-bold">Belanja</h3>
                <ul class="mt-4 space-y-3 text-sm text-neutral-500">
                    <li><a href="#" class="hover:text-brand">Semua produk</a></li>
                    <li><a href="#" class="hover:text-brand">Promo</a></li>
                    <li><a href="#" class="hover:text-brand">Produk baru</a></li>
                    <li><a href="#" class="hover:text-brand">Terlaris</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-bold">Bantuan</h3>
                <ul class="mt-4 space-y-3 text-sm text-neutral-500">
                    <li><a href="#" class="hover:text-brand">Cara pemesanan</a></li>
                    <li><a href="#" class="hover:text-brand">Pengiriman</a></li>
                    <li><a href="#" class="hover:text-brand">Pengembalian</a></li>
                    <li><a href="#" class="hover:text-brand">Hubungi kami</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-bold">Perusahaan</h3>
                <ul class="mt-4 space-y-3 text-sm text-neutral-500">
                    <li><a href="#" class="hover:text-brand">Tentang kami</a></li>
                    <li><a href="#" class="hover:text-brand">Karier</a></li>
                    <li><a href="#" class="hover:text-brand">Kebijakan privasi</a></li>
                    <li><a href="#" class="hover:text-brand">Syarat &amp; ketentuan</a></li>
                </ul>
            </div>
        </div>

        <div
            class="mt-12 flex flex-col items-center justify-between gap-4 border-t border-neutral-200 pt-6 text-xs text-neutral-500 sm:flex-row">
            <p>© <?= date('Y') ?> Jingga. Semua hak dilindungi.</p>
            <p>Dibuat di Bandung, Indonesia</p>
        </div>
    </div>
</footer>
