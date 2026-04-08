<x-guest-layout>
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-50 px-4 overflow-y-auto py-10">
        <div class="max-w-xl w-full bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row border border-gray-100">
            <div class="w-full p-10 flex flex-col justify-center">
                <h2 class="text-3xl font-black text-gray-900 mb-2">Daftar Akun</h2>
                <p class="text-sm text-gray-500 mb-8">Bergabunglah untuk menyelamatkan makanan.</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Nama Lengkap</label>
                            <input type="text" name="name" class="w-full px-4 py-2.5 rounded-lg bg-gray-50 border border-gray-200 focus:border-orange-500 text-sm" required />
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Email</label>
                            <input type="email" name="email" class="w-full px-4 py-2.5 rounded-lg bg-gray-50 border border-gray-200 focus:border-orange-500 text-sm" required />
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Kata Sandi</label>
                        <input type="password" name="password" class="w-full px-4 py-2.5 rounded-lg bg-gray-50 border border-gray-200 focus:border-orange-500 text-sm" required />
                    </div>

                    <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-4 rounded-xl shadow-lg transition">BUAT AKUN SEKARANG</button>
                </form>
                <p class="text-center text-sm text-gray-500 mt-6">Sudah punya akun? <a href="{{ route('login') }}" class="text-orange-600 font-bold">Masuk</a></p>
            </div>
        </div>
    </div>
</x-guest-layout>