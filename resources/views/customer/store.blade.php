<x-app-layout>
    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ route('katalog.index') }}" class="text-sm font-semibold text-slate-500 hover:text-slate-800 mb-6 inline-block">&larr; Kembali ke Katalog</a>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8 mb-8 flex items-center gap-6">
                <div class="w-20 h-20 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 text-3xl font-black">
                    {{ substr($seller->store_name ?? $seller->name, 0, 1) }}
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Company Profile</p>
                    <h3 class="text-3xl font-extrabold text-slate-900">{{ $seller->store_name ?? $seller->name }}</h3>
                    <p class="text-slate-500 mt-2 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        {{ $seller->address ?? 'Alamat belum ditambahkan' }}
                    </p>
                </div>
            </div>

            <h4 class="text-xl font-extrabold mb-6 text-slate-900">List of Project (Makanan)</h4>

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($foods as $food)
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden flex flex-col hover:shadow-md transition">
                        <div class="p-5 flex-grow">
                            <h3 class="text-lg font-bold text-slate-900 mb-4">{{ $food->name }}</h3>
                            <div class="mb-4 pt-4 border-t border-slate-100">
                                <p class="text-xs text-slate-400 uppercase tracking-wider font-bold mb-1">Harga Special</p>
                                <div class="flex items-center gap-2">
                                    <p class="text-2xl font-extrabold text-slate-900">Rp {{ number_format($food->discount_price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-5 pt-0">
                            <form action="{{ route('order.store', $food->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-4 rounded-xl shadow-sm transition">
                                    + Assign Order
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-slate-500 text-center py-10 bg-white rounded-2xl border border-slate-100">
                        Tidak ada project aktif di perusahaan ini.
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>