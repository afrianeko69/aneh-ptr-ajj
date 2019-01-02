@extends('layouts.pintaria3.master') 

@section('title') Pintaria - Portal Edukasi Indonesia @endsection 
@section('meta_description')Informasi, Berita dan Artikel Kuliah Online, Info Kuliah, Kursus Online, Kelas Karyawan, Kuliah Karyawan, Pendidikan di Indonesia & lainnya @endsection
@section('content')

<!-- BEGIN: PAGE CONTENT -->
<main>
    <section id="hero_in" class="static blog-banner-header">
        <div class="wrapper">
            <div class="container">
                <h1 class="fadeInUp"><span></span>blog</h1>
            </div>
        </div>
    </section>
    <!--/hero_in-->
    <nav class="secondary_nav sticky_horizontal">
        <div class="container">
            <ul class="clearfix">
                <li>Tag <i class="icon-angle-right"></i> {{ucfirst($stringTag)}}</li>
            </ul>
        </div>
    </nav>
    <div class="container margin_120_95">
        <div class="row">
            <div class="col-lg-9">
                @foreach ($posts as $post) 
                <article class="blog wow fadeIn">
                    <div class="row no-gutters">
                        <div class="col-lg-7">
                            <figure>
                                <a href="{{ url('blog/'.$post->slug) }}"><img data-src="{{ asset_cdn($post->image) }}" alt="">
                                    <div class="preview"><span>Baca Selengkapnya</span></div>
                                </a>
                            </figure>
                        </div>
                        <div class="col-lg-5">
                            <div class="post_info">
                                <small>{{ date('d F y H:i',strtotime($post->created_at)) }}</small>
                                <h3><a href="{{ url('blog/'.$post->slug) }}">{{ $post->title }}</a></h3>
                                <p>{{ str_limit($post->excerpt, 280) }}</p>
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach
                <!-- /article -->

                <nav aria-label="...">
                    {{ $posts->links() }}
                </nav>
                <!-- /pagination -->
            </div>
            <!-- /col -->

            <aside class="col-lg-3">
                @include('layouts.pintaria3.partials.post.sidebar')
            </aside>
            <!-- /aside -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</main>
<!-- END: PAGE CONTENT -->

@endsection