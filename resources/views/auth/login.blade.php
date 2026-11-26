<x-auth-layout title="Masuk" heading="Selamat datang kembali" subheading="Masuk untuk lanjut belanja di Jingga."
    :active="1">

    <x-auth-session-status class="mt-4 text-center text-sm text-green-600" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-5">
        @csrf

        <div>
            <label for="email" class="mb-1.5 block text-xs font-semibold text-neutral-700">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                autocomplete="username" placeholder="nama@email.com"
                class="w-full rounded-xl border border-transparent bg-neutral-100 px-4 py-3.5 text-sm text-neutral-900 outline-none placeholder:text-neutral-400 focus:border-[#EA6A2E] focus:bg-white focus:ring-4 focus:ring-[#EA6A2E]/15" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <div>
            <label for="password" class="mb-1.5 block text-xs font-semibold text-neutral-700">Password</label>
            <div class="relative">
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    placeholder="Masukkan password"
                    class="w-full rounded-xl border border-transparent bg-neutral-100 py-3.5 pl-4 pr-28 text-sm text-neutral-900 outline-none placeholder:text-neutral-400 focus:border-[#EA6A2E] focus:bg-white focus:ring-4 focus:ring-[#EA6A2E]/15" />
                <button type="button" onclick="togglePassword('password', this)"
                    class="absolute right-4 top-1/2 -translate-y-1/2 text-xs font-semibold text-neutral-500 hover:text-[#EA6A2E]">Lihat</button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <div class="flex items-center justify-between text-sm">
            <label for="remember_me" class="inline-flex cursor-pointer items-center gap-x-2 text-neutral-600">
                <input id="remember_me" type="checkbox" name="remember"
                    class="size-4 rounded border-neutral-300 text-[#EA6A2E] focus:ring-[#EA6A2E]" />
                Ingat saya
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="font-semibold text-[#EA6A2E] hover:underline">Lupa
                    password?</a>
            @endif
        </div>

        <button type="submit"
            class="w-full rounded-xl bg-[#EA6A2E] px-4 py-3.5 text-sm font-bold text-white transition-colors hover:bg-neutral-900 focus:outline-none focus-visible:ring-4 focus-visible:ring-[#EA6A2E]/30">
            Masuk
        </button>

        {{-- <p class="text-center text-sm text-neutral-500">
            Belum punya akun?
            <a href="{{ route('register') }}" class="font-semibold text-[#EA6A2E] hover:underline">Daftar</a>
        </p> --}}

        <div class="flex items-center gap-x-3 text-xs text-neutral-400">
            <span class="h-px flex-1 bg-neutral-200"></span> Atau <span class="h-px flex-1 bg-neutral-200"></span>
        </div>

        {{-- Tampilan saja. Perlu Laravel Socialite agar benar-benar berfungsi --}}
        <a href="#"
            class="flex w-full items-center justify-center gap-x-2 rounded-xl border border-neutral-200 px-4 py-3.5 text-sm font-semibold text-neutral-800 transition-colors hover:bg-neutral-50">
            <svg class="size-5" viewBox="0 0 24 24">
                <path fill="#4285F4"
                    d="M23.5 12.3c0-.8-.1-1.6-.2-2.3H12v4.5h6.5a5.6 5.6 0 0 1-2.4 3.7v3h3.9c2.3-2.1 3.5-5.2 3.5-8.9Z" />
                <path fill="#34A853"
                    d="M12 24c3.2 0 6-1.1 7.9-2.9l-3.9-3c-1.1.7-2.4 1.1-4 1.1-3.1 0-5.7-2.1-6.6-4.9H1.4v3.1A12 12 0 0 0 12 24Z" />
                <path fill="#FBBC05" d="M5.4 14.3a7.2 7.2 0 0 1 0-4.6V6.6H1.4a12 12 0 0 0 0 10.8l4-3.1Z" />
                <path fill="#EA4335"
                    d="M12 4.8c1.8 0 3.3.6 4.6 1.8l3.4-3.4A12 12 0 0 0 1.4 6.6l4 3.1C6.3 6.9 8.9 4.8 12 4.8Z" />
            </svg>
            Masuk dengan Google
        </a>
    </form>
</x-auth-layout>
