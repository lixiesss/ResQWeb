<x-guest-layout>
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-50 sm:px-6 lg:px-8">
        
        <div class="max-w-4xl w-full bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col md:flex-row">
            
            <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center bg-white">
                <div class="flex items-center gap-2 mb-8">
                    <div class="w-8 h-8 bg-orange-500 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold">R</span>
                    </div>
                    <span class="text-xl font-bold text-gray-800 tracking-tight">ResQ-Food</span>
                </div>

                <h2 class="text-2xl font-bold text-gray-900 mb-2">Selamat Datang 👋</h2>
                <p class="text-sm text-gray-500 mb-8">Silakan masukkan akun Anda untuk mulai menyelamatkan makanan.</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-2">Email / Username</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:bg-white focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-colors text-sm" placeholder="contoh: agus@gmail.com">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-2">Kata Sandi</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password" class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:bg-white focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-colors text-sm" placeholder="••••••••">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between mb-8">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-orange-600 shadow-sm focus:ring-orange-500">
                            <span class="ms-2 text-sm text-gray-600">Ingat Saya</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm font-medium text-orange-600 hover:text-orange-500" href="{{ route('password.request') }}">
                                Lupa Sandi?
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-4 rounded-lg transition duration-150 shadow-md hover:shadow-lg">
                        MASUK APLIKASI
                    </button>
                </form>

                <p class="text-center text-sm text-gray-600 mt-8">
                    Belum mendaftar? 
                    <a href="{{ route('register') }}" class="font-bold text-orange-600 hover:text-orange-500">Buat Akun</a>
                </p>
            </div>

            <div class="hidden md:flex w-full md:w-1/2 bg-gradient-to-br from-orange-400 to-orange-600 p-12 text-white flex-col justify-center relative overflow-hidden">
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-white opacity-10 rounded-full blur-2xl"></div>
                <div class="absolute -bottom-24 -left-24 w-48 h-48 bg-white opacity-10 rounded-full blur-xl"></div>
                
                <div class="relative z-10 flex flex-col items-end text-right">
                    <div class="flex gap-4 mb-16 text-xs font-semibold tracking-wider text-orange-100 uppercase">
                        <a href="#" class="hover:text-white transition">Tentang Kami</a>
                        <a href="#" class="hover:text-white transition">Bantuan</a>
                    </div>
                    
                    <h1 class="text-4xl font-extrabold mb-4 leading-tight">ResQ-Food<br>Marketplace</h1>
                    <p class="text-lg text-orange-50 font-medium">Dari langkah kecil, cegah food waste, ciptakan kelestarian lingkungan bersama.</p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>