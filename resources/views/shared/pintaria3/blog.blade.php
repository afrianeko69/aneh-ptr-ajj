<div class="col-md-6">
    <h5>BLOG</h5>
    @foreach($blogs as $blog)
    <div class="col-md-6" style="float:left;">
        <div class="row">
            <ul>
                <li>
                    <h6><a href="{{url('blog/'.$blog->slug)}}">{{$blog->title}}</a></h6>
                    <p class="c-text">{{str_limit($blog->excerpt,100)}}</p>
                </li>
            </ul>
        </div>
    </div>
    @endforeach
</div>