<!-- /widget -->
<div class="widget">
    <div class="widget-title">
        <h4>Artikel Terbaru</h4>
    </div>
    <ul class="comments-list">
        @foreach ($recentPost as $k => $post)
        <li>
            <div class="alignleft">
                <a href="{{ url('blog/'.$post->slug) }}"><img data-src="{{ $post->small_image_full_url }}" alt=""></a>
            </div>
            <small>{{date('d F y',strtotime($post->created_at))}}</small>
            <h3><a href="{{ url('blog/'.$post->slug) }}">{{ $post->title }}</a></h3>
        </li>
        @endforeach
    </ul>
</div>

<div class="widget">
    <div class="widget-title">
        <h4>Video 60 Detik Terbaru</h4>
    </div>
    @forelse ($latest_videos as $video)
        <div class="sidebar_video">
            <div class="row">
                <div class="col-4">
                    <img src="{{ asset_cdn($video->image) }}" alt="{{$video->title}}" class="img-fluid"/>
                    <div class="video_icon">
                        <div class="caption-content">
                            <a href="{{ route('video.detail',['title' => urlencode($video->title)]) }}" title="{{$video->title}}">
                                <i class="icon-play-circled"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    {{date('d F Y', strtotime($video->created_at))}}
                    <br clear="both" />
                    <a href="{{ route('video.detail',['title' => urlencode($video->title)]) }}" title="{{$video->title}}" class="font_black">{{$video->title}}</a>
                </div>
            </div>
        </div>
    @empty
    @endforelse
    <br clear="both" />
    <a href="{{ route('video')}}" class="font_gray float-right">Lihat Selengkapnya ></a>
</div>

<!-- /widget -->
<div class="widget">
    <div class="widget-title">
        <h4>Tags</h4>
    </div>
    <div class="tags">
        @foreach ($tags as $tag)
        <a href="{{ route('tag',['slug' => str_slug($tag->name)])}} ">{{ $tag->name }}</a>
        @endforeach
    </div>
</div>