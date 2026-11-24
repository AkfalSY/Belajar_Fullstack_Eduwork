<x-app-layout>
    <x-slot name="header">Product</x-slot>

    <div class="rounded-2xl border border-neutral-200 bg-white">

        <div class="flex flex-col gap-3 p-5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-lg font-bold text-neutral-900">Daftar Kategori</h2>
                @if (request('q'))
                    <p class="text-sm text-neutral-500">
                        Hasil pencarian "{{ request('q') }}" ·
                        <a href="{{ route('products.index') }}"
                            class="font-semibold text-[#EA6A2E] hover:underline">Reset</a>
                    </p>
                @endif
            </div>

            <button type="button" @click="$dispatch('open-modal', 'create-category')"
                class="inline-flex items-center justify-center gap-x-2 whitespace-nowrap rounded-xl bg-neutral-900 px-5 py-3 text-sm font-bold text-white transition-colors hover:bg-[#EA6A2E]">
                <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round">
                    <path d="M12 5v14M5 12h14" />
                </svg>
                Tambah Kategori
            </button>
        </div>

        <table class="w-full text-left text-sm">
            <thead>
                <tr class="bg-neutral-50 text-xs font-semibold uppercase tracking-wider text-neutral-500">
                    <th class="px-5 py-3.5">ID</th>
                    <th class="px-5 py-3.5">Nama</th>
                    <th class="px-5 py-3.5">Deskripsi</th>
                    <th class="px-5 py-3.5">Image</th>
                    <th class="px-5 py-3.5">Price</th>
                    <th class="px-5 py-3.5">Stock</th>
                    <th class="px-5 py-3.5 text-right">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr class="border-t border-neutral-100 transition-colors hover:bg-neutral-50">
                        <td class="px-5 py-4 font-medium text-neutral-500">#{{ $product->id }}</td>
                        <td class="px-5 py-4 font-semibold text-neutral-900">{{ $product->name }}</td>
                        <td class="px-5 py-4 font-semibold text-neutral-900">{{ $product->description }}</td>
                        <td class="px-5 py-4 font-semibold text-neutral-900">{{ $product->image }}</td>
                        <td class="px-5 py-4 font-semibold text-neutral-900">{{ $product->price }}</td>
                        <td class="px-5 py-4 font-semibold text-neutral-900">{{ $product->stock }}</td>
                        <td class="px-5 py-4 text-right">

                            {{-- menu aksi (...) --}}
                            <div x-data="{ open: false }" @click.outside="open = false"
                                @keydown.escape.window="open = false" class="relative inline-block text-left">
                                <button type="button" @click="open = !open" aria-label="Aksi"
                                    class="rounded-lg p-2 text-neutral-500 hover:bg-neutral-100 hover:text-neutral-900">
                                    <svg class="size-5" fill="currentColor" viewBox="0 0 24 24">
                                        <circle cx="5" cy="12" r="1.6" />
                                        <circle cx="12" cy="12" r="1.6" />
                                        <circle cx="19" cy="12" r="1.6" />
                                    </svg>
                                </button>

                                <div x-show="open" x-cloak x-transition.origin.top.right
                                    class="absolute right-0 z-20 mt-1 w-40 rounded-xl border border-neutral-200 bg-white p-1 shadow-lg">
                                    <button type="button"
                                        @click="open = false; editing = { id: {{ $product->id }}, name: @js($product->name) }; $dispatch('open-modal', 'edit-category')"
                                        class="flex w-full items-center gap-x-2 rounded-lg px-3 py-2 text-sm font-medium text-neutral-700 hover:bg-neutral-100">
                                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 20h9M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5Z" />
                                        </svg>
                                        Edit
                                    </button>
                                    <button type="button"
                                        @click="open = false; deleting = { id: {{ $product->id }}, name: @js($product->name) }; $dispatch('open-modal', 'delete-category')"
                                        class="flex w-full items-center gap-x-2 rounded-lg px-3 py-2 text-sm font-medium text-red-600 hover:bg-red-50">
                                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M3 6h18M8 6V4h8v2m-9 0 1 14h8l1-14" />
                                        </svg>
                                        Hapus
                                    </button>
                                </div>
                            </div>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-5 py-12 text-center text-neutral-500">Belum ada kategori.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="flex flex-col gap-3 border-t border-neutral-100 p-5 sm:flex-row sm:items-center sm:justify-between">
            <p class="text-sm text-neutral-500">
                Menampilkan {{ $products->firstItem() ?? 0 }}–{{ $products->lastItem() ?? 0 }} dari
                {{ $products->total() }} kategori
            </p>
            {{ $products->links() }}
        </div>
    </div>

</x-app-layout>
