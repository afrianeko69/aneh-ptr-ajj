@extends('layouts.pintaria3.master') 
@section('title') 
Pintaria - Portal Edukasi Indonesia 
@endsection 
@section('meta_description')Info Kuliah, Kursus Online, Kelas Karyawan, Kuliah Karyawan, Kuliah Blended dan Pendidikan di Indonesia, semuanya ada di Pintaria.com @endsection

@section('additional.styles')
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.css" />
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-flat.css" />
@endsection

@section('content')
<main>
    <section id="hero_in" class="static video-banner-header">
        <div class="wrapper">
            <div class="container">
                <h1 class="fadeInUp"><span></span>Video 60 Detik</h1>
            </div>
        </div>
    </section>
    <!--/hero_in-->
    <div class="bg_color_1">
        <div class="container margin_60_35">
            <div class="section-video-wrap">
                <div class="row justify-content-md-center">
                    <div class="col-md-8">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe src="//youtube.com/embed/{{$video->youtube_id}}" class="embed-responsive-item" width="560" height="315" frameborder="0" allowfullscreen=""></iframe>
                        </div> 

                        <br clear="both" />
                        <h2>{{$video->title}}</h2>
                        <p>{{$video->description}}</p>

                        <div class="row mt-4">
                            <div class="col-12 mb-4">
                                <span>
                                    Bagikan :
                                </span>
                                <div id="shareNative" class="jssocials"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <h4>Video 60 Detik Terbaru</h4>
                        <hr>
                        @forelse ($latest as $video)
                            <div class="sidebar_video">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="{{ asset_cdn($video->image) }}" alt="{{$video->title}}" class="img-fluid"/>
                                        <div class="video_icon">
                                            <div class="caption-content">
                                                <a href="{{ route('video.detail', ['title' => urlencode($video->title)]) }}" title="{{$video->title}}">
                                                    <i class="icon-play-circled"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        {{date('d F Y', strtotime($video->created_at))}}
                                        <br clear="both" />
                                        <a href="{{ route('video.detail', ['title' => urlencode($video->title)]) }}" title="{{$video->title}}">{{$video->title}}</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                        <br clear="both" />
                        <a href="{{route('video')}}" class="float-right font_gray">Lihat Selengkapnya ></a>
                    </div>

                </div>
            </div>
            <!-- /grid -->
        </div>
        <!-- /container -->
    </div>
    <!-- /container -->
</main>
<!--/main-->
@endsection


@section('additional.scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.min.js"></script>
<script>
$(document).ready(function(){
    $("#shareNative").jsSocials({
        showCount: false,
        showLabel: true,    
        url: "{{ Request::url() }}",
        text: "Yuk lihat video '{{$video->title}}' di pintaria.com",
        shares: [
            { share: "facebook", label: "Share" },
            "twitter",
            { share: "googleplus", label: "Share" },
            "linkedin",
        ]
    });
});
</script>
@endsection