@extends('layouts.affiliate.master')

@section('content')
    <div class="container">
        <div class="row">
            @include('layouts.affiliate.partials.sidebar')
            <div class="col-md-9 bg_color_1 add_padding_20">
                <div class="c-content-title-1">
                    <h3 class="c-font-uppercase c-font-bold">Pages</h3>
                    <div class="c-line-left"></div>
                </div>
                <div class="col-md-12">
                    @if (!$pages->isEmpty())
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Body</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($pages as $page)
                            <tr>
                                <td>{{$page->title}}</td>
                                <td>{{str_limit(strip_tags($page->body),150)}}</td>
                                <td><a href="{{route('pages.edit',['id' => $page->id])}}" class="btn c-theme-btn c-btn-uppercase c-btn-bold c-btn-square">Edit</a></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional.scripts')
@endsection
