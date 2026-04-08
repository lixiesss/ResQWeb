<section>
    <header class="mb-6 border-b border-gray-50 pb-4">
        <h2 class="text-xl font-bold text-gray-900">Ubah Kata Sandi</h2>
        <p class="mt-1 text-sm text-gray-500">Gunakan kata sandi yang kuat untuk menjaga keamanan akun.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div>
            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Sandi Saat Ini</label>
            <input name="current_password" type="password" class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 text-sm" />
        </div>

        <div>
            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Sandi Baru</label>
            <input name="password" type="password" class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 text-sm" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2.5 px-6 rounded-xl shadow-sm transition">Perbarui Sandi</button>
        </div>
    </form>
</section>