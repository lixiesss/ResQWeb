<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Katalog Makanan</h1>
                <p class="text-sm text-gray-500 mt-1">Eksplorasi dan selamatkan makanan layak dari resto terdekat.</p>
            </div>

            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-xl flex items-center gap-3">
                    <span class="font-medium text-sm">{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-xl">
                    <span class="font-medium text-sm">{{ $errors->first() }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($foods as $food)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col hover:shadow-md transition">
                        @if($food->image)
                            <img src="{{ asset('storage/' . $food->image) }}" alt="{{ $food->name }}" class="w-full h-40 object-cover">
                        @else
                            <div class="w-full h-40 bg-orange-50 flex items-center justify-center border-b border-orange-100">
                                <span class="text-orange-300 font-medium text-sm">ResQ-Food</span>
                            </div>
                        @endif

                        <div class="p-5 flex-grow">
                            <div class="flex justify-between items-start mb-3">
                                <span class="bg-orange-100 text-orange-600 text-xs font-extrabold px-3 py-1 rounded-md tracking-wide">
                                    SISA: {{ $food->stock }}
                                </span>
                            </div>

                            <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $food->name }}</h3>
                            <a href="{{ route('toko.show', $food->seller_id) }}" class="text-sm text-gray-500 hover:text-orange-500 font-medium mb-3 block transition">
                                Toko: {{ $food->seller->store_name ?? $food->seller->name }}
                            </a>

                            <div class="grid grid-cols-2 gap-2 mb-4">
                                <div class="rounded-xl bg-slate-50 border border-slate-100 px-3 py-2">
                                    <p class="text-[11px] font-bold uppercase tracking-wide text-slate-400">Rating Toko</p>
                                    <p class="text-sm font-extrabold text-slate-800">{{ $food->store_avg_rating ? number_format($food->store_avg_rating, 1) : '-' }}/5</p>
                                </div>
                                <div class="rounded-xl bg-slate-50 border border-slate-100 px-3 py-2">
                                    <p class="text-[11px] font-bold uppercase tracking-wide text-slate-400">Rating Supplier</p>
                                    <p class="text-sm font-extrabold text-slate-800">{{ $food->supplier_avg_rating ? number_format($food->supplier_avg_rating, 1) : '-' }}/5</p>
                                </div>
                            </div>

                            <div class="mb-4 pt-4 border-t border-gray-100">
                                <p class="text-xs text-gray-400 uppercase tracking-wider font-bold mb-1">Harga Special</p>
                                <div class="flex items-center gap-2">
                                    <p class="text-2xl font-extrabold text-orange-600">Rp {{ number_format($food->discount_price, 0, ',', '.') }}</p>
                                    <p class="text-sm text-gray-400 line-through">Rp {{ number_format($food->original_price, 0, ',', '.') }}</p>
                                </div>
                                <p class="text-xs text-slate-500 mt-2">Biaya admin {{ config('resq.admin_fee_percentage') }}% akan ditambahkan saat order.</p>
                            </div>
                        </div>

                        <div class="p-5 pt-0">
                            <form
                                action="{{ route('order.store', $food->id) }}"
                                method="POST"
                                data-confirm-submit
                                data-confirm-title="Pesan makanan ini?"
                                data-confirm-text="Pesanan akan dikirim ke penjual. Pastikan kamu siap pickup tepat waktu."
                                data-confirm-button="Ya, pesan"
                                data-loading-message="Pesanan sedang dikirim ke penjual."
                            >
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <label class="flex items-start gap-2 text-xs text-gray-500 mb-3">
                                    <input type="checkbox" name="accepted_order_terms" value="1" class="mt-0.5 rounded border-gray-300 text-orange-500 focus:ring-orange-500" required>
                                    <span>Setuju <a href="{{ route('terms.show') }}" class="font-bold text-orange-600">T&C</a> dan siap pickup tepat waktu.</span>
                                </label>
                                <button type="submit" data-loading-text="Mengirim pesanan..." class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-4 rounded-xl shadow-sm transition">
                                    Pesan Sekarang
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-16 text-center bg-white rounded-2xl border border-gray-100">
                        <p class="text-gray-500 font-medium">Belum ada project makanan tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
