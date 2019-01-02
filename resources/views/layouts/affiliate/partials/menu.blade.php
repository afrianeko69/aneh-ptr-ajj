
<nav class="c-mega-menu c-pull-right c-mega-menu-dark c-mega-menu-dark-mobile c-fonts-uppercase c-fonts-bold">
    <ul class="nav navbar-nav c-theme-nav">
        @if (!empty(auth()->user()))
        <li class="">
            <a href="{{ route('affiliate.logout') }}" class="c-link dropdown-toggle">LOGOUT<span class="c-arrow c-toggler"></span></a>
        </li>
        @else
        <li class="{{ (Request::url() === route('affiliate.index')) ? 'c-active' : '' }}">
            <a href="{{ route('affiliate.index') }}" class="c-link dropdown-toggle">LOGIN<span class="c-arrow c-toggler"></span></a>
        </li>
        @endif
    </ul>
</nav>