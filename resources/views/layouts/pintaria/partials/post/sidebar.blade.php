<div class="c-content-tab-1 c-theme">
    <div class="nav-justified">
        <ul class="nav nav-tabs nav-justified">
            <li class="active"><a href="#blog_recent_posts" data-toggle="tab">Artikel Terbaru</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="blog_recent_posts">
                <ul class="c-content-recent-posts-1">
                    @foreach ($recentPost as $k => $post)
                    <li>
                        <div class="c-image">
                            <img src="{{ asset_cdn($post->image) }}" alt="" class="img-responsive">
                        </div>
                        <div class="c-post">
                            <a href="{{url('blog/'.$post->slug)}}" class="c-title">{{$post->title}}</a>
                            <div class="c-date">{{date('d F y',strtotime($post->created_at))}}</div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <br clear="both" />
    <div class="nav-justified">
        <ul class="nav nav-tabs nav-justified">
            <li class="active"><a href="#" data-toggle="tab">Tags</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active">
                <br clear="both">
                @foreach ($tags as $tag)
                    <p class="list_tags"><a href="{{route('tag',['slug' => str_slug($tag->name)])}}">{{$tag->name}}</a></p>
                @endforeach
            </div>
        </div>
    </div>
    <br clear="both">
    <div class="nav-justified">
        @include('shared.newsletter')
    </div>
</div>