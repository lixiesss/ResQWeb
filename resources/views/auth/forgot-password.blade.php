<x-guest-layout>
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-50 px-4">
        <div class="max-w-md w-full bg-white rounded-2xl shadow-xl p-10 border border-gray-100">
            <div class="flex justify-center mb-8">
                <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center text-white font-black text-xl">R</div>
            </div>
            
            <h2 class="text-2xl font-black text-gray-900 text-center mb-2">Lupa Sandi?</h2>
            <p class="text-sm text-gray-500 text-center mb-8">Masukkan email Anda dan kami akan mengirimkan tautan pemulihan.</p>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="mb-6">
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Email Akun</label>
                    <input type="email" name="email" class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 text-sm" required />
                </div>
                <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-4 rounded-xl shadow-md transition">KIRIM TAUTAN RESET</button>
            </form>
        </div>
    </div>
</x-guest-layout>