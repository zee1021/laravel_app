<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center">
    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
    </x-nav-link>

    @auth
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