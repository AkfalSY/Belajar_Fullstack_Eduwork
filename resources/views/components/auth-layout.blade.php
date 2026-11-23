@props(['title' => 'Masuk', 'heading', 'subheading' => null, 'active' => 1])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} - Jingga</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-orange-200 p-3 antialiased sm:p-8" style="font-family: 'Plus Jakarta Sans', sans-serif;">

    <div
        class="mx-auto grid min-h-[calc(100vh-1.5rem)] max-w-8xl overflow-hidden rounded-[2rem] bg-white sm:min-h-[calc(100vh-4rem)] lg:grid-cols-2 shadow-xl">

        {{-- ====== PANEL KIRI ====== --}}
        <aside
            class="relative hidden flex-col justify-between overflow-hidden bg-gradient-to-br from-[#F4853F] via-[#EA6A2E] to-[#C94F1A] p-8 text-white lg:flex">

            {{-- dekorasi --}}
            <div class="absolute -right-24 -top-24 size-80 rounded-full bg-white/10"></div>
            <div class="absolute -left-20 top-1/3 size-72 rounded-full bg-black/10"></div>
            <div
                class="absolute right-10 top-28 grid size-52 place-items-center rounded-full bg-neutral-900 shadow-2xl">
                <div class="grid size-32 place-items-center rounded-full border-[10px] border-[#EA6A2E] bg-neutral-900">
                    <div class="size-9 rounded-full bg-white"></div>
                </div>
            </div>

            {{-- logo --}}
            <a href="/" class="relative flex items-center gap-x-2">
                <span
                    class="grid size-9 place-items-center rounded-xl bg-white text-lg font-extrabold text-[#EA6A2E]">J</span>
                <span class="text-xl font-bold">Jingga</span>
            </a>

            {{-- konten bawah --}}
            <div class="relative">
                <span
                    class="inline-flex items-center gap-x-2 rounded-full bg-white/20 px-4 py-2 text-sm font-semibold backdrop-blur">
                    <span class="size-2 rounded-full bg-white"></span>
                    Gabung bareng Jingga
                </span>

                <h2 class="mt-5 text-5xl font-extrabold leading-[1.1] tracking-tight">
                    Mulai belanja gadget pilihan.
                </h2>
                <p class="mt-3 text-white/80">Ikuti langkah mudah berikut untuk mulai berbelanja.</p>

                @php
                    $steps = [
                        1 => 'Masuk atau daftar akun',
                        2 => 'Pilih produk favoritmu',
                        3 => 'Bayar, paket dikirim',
                    ];
                @endphp

                <div class="mt-8 grid grid-cols-3 gap-3">
                    @foreach ($steps as $number => $label)
                        <div
                            class="flex min-h-32 flex-col justify-between rounded-2xl p-4 text-sm font-semibold
                            {{ $number === $active ? 'bg-white text-neutral-900' : 'bg-white/15 text-white/70 backdrop-blur' }}">
                            <span
                                class="grid size-6 place-items-center rounded-full text-xs
                                {{ $number === $active ? 'bg-neutral-900 text-white' : 'border border-white/40' }}">
                                {{ $number }}
                            </span>
                            {{ $label }}
                        </div>
                    @endforeach
                </div>
            </div>
        </aside>

        {{-- ====== PANEL KANAN ====== --}}
        <main class="flex items-center justify-center px-6 py-10 sm:px-12">
            <div class="w-full max-w-md">

                {{-- logo versi mobile --}}
                <a href="/" class="mb-8 flex items-center justify-center gap-x-2 lg:hidden">
                    <span
                        class="grid size-9 place-items-center rounded-xl bg-[#EA6A2E] text-lg font-extrabold text-white">J</span>
                    <span class="text-xl font-bold text-neutral-900">Jingga</span>
                </a>

                <h1 class="text-center text-3xl font-extrabold tracking-tight text-neutral-900">{{ $heading }}</h1>
                @if ($subheading)
                    <p class="mt-2 text-center text-sm text-neutral-500">{{ $subheading }}</p>
                @endif

                {{ $slot }}
            </div>
        </main>
    </div>

    <script>
        function togglePassword(id, btn) {
            const input = document.getElementById(id);
            const show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            btn.textContent = show ? 'Sembunyikan' : 'Lihat';
        }
    </script>
</body>

</html>
