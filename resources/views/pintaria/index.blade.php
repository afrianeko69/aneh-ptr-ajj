@extends('layouts.pintaria.master')

@section('title') Pintaria - Portal Edukasi Indonesia @endsection

@section('content')
<!-- BEGIN: PAGE CONTENT -->
@include('layouts.pintaria.partials.banner')
<!-- BEGIN: CONTENT/BARS/BAR-1 -->
<div class="c-content-box c-size-md">
    <div class="container rich-text-editor">
        <div class="c-content-bar-1 c-opt-1">
            <h3 class="c-font-uppercase c-font-bold">{{$tentang_pintaria->title}}</h3>
            <p class="c-font-uppercase">
                {!!$tentang_pintaria->description!!}
            </p>
        </div>
    </div> 
</div>
<!-- END: CONTENT/BARS/BAR-1 -->

<!-- BEGIN: CONTENT/SHOPS/SHOP-2-2 -->
<div class="c-content-box c-size-sm c-overflow-hide c-bs-grid-small-space">
    <div class="container">
        <div class="c-content-title-1">
            <h3 class="c-font-uppercase c-center c-font-bold "><span class="c-bg-white">{{$punya_waktu->title}}</span></h3>
        </div>

        <div class="row">
            <h3 class="c-center c-font-uppercase c-font-bold"><a href="{{url('produk?'.\App\Product::CATEGORY.'=Kuliah')}}">KULIAH</a></h3>
            <div class="c-line-center"></div>
            @if($products[\App\Product::CATEGORY_KULIAH_NAME])
                <div data-slider="owl">
                    <div class="owl-carousel owl-theme c-theme owl-small-space c-owl-nav-center" data-rtl="false" data-items="4" data-slide-speed="8000">
                        @foreach($products[\App\Product::CATEGORY_KULIAH_NAME] as $product)
                            <div class="item">
                                <div class="c-content-product-2 c-bg-white c-border">
                                    <div class="c-content-overlay">
                                        <!-- <div class="c-label c-bg-red c-font-uppercase c-font-white c-font-13 c-font-bold">Sale</div> -->
                                        <div class="c-overlay-wrapper">
                                            <div class="c-overlay-content">
                                                @if(!is_null($product->price) && ($product->is_open_enrollment))
                                                    <a href="{{ $product->route_purchase_url }}" class="btn btn-md c-btn-grey-1 c-btn-uppercase c-btn-bold c-btn-border-1x c-btn-square">Beli!</a>
                                                @else
                                                    <a href="{{ $product->route_url }}" class="btn btn-md c-btn-grey-1 c-btn-uppercase c-btn-bold c-btn-border-1x c-btn-square">Info</a>
                                                @endif
                                            </div>
                                        </div>
                                        <img class="img-responsive" src="{{ $product->image_full_url }}" />
                                    </div>
                                    <div class="c-info">
                                        <a href="{{ $product->route_url }}">
                                            <p class="c-title c-font-18 c-font-slim line-height-4">{{ $product->name }}</p>
                                        </a>

                                        @if (is_null($product->price))
                                            <span class="c-price c-font-16 c-font-slim">&nbsp;</span>
                                            <p class="c-price c-font-16 c-font-slim">&nbsp;</p>
                                        @elseif ($product->is_discount)
                                            <span class="c-font-16 c-font-line-through c-font-red">
                                                <small>
                                                    {{ $product->formatted_price }}
                                                </small>
                                            </span>
                                            <p class="c-price c-font-16 c-font-slim">{{ $product->formatted_price_after_discount }} &nbsp;</p>
                                        @else
                                            <span class="c-font-16 c-font-red">&nbsp;</span>
                                            <p class="c-price c-font-16 c-font-slim">{{ $product->formatted_price }} &nbsp;</p>
                                        @endif
                                    </div>
                                    <div class="btn-group btn-group-justified" role="group">
                                        @if(!is_null($product->price) && ($product->is_open_enrollment))
                                            <div class="btn-group c-border-top" role="group">
                                                <a href="{{ $product->route_purchase_url }}" class="btn btn-lg c-btn-white c-btn-uppercase c-btn-square c-font-grey-3 c-font-white-hover c-bg-red-2-hover c-btn-product">Beli!</a>
                                            </div>
                                        @endif
                                        <div class="btn-group c-border-left c-border-top" role="group">
                                            <a href="{{ $product->route_url }}" class="btn btn-lg c-btn-white c-btn-uppercase c-btn-square c-font-grey-3 c-font-white-hover c-bg-red-2-hover c-btn-product">Info</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="row">
                    <p class="c-center">Belum ada produk.</p>
                </div>
            @endif
        </div>

        <br clear="both">

        <div class="row">
            <h3 class="c-center c-font-uppercase c-font-bold"><a href="{{url('produk?'.\App\Product::CATEGORY.'=Kursus%2FPelatihan')}}">KURSUS/PELATIHAN</a></h3>
            <div class="c-line-center"></div>
            @if($products[\App\Product::CATEGORY_KURSUS])
                <div data-slider="owl">
                    <div class="owl-carousel owl-theme c-theme owl-small-space c-owl-nav-center" data-rtl="false" data-items="4" data-slide-speed="8000">
                        @foreach($products[\App\Product::CATEGORY_KURSUS] as $product)
                            <div class="item">
                                <div class="c-content-product-2 c-bg-white c-border">
                                    <div class="c-content-overlay">
                                        <div class="c-overlay-wrapper">
                                            <div class="c-overlay-content">
                                                @if(!is_null($product->price) && ($product->is_open_enrollment))
                                                    <a href="{{ $product->route_purchase_url }}" class="btn btn-md c-btn-grey-1 c-btn-uppercase c-btn-bold c-btn-border-1x c-btn-square">Beli!</a>
                                                @else
                                                    <a href="{{ $product->route_url }}" class="btn btn-md c-btn-grey-1 c-btn-uppercase c-btn-bold c-btn-border-1x c-btn-square">Info</a>
                                                @endif
                                            </div>
                                        </div>
                                        <img class="img-responsive" src="{{ $product->image_full_url }}"/>
                                    </div>
                                    <div class="c-info">
                                        <a href="{{ $product->route_url }}">
                                            <p class="c-title c-font-18 c-font-slim line-height-4">{{ $product->name }}</p>
                                        </a>

                                        @if (is_null($product->price))
                                            <span class="c-price c-font-16 c-font-slim">&nbsp;</span>
                                            <p class="c-price c-font-16 c-font-slim">&nbsp;</p>
                                        @elseif ($product->is_discount)
                                            <span class="c-font-16 c-font-line-through c-font-red">
                                                <small>
                                                    {{ $product->formatted_price }}
                                                </small>
                                            </span>
                                            <p class="c-price c-font-16 c-font-slim">{{ $product->formatted_price_after_discount }} &nbsp;</p>
                                        @else
                                            <span class="c-font-16 c-font-red">&nbsp;</span>
                                            <p class="c-price c-font-16 c-font-slim">{{ $product->formatted_price }} &nbsp;</p>
                                        @endif
                                    </div>
                                    <div class="btn-group btn-group-justified" role="group">
                                        @if(!is_null($product->price) && ($product->is_open_enrollment))
                                            <div class="btn-group c-border-top" role="group">
                                                <a href="{{ $product->route_purchase_url }}" class="btn btn-lg c-btn-white c-btn-uppercase c-btn-square c-font-grey-3 c-font-white-hover c-bg-red-2-hover c-btn-product">Beli!</a>
                                            </div>
                                        @endif
                                        <div class="btn-group c-border-left c-border-top" role="group">
                                            <a href="{{ $product->route_url }}" class="btn btn-lg c-btn-white c-btn-uppercase c-btn-square c-font-grey-3 c-font-white-hover c-bg-red-2-hover c-btn-product">Info</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="row">
                    <p class="c-center">Belum ada produk.</p>
                </div>
            @endif
        </div>
        <br clear="both" />
        <center>
            <a href="{{url('produk')}}" class="btn c-theme-btn c-btn-square c-btn-uppercase c-font-bold">Lihat Semua Produk</a>
        </center>
    </div>
</div>
<!-- END: CONTENT/SHOPS/SHOP-2-2 -->

<!-- BEGIN: CONTENT/TILES/TILE-3 -->
<div class="c-content-box c-size-md c-bg-white">
    <div class="c-content-tile-grid c-bs-grid-reset-space" data-auto-height="true">
        <div class="c-content-title-1 wow animate fadeInDown">
            <h3 class="c-font-uppercase c-center c-font-bold">{{$tambah_pintar->title}}</h3>
        </div>

        <div class="c-content-panel">
            <div class="row wow animate">
                @php $colors = ['#0CAAE8','#5CD65C','#FF9E00','#DA1C5C'] @endphp
                @foreach ($video as $k => $v)
                <div class="col-md-6">
                    <div class="c-content-tile-1" style="background-color:{{$colors[$k]}}">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="c-tile-content c-content-v-center" data-height="height">
                                    <div class="c-wrapper">
                                        <div class="c-body c-center rich-text-editor">
                                            <h3 class="c-tile-title c-font-25 c-line-height-34 c-font-uppercase c-font-bold c-font-white">
                                                {{$v->title}}
                                            </h3>
                                            <p class="c-tile-body c-font-white">{!!$v->description!!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="c-tile-content c-arrow-right c-content-overlay"  style="background-color:{{$colors[$k]}}; border-left-color:{{$colors[$k]}};">
                                    <div class="c-overlay-wrapper force-overlay">
                                        <div class="c-overlay-content">
                                            <a class="c-content-isotope-overlay " href='#'  data-toggle="modal" data-target="#youtubeModal{{$k}}" >
                                                <i class="icon-control-play"></i> 
                                            </a>
                                        </div>
                                    </div>
                                    <div class="c-image c-overlay-object" data-height="height" style="background-image: url({{ asset_cdn($v->image) }})"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="youtubeModal{{$k}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog youtube-modal-dialog" role="document">
                        <iframe src="//www.youtube.com/embed/{{$v->youtube_id}}?rel=0&version=3&enablejsapi=1&origin={{$_SERVER['HTTP_HOST']}}" width="100%" height="100%" frameborder="0" allowfullscreen></iframe>   
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <center>
            <a href="{{url('video')}}" class="btn c-theme-btn c-btn-square c-btn-uppercase c-font-bold">Lihat Video Lainnya</a>
        </center>
    </div>
</div>
<!-- END: CONTENT/TILES/TILE-3 -->


<a id="saya-berminat"></a>
<div class="c-content-title-1">
    <h3 class="c-center c-font-uppercase c-font-bold">{{$informasi->title}}</h3>
</div>
@include('shared.more-info')

@if (!empty($partner_kami))
<!-- BEGIN: CONTENT/CONTACT/FEEDBACK-1 -->
<div class="c-content-box c-size-md c-bg-white">
    <div class="container">
        <div class="c-content-feedback-1 c-option-1">
            <div class="row">
                <div class="col-md-6">
                    <div class="c-container c-bg-green c-bg-img-bottom-right" style="background-image:url({{url('pintaria/img/content/misc/feedback_box_1.png')}} )">
                        <div class="c-content-title-1 c-inverse">
                            <h3 class="c-font-uppercase c-font-bold">{{$partner_kami->title}}</h3>
                            <div class="c-line-left"></div>
                                <p class="c-font-lowercase">
                                </p>
                                <div class="rich-text-editor white-text">
                                    {!!$partner_kami->description!!}
                                </div>
                            <a href="mailto:info@pintaria.com" class="btn btn-md c-btn-border-2x c-btn-white c-btn-uppercase c-btn-square c-btn-bold">MOHON INFO</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    @include('shared.newsletter')
                </div>
            </div>
        </div>
    </div> 
</div>
<!-- END: CONTENT/CONTACT/FEEDBACK-1 -->
@endif

<!-- BEGIN: CONTENT/MISC/ABOUT-2 -->
<div class="c-content-box c-size-md c-bg-white">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 wow animate fadeInUp rich-text-editor">
                {!!$seo_description->description!!}
            </div>
        </div>
    </div> 
</div>
<!-- END: CONTENT/MISC/ABOUT-2 -->

@endsection

@section('additional.scripts')
<script>
@foreach ($video as $k => $v)
    @php echo 'var videoSrc'.$k.' = $("#youtubeModal'.$k.' iframe").attr("src");' @endphp
    $('#youtubeModal{{$k}}').on('show.bs.modal', function () { // on opening the modal
        $("#youtubeModal{{$k}} iframe").attr("src", videoSrc{{$k}}+"&amp;autoplay=1");
    });
    $("#youtubeModal{{$k}}").on('hidden.bs.modal', function (e) { // on closing the modal
        $("#youtubeModal{{$k}} iframe").attr("src", null);
    });
@endforeach
</script>
@endsection