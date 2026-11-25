<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Jingga') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-neutral-100 antialiased" style="font-family: 'Plus Jakarta Sans', sans-serif;">

    @php
        $menus = [
            [
                'label' => 'Dashboard',
                'href' => route('dashboard.index'),
                'active' => request()->routeIs('dashboard'),
                'icon' =>
                    'M4 5a1 1 0 0 1 1-1h5v7H4V5Zm10-1h5a1 1 0 0 1 1 1v3h-6V4ZM4 13h6v7H5a1 1 0 0 1-1-1v-6Zm10-3h6v9a1 1 0 0 1-1 1h-5v-10Z',
            ],
            [
                'label' => 'Product',
                'href' => url('/products'),
                'active' => request()->is('products*'),
                'icon' => 'm12 3 8 4.5v9L12 21l-8-4.5v-9L12 3Zm0 9 8-4.5M12 12v9M12 12 4 7.5',
            ],
            [
                'label' => 'Kategori Product',
                'href' => route('category.index'),
                'active' => request()->routeIs('category-products.*'),
                'icon' => 'M3 12V4h8l10 10-8 8L3 12Zm5-5h.01',
            ],
        ];
    @endphp

    <div x-data="{ sidebar: false }" class="min-h-screen">

        {{-- overlay mobile --}}
        <div x-show="sidebar" x-cloak @click="sidebar = false" class="fixed inset-0 z-30 bg-black/50 lg:hidden"></div>

        {{-- ====== SIDEBAR ====== --}}
        <aside
            class="fixed inset-y-0 left-0 z-40 flex w-64 flex-col border-r border-neutral-200 bg-white transition-transform duration-300 lg:translate-x-0"
            :class="sidebar ? 'translate-x-0' : '-translate-x-full'">

            <a href="{{ route('dashboard.index') }}" class="flex items-center gap-x-2 px-6 py-6">
                <span
                    class="grid size-9 place-items-center rounded-xl bg-[#EA6A2E] text-lg font-extrabold text-white">J</span>
                <span class="text-xl font-extrabold text-neutral-900">Jingga</span>
            </a>

            <nav class="flex flex-1 flex-col gap-y-1 px-4">
                <p class="px-3 pb-2 pt-2 text-xs font-semibold uppercase tracking-wider text-neutral-400">Menu</p>

                @foreach ($menus as $menu)
                    <a href="{{ $menu['href'] }}"
                        class="flex items-center gap-x-3 rounded-xl px-3 py-3 text-sm font-semibold transition-colors
                   {{ $menu['active'] ? 'bg-[#EA6A2E] text-white' : 'text-neutral-600 hover:bg-neutral-100 hover:text-neutral-900' }}">
                        <svg class="size-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="{{ $menu['icon'] }}" />
                        </svg>
                        {{ $menu['label'] }}
                    </a>
                @endforeach
            </nav>

            <div class="m-4 rounded-2xl bg-neutral-900 p-4 text-white">
                <p class="text-sm font-bold">Butuh bantuan?</p>
                <p class="mt-1 text-xs text-neutral-400">Hubungi tim Jingga kapan saja.</p>
            </div>
        </aside>

        {{-- ====== AREA UTAMA ====== --}}
        <div class="lg:pl-64">

            {{-- NAVBAR ATAS --}}
            <header
                class="sticky top-0 z-20 flex items-center gap-x-4 border-b border-neutral-200 bg-white px-4 py-4 sm:px-8">
                <button type="button" @click="sidebar = true"
                    class="rounded-lg p-2 text-neutral-700 hover:bg-neutral-100 lg:hidden" aria-label="Buka menu">
                    <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round">
                        <path d="M4 7h16M4 12h16M4 17h16" />
                    </svg>
                </button>

                {{-- search --}}
                <form method="GET" action="{{ url()->current() }}"
                    class="flex w-full max-w-md items-center gap-x-2 rounded-xl border border-neutral-200 bg-neutral-50 px-4 py-2.5 focus-within:border-[#EA6A2E] focus-within:ring-4 focus-within:ring-[#EA6A2E]/15">
                    <svg class="size-5 shrink-0 text-neutral-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        <path d="m21 21-4.3-4.3M17 10.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0Z" />
                    </svg>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari..."
                        class="w-full border-0 bg-transparent p-0 text-sm text-neutral-900 placeholder:text-neutral-400 focus:ring-0" />
                </form>

                {{-- profil --}}
                <div class="ml-auto">
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
                                    <span class="block text-xs text-neutral-500">{{ Auth::user()->email }}</span>
                                </span>
                                <svg class="hidden size-4 text-neutral-500 sm:block" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">Log
                                    Out</x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </header>

            {{-- KONTEN --}}
            <main class="p-4 sm:p-8">
                @isset($header)
                    <h1 class="mb-6 text-2xl font-extrabold tracking-tight text-neutral-900">{{ $header }}</h1>
                @endisset

                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
