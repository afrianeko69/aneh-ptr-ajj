<nav id="menu" class="main-menu">
    <ul id="top_menu">

        <li class="">
            <span>
                <a href="{{route('category.index')}}" class="c-link ">KATEGORI PROGRAM<span class="c-arrow c-toggler"></span></a>
            </span>
        </li>
        <li class="">
            <span>
                <a href="{{route('profession.index')}}" class="c-link ">INFO PROFESI<span class="c-arrow c-toggler"></span></a>
            </span>
        </li>
        <li class="">
            <span>
                <a href="{{route('blog')}}" class="c-link ">BLOG<span class="c-arrow c-toggler"></span></a>
            </span>
        </li>
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
            <li class="{{ (Request::url() === route('kelas.saya')) ? 'c-active' : '' }}">
                <span>
                    <a href="{{ route('kelas.saya') }}" class="c-link ">KELAS SAYA<span class="c-arrow c-toggler"></span></a>
                </span>
            </li>
            <li>
                {!! Form::open(['url' => route('home.global.search'),'method' => 'get']) !!}
                    <global-search {!! !empty($search_placeholder) ? 'search-placeholder=\'' . strip_tags($search_placeholder->description) . '\'' : '' !!}></global-search>
                {!! Form::close() !!}
            </li>
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
                    <div class="row">
                        <div class="col-12">
                            <a class="akun-saya mt-0" href="{{ route('akun.saya') }}"><i class="fa fa-user mr-1"></i>Akun Saya</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('keluar') }}" class="logout">Keluar</a>
                        </div>
                    </div>
                </div>
            </li>
            <li class="{{ (Request::url() === route('akun.saya')) ? 'c-active' : '' }} show-mobile">
                <a href="{{ route('akun.saya') }}" class="c-link ">AKUN SAYA<span class="c-arrow c-toggler"></span></a>
            </li>
        @endif
        @if(Auth::guest())
            <li>
                {!! Form::open(['url' => route('home.global.search'),'method' => 'get']) !!}
                    <global-search {!! !empty($search_placeholder) ? 'search-placeholder=\'' . strip_tags($search_placeholder->description) . '\'' : '' !!}></global-search>
                {!! Form::close() !!}
            </li>
            <li class="{{ (Request::url() === route('masuk')) ? 'c-active' : '' }}">
                <span>
                    <a href="{{ route('masuk') }}" class="c-link ">MASUK<span class="c-arrow c-toggler"></span></a>
                </span>
            </li>
            <li class="hidden_tablet"><a href="{{ route('daftar') }}" class="btn_1 rounded blue">DAFTAR</a></li>
            <li class="show-mobile"><a href="{{ route('daftar') }}" >DAFTAR</a></li>
        @else
            <li class="{{ (Request::url() === route('keluar')) ? 'c-active' : '' }} show-mobile">
                <span>
                    <a href="{{ route('keluar') }}" class="c-link ">KELUAR<span class="c-arrow c-toggler"></span></a>
                </span>
            </li>
        @endif
    </ul>
</nav>