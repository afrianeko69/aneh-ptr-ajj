@extends('layouts.pintaria3.master') 

@section('title') Pintaria - Portal Edukasi Indonesia @endsection 
@section('meta_description')Informasi, Berita dan Artikel Kuliah Online, Info Kuliah, Kursus Online, Kelas Karyawan, Kuliah Karyawan, Pendidikan di Indonesia & lainnya @endsection

@section('additional.styles')
<style>
    .video_icon{
        font-size: 25px;      
    }
</style>
@endsection

@section('content')

<!-- BEGIN: PAGE CONTENT -->
<main>
    <section id="hero_in" class="static blog-banner-header">
        <div class="wrapper">
            <div class="container">
                <h1 class="fadeInUp"><span></span>Berita</h1>
            </div>
        </div>
    </section>
    <!--/hero_in-->

    <div class="container margin_120_95">
        <div class="row">
            <div class="col-lg-9">
                @foreach ($newses as $news) 
                <article class="blog wow fadeIn">
                    <div class="row no-gutters">
                        <div class="col-lg-7">
                            <figure>
                                <a href="{{ url('berita/'.$news->slug) }}"><img data-src="{{ $news->medium_image_full_url }}" alt="">
                                    <div class="preview"><span>Lihat Selengkapnya</span></div>
                                </a>
                            </figure>
                        </div>
                        <div class="col-lg-5">
                            <div class="post_info">
                                <small>{{ date('d F y H:i',strtotime($news->created_at)) }}</small>
                                <h3><a href="{{ url('berita/'.$news->slug) }}">{{ $news->title }}</a></h3>
                                <p>{{ str_limit($news->excerpt, 280) }}</p>
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach
                <!-- /article -->

                <nav aria-label="...">
                    {{ $newses->links() }}
                </nav>
                <!-- /pagination -->
            </div>
            <!-- /col -->

            <aside class="col-lg-3">
                @include('layouts.pintaria3.partials.news.sidebar')
            </aside>
            <!-- /aside -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</main>
<!-- END: PAGE CONTENT -->

@endsection