@if (!empty($banners))
    <div id="carousel-generic" class="carousel slide"
        data-ride="carousel"
        data-interval="4000">

        <!-- Bullets -->
        <ol class="carousel-indicators">
            @foreach($banners as $k => $v)
                <li data-target="#carousel-generic" class="{{ $k == 0 ? 'active': '' }}" data-slide-to="{{ $k }}"></li>
            @endforeach
        </ol>

        <div class="carousel-inner" role="listbox">
            @foreach($banners as $k => $v)
                <div class="item {{ $k == 0 ? 'active': '' }}">
                    <a href="{{ $v->url ? $v->url : '#' }}">
                        <picture>
                            @if (!empty($v->image_large))
                            <source media="(min-width: 1600px)" srcset="{{ asset_cdn($v->image_large) }}">
                            @endif
                            <source media="(min-width: 700px)" srcset="{{ asset_cdn($v->image) }}">
                            @if (!empty($v->image_small))
                            <source media="(min-width: 300px)" srcset="{{ asset_cdn($v->image_small) }}">
                            @endif
                            <img src="{{ asset_cdn($v->image) }}" 
                            class="img-responsive">
                            <div class="carousel-caption rich-text-editor">
                                <p class="text-default">{!! $v->description !!}</p>
                            </div>
                        </picture>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endif