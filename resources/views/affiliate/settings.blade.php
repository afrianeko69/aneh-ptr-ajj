@extends('layouts.affiliate.master')

@section('content')
    <div class="container">
        <div class="row">
            @include('layouts.affiliate.partials.sidebar')
            <div class="col-md-9 bg_color_1 add_padding_20">

                <div class="c-content-title-1">
                    <h3 class="c-font-uppercase c-font-bold">Settings</h3>
                    <div class="c-line-left"></div>
                </div>

                @if ($pages->isEmpty() && $contents->isEmpty())
                    <a href="{{route('settings.import')}}" class="btn btn-primary pull-right">Import Pages & Content</a>
                @endif

                <br clear="both" />

                <form class="c-shop-form-1 add_padding_20" method="post" action="{{route('affiliate.updateSettings')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="">
                        <div class="row">
                            <span class="input">
                                <input class="input_field" type="text" name="site_title" value="{{(!empty($affiliate->site_title) ? $affiliate->site_title : '')}}">
                                <label class="input_label">
                                    <span class="input__label-content">Site Title</span>
                                </label>
                            </span>

                            <div class="form-group col-lg-12 col-md-12 col-sm-4">
                                <label class="control-label">Logo Preview</label>
                                <br clear="both" />
                                @if (!empty($affiliate->logo))
                                    <img class="img-responsive mb-2" src="{{ asset_cdn($affiliate->logo) }}" />
                                @else
                                    <img class="img-responsive mb-2" src="{{ asset('pintaria/img/shared/default-profile-photo.jpg') }}" />
                                @endif
                            </div>

                            <div class="form-group col-lg-12 col-md-12 col-sm-4">
                                <label class="control-label">Change Logo</label>
                                <input type="file" name="logo" >
                            </div>

                            <div class="form-group col-lg-12 col-md-12 col-sm-4">
                                <label class="control-label">Favicon Preview</label>
                                <br clear="both" />
                                @if (!empty($affiliate->favicon))
                                    <img class="img-responsive mb-2" src="{{ asset_cdn($affiliate->favicon) }}" />
                                @else
                                    <img class="img-responsive mb-2" src="{{ asset('pintaria/img/shared/default-profile-photo.jpg') }}" />
                                @endif
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-4">
                                <label class="control-label">
                                    Change Favicon<br>
                                    <small>Maximum file size is 160x160</small>
                                </label>
                                <input type="file" name="favicon" >
                            </div>

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
                        </div>
                        
                        <div class="row c-margin-t-20">
                            <div class="form-group col-md-12" role="group">
                                <button type="submit" class="btn_1 rounded full-width add_top_30 btn-update">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>         
            </div>
        </div>
    </div>
@endsection

@section('additional.scripts')
@endsection
