<nav class="clickable_secondary_nav sticky_horizontal scroll-tab">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="clearfix">
                    <li><a href="{{ route('akun.saya') }}" class="{{ Request::url() == route('akun.saya') ? 'active' : '' }}">Akun Saya</a></li>
                    <li><a href="{{ route('ubah.akun.saya') }}" class="{{ Request::url() == route('ubah.akun.saya') ? 'active' : '' }}">Perbarui Akun Saya</a></li>
                    <li><a href="{{ route('my.transaction') }}" class="{{ Request::url() == route('my.transaction') ? 'active' : '' }}">Transaksi Saya</a></li>
                    <li><a href="{{ route('ubah.password.saya') }}" class="{{ Request::url() == route('ubah.password.saya') ? 'active' : '' }}">Perbarui Password Saya</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>