@extends('layouts.pintaria.master') 

@section('title') Pintaria - Portal Edukasi Indonesia @endsection 

@section('content')

<!-- BEGIN: PAGE CONTENT -->
<div class="c-content-box c-size-md">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="tags_breadcrumbs">
                    <span class="span_tags_breadcrumbs">Tag >> {{ucfirst($stringTag)}}</span>
                </div>
                <div class="c-content-blog-post-card-1-grid">
                    <div class="row">
                        <div class="col-md-6">
                            @foreach ($posts as $k => $post) 
                            @if ($k % 2 == 0)
                            <div class="c-content-blog-post-card-1 c-option-2 c-bordered">
                                <div class="c-media c-content-overlay">
                                    <div class="c-overlay-wrapper">
                                        <div class="c-overlay-content">
                                            <a href="{{url('blog/'.$post->slug)}}"><i class="icon-link"></i></a>
                                            <a href="{{ asset_cdn($post->image) }}" data-lightbox="fancybox" data-fancybox-group="gallery"><i class="icon-magnifier"></i></a>
                                        </div>
                                    </div>
                                    <img class="c-overlay-object img-responsive" src="{{ asset_cdn($post->image) }}" alt="">
                                </div>
                                <div class="c-body">
                                    <div class="c-title c-font-bold c-font-uppercase">
                                        <a href="{{url('blog/'.$post->slug)}}">{{$post->title}}</a>
                                    </div>
                                    <div class="c-author">
                                        By <a href="#"><span class="c-font-uppercase">Pintaria</span></a> on <span class="c-font-uppercase">{{date('d F y H:i',strtotime($post->created_at))}}</span>
                                    </div>
                                    <p>
                                        {{$post->excerpt}}
                                    </p>
                                </div>
                            </div>
                            @endif 
                            @endforeach
                        </div>

                        <div class="col-md-6">
                            @foreach ($posts as $k => $post) 
                            @if ($k % 2 == 1)
                            <div class="c-content-blog-post-card-1 c-option-2 c-bordered">
                                <div class="c-media c-content-overlay">
                                    <div class="c-overlay-wrapper">
                                        <div class="c-overlay-content">
                                            <a href="{{url('blog/'.$post->slug)}}"><i class="icon-link"></i></a>
                                            <a href="{{ asset_cdn($post->image) }}" data-lightbox="fancybox" data-fancybox-group="gallery"><i class="icon-magnifier"></i></a>
                                        </div>
                                    </div>
                                    <img class="c-overlay-object img-responsive" src="{{ asset_cdn($post->image) }}" alt="">
                                </div>
                                <div class="c-body">
                                    <div class="c-title c-font-bold c-font-uppercase">
                                        <a href="{{url('blog/'.$post->slug)}}">{{$post->title}}</a>
                                    </div>
                                    <div class="c-author">
                                        By <a href="#"><span class="c-font-uppercase">Pintaria</span></a> on <span class="c-font-uppercase">{{date('d F y H:i',strtotime($post->created_at))}}</span>
                                    </div>
                                    <p>
                                        {{$post->excerpt}}
                                    </p>
                                </div>
                            </div>
                            @endif 
                            @endforeach
                        </div>
                    </div>

                    <div class="c-pagination">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                @include('layouts.pintaria.partials.post.sidebar')
            </div>
        </div>
    </div>
</div>
<!-- END: PAGE CONTENT -->

@endsection