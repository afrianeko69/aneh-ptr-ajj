@extends('layouts.pintaria.master') 

@section('title') Pintaria - Portal Edukasi Indonesia @endsection 

@section('content')

<div class="c-content-box c-size-md c-bg-white">
    <div class="c-content-tile-grid c-bs-grid-reset-space" data-auto-height="true">
        <div class="c-content-title-1 wow animate fadeInDown">
            <h3 class="c-font-uppercase c-center c-font-bold">{{$tambahPintar->title}}</h3>
        </div>

        <div class="c-content-panel">
            <div class="row wow animate">
                @php $colors = ['#0CAAE8','#5CD65C','#FF9E00','#DA1C5C'] @endphp
                @foreach ($videos as $k => $v)
                <div class="col-md-6">
                    <div class="c-content-tile-1" style="background-color:{{$colors[$k]}}">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="c-tile-content c-content-v-center" data-height="height">
                                    <div class="c-wrapper">
                                        <div class="c-body c-center">
                                            <h3 class="c-tile-title c-font-25 c-line-height-34 c-font-uppercase c-font-bold c-font-white">
                                                {{$v->title}}
                                            </h3>
                                            <p class="c-tile-body c-font-white">{!!$v->description!!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="c-tile-content c-arrow-right c-content-overlay"  style="background-color:{{$colors[$k]}}; border-left-color:{{$colors[$k]}};">
                                    <div class="c-overlay-wrapper force-overlay">
                                        <div class="c-overlay-content">
                                            <a class="c-content-isotope-overlay " href='#'  data-toggle="modal" data-target="#youtubeModal{{$k}}" >
                                                <i class="icon-control-play"></i> 
                                            </a>
                                        </div>
                                    </div>
                                    <div class="c-image c-overlay-object" data-height="height" style="background-image: url({{ asset_cdn($v->image) }})"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="youtubeModal{{$k}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog youtube-modal-dialog" role="document">
                        <iframe src="//www.youtube.com/embed/{{$v->youtube_id}}?rel=0&version=3&enablejsapi=1&origin={{$_SERVER['HTTP_HOST']}}" width="100%" height="100%" frameborder="0" allowfullscreen></iframe>   
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<center>
    <div class="c-pagination">
        {{ $videos->links() }}
    </div>
</center>
@endsection

@section('additional.scripts')
<script>
@foreach ($videos as $k => $v)
    @php echo 'var videoSrc'.$k.' = $("#youtubeModal'.$k.' iframe").attr("src");' @endphp
    $('#youtubeModal{{$k}}').on('show.bs.modal', function () { // on opening the modal
        $("#youtubeModal{{$k}} iframe").attr("src", videoSrc{{$k}}+"&amp;autoplay=1");
    });
    $("#youtubeModal{{$k}}").on('hidden.bs.modal', function (e) { // on closing the modal
        $("#youtubeModal{{$k}} iframe").attr("src", null);
    });
@endforeach
</script>
@endsection