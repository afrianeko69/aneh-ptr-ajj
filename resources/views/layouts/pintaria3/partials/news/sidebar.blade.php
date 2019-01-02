<!-- /widget -->
<div class="widget">
    <div class="widget-title">
        <h4>Berita Terbaru</h4>
    </div>
    <ul class="comments-list">
        @foreach ($recentNews as $k => $news)
        <li>
            <div class="alignleft">
                <a href="{{ url('berita/'.$news->slug) }}"><img data-src="{{ $news->small_image_full_url }}" alt=""></a>
            </div>
            <small>{{date('d F y',strtotime($news->created_at))}}</small>
            <h3><a href="{{ url('berita/'.$news->slug) }}">{{ $news->title }}</a></h3>
        </li>
        @endforeach
    </ul>
</div>
