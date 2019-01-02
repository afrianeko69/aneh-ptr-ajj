<div id="full-slider-wrapper" class="carousel slide carousel-fade" data-ride="carousel">
    <ol class="carousel-indicators">
        @foreach($banners as $k => $v)
            <li data-target="#full-slider-wrapper" data-slide-to="{{ $k }}" class="{{ $k == 0 ? 'active': '' }}"></li>
        @endforeach
    </ol>
    <div class="carousel-inner">
        @foreach($banners as $k => $v)
        <div class="carousel-item {{ $k == 0 ? 'active': '' }}">
            <a {{ !empty($v->url) ? 'href=' . $v->url : '' }}>
                <picture>
                    <source media="(min-width: 700px)" srcset="{{ asset_cdn($v->image) }}">
                    @if (!empty($v->image_small))
                    <source media="(min-width: 300px)" srcset="{{ asset_cdn($v->image_small) }}">
                    @endif
                    <img src="{{ asset_cdn($v->image) }}" 
                    class="img-responsive">
                    <div class="carousel-caption rich-text-editor">
                        @if (!empty($v->description))
                            <p class="text-default">{!! $v->description !!}</p>
                        @endif
                    </div>
                </picture>
            </a>
        </div>
        @endforeach
    </div>

    @if(count($banners) > 1 )
        <a class="carousel-control-prev" href="#full-slider-wrapper" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#full-slider-wrapper" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    @endif
</div>
