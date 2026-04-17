<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center">
    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
        {{ __('Marketplace') }}
    </x-nav-link>

    @auth
        <x-nav-link :href="route('seller.dashboard')" :active="request()->routeIs('seller.*')">
            {{ __('Seller Dashboard') }}
        </x-nav-link>

        <a href="{{ route('items.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
            Post an Item
        </a>
    @endauth

    @guest
        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">
            Login to Sell
        </a>
    @endguest
</div>
<!-- Responsive Navigation Menu -->
<div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
    <div class="pt-2 pb-3 space-y-1">
        <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
            {{ __('Marketplace') }}
        </x-responsive-nav-link>

        <!-- Add your new responsive Seller Dashboard link here -->
        <x-responsive-nav-link :href="route('seller.dashboard')" :active="request()->routeIs('seller.*')">
            {{ __('Seller Dashboard') }}
        </x-responsive-nav-link>
    </div>
    
    <!-- ... -->
