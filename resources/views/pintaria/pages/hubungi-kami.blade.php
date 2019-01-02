@extends('layouts.pintaria.master')

@section('title') {{(empty($pages->title_tag)?'Pintaria - Portal Edukasi Indonesia':$pages->title_tag)}} @endsection

@section('meta_description') {{(empty($pages->meta_description)?'':$pages->meta_description)}} @endsection

@section('content')
<!-- BEGIN: CONTENT/CONTACT/CONTACT-1 -->
<div class="c-content-box c-size-md c-bg-img-top c-no-padding c-pos-relative">
    <div class="container">
        <div class="c-content-contact-1 c-opt-1">
            <div class="row" data-auto-height=".c-height">
                <div class="col-sm-8 c-desktop"></div>
                <div class="col-sm-4">
                    <div class="c-body">
                        <div class="c-section">
                            <h3>{{$pages->title}}</h3>
                        </div>
                        <div class="c-section rich-text-editor">
                            {!!$pages->body!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 

    @if (!empty($affiliate_contact['streetview_embed_code']))
    {!! addClassIframe($affiliate_contact['streetview_embed_code'])!!}
    @else
    <iframe class="c-content-contact-1-gmap"  src="https://www.google.com/maps/embed?pb=!1m0!4v1504777497465!6m8!1m7!1sKsL6oF9AZGekvaen96PrgA!2m2!1d-6.229895540743821!2d106.805680925228!3f15.93!4f39.889999999999986!5f0.8160813932612223" width="615" height="613" frameborder="0" style="border:0" allowfullscreen></iframe>
    @endif

</div> 
<!-- END: CONTENT/CONTACT/CONTACT-1 -->
@endsection