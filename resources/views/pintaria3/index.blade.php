@extends('layouts.pintaria3.master')

@section('title') Pintaria - Portal Edukasi Indonesia @endsection
@section('meta_description')Info Kuliah, Kursus Online, Kelas Karyawan, Kuliah Karyawan, Kuliah Blended dan Pendidikan di Indonesia, semuanya ada di Pintaria.com @endsection

@section('content')
@include('layouts.pintaria3.partials.banner')

<div class="features clearfix">
    <div class="container industry">
        <h3 class="white-text">Mengapa Pintaria?</h3>
        <ul>
            <li>
                <a>
                    <img data-src="{{url('pintaria3/img/fleksibel.svg')}}" class="industry-icon" />
                    <h4>Fleksibel</h4>
                </a>
            </li>
            <li>
                <a>
                    <img data-src="{{url('pintaria3/img/terjangkau.svg')}}" class="industry-icon" />
                    <h4>Terjangkau</h4>
                </a>
            </li>
            <li>
                <a>
                    <img data-src="{{url('pintaria3/img/terpercaya.svg')}}" class="industry-icon" />
                    <h4>Terpercaya</h4>
                </a>
            </li>
            <li>
                <a>
                    <img data-src="{{url('pintaria3/img/berkualitas.svg')}}" class="industry-icon" />
                    <h4>Berkualitas</h4>
                </a>
            </li>
        </ul>
        <p>
            Pintaria menjawab kebutuhanmu untuk melanjutkan pendidikan tinggi, mengembangkan diri dan meningkatkan karier
        </p>
    </div>
</div>
<!-- /features -->

<div id="our_program" class="container-fluid margin_120_0">
    <div class="main_title_2">
        <span><em></em></span>
        <h2>Kuliah</h2>
        <p>Temukan universitas mitra kami dan jurusan yang kamu minati dengan metode blended learning<br />Kamu bisa kuliah S1 atau S2 sambil tetap bekerja</p>
    </div>
    
    <div id="reccomended" class="owl-carousel owl-theme carousels">
        @if($products[\App\Product::CATEGORY_KULIAH_NAME])
        @foreach($products[\App\Product::CATEGORY_KULIAH_NAME] as $product)
        <div class="item">
            <div class="box_grid">
                <figure>
                    <a href="{{ $product->route_url }}">
                        <div class="preview"><span>Lihat Program</span></div><img src="{{ $product->image_full_url }}" class="img-fluid"></a>
                        @if (is_null($product->price))
                            
                        @elseif ($product->is_discount)
                            <div class="price"><strike>{{ $product->formatted_price }}</strike><br>{{ $product->formatted_price_after_discount }} &nbsp;</div>
                        @elseif ($product->price != 0)
                            <div class="price">{{ $product->formatted_price }}</div>
                        @endif

                </figure>
                <div class="wrapper">
                    <small>{{ !empty($product->category_name) ? $product->category_name : ''}}</small>
                    <h3>{{ $product->name }}</h3>
                    {{ $product->excerpt }}
                </div>
                <ul class="clearfix">
                    <li>
                        @if(!is_null($product->price) && ($product->is_open_enrollment))
                            @if ($product->is_open_enrollment == 2)
                                <a href="{{ $product->route_url }}" class="btn btn-md c-btn-grey-1 c-btn-uppercase c-btn-bold c-btn-border-1x c-btn-square">Info</a>
                            @else
                                <a href="{{ $product->route_purchase_url }}" class="btn btn-md c-btn-grey-1 c-btn-uppercase c-btn-bold c-btn-border-1x c-btn-square"  onClick="tracker('button_beli_kuliah', '', 'button_beli', '{{ $product->name ?? '' }}' , 'kuliah' );">{{ ($product->price == 0) ? 'Mulai' : 'Beli!' }}</a>
                            @endif
                        @else
                            <a href="{{ $product->route_url }}" class="btn btn-md c-btn-grey-1 c-btn-uppercase c-btn-bold c-btn-border-1x c-btn-square">Info</a>
                        @endif    
                    </li>
                </ul>
            </div>
        </div>
        @endforeach
        @endif
    </div>

    <div class="container">
        <p class="btn_home_align"><a href="{{route('product.search', ['nama' => '', 'kategori_program' => '', 'kategori' => 'Kuliah', 'industri_program' => '', 'min' => '', 'max' => ''])}}" id="more_kuliah_link" class="btn_1 rounded">Lihat selengkapnya</a></p>
    </div>

    <div class="main_title_2">
        <span><em></em></span>
        <h2>Kursus</h2>
        <p>Pelajari keterampilan yang kamu butuhkan untuk pengembangan diri dan kariermu</p>
    </div>
    <div id="reccomended" class="owl-carousel owl-theme carousels">
        @if($products[\App\Product::CATEGORY_KURSUS])
        @foreach($products[\App\Product::CATEGORY_KURSUS] as $product)
        <div class="item">
            <div class="box_grid">
                <figure>
                    <a href="{{ $product->route_url }}">
                        <div class="preview"><span>Lihat Program</span></div><img src="{{ $product->image_full_url }}" class="img-fluid"></a>
                        @if (is_null($product->price))
                            &nbsp;
                            &nbsp;
                        @elseif ($product->is_discount)
                            
                            <div class="price"><strike>{{ $product->formatted_price }}</strike><br>{{ $product->formatted_price_after_discount }} &nbsp;</div>
                        @else
                            <div class="price">{{ $product->formatted_price }}</div>
                        @endif

                </figure>
                <div class="wrapper">
                    <small>{{ !empty($product->category_name) ? $product->category_name : ''}}</small>
                    <h3>{{ $product->name }}</h3>
                    {{ $product->excerpt }}
                </div>
                <ul class="clearfix">
                    <li>
                        @if(!is_null($product->price) && ($product->is_open_enrollment))

                            @if ($product->is_open_enrollment == 2)
                                <a href="{{ $product->route_url }}" class="btn btn-md c-btn-grey-1 c-btn-uppercase c-btn-bold c-btn-border-1x c-btn-square">Info</a>
                            @elseif ($product->is_open_enrollment == 3 && !empty($product->selected_bundle_id))
                                <a href="{{ route('product.konfirmasi.beli', [$product->slug, 'paket' => $product->selected_bundle_id]) }}" class="btn btn-md c-btn-grey-1 c-btn-uppercase c-btn-bold c-btn-border-1x c-btn-square" onClick="tracker('button_beli_kursus', '', 'button_beli', '{{ $product->name ?? '' }}' , 'kursus' );">{{ ($product->price == 0) ? 'Mulai' : 'Beli!' }}</a>
                            @else
                                <a href="{{ $product->route_purchase_url }}" class="btn btn-md c-btn-grey-1 c-btn-uppercase c-btn-bold c-btn-border-1x c-btn-square" onClick="tracker('button_beli_kursus', '', 'button_beli', '{{ $product->name ?? '' }}' , 'kursus' );">{{ ($product->price == 0) ? 'Mulai' : 'Beli!' }}</a>
                            @endif

                        @else
                            <a href="{{ $product->route_url }}" class="btn btn-md c-btn-grey-1 c-btn-uppercase c-btn-bold c-btn-border-1x c-btn-square">Info</a>
                        @endif    
                    </li>
                </ul>
            </div>
        </div>
        @endforeach
        @endif
    </div>

    <div class="container">
        <p class="btn_home_align"><a href="{{route('product.search', ['nama' => '', 'kategori_program' => '', 'kategori' => 'Training', 'industri_program' => '', 'min' => '', 'max' => ''])}}" id="more_training_link" class="btn_1 rounded">Lihat selengkapnya</a></p>
    </div>
</div>
<!-- /container -->

<div id="category_program" class="container margin_30_95">
    <div class="main_title_2">
        <span><em></em></span>
        <h2>Kategori Program</h2>
        <p>Temukan kategori program kami berdasarkan subjek yang kamu minati</p>
    </div>

    <div class="row">
        @forelse ($categories as $category)
        <div class="col-lg-4 col-md-6 wow" data-wow-offset="150">
            <a href="{{route('product.search')}}?{{\App\Product::CATEGORY_PROGRAM . '=' . urlencode($category->name)}}" class="grid_item">
                <figure class="block-reveal">
                    <div class="block-horizzontal"></div>
                    <img data-src="{{ asset_cdn($category->thumbnail_image) }}" class="img-fluid" alt="">
                    <div class="info">
                        <small><i class="ti-layers"></i>{{$category->total_product}} Program</small>
                        <h3>{{$category->name}}</h3>
                    </div>
                </figure>
            </a>
        </div>
        @empty
        <center>Data Kosong</center>
        @endforelse
    </div>
    <!-- /row -->

    <div class="container">
        <p class="btn_home_align"><a href="{{route('category.index')}}" class="btn_1 rounded">Lihat selengkapnya</a></p>
    </div>
</div>
<!-- /container -->

<div class="bg_color_1">
    <div class="container margin_60_35">
        <div class="main_title_2">
            <span><em></em></span>
            <h2>Testimoni</h2>
            <p>Lihat kesan mereka mengikuti program di Pintaria</p>
        </div>
            <div class="carousel slide" data-ride="carousel" id="carousel-testimony">
                <div class="carousel-inner">
                    @foreach($testimonies as $index => $testimony)
                        <div class="carousel-item {{ $index == 0 ? 'active': '' }}">
                            @if ($testimony->youtube_video_id)
                            <div class="row justify-content-center">
                                <div class="col-md-8 col-sm-12">
                                    <div class="video_container">
                                        <iframe src="//www.youtube.com/embed/{{$testimony->youtube_video_id}}" frameborder="0" allowfullscreen class="video"></iframe>
                                        <a class="video_trigger" href="{{ youtube_url_generator($testimony->youtube_video_id) }}">
                                            <div class="video_mask"></div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="row">
                                <div class="col-4 d-none d-xl-block d-lg-block d-md-block">
                                    <img class="img-testimony" src="{{ asset_cdn($testimony->photo) }}" />
                                </div>
                                <div class="col-8 d-none d-xl-block d-lg-block d-md-block">
                                    <div class="carousel-caption testimony-wrapper">
                                        <div class="testimony-word">
                                            {!! $testimony->testimony !!}
                                        </div>
                                        <div class="testimony-user-title">
                                            {{ $testimony->name }}, {{ $testimony->title }}
                                        </div>
                                    </div>
                                </div>

                                <img class="img-testimony d-block d-xl-none d-lg-none d-md-none" src="{{ asset_cdn($testimony->photo) }}" />
                                <div class="carousel-caption testimony-wrapper d-block d-xl-none d-lg-none d-md-none">
                                    <div class="testimony-word">
                                        {!! $testimony->testimony !!}
                                    </div>
                                    <div class="testimony-user-title">
                                        {{ $testimony->name }}, {{ $testimony->title }}
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carousel-testimony" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel-testimony" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
    </div>
</div>

<div class="container margin_120_95">
    <div class="main_title_2">
        <span><em></em></span>
        <h2>Blog</h2>
        <p>Simak beragam artikel menarik dari Pintaria</p>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="row">
                @forelse($blog_posts as $berita)
                <div class="col-lg-6 col-md-12 col-sm-6">
                    <a class="box_news" href="{{ $berita->post_detail_url }}">
                        <figure>
                            <img data-src="{{ $berita->medium_image_full_url }}">
                            <figcaption>{!! $berita->shortDate !!}</figcaption>
                        </figure>
                        <ul>
                            <li>{{ $berita->author_name }}</li>
                            <li>{{ $berita->human_date }}</li>
                        </ul>
                        <h4>{{ $berita->title }}</h4>
                        <p>{{ str_limit($berita->excerpt, 80, '...') }}</p>
                    </a>
                </div>
                @empty
                    <p>
                        Belum ada Berita
                    </p>
                @endforelse
            </div>
        </div>
    </div>
    <p class="btn_home_align"><a href="{{ url('blog') }}" class="btn_1 rounded">Lihat selengkapnya</a></p>
</div>
<!-- /container -->

@include('shared.pintaria3.more-info')
@endsection

@section('additional.scripts')
<script type="text/javascript">
    $(document).ready(function () {
        // Show video popup
        $('.video_trigger').click(function (e) {
            e.preventDefault();
            setModalCloseButtonPlacement();
            registerVideoToModal($(this).parent().find('.video').attr('src'));
            $('#testimony_modal').css('display', 'block');
        });

        $('#testimony_modal .close').click(function (e) {
            $('#testimony_modal').css('display', 'none');
            resetVideoInModal();
        });
    });

    function setModalCloseButtonPlacement() {
        if ($(window).width() > 768) { // Desktop
            var iframeWidth = 720; 
            var iframeHeight = 405;
            var rightWidth = ($(window).width() - iframeWidth) / 2; // Right side width of the iframe
            var topHeight = ($(window).height() - iframeHeight) / 2; // Top height of the iframe
            $('#testimony_modal .close').css('right', rightWidth - 25 + 'px');
            $('#testimony_modal .close').css('top', topHeight - 35 + 'px');
        } else { // Mobile
            // Calculate top side of the iframe
            var iframeHeight = $(window).width() * (9 / 16);
            var topHeight = ($(window).height() - iframeHeight) / 2;
            $('#testimony_modal .close').css('top', topHeight - 48 + 'px');
            $('#testimony_modal .close').css('right', '10px');
        }
    };

    function registerVideoToModal(url) {
        $('#testimony_modal .modal_content .modal_video iframe').attr('src', url);
    }

    function resetVideoInModal() {
        $('#testimony_modal .modal_content .modal_video iframe').attr('src', '');
    }
</script>
@endsection
