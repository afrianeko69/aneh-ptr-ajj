@extends('layouts.pintaria3.master')

@section('title') {{(empty($pages->title_tag)?'Pintaria - Portal Edukasi Indonesia':$pages->title_tag)}} @endsection

@section('meta_description') {{(empty($pages->meta_description)?'':$pages->meta_description)}} @endsection

@section('content')
    <section id="hero_in" class="static {{ $page_type }}">
        <div class="wrapper">
            <div class="container">
                <h1 class="fadeInUp"><span></span>{{$pages->title}}</h1>
            </div>
        </div>
    </section>

    <div class="bg_color_1">
        <div class="container margin_120_95">
            <div class="row justify-content-between">
                <div class="col-lg-12 col-md-12 rich-text-editor">
                    {!!$pages->body!!}
                </div>
            </div>
            <!--/row-->
        </div>
        <!--/container-->
    </div>
    <!--/bg_color_1-->

@endsection