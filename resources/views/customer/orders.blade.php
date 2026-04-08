<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-xl flex items-center gap-3 shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span class="font-medium text-sm">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-6 border-b border-gray-100 flex justify-between items-center bg-white">
                    <div>
                        <h3 class="text-xl font-extrabold text-gray-900 tracking-tight">Pesanan Saya</h3>
                        <p class="text-sm text-gray-500 mt-1">Monitoring makanan yang harus kamu ambil (pickup).</p>
                    </div>
                    <a href="{{ route('katalog.index') }}" class="bg-orange-500 hover:bg-orange-600 text-white text-sm font-bold py-2.5 px-5 rounded-lg shadow-sm transition">
                        + Cari Makanan Baru
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-white border-b border-gray-100">
                                <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-wider">Task ID</th>
                                <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-wider">Project Item (Makanan)</th>
                                <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-wider">Penjual (Toko)</th>
                                <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-wider text-center">Qty</th>
                                <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-wider">Waktu Ambil</th>
                                <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($orders as $order)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="py-5 px-6">
                                        <span class="text-sm font-bold text-orange-600">#TASK-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                                    </td>
                                    <td class="py-5 px-6">
                                        <p class="text-sm font-bold text-gray-800">{{ $order->food->name }}</p>
                                        <p class="text-xs text-gray-500 mt-0.5">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                    </td>
                                    <td class="py-5 px-6 flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 font-bold text-xs">
                                            {{ substr($order->food->seller->store_name ?? $order->food->seller->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-gray-700">{{ $order->food->seller->store_name ?? $order->food->seller->name }}</p>
                                        </div>
                                    </td>
                                    <td class="py-5 px-6 text-center">
                                        <span class="text-lg font-extrabold text-gray-800">{{ $order->quantity }}</span>
                                    </td>
                                    <td class="py-5 px-6 text-sm text-gray-500 font-medium">
                                        {{ \Carbon\Carbon::parse($order->food->pickup_time_start)->format('H:i') }} - {{ \Carbon\Carbon::parse($order->food->pickup_time_end)->format('H:i') }}
                                    </td>
                                    <td class="py-5 px-6">
                                        @if($order->status == 'pending')
                                            <span class="inline-flex px-3 py-1 rounded-full border border-yellow-200 bg-yellow-50 text-yellow-700 text-xs font-bold tracking-wide">PROSES AMBIL</span>
                                        @elseif($order->status == 'completed')
                                            <span class="inline-flex px-3 py-1 rounded-full border border-green-200 bg-green-50 text-green-700 text-xs font-bold tracking-wide">SELESAI</span>
                                        @else
                                            <span class="inline-flex px-3 py-1 rounded-full border border-red-200 bg-red-50 text-red-700 text-xs font-bold tracking-wide">BATAL</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-12 text-center">
                                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3 text-gray-400">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                        </div>
                                        <p class="text-gray-500 font-medium">Belum ada task pesanan saat ini.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>