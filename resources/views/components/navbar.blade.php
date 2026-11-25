    <header class="sticky top-0 z-40 bg-white/90 backdrop-blur border-b border-neutral-100">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center gap-4 lg:gap-8">
                <a href="index.php" class="flex items-center gap-2 text-xl font-extrabold tracking-tight">
                    <span class="grid h-8 w-8 place-items-center rounded-lg bg-brand text-white">J</span>
                    Jingga
                </a>

                <nav class="hidden lg:flex items-center gap-6 text-sm font-medium text-neutral-600">
                    <a href="#" class="text-ink">Beranda</a>
                    <a href="#kategori" class="hover:text-ink">Kategori</a>
                    <a href="#produk" class="hover:text-ink">Produk</a>
                    <a href="#promo" class="hover:text-ink">Promo</a>
                    <a href="#" class="hover:text-ink">Bantuan</a>
                </nav>

                <form action="search.php" method="get" class="hidden md:flex flex-1 max-w-xl">
                    <label for="q" class="sr-only">Cari produk</label>
                    <div
                        class="flex w-full items-center rounded-full bg-neutral-100 pl-4 pr-1 focus-within:ring-2 focus-within:ring-brand">
                        <svg class="h-4 w-4 text-neutral-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <circle cx="11" cy="11" r="7" />
                            <path d="m20 20-3.5-3.5" />
                        </svg>
                        <input id="q" name="q" type="search" placeholder="Cari headphone, keyboard, tas…"
                            class="w-full bg-transparent px-3 py-2.5 text-sm outline-none placeholder:text-neutral-400">
                        <button
                            class="rounded-full bg-brand px-5 py-2 text-sm font-semibold text-white hover:bg-brand-dark transition-colors">Cari</button>
                    </div>
                </form>

                <div class="ml-auto flex items-center gap-1 sm:gap-2">
                    @if (Route::has('login'))
                        <nav class="flex items-center justify-end gap-4">
                            @auth
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button
                                            class="flex items-center gap-x-3 rounded-xl p-1.5 hover:bg-neutral-100 focus:outline-none">
                                            <span
                                                class="grid size-9 place-items-center rounded-full bg-neutral-900 text-sm font-bold text-white">
                                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                            </span>
                                            <span class="hidden text-left sm:block">
                                                <span
                                                    class="block text-sm font-semibold leading-tight text-neutral-900">{{ Auth::user()->name }}</span>
                                                <span
                                                    class="block text-xs text-neutral-500">{{ Auth::user()->email }}</span>
                                            </span>
                                            <svg class="hidden size-4 text-neutral-500 sm:block" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m6 9 6 6 6-6" />
                                            </svg>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        @if (Auth::user()->role === 'admin')
                                            <x-dropdown-link :href="route('dashboard.index')">Dashboard</x-dropdown-link>
                                        @endif
                                        <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault(); this.closest('form').submit();">
                                                Log Out
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            @else
                                <a href="{{ route('login') }}"
                                    class="hidden sm:inline-flex rounded-full px-4 py-2 text-sm font-semibold hover:bg-neutral-100">Masuk</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="hidden sm:inline-flex rounded-full px-4 py-2 text-sm font-semibold hover:bg-neutral-100">Daftar</a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                    <a href="cart"
                        class="relative grid h-10 w-10 place-items-center rounded-full hover:bg-neutral-100"
                        aria-label="Keranjang">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="1.8">
                            <path d="M6 7h12l-1 12H7L6 7Z" />
                            <path d="M9 7a3 3 0 0 1 6 0" />
                        </svg>
                        <span
                            class="absolute -right-0.5 -top-0.5 grid h-5 min-w-5 place-items-center rounded-full bg-brand px-1 text-[10px] font-bold text-white">2</span>
                    </a>
                    <button id="menuBtn"
                        class="grid h-10 w-10 place-items-center rounded-full hover:bg-neutral-100 lg:hidden"
                        aria-label="Buka menu" aria-expanded="false" aria-controls="mobileMenu">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M4 7h16M4 12h16M4 17h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Menu mobile -->
        <div id="mobileMenu" class="hidden border-t border-neutral-100 lg:hidden">
            <div class="space-y-1 px-4 py-4 text-sm font-medium">
                <form action="search.php" method="get" class="mb-3">
                    <input name="q" type="search" placeholder="Cari produk…"
                        class="w-full rounded-full bg-neutral-100 px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-brand">
                </form>
                <a href="#" class="block rounded-lg px-3 py-2 hover:bg-neutral-100">Beranda</a>
                <a href="#kategori" class="block rounded-lg px-3 py-2 hover:bg-neutral-100">Kategori</a>
                <a href="#produk" class="block rounded-lg px-3 py-2 hover:bg-neutral-100">Produk</a>
                <a href="#promo" class="block rounded-lg px-3 py-2 hover:bg-neutral-100">Promo</a>
                @if (Route::has('login'))
                    @auth
                        @if (Auth::user()->role === 'admin')
                            <a href="{{ route('dashboard.index') }}"
                                class="block rounded-lg px-3 py-2 hover:bg-neutral-100">Dashboard</a>
                        @endif
                        <a href="{{ route('profile.edit') }}"
                            class="block rounded-lg px-3 py-2 hover:bg-neutral-100">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="block w-full rounded-lg px-3 py-2 text-left hover:bg-neutral-100">Log Out</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block rounded-lg px-3 py-2 hover:bg-neutral-100">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="block rounded-lg px-3 py-2 hover:bg-neutral-100">Daftar</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </header>
