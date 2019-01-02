
<nav class="c-mega-menu c-pull-right c-mega-menu-dark c-mega-menu-dark-mobile c-fonts-uppercase c-fonts-bold">
    <ul class="nav navbar-nav c-theme-nav">
        @if(Auth::check())
            @php
                $activeUser = Auth::user();
                $initial = 'nn';

                $words = explode(' ', trim(ucwords($activeUser->name)));
                $words_count = count($words);
                if($words_count == 1) {
                    $initial = $words[0][0] . $words[0][0];
                } elseif ($words_count > 1) {
                    $initial = $words[0][0] . $words[$words_count - 1][0];
                }
            @endphp
            <li class="user hide-mobile">
                <span class="user-pic">
                    @if($activeUser->profile_picture)
                        <img src="{{ route('asset', [$activeUser->profile_picture]) }}">
                    @else
                        {{ $initial }}
                    @endif
                </span>
                <div class="user-dropdown">
                    <div class="user-detail">
                        <span class="avatar">
                            @if($activeUser->profile_picture)
                                <img src="{{ route('asset', [$activeUser->profile_picture]) }}">
                            @else
                                {{ $initial }}
                            @endif
                        </span>
                        <p>{{ $activeUser->name }} <br/><span>{{ $activeUser->email }}</span></p>
                    </div>
                    <a href="{{ route('akun.saya') }}"><i class="fa fa-user"></i>akun saya</a>
                    <a href="{{ route('keluar') }}" class="logout">keluar</a>
                </div>
            </li>
            <li class="{{ (Request::url() === route('kelas.saya')) ? 'c-active' : '' }}">
                <a href="{{ route('kelas.saya') }}" class="c-link ">KELAS SAYA<span class="c-arrow c-toggler"></span></a>
            </li>
            <li class="{{ (Request::url() === route('akun.saya')) ? 'c-active' : '' }} show-mobile">
                <a href="{{ route('akun.saya') }}" class="c-link ">AKUN SAYA<span class="c-arrow c-toggler"></span></a>
            </li>
        @endif
        <li class="{{ (Request::url() === route('hubungi.kami')) ? 'c-active' : '' }}">
            <a href="{{ route('hubungi.kami') }}" class="c-link ">HUBUNGI KAMI<span class="c-arrow c-toggler"></span></a>
        </li>
        <li class="{{ (Request::url() === route('tentang.kami')) ? 'c-active' : '' }}">
            <a href="{{ route('tentang.kami') }}" class="c-link ">TENTANG KAMI<span class="c-arrow c-toggler"></span></a>
        </li>
        @if(Auth::guest())
            <li class="{{ (Request::url() === route('masuk')) ? 'c-active' : '' }}">
                <a href="{{ route('masuk') }}" class="c-link ">Masuk<span class="c-arrow c-toggler"></span></a>
            </li>
            <li>
                <a href="{{ route('daftar') }}" class="btn c-btn btn-no-focus c-btn-square c-btn-uppercase c-btn-bold c-theme-btn">Daftar</a>
            </li>
        @else
            <li class="{{ (Request::url() === route('keluar')) ? 'c-active' : '' }} show-mobile">
                <a href="{{ route('keluar') }}" class="c-link ">Keluar<span class="c-arrow c-toggler"></span></a>
            </li>
        @endif
    </ul>
</nav>
