<?php
$categories = ['Elektronik', 'Gaming', 'Audio', 'Fashion', 'Rumah', 'Kecantikan', 'Olahraga', 'Aksesori'];

function rupiah($n)
{
    return 'Rp' . number_format($n, 0, ',', '.');
}
?>
@extends('layout')
@section('title', 'eccomerce jingga')
@section('content')
    <!-- HERO -->
    <section class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pt-6 sm:pt-10">
        <div class="grid overflow-hidden rounded-[2rem] bg-brand-soft lg:grid-cols-2">
            <div class="flex flex-col justify-center p-8 sm:p-12 lg:p-16">
                <p
                    class="inline-flex w-fit items-center gap-2 rounded-full bg-white px-3 py-1 text-xs font-semibold shadow-sm">
                    <span class="h-2 w-2 rounded-full bg-brand"></span> Koleksi terbaru 2026
                </p>
                <h1 class="mt-5 text-4xl font-extrabold leading-[1.1] tracking-tight sm:text-5xl lg:text-6xl">
                    Gadget pilihan,<br>harga masuk akal.
                </h1>
                <p class="mt-5 max-w-md text-base leading-relaxed text-neutral-600">
                    Audio, gaming, dan aksesori harian dari brand terpercaya. Pengiriman cepat, garansi resmi, bayar
                    di tempat tersedia.
                </p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="#produk"
                        class="rounded-full bg-ink px-7 py-3.5 text-sm font-semibold text-white hover:bg-neutral-800 transition-colors">Belanja
                        sekarang</a>
                    <a href="#promo"
                        class="rounded-full border border-ink/15 bg-white px-7 py-3.5 text-sm font-semibold hover:border-ink transition-colors">Lihat
                        promo</a>
                </div>
            </div>

            <!-- Visual hero: ganti dengan <img src="assets/hero.png"> bila sudah ada gambar -->
            <div class="relative flex min-h-[300px] items-center justify-center bg-brand p-8 lg:min-h-[480px]">
                <div class="absolute -right-16 -top-16 h-64 w-64 rounded-full bg-white/10"></div>
                <div class="absolute -bottom-20 -left-10 h-72 w-72 rounded-full bg-black/10"></div>
                <div class="relative grid h-56 w-56 place-items-center rounded-full bg-ink sm:h-72 sm:w-72">
                    <div class="grid h-36 w-36 place-items-center rounded-full border-[14px] border-brand sm:h-48 sm:w-48">
                        <div class="h-10 w-10 rounded-full bg-white sm:h-14 sm:w-14"></div>
                    </div>
                </div>
                <div class="absolute bottom-6 left-6 rounded-2xl bg-white p-4 shadow-xl sm:bottom-10 sm:left-10">
                    <p class="text-xs text-neutral-500">Mulai dari</p>
                    <p class="text-lg font-extrabold">Rp249.000</p>
                </div>
                <div
                    class="absolute right-6 top-6 rounded-full bg-ink px-4 py-2 text-xs font-semibold text-white sm:right-10 sm:top-10">
                    Diskon hingga 40%</div>
            </div>
        </div>

        <!-- Keunggulan -->
        <div class="mt-6 grid grid-cols-2 gap-4 rounded-2xl border border-neutral-100 p-5 lg:grid-cols-4">
            <?php
        $perks = [
          ['Pengiriman cepat','Sampai 1–3 hari kerja'],
          ['Garansi resmi','Produk 100% original'],
          ['Bayar di tempat','COD ke seluruh kota'],
          ['Bantuan 24/7','Chat kapan saja'],
        ];
        foreach ($perks as $p): ?>
            <div class="flex items-center gap-3">
                <span class="grid h-10 w-10 shrink-0 place-items-center rounded-full bg-brand-soft text-brand">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="m5 12 5 5L20 7" />
                    </svg>
                </span>
                <div>
                    <p class="text-sm font-semibold"><?= htmlspecialchars($p[0]) ?></p>
                    <p class="text-xs text-neutral-500"><?= htmlspecialchars($p[1]) ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- KATEGORI -->
    <section id="kategori" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pt-14">
        <div class="flex items-end justify-between">
            <h2 class="text-2xl font-extrabold tracking-tight sm:text-3xl">Belanja per kategori</h2>
            <a href="categories.php" class="text-sm font-semibold text-brand hover:underline">Lihat semua</a>
        </div>
        <div class="mt-6 flex gap-3 overflow-x-auto pb-2 [scrollbar-width:none]">
            <?php foreach ($categories as $i => $cat): ?>
            <a href="category.php?name=<?= urlencode($cat) ?>"
                class="shrink-0 rounded-full border px-6 py-3 text-sm font-semibold transition-colors
                    <?= $i === 0 ? 'border-ink bg-ink text-white' : 'border-neutral-200 hover:border-brand hover:text-brand' ?>">
                <?= htmlspecialchars($cat) ?>
            </a>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- PRODUK -->
    <section id="produk" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pt-10">
        <div class="flex items-end justify-between">
            <div>
                <h2 class="text-2xl font-extrabold tracking-tight sm:text-3xl">Produk terlaris</h2>
                <p class="mt-1 text-sm text-neutral-500">Paling banyak dibeli minggu ini</p>
            </div>
            <a href="products.php" class="text-sm font-semibold text-brand hover:underline">Lihat semua</a>
        </div>

        <div class="mt-8 grid grid-cols-2 gap-x-4 gap-y-8 md:grid-cols-3 lg:grid-cols-4 lg:gap-x-6">
            @foreach ($products as $p)
                <article class="group">
                    <a href="product.php?id={{ $p->id }}"
                        class="relative block aspect-square overflow-hidden rounded-2xl bg-neutral-100">
                        @if (!empty($p->image))
                            <img src="{{ $p->image }}" alt="{{ $p->name }}" loading="lazy"
                                class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
                        @else
                            <div class="grid h-full w-full place-items-center text-neutral-300">
                                <svg class="h-14 w-14" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="1.2">
                                    <rect x="3" y="4" width="18" height="16" rx="2" />
                                    <circle cx="9" cy="10" r="1.6" />
                                    <path d="m21 16-5-5-8 8" />
                                </svg>
                            </div>
                        @endif
                    </a>

                    <button type="button" aria-label="Simpan ke wishlist" class="sr-only">Wishlist</button>

                    <div class="mt-3">
                        <div class="mt-2 flex flex-col">
                            <h3 class="mt-0.5 text-lg font-semibold leading-snug">
                                <a href="product.php?id={{ $p->id }}"
                                    class="hover:text-brand">{{ htmlspecialchars($p->name) }}</a>
                            </h3>
                            <p class="text-sm text-gray-500">{{ $p->description }}</p>
                        </div>

                        <div class="mt-2 flex items-end justify-between gap-2">
                            <div>
                                <p class="text-base font-extrabold">{{ rupiah($p->price) }}</p>
                            </div>
                            <form action="cart_add.php" method="post">
                                <input type="hidden" name="id" value="{{ (int) $p->id }}">
                                <a href="{{ route('click.product', $p->id) }}"
                                    class="grid h-10 w-10 place-items-center rounded-full bg-ink text-white transition-colors hover:bg-brand"
                                    aria-label="Tambah ke keranjang">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2">
                                        <path d="M12 5v14M5 12h14" />
                                    </svg>
                                </a>
                            </form>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    </section>

    <!-- BANNER PROMO -->
    <section id="promo" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16">
        <div
            class="flex flex-col items-start justify-between gap-6 rounded-[2rem] bg-ink p-8 text-white sm:p-12 md:flex-row md:items-center">
            <div>
                <h2 class="text-3xl font-extrabold tracking-tight sm:text-4xl">Diskon hingga 50%<br>untuk pengguna
                    baru.</h2>
                <p class="mt-3 max-w-md text-neutral-400">Daftar sekarang dan dapatkan voucher belanja pertama
                    tanpa minimum pembelian.</p>
            </div>
            <a href="register.php"
                class="shrink-0 rounded-full bg-brand px-8 py-4 text-sm font-semibold text-white hover:bg-brand-dark transition-colors">Daftar
                gratis</a>
        </div>
    </section>
@endsection
