@extends('layouts.pintaria3.master') 
@section('title') 
Pintaria - Portal Edukasi Indonesia 
@endsection 
@section('meta_description')Info Kuliah, Kursus Online, Kelas Karyawan, Kuliah Karyawan, Kuliah Blended dan Pendidikan di Indonesia, semuanya ada di Pintaria.com @endsection

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
            <div class="main_title_2">
                <span><em></em></span>
                <h2>{{$tambahPintar->title}}</h2>
                <p>Lihat beragam video singkat yang dapat menambah wawasan kamu</p>
            </div>
            <div class="grid">
                <ul>
                    @foreach ($videos as $k => $v)
                    <li>
                        <figure>
                            <img src="{{ asset_cdn($v->image) }}" alt=""/>
                            <figcaption>
                                <div class="caption-content">
                                    <a href="{{ route('video.detail', ['title' => urlencode($v->title)]) }}" title="{{$v->title}}">
                                        <i class="icon-play-circled"></i>
                                        <p>{{$v->title}}</p>
                                    </a>
                                </div>
                            </figcaption>
                        </figure>
                    </li>
                    @endforeach
                </ul>
            </div>
            <nav aria-label="...">
                {{ $videos->links() }}
            </nav>
            <!-- /grid -->
        </div>
        <!-- /container -->
    </div>
    <!-- /container -->
</main>
<!--/main-->
@endsection
