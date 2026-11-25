<x-app-layout>
    <x-slot name="header">Dashboard</x-slot>

    {{-- kartu statistik --}}
    <div class="grid gap-4 sm:grid-cols-3">
        <div class="rounded-2xl border border-neutral-200 bg-white p-5">
            <p class="text-sm text-neutral-500">Total Kategori</p>
            <p class="mt-1 text-3xl font-extrabold text-neutral-900">{{ $totalCategories }}</p>
        </div>
        <div class="rounded-2xl border border-neutral-200 bg-white p-5">
            <p class="text-sm text-neutral-500">Total Produk</p>
            <p class="mt-1 text-3xl font-extrabold text-[#EA6A2E]">{{ $totalProducts }}</p>
        </div>
        <div class="rounded-2xl border border-neutral-200 bg-white p-5">
            <p class="text-sm text-neutral-500">Kategori Kosong</p>
            <p class="mt-1 text-3xl font-extrabold text-neutral-900">{{ $emptyCategories }}</p>
        </div>
    </div>

</x-app-layout>
