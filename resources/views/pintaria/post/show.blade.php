@extends('layouts.pintaria.master') 

@section('title'){{ (!empty($post->seo_title) ? $post->seo_title : 'Pintaria - Portal Edukasi Indonesia') }}@endsection 

@section('meta_description'){{ (!empty($post->meta_description) ? $post->meta_description : '') }}@endsection 

@section('content')
<!-- BEGIN: BLOG LISTING -->
<div class="c-content-box c-size-md">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="c-content-blog-post-1-view">
                    <div class="c-content-blog-post-1">
                        <div class="c-media">
                            <div class="c-content-media-2-slider">
                                <img src="{{ asset_cdn($post->image) }}" class="img-responsive" />
                            </div>
                        </div>

                        <div class="c-title c-font-bold c-font-uppercase">
                            <a href="#">{{$post->title}}</a>
                        </div>

                        <div class="c-desc rich-text-editor">
                            {!! $post->body !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                @include('layouts.pintaria.partials.post.sidebar')
            </div>
        </div>
    </div>
</div>
<!-- END: BLOG LISTING  -->

@endsection