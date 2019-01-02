<div class="col-md-3 bg_color_1 add_padding_20">
    <div class="c-sidebar-menu-toggler">
        <h3 class="c-title c-font-uppercase c-font-bold">My Menu</h3>
        <a href="javascript:;" class="c-content-toggler" data-toggle="collapse" data-target="#sidebar-menu-1">
            <span class="c-line"></span> <span class="c-line"></span> <span class="c-line"></span>
        </a>
    </div>

    <div class="collapse show" id="collapseFilters" style="">
        <div class="filter_type">
            <ul>
                <li class="c-dropdown c-open">
                    <ul class="c-dropdown-menu">
                        <li class="{{ (Request::url() === route('affiliate.settings')) ? 'c-active' : '' }}">
                            <a href="{{ route('affiliate.settings') }}">Settings</a>
                        </li>
                        <li class="{{ (Request::url() === route('affiliate-product.index')) ? 'c-active' : '' }}">
                            <a href="{{ route('affiliate-product.index') }}">Product Thumbnails</a>
                        </li>
                        <li class="{{ (Request::url() === route('content.index')) ? 'c-active' : '' }}">
                            <a href="{{ route('content.index') }}">Contents</a>
                        </li>
                        <li class="{{ (Request::url() === route('pages.index')) ? 'c-active' : '' }}">
                            <a href="{{ route('pages.index') }}">Pages</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    
</div>