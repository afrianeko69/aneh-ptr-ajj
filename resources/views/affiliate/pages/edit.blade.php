@extends('layouts.affiliate.master')

@section('content')
    <div class="container">
        <div class="row">
            @include('layouts.affiliate.partials.sidebar')
            <div class="col-md-9 bg_color_1 add_padding_20 ">
                <div class="c-content-title-1">
                    <h3 class="c-font-uppercase c-font-bold">Pages</h3>
                    <div class="c-line-left"></div>
                </div>
                <div class="c-content-panel">
                    <div class="c-body">
                        
                        @if (isset($errors) && $errors->any())
                        <div class="col-md-12">
                            <span class="text-danger error error-profile_picture">
                                <small>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </small>
                            </span>
                        </div>
                        @endif
                        
                        {{ Form::model($page, array('route' => array('pages.update', $page->id), 'method' => 'PUT','class' => 'form-horizontal')) }}
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-4 control-label">Title</label>
                                <div class="col-md-6">
                                    <input type="text" name="title" class="form-control  c-square c-theme" id="" placeholder="" value="{{(!empty($page->title) ? $page->title : '')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-md-4 control-label">Description</label>
                                <div class="col-md-6">
                                    <textarea class="form-control  c-square c-theme" rows="5" name="body">{{(!empty($page->body) ? $page->body : '')}}</textarea>
                                </div>
                            </div>
                            <div class="form-group c-margin-t-40">
                                <div class="col-sm-offset-4 col-md-8">
                                    <button type="submit" class="btn c-theme-btn c-btn-square c-btn-uppercase c-btn-bold">Submit</button> 
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional.scripts')
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey={{env('TINYMCE_KEY')}}"></script>
<script>tinymce.init({ selector:'textarea' });</script>
@endsection
