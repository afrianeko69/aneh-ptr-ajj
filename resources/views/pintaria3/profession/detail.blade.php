@extends('layouts.pintaria3.master')

@section('title') Pintaria - Portal Edukasi Indonesia @endsection
@section('meta_description')Info Kuliah, Kursus Online, Kelas Karyawan, Kuliah Karyawan, Kuliah Blended dan Pendidikan di Indonesia, semuanya ada di Pintaria.com @endsection
@section('additional.styles')
<link rel="stylesheet" type="text/css" href="//api.jooble.org/joobleapi.classic.css">
<style type="text/css">
#hero_in.banner-profession-detail {
  background: url("{{asset_cdn($profession->banner)}}") center center no-repeat;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
</style>
@endsection

@section('content')

    <section id="hero_in" class="banner-profession-detail">
        <div class="wrapper">
            <div class="container">
                <h1 class="fadeInUp"><span></span>{{$profession->name}}</h1>
            </div>
        </div>
    </section>
    <nav class="secondary_nav sticky_horizontal">
        <div class="container">
            <ul class="clearfix">
                <li><a href="#description" class="active">Deskripsi</a></li>
                @if($profession->youtube_video_id)
                    <li><a href="#video">Video</a></li>
                @endif
                @if($profession->pay)
                    <li><a href="#gaji">Gaji</a></li>
                @endif
                @if($profession->task)
                    <li><a href="#tugas">Tugas</a></li>
                @endif
                @if($profession->knowledge)
                    <li><a href="#pengetahuan">Pengetahuan</a></li>
                @endif
                @if($profession->skill)
                    <li><a href="#keterampilan_dan_kemampuan">Keterampilan dan Kemampuan</a></li>
                @endif
                @if($profession->jooble)
                    <li><a href="#lowongan-pekerjaan">Lowongan Pekerjaan</a></li>
                @endif
                @if($products)
                    <li><a href="#program-terkait">Program Terkait</a></li>
                @endif
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <section id="description" class="add_top_30">
                    <h2>Deskripsi</h2>
                    <div class="more">
                        {!!$profession->description!!}
                    </div>
                </section>

                @if($profession->youtube_video_id)
                    <section id="video" class="add_bottom_30">
                        <h2>Video</h2>
                        <div class="embed-responsive embed-responsive-21by9">
                            <iframe class="embed-responsive-item" src="{{ $profession->youtubeEmbedUrl() }}" allowfullscreen="allowfullscreen" data-mce-fragment="1" width="70%" height="450" frameborder="0"></iframe>
                        </div>
                    </section>
                @endif

                @if($profession->pay)
                    <section id="gaji" class="rich-text add_bottom_30">
                        <h2>Gaji</h2>
                        <div class="more">
                            {!! $profession->pay !!}
                        </div>
                    </section>
                @endif

                @if($profession->task)
                    <section id="tugas" class="rich-text add_bottom_30">
                        <h2>Tugas</h2>
                        <div class="more">
                            {!! $profession->task !!}
                        </div>
                    </section>
                @endif

                @if($profession->knowledge)
                    <section id="pengetahuan" class="rich-text add_bottom_30">
                        <h2>Pengetahuan</h2>
                        <div class="more">
                            {!! $profession->knowledge !!}
                        </div>
                    </section>
                @endif

                @if($profession->skill)
                    <section id="keterampilan_dan_kemampuan" class="rich-text add_bottom_30">
                        <h2>Keterampilan dan Kemampuan</h2>
                        <div class="more">
                            {!! $profession->skill !!}
                        </div>
                    </section>
                @endif

                <hr />

                @if($profession->jooble)
                    <section id="lowongan-pekerjaan" class="add_bottom_30">
                        <h2>Lowongan Pekerjaan</h2>
                        <div class="more">
                            <div id="joobleVacancyBox">
                                <input id="joobleVacancyOnPage" type="hidden" value="5">
                                <input id="joobleCharsAroundCurrentPage" type="hidden" value="1">
                                <input id="joobleCountry" type="hidden" value="id">
                                <input id="joobleIsSnippet" type="hidden" value="1">
                                <input id="joobleWaitMessage" type="hidden" value="Please wait a moment while we're retrieving the job listings">
                                <input id="joobleKey" type="hidden" value="c57383cb-b9c1-450c-bd4c-81ba541fe13a">
                                <input id="joobleKeyword" type="search"  placeholder="Posisi" value="{{ $profession->jooble }}" onkeyup="if(event.keyCode==13){joobleAPI.newSearch()}"  >
                                <input id="joobleLocation" type="search" placeholder="Lokasi"  value="Jakarta" onkeyup="if(event.keyCode==13){joobleAPI.newSearch()}" >
                                <button id="joobleButton" onClick="joobleAPI.newSearch()">Cari!</button>
                                <div id="joobleVacancy"></div>
                                <div id="jooblePageing"></div>
                                <div id="joobleStaticLink"><a href="https://id.jooble.org/" target="blank">Loker dari <span class="jooble logo bluechar">J</span><span class="jooble logo greenchar">oo</span><span class="jooble logo bluechar">ble</span></a></div>
                            </div>
                        </div>
                    </section>
                @endif

                @if($products)
                    <section id="program-terkait" class="add_bottom_30">
                        <h2>Program Terkait</h2>
                        <div id="reccomended" class="owl-carousel owl-theme carousels">
                            @foreach($products as $product)
                                <div class="item">
                                    <div class="box_grid">
                                        <figure>
                                            <a href="{{ $product->route_url }}">
                                                <div class="preview"><span>Lihat Program</span></div><img src="{{ $product->image_full_url }}" class="img-fluid" alt=""></a>
                                                @if (is_null($product->price))
                                                    &nbsp;
                                                    &nbsp;
                                                @elseif ($product->is_discount)
                                                    <div class="price">
                                                    <strike>{{ $product->formatted_price }}</strike><br>
                                                    {{ $product->formatted_price_after_discount }}
                                                    </div>
                                                @else
                                                    <div class="price">
                                                        {{ $product->formatted_price }}
                                                    </div>
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
                                                    <a href="{{ $product->route_purchase_url }}" class="btn btn-md c-btn-grey-1 c-btn-uppercase c-btn-bold c-btn-border-1x c-btn-square">Beli!</a>
                                                @else
                                                    <a href="{{ $product->route_url }}" class="btn btn-md c-btn-grey-1 c-btn-uppercase c-btn-bold c-btn-border-1x c-btn-square">Info</a>
                                                @endif    
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif
            </div>
        </div>
    </div>
    <!-- /container -->
@endsection
@push('scripts')
<script type="text/javascript" src="https://api.jooble.org/joobleapi.js"></script>
@endpush
