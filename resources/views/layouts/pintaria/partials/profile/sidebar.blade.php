<div class="c-layout-sidebar-menu c-theme ">
    <div class="c-sidebar-menu-toggler">
        <h3 class="c-title c-font-uppercase c-font-bold">Akun Saya</h3>
        <a href="javascript:;" class="c-content-toggler" data-toggle="collapse" data-target="#sidebar-menu-1">
            <span class="c-line"></span> <span class="c-line"></span> <span class="c-line"></span>
        </a>
    </div>

    <ul class="c-sidebar-menu collapse " id="sidebar-menu-1">
        <li class="{{ (Request::url() == route('akun.saya')) ? 'c-active': '' }}">
            <a href="{{ route('akun.saya') }}">Akun Saya</a>
        </li>
        <li class="{{ (Request::url() == route('ubah.akun.saya')) ? 'c-active': '' }}">
            <a href="{{ route('ubah.akun.saya') }}">Perbarui Akun Saya</a>
        </li>
        <li class="{{ (Request::url() == route('my.transaction')) ? 'c-active': '' }}">
            <a href="{{ route('my.transaction') }}">Transaksi Saya</a>
        </li>
        <li class="{{ (Request::url() == route('ubah.password.saya')) ? 'c-active': '' }}">
            <a href="{{ route('ubah.password.saya') }}">Perbarui Password Saya</a>
        </li>
    </ul>
</div>
