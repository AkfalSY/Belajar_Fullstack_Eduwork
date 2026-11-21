<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/output.css">
    <title>login</title>
</head>
<body>
    <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/output.css">
    <title>Login</title>
</head>
<body class="min-h-screen bg-white text-slate-700 antialiased">
    <main class="grid min-h-screen lg:grid-cols-2">

        <!-- KOLOM KIRI: FORM -->
        <section class="flex items-center justify-center px-6 py-12 sm:px-12">
            <div class="w-full max-w-sm">
                <h1 class="mt-10 text-3xl font-bold text-blue-950">Selamat datang kembali</h1>
                <p class="mt-2 text-slate-500">Masuk untuk melanjutkan ke akunmu.</p>

                <form id="formLogin" action="proses.php" method="POST" class="mt-8 space-y-5">
                    <input type="hidden" name="aksi" value="login">

                    <div>
                        <label for="username" class="block text-sm font-medium text-slate-700">Username</label>
                        <input type="text" name="username" id="username" placeholder="Masukkan username" autocomplete="username" required
                            class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 placeholder:text-slate-400 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600/20">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                        <div class="relative mt-2">
                            <input type="password" name="password" id="password" placeholder="Masukkan password" autocomplete="current-password" required
                                class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-4 pr-28 text-slate-900 placeholder:text-slate-400 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600/20">
                            <button type="button" id="togglePassword" class="cursor-pointer absolute inset-y-0 right-0 px-4 text-sm font-medium text-blue-600 hover:text-blue-800">Tampilkan</button>
                        </div>
                    </div>

                    <button type="submit"
                        class="cursor-pointer w-full rounded-xl bg-blue-600 px-4 py-3 font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2">
                        Masuk
                    </button>
                </form>
            </div>
        </section>

        <!-- KOLOM KANAN: ILUSTRASI (disembunyikan di HP) -->
        <section class="relative hidden overflow-hidden bg-blue-600 lg:flex lg:flex-col lg:items-center lg:justify-center lg:px-12">
            <div class="absolute -right-20 -top-20 h-72 w-72 rounded-full bg-blue-500/60"></div>
            <div class="absolute -bottom-24 -left-16 h-80 w-80 rounded-full bg-blue-700/50"></div>

            <div class="relative z-10 w-full max-w-md text-center">
                <svg viewBox="0 0 400 320" class="mx-auto h-auto w-full" role="img" aria-label="Ilustrasi halaman login">
                    <rect x="40" y="40" width="320" height="230" rx="24" fill="#FFFFFF" fill-opacity="0.12" />
                    <rect x="70" y="70" width="260" height="210" rx="18" fill="#FFFFFF" />
                    <circle cx="92" cy="90" r="4" fill="#BFDBFE" />
                    <circle cx="106" cy="90" r="4" fill="#BFDBFE" />
                    <circle cx="120" cy="90" r="4" fill="#BFDBFE" />
                    <circle cx="120" cy="132" r="22" fill="#DBEAFE" />
                    <circle cx="120" cy="126" r="8" fill="#2563EB" />
                    <path d="M104 148a16 12 0 0 1 32 0z" fill="#2563EB" />
                    <rect x="160" y="120" width="100" height="10" rx="5" fill="#1E3A8A" />
                    <rect x="160" y="140" width="70" height="8" rx="4" fill="#BFDBFE" />
                    <rect x="95" y="170" width="210" height="28" rx="8" fill="#EFF6FF" stroke="#BFDBFE" />
                    <rect x="95" y="206" width="210" height="28" rx="8" fill="#EFF6FF" stroke="#BFDBFE" />
                    <rect x="95" y="244" width="210" height="24" rx="12" fill="#2563EB" />
                    <circle cx="330" cy="90" r="34" fill="#1D4ED8" stroke="#FFFFFF" stroke-width="4" />
                    <path d="M316 90l10 10 20-20" fill="none" stroke="#FFFFFF" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" />
                </svg>

                <h2 class="mt-8 text-2xl font-bold text-white">Kelola data dengan rapi dan mudah</h2>
                <p class="mt-2 text-blue-100">Masuk sekali, semua yang kamu butuhkan ada dalam satu tempat.</p>
            </div>
        </section>
    </main>

    <script src="script.js"></script>
</body>
</html>
</body>
</html>