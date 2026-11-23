<x-auth-layout title="Daftar" heading="Buat akun Jingga" subheading="Daftar gratis dan mulai belanja hari ini."
    :active="1">

    <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-5">
        @csrf

        <div>
            <label for="name" class="mb-1.5 block text-xs font-semibold text-neutral-700">Nama lengkap</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                autocomplete="name" placeholder="Contoh: Akfal Shamid"
                class="w-full rounded-xl border border-transparent bg-neutral-100 px-4 py-3.5 text-sm text-neutral-900 outline-none placeholder:text-neutral-400 focus:border-[#EA6A2E] focus:bg-white focus:ring-4 focus:ring-[#EA6A2E]/15" />
            <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
        </div>

        <div>
            <label for="email" class="mb-1.5 block text-xs font-semibold text-neutral-700">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                autocomplete="username" placeholder="nama@email.com"
                class="w-full rounded-xl border border-transparent bg-neutral-100 px-4 py-3.5 text-sm text-neutral-900 outline-none placeholder:text-neutral-400 focus:border-[#EA6A2E] focus:bg-white focus:ring-4 focus:ring-[#EA6A2E]/15" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <div class="grid gap-5 sm:grid-cols-2">
            <div>
                <label for="password" class="mb-1.5 block text-xs font-semibold text-neutral-700">Password</label>
                <div class="relative">
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                        placeholder="Min. 8 karakter"
                        class="w-full rounded-xl border border-transparent bg-neutral-100 py-3.5 pl-4 pr-16 text-sm text-neutral-900 outline-none placeholder:text-neutral-400 focus:border-[#EA6A2E] focus:bg-white focus:ring-4 focus:ring-[#EA6A2E]/15" />
                    <button type="button" onclick="togglePassword('password', this)"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-xs font-semibold text-neutral-500 hover:text-[#EA6A2E]">Lihat</button>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
            </div>

            <div>
                <label for="password_confirmation"
                    class="mb-1.5 block text-xs font-semibold text-neutral-700">Konfirmasi password</label>
                <div class="relative">
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        autocomplete="new-password" placeholder="Ulangi password"
                        class="w-full rounded-xl border border-transparent bg-neutral-100 py-3.5 pl-4 pr-16 text-sm text-neutral-900 outline-none placeholder:text-neutral-400 focus:border-[#EA6A2E] focus:bg-white focus:ring-4 focus:ring-[#EA6A2E]/15" />
                    <button type="button" onclick="togglePassword('password_confirmation', this)"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-xs font-semibold text-neutral-500 hover:text-[#EA6A2E]">Lihat</button>
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
            </div>
        </div>

        <button type="submit"
            class="w-full rounded-xl bg-[#EA6A2E] px-4 py-3.5 text-sm font-bold text-white transition-colors hover:bg-neutral-900 focus:outline-none focus-visible:ring-4 focus-visible:ring-[#EA6A2E]/30">
            Buat akun
        </button>

        <p class="text-center text-sm text-neutral-500">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-semibold text-[#EA6A2E] hover:underline">Masuk</a>
        </p>

        <p class="text-center text-xs leading-relaxed text-neutral-400">
            Dengan mendaftar, kamu menyetujui Syarat &amp; Ketentuan dan Kebijakan Privasi Jingga.
        </p>
    </form>
</x-auth-layout>
