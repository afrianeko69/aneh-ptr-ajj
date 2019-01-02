<div id="main_menu">
    <div class="container">
        <nav class="version_2">
            <div class="row">
                <div class="col-md-3">
                    <a href="{{ route('category.index') }}" rel="relativeanchor">
                        <h3>Kategori Program</h3>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('profession.index') }}">
                        <h3>Info Profesi</h3>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('blog') }}">
                        <h3>Blog</h3>
                    </a>
                </div>
                @if(auth()->user())
                    <div class="col-md-3">
                        <h3>Kelas dan Akun</h3>
                        <ul>
                            <li>
                                <a href="{{ route('kelas.saya') }}">
                                    Kelas Saya
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('akun.saya') }}">
                                    Akun Saya
                                </a>
                            </li>
                        </ul>
                    </div>
                @endif
                @if(auth()->guest())
                    <div class="col-md-3">
                        <a href="{{ route('masuk') }}">
                            <h3>Masuk</h3>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('daftar') }}">
                            <h3>Daftar</h3>
                        </a>
                    </div>
                @else
                    <div class="col-md-3">
                        <a href="{{ route('keluar') }}">
                            <h3>Keluar</h3>
                        </a>
                    </div>
                @endif
            </div>
        </nav>
    </div>
</div>