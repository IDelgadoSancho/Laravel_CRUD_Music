<!-- Navigation -->
<nav>
    @if (Auth::check())
        <strong>Has fet login com a {{ Auth::user()->name }}</strong>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-dropdown-link>
        </form>
    @else
        <a href="{{ route('login') }}">LogIn</a>
        &nbsp;&nbsp;&nbsp;
        <a href="{{ route('register') }}">Register</a>
    @endif
    <br><br>
    <a href="{{ route('home') }}">Inici</a>
    &nbsp;&nbsp;&nbsp;
    <a href="{{ route('festival_list') }}">Festivals</a>
    &nbsp;&nbsp;&nbsp;
    <a href="">Concerts</a>
    &nbsp;&nbsp;&nbsp;
    <a href="">Artistes</a>
</nav>