<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-xl flex items-center gap-3 shadow-sm">
                    <span class="font-medium text-sm">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-6 border-b border-gray-100 flex flex-col md:flex-row md:justify-between md:items-center bg-white gap-4">
                    <div>
                        <h3 class="text-xl font-extrabold text-gray-900 tracking-tight">Manajemen Stok Makanan</h3>
                        <p class="text-sm text-gray-500 mt-1">Kelola sisa makanan hari ini agar tidak terbuang sia-sia.</p>
                    </div>
                    <a href="{{ route('food.create') }}" class="inline-flex items-center justify-center bg-orange-500 hover:bg-orange-600 text-white text-sm font-bold py-2.5 px-5 rounded-lg shadow-sm transition gap-2">
                        + Tambah Makanan
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 border-b border-gray-100">
                                <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-wider">Info Makanan</th>
                                <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-wider">Harga</th>
                                <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-wider text-center">Sisa Stok</th>
                                <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-wider">Waktu Pickup</th>
                                <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-wider text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($foods as $food)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="py-4 px-6">
                                        <p class="text-sm font-bold text-gray-800">{{ $food->name }}</p>
                                        <p class="text-xs text-gray-400 mt-1">{{ $food->description ?: 'Tidak ada deskripsi' }}</p>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="text-sm font-extrabold text-orange-600">Rp {{ number_format($food->discount_price, 0, ',', '.') }}</span>
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <span class="inline-flex items-center justify-center px-3 py-1 rounded-md {{ $food->stock > 0 ? 'bg-orange-100 text-orange-700' : 'bg-gray-100 text-gray-500' }} font-bold text-xs">
                                            {{ $food->stock }} porsi
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-sm text-gray-500 font-medium">
                                        {{ \Carbon\Carbon::parse($food->pickup_time_start)->format('H:i') }} - {{ \Carbon\Carbon::parse($food->pickup_time_end)->format('H:i') }}
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <form
                                            action="{{ route('food.destroy', $food->id) }}"
                                            method="POST"
                                            id="delete-form-{{ $food->id }}"
                                            data-confirm-submit
                                            data-confirm-title="Hapus makanan ini?"
                                            data-confirm-text="Menu akan dihapus permanen dari katalog dan tidak bisa dikembalikan."
                                            data-confirm-button="Ya, hapus"
                                            data-confirm-icon="warning"
                                            data-loading-message="Makanan sedang dihapus."
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" data-loading-text="Menghapus..." class="text-gray-400 hover:text-red-600 transition">
                                                <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-12 text-center text-gray-500 font-medium">Belum ada makanan yang diunggah.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
