@php
    use App\Models\User;
@endphp

<!-- Navigation -->

<nav class="bg-gray-800 p-4 flex items-center justify-between">
    <div>
        @if (Auth::check())
            <span class="rounded-md px-3 py-2 text-lg font-medium text-[#FF3427]">Has fet login com a
                {{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" class="inline-block">
                @csrf
                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                    <span class="rounded-md px-3 py-2 font-thin text-white hover:bg-gray-700">{{ __('Log Out') }}
                        <img src="{{ asset('images/log_out.svg') }}" alt="Delete"
                            class="w-auto h-5 ml-1 inline-block"></span>
                </x-dropdown-link>
            </form>
        @else
            <a href="{{ route('login') }}"
                class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-gray-700">LogIn</a>
            &nbsp;&nbsp;&nbsp;
            <a href="{{ route('register') }}"
                class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-gray-700">Register</a>
        @endif
        <br><br>
        <a href="{{ route('home') }}"
            class="rounded-md px-3 py-2 text-base font-bold text-white hover:bg-gray-700">Inici</a>
        &nbsp;&nbsp;&nbsp;
        <a href="{{ route('festival_list') }}"
            class="rounded-md px-3 py-2 text-base font-bold text-white hover:bg-gray-700">Festivals</a>
        &nbsp;&nbsp;&nbsp;
        <a href="{{ route('concert_list') }}"
            class="rounded-md px-3 py-2 text-base font-bold text-white hover:bg-gray-700">Concerts</a>
        &nbsp;&nbsp;&nbsp;
        <a href="{{ route('artista_list') }}"
            class="rounded-md px-3 py-2 text-base font-bold text-white hover:bg-gray-700">Artistes</a>
        &nbsp;&nbsp;&nbsp;
        @if (Auth::check() && Auth::user()->isAdmin())
            <a href="{{ route('user_list') }}"
                class="rounded-md px-3 py-2 text-base font-bold text-white hover:bg-gray-700">Usuaris</a>
        @endif

    </div>
    <div>
        <img src="{{ asset('images/laravel_logo.png') }}" alt="Logo" class="h-15 mr-5">
    </div>
</nav>