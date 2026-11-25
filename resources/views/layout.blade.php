<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif']
                    },
                    colors: {
                        brand: {
                            DEFAULT: '#FF5A1F',
                            dark: '#E24A12',
                            soft: '#FFF1EA'
                        },
                        ink: '#111111'
                    }
                }
            }
        }
    </script>
    <style>
        :focus-visible {
            outline: 2px solid #FF5A1F;
            outline-offset: 2px;
        }

        input[type="checkbox"] {
            accent-color: #111;
        }
    </style>
    @vite(['resources/js/app.js'])
</head>

<body class="bg-white font-sans text-ink antialiased">
    <div class="bg-ink text-white text-xs sm:text-sm text-center py-2 px-4">
        Gratis ongkir untuk pembelian di atas Rp250.000 · <a href="index.php#produk"
            class="text-brand font-semibold hover:underline">Belanja sekarang</a>
    </div>
    <x-navbar></x-navbar>

    <main>
        @yield('content')
    </main>

    <x-footer></x-footer>

    @stack('scripts')
    <script>
        const btn = document.getElementById('menuBtn');
        const menu = document.getElementById('mobileMenu');
        btn.addEventListener('click', () => {
            const open = menu.classList.toggle('hidden') === false;
            btn.setAttribute('aria-expanded', open);
        });
    </script>
</body>

</html>
