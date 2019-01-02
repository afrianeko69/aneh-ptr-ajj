@extends('layouts.pintaria.master')

@section('title') Pintaria - Portal Edukasi Indonesia @endsection

@section('content')
<div class="container">
    @include('layouts.pintaria.partials.profile.sidebar')
    <div class="c-layout-sidebar-content ">
        <div class="c-content-title-1">
            <h3 class="c-font-uppercase">Hi <strong>{{ $user->name }}</strong></h3>
            <div class="c-line-left"></div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-lg-offset-0 col-md-4 col-md-offset-0 col-sm-4 col-sm-offset-0 col-xs-6 col-xs-offset-3">
                @if($user->profile_picture)
                    <img src="{{ route('asset', [$user->profile_picture]) }}" class="img-responsive">
                @else
                    <img src="{{ asset('pintaria/img/shared/default-profile-photo.jpg') }}" class="img-responsive"/>
                @endif
            </div>
            <div class="col-md-6 col-md-offset-1 col-sm-6 col-sm-offset-1 col-xs-12 mt-2">
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <label>Nama</label>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <p>{{ $user->name }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <label>Email</label>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <p>{{ $user->email }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <label>Nomor Telepon Rumah</label>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <p>{{ ($user->home_number ?: '(Tidak Tersedia)') }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <label>Nomor Ponsel</label>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <p>{{ ($user->phone_number ?: '(Tidak Tersedia)') }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <label>Alamat</label>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <p>{{ ($user->address ?: '(Tidak Tersedia)') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection