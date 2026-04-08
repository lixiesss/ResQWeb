<section class="space-y-6">
    <header>
        <h2 class="text-xl font-bold text-red-600">Hapus Akun</h2>
        <p class="mt-1 text-sm text-gray-500">Tindakan ini permanen. Semua data Anda akan dihapus selamanya.</p>
    </header>

    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" class="bg-red-50 hover:bg-red-600 text-red-600 hover:text-white font-bold py-2.5 px-6 rounded-xl border border-red-100 shadow-sm transition">
        Hapus Akun Permanen
    </button>

    <x-modal name="confirm-user-deletion" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8 bg-white rounded-2xl">
            @csrf
            @method('delete')
            
            <h2 class="text-xl font-extrabold text-gray-900 mb-2 text-center">Konfirmasi Penghapusan</h2>
            <p class="text-sm text-gray-500 text-center mb-6">Tindakan ini tidak dapat dibatalkan. Masukkan sandi Anda untuk melanjutkan.</p>
            
            <div>
                <input name="password" type="password" class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:bg-white focus:border-red-500 focus:ring-2 focus:ring-red-200 transition-colors text-sm font-semibold text-gray-800" placeholder="Masukkan Sandi Anda" required />
                
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-red-500 text-sm font-medium" />
            </div>
            
            <div class="flex justify-end gap-3 mt-6 pt-6 border-t border-gray-50">
                <button type="button" x-on:click="$dispatch('close')" class="px-6 py-2.5 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-xl font-bold transition">
                    Batal
                </button>
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2.5 rounded-xl font-bold shadow-sm transition">
                    Ya, Hapus Akun
                </button>
            </div>
        </form>
    </x-modal>
</section>