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
                                🏪 {{ $food->seller->store_name ?? $food->seller->name }}
                            </a>
                            
                            <div class="mb-4 pt-4 border-t border-gray-100">
                                <p class="text-xs text-gray-400 uppercase tracking-wider font-bold mb-1">Harga Special</p>
                                <div class="flex items-center gap-2">
                                    <p class="text-2xl font-extrabold text-orange-600">Rp {{ number_format($food->discount_price, 0, ',', '.') }}</p>
                                    <p class="text-sm text-gray-400 line-through">Rp {{ number_format($food->original_price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-5 pt-0">
                            <form action="{{ route('order.store', $food->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-4 rounded-xl shadow-sm transition">
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