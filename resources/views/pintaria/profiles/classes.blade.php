@extends('layouts.pintaria.master')

@section('title') Pintaria - Portal Edukasi Indonesia @endsection

@section('content')
<div class="c-content-box c-size-md c-bg-white">
    <div class="container">
        <div class="c-content-title-1">
            <h3 class="c-center c-font-uppercase c-font-bold">Kelas Saya</h3>
            <div class="c-line-center"></div>
        </div>
        <!-- BEGIN: CONTENT/SHOPS/SHOP-2-7 -->
        <div class="c-bs-grid-small-space">
            <div class="row">
                @forelse($courses as $course)
                    <div class="col-md-3 col-sm-6 c-margin-b-20">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="c-content-product-2 c-bg-white c-border">
                                    <div class="c-content-overlay">
                                        <div class="c-overlay-wrapper">
                                            <div class="c-overlay-content">
                                                <a href="{{ $course->masuk_kelas_url }}" class="btn btn-md c-btn-grey-1 c-btn-uppercase c-btn-bold c-btn-border-1x c-btn-square">Masuk Kelas</a>
                                            </div>
                                        </div>
                                        <div class="c-bg-img-center c-overlay-object" data-height="height" style="height: 230px; background-image: url({{ $course->full_course_thumbnail_url }});"></div>
                                    </div>
                                    <div class="c-info bundle">
                                        <p class="c-title c-font-16 c-font-slim height-5">
                                            <a href="{{ $course->route_url }}" class="base-color">
                                                <strong>
                                                    {{ $course->course_name }}
                                                </strong>
                                            </a>
                                        </p>
                                        <p class="c-price c-font-14 c-font-slim">
                                            {{ $course->provider_list }}&nbsp;
                                        </p>
                                    </div>
                                    <div class="btn-group btn-group-justified" role="group">
                                        <div class="btn-group c-border-top" role="group">
                                            <a href="{{ $course->masuk_kelas_url }}" class="btn btn-sm c-btn-uppercase c-btn-square c-font-white c-bg-red-2 c-btn-product">
                                                <strong>
                                                    Masuk Kelas
                                                </strong>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row c-content-product-2">
                            <div class="col-md-12" style="height:3.7rem;">
                                @if($course->is_reviewable)
                                    <div class="btn-group btn-group-justified c-border" role="group">
                                        <div class="btn-group c-border-top" role="group">
                                            <a href="{{ $course->review_url }}" class="btn btn-sm c-btn-white c-btn-uppercase c-btn-square c-bg-white-hover base-color c-btn-product">
                                                <i class="fa fa-pencil"></i>
                                                <strong>
                                                    Tulis Ulasan
                                                </strong>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">
                        Belum ada kelas. Silakan cari kelas di <strong><a href="{{ route('home') }}">Beranda</a></strong>.
                    </p>
                @endforelse
            </div>
        </div><!-- END: CONTENT/SHOPS/SHOP-2-7 -->
    </div>
</div>
@endsection