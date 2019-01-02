@extends('layouts.pintaria.master')

@section('title') {{(empty($pages->title_tag)?'Pintaria - Portal Edukasi Indonesia':$pages->title_tag)}} @endsection

@section('meta_description') {{(empty($pages->meta_description)?'':$pages->meta_description)}} @endsection

@section('content')

<!-- BEGIN: PAGE CONTENT -->
<div class="c-content-box c-size-md c-bg-white">
    <div class="container">

        <div class="c-content-title-1">
            <h3 class="c-center c-font-dark c-font-uppercase">{{$pages->title}}</h3>
        </div>
        
        <div class="c-content-panel">
            <div class="c-body rich-text-editor">
                {!!$pages->body!!}
            </div>
        </div>

    </div>
</div>
<!-- END: PAGE CONTENT -->

@endsection