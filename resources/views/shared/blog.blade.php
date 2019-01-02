<div class="col-md-6">
    <div class="c-content-title-1">
        <h3 class="c-font-uppercase c-font-bold text-grey">BLOG</h3>
        <div class="c-line-left hide"></div>
    </div>
    @foreach($blogs as $blog)
    <div class="col-md-6">
        <div class="c-container">
            <div class="c-blog">
                <div class="c-post">
                    <div class="c-post-img"><img src="{{ asset_cdn($blog->image) }} " alt="" class="img-responsive"/></div>
                    <div class="c-post-content">
                        <h4 class="c-post-title"><a href="{{url('blog/'.$blog->slug)}}">{{$blog->title}}</a></h4>
                        <p class="c-text">{{str_limit($blog->excerpt,100)}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>