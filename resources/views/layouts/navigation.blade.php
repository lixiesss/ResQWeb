<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-8">
                <div class="shrink-0 flex items-center gap-3">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-orange-500 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-sm">R</span>
                        </div>
                        <span class="text-gray-900 font-extrabold text-lg tracking-tight hidden sm:block">ResQ-Food</span>
                        <span class="bg-orange-100 text-orange-600 text-[10px] font-extrabold px-2 py-1 rounded tracking-wider uppercase ml-1">
                            {{ Auth::user()->role }}
                        </span>
                    </a>
                </div>

                <div class="hidden space-x-6 sm:flex h-full">
                    @if(Auth::user()->role == 'seller')
                        <a href="{{ route('seller.dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-semibold transition duration-150 ease-in-out {{ request()->routeIs('seller.dashboard') ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-500 hover:text-orange-500 hover:border-orange-300' }}">Stok Makanan</a>
                        <a href="{{ route('seller.orders') }}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-semibold transition duration-150 ease-in-out {{ request()->routeIs('seller.orders') ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-500 hover:text-orange-500 hover:border-orange-300' }}">Pesanan Masuk</a>
                    @endif

                    @if(Auth::user()->role == 'customer')
                        <a href="{{ route('katalog.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-semibold transition duration-150 ease-in-out {{ request()->routeIs('katalog.index') ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-500 hover:text-orange-500 hover:border-orange-300' }}">Katalog</a>
                        <a href="{{ route('order.history') }}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-semibold transition duration-150 ease-in-out {{ request()->routeIs('order.history') ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-500 hover:text-orange-500 hover:border-orange-300' }}">Pesanan Saya</a>
                    @endif

                    @if(Auth::user()->role == 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-semibold transition duration-150 ease-in-out {{ request()->routeIs('admin.dashboard') ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-500 hover:text-orange-500 hover:border-orange-300' }}">Dashboard</a>
                    @endif

                    <a href="{{ route('terms.show') }}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-semibold transition duration-150 ease-in-out {{ request()->routeIs('terms.show') ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-500 hover:text-orange-500 hover:border-orange-300' }}">T&C</a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:gap-6">
                <a href="{{ route('profile.edit') }}" class="text-sm font-medium text-gray-500 hover:text-orange-500 transition">
                    Halo, {{ Auth::user()->name }}
                </a>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold px-4 py-2 rounded-lg transition">
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
