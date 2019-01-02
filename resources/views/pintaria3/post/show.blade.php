@extends('layouts.pintaria3.master') 

@section('title'){{ (!empty($post->seo_title) ? $post->seo_title : 'Pintaria - Portal Edukasi Indonesia') }}@endsection 

@section('meta_description'){{ (!empty($post->meta_description) ? $post->meta_description : '') }}@endsection 

@section('additional.styles')
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.css" />
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-flat.css" />
@endsection

@section('content')
<!-- BEGIN: BLOG LISTING -->
<section id="hero_in" class="static blog-banner-header">
    <div class="wrapper">
        <div class="container">
            <h1 class="fadeInUp"><span></span>blog</h1>
        </div>
    </div>
</section>

<div class="container margin_60_35">
    <div class="row">

        <div class="col-lg-12">
            <div class="share">
                <span>
                    Bagikan :
                </span>
                <div class="shareNative jssocials"></div>
                <br clear="both" />
            </div>
        </div>
        <div class="col-lg-9">
            <div class="bloglist singlepost">
                <p><img alt="" class="img-fluid" src="{{ asset_cdn($post->image) }}"></p>
                <h1>{{ $post->title }}</h1>
                <div class="post-content">
                    <div class="dropcaps">
                        <p>{!! $post->body !!}</p>
                    </div>
                </div>
            </div>
            <div class="share">
                <span>
                    Bagikan :
                </span>
                <div class="shareNative jssocials"></div>
            </div>
        </div>

        <aside class="col-lg-3">
            @include('layouts.pintaria3.partials.post.sidebar')
        </aside>
    </div>
</div>
<!-- END: BLOG LISTING  -->

@endsection

@section('additional.scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.min.js"></script>
<script type="text/javascript">
    $(".shareNative").jsSocials({
        showCount: false,
        showLabel: true,
        url: "{{ Request::url() }}",
        shares: [
            { share: "facebook", label: "Share" },
            "twitter",
            { share: "googleplus", label: "Share" },
            "linkedin",
        ]
    });
</script>
@endsection