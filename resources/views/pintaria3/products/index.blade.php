@extends('layouts.pintaria3.master')

@section('title') {{ !empty($product->seo_title) ? $product->seo_title : 'Pintaria - Portal Edukasi Indonesia' }} @endsection

@section('meta_description') {{ !empty($product->meta_description) ? $product->meta_description : '' }} @endsection

@section('additional.styles')
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.css" />
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-flat.css" />
<link rel="stylesheet" type="text/css" href="https://api.jooble.org/joobleapi.classic.css">
<style type="text/css">
    #hero_in.courses-2:before {
      background: url("{{ $product->banner_full_url }}") center center no-repeat;
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
    }
</style>
@endsection

@section('content')
<section id="hero_in" class="courses-2">
    <div class="wrapper">
        <div class="container">
            <h1 class="fadeInUp"><span></span>{{ $product->product_name }}</h1>
        </div>
    </div>
</section>

<div class="bg_color_1">
    <nav class="secondary_nav sticky_horizontal scroll-tab">
        <div class="container">
            <ul class="clearfix">
                <li><a href="#description" class="active">Deskripsi</a></li>
                @if($product->is_learning_material_showed)
                    <li><a href="#materi-belajar">Materi Belajar</a></li>
                @endif
                @if(!$product->providers->isEmpty())
                    <li><a href="#provider">Penyelenggara</a></li>
                @endif
                @if(!$product->instructors->isEmpty())
                    <li><a href="#instructure">Instruktur</a></li>
                @endif
                @if(!empty($product->career))
                    <li><a href="#career">Karir</a></li>
                @endif
                @if(!empty($product->jobs))
                    <li><a href="#job">Lowongan Pekerjaan</a></li>
                @endif
                @if($product->is_review_shown)
                    <li><a href="#reviews">Ulasan</a></li>
                @endif
                @if($bundles)
                    <li><a href="#bundle">Lihat Paket</a></li>
                @endif
            </ul>
        </div>
    </nav>
    <div class="container margin_60_35 pt-2">
        <div class="d-none container container-message-flash-danger-register">
        </div>
        <div class="row mt-4">
            <div class="col-12 mb-4">
                <span>
                    Bagikan :
                </span>
                <div id="shareNative" class="jssocials"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 order-2 order-lg-1">
                <section id="description">
                    <h2>Deskripsi</h2>
                    <div class="more">
                        {!! $product->description !!}
                    </div>
                </section>

                @if($product->is_learning_material_showed)
                    <section id="materi-belajar" class="add_bottom_30">
                        <h2>Materi Belajar</h2>
                        <div id="accordion">
                            @forelse($learning_materials as $key => $material)
                                <div class="card">
                                    <div class="card-header" id="heading{{ $key }}">
                                        <button class="header text-capitalize font-weight-bold mb-0" data-toggle="collapse" data-target="#collapse{{ $key }}" aria-expanded="true" aria-controls="collapse{{ $key }}">
                                            <i class="fa fa-plus" aria-hidden="true"></i>&nbsp; {{ $material['section_name'] }}
                                        </button>
                                    </div>

                                    <div id="collapse{{ $key }}" class="collapse" aria-labelledby="heading{{ $key }}" data-parent="#accordion">
                                        <div class="card-body p-0">
                                            @forelse($material['section_units'] as $unit)
                                                <div class="card">
                                                    <div class="card-header pl-5">
                                                        <i class="fa {{ $unit['icon'] }}" aria-hidden="true"></i> {{ $unit['name'] }}
                                                    </div>
                                                </div>
                                            @empty
                                                <p>Belum ada detail</p>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>Silakan cek lagi dalam beberapa saat. Kami sedang memproses data untuk Anda.</p>
                            @endforelse
                        </div>
                    </section>
                @endif

                @if(!$product->providers->isEmpty())
                    <section id="provider" class="add_bottom_30">
                        <div class="intro_title">
                            <h2>Penyelenggara</h2>
                        </div>
                        <div class="more mt-3">
                            @foreach($product->providers as $provider)
                                <div class="row">
                                    <div class="col-md-3 col-xs-12">
                                        <figure class="rev-thumb">
                                            @if($provider->logo)
                                                <img src="{{ $provider->logo_full_url }}" class="img-fluid circle_image" alt="">
                                            @endif
                                        </figure>
                                    </div>
                                    <div class="col-md-9 col-xs-12">
                                        <div class="rev-content">
                                            <div class="rev-info">
                                                <h4>{{ $provider->name }}</h4>
                                                 {{ $provider->tagline }}
                                            </div>
                                            <div class="rev-text">
                                                <p>
                                                    {!! $provider->description !!}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br clear="both">
                            @endforeach
                        </div>
                    </section>
                @endif

                @if(!$product->instructors->isEmpty())
                    <section id="instructure" class="add_bottom_30">
                        <h2>Instruktur</h2>
                        <div class="more mt-3">
                            @foreach($product->instructors as $instructor)
                                <div class="row">
                                    <div class="col-md-3 col-xs-12">
                                        <figure class="rev-thumb instructor">
                                            @if($instructor->profile_picture)
                                                <img src="{{ $instructor->profile_picture_full_url }}" class="img-fluid circle_image" alt="">
                                            @endif
                                        </figure>
                                    </div>
                                    <div class="col-md-9 col-xs-12">
                                        <div class="rev-content">
                                            <div class="rev-info">
                                                <h4>{{ $instructor->name }}</h4>
                                                {{ $instructor->title }}
                                            </div>
                                            <div class="rev-text">
                                                <p>
                                                    {!! $instructor->description !!}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br clear="both">
                            @endforeach
                        </div>
                    </section>
                @endif

                @if($product->career)
                    <section id="career" class="add_bottom_30">
                        <h2>Karir</h2>
                        <div class="more">
                            {!! $product->career !!}
                        </div>
                    </section>
                @endif

                @if($product->jobs)
                    <section id="job" class="add_bottom_30">
                        <h2>Lowongan Pekerjaan</h2>
                        <div class="more">
                            
                            <div id="joobleVacancyBox">
                                <input id="joobleVacancyOnPage" type="hidden" value="5">
                                <input id="joobleCharsAroundCurrentPage" type="hidden" value="1">
                                <input id="joobleCountry" type="hidden" value="id">
                                <input id="joobleIsSnippet" type="hidden" value="1">
                                <input id="joobleWaitMessage" type="hidden" value="Please wait a moment while we're retrieving the job listings">
                                <input id="joobleKey" type="hidden" value="c57383cb-b9c1-450c-bd4c-81ba541fe13a">
                                <input id="joobleKeyword" type="search"  placeholder="Posisi" value="{{ strip_tags($product->jobs) }}" onkeyup="if(event.keyCode==13){joobleAPI.newSearch()}"  >
                                <input id="joobleLocation" type="search" placeholder="Lokasi"  value="Jakarta" onkeyup="if(event.keyCode==13){joobleAPI.newSearch()}" >
                                <button id="joobleButton" onClick="joobleAPI.newSearch()">Cari!</button>
                                <div id="joobleVacancy"></div>
                                <div id="jooblePageing"></div>
                                <div id="joobleStaticLink"><a href="https://id.jooble.org/" target="blank">Loker dari <span class="jooble logo bluechar">J</span><span class="jooble logo greenchar">oo</span><span class="jooble logo bluechar">ble</span></a></div>
                            </div>
                        </div>
                    </section>
                @endif

                @if ($product->is_review_shown)
                    <section id="reviews" class="add_bottom_30">
                        <h2>Ulasan</h2>
                        @php
                            $rating = $product->rating_review;
                        @endphp
                            <div class="reviews-container">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div id="review_summary">
                                            <strong>{{ $rating['avg_rating'] }}</strong>
                                            <div class="rating">
                                                @for($i = 0; $i < 5; $i++)
                                                    <i class="icon_star {{ ((int) $rating['avg_rating'] > $i) ? 'voted': '' }}"></i>
                                                @endfor
                                            </div>
                                            <small>{{ $rating['total_reviewer'] }} Ulasan</small>
                                        </div>
                                    </div>
                                    @if($rating['review']['reviews']->isEmpty())
                                        <div class="col-lg-9">
                                            <div class="row rounded h-100 align-items-center">
                                                <div class="col-12">
                                                    <p class="text-center pt-4">
                                                        Kami masih menunggu ulasan Anda untuk program ini
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-lg-9">
                                            @for($i = 5; $i > 0; $i--)
                                                <div class="row">
                                                    <div class="col-lg-10 col-9">
                                                        <div class="progress">
                                                            <div class="progress-bar" role="progressbar" style="width: {{ $rating['ratings'][$i]['avg'] }}%" aria-valuenow="{{ $rating['ratings'][$i]['avg'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-3"><small><strong>{{ $i }} stars</strong></small></div>
                                                </div>
                                            @endfor
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <hr>

                            @if(!$rating['review']['reviews']->isEmpty())
                                <div class="reviews-container">
                                    <div class="review-body">
                                        @php
                                            $reviews = $rating['review'];
                                        @endphp
                                        @foreach($reviews['reviews'] as $review)
                                            <div class="review-box clearfix">
                                                <figure class="rev-thumb">
                                                    @if($review->profile_picture)
                                                        <img src="{{ $review->full_profile_picture_url }}" alt="">
                                                    @else
                                                        <div class="circle">
                                                            <p>
                                                                {{ $review->reviewer_initial }}
                                                            </p>
                                                        </div>
                                                    @endif
                                                </figure>
                                                <div class="rev-content">
                                                    <div class="rating">
                                                        @for($i = 0; $i < 5; $i++)
                                                            <i class="icon_star {{ ($i < $review->rating) ? 'voted' : '' }}"></i>
                                                        @endfor
                                                    </div>
                                                    <div class="rev-info">
                                                        {{ $review->reviewer_name }} – {{ $review->human_review_rating_at }}:
                                                    </div>
                                                    <div class="rev-text">
                                                        <p>
                                                            {{ $review->review }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="review-footer">
                                        <div class="col">
                                            <div class="row justify-content-end">
                                                <nav>
                                                    @php
                                                        $total_pagination = $reviews['total_pagination'];
                                                        $is_class_disabled_for_next = 'disabled';
                                                        $next_page = '';
                                                        $last_page = '';
                                                        if($total_pagination > 1) {
                                                            $is_class_disabled_for_next = '';
                                                            $next_page = 2;
                                                            $last_page = $total_pagination;
                                                        }
                                                        $max_right_nearest_page = 3;
                                                        if($total_pagination < $max_right_nearest_page) {
                                                            $max_right_nearest_page = $total_pagination;
                                                        }
                                                    @endphp
                                                    <ul class="pagination">
                                                        <li class="disabled page-item">
                                                            <a href="#" aria-label="Previous" class="page-link" tabindex="-1">
                                                                <span aria-hidden="true">&#60;</span>
                                                                <span class="sr-only">Previous</span>
                                                            </a>
                                                        </li>
                                                        @for($i = 1; $i <= $max_right_nearest_page; $i++)
                                                            <li class="page-item {{ $i == 1 ? 'active' : '' }}" data-page="{{ $i }}">
                                                                <a href="#" aria-label="{{ $i }}" class="page-link">
                                                                    {{ $i }}
                                                                </a>
                                                            </li>
                                                        @endfor
                                                        @if($max_right_nearest_page != $total_pagination)
                                                            <li class="page-item">
                                                                <a href="#" class="no-border-top no-border-bottom page-link">
                                                                    ..
                                                                </a>
                                                            </li>
                                                            <li class="page-item" data-page="{{ $total_pagination }}">
                                                                <a href="#" aria-label="{{ $total_pagination }}" class="page-link">
                                                                    {{ $total_pagination }}
                                                                </a>
                                                            </li>
                                                        @endif
                                                        <li class="page-item {{ $is_class_disabled_for_next }}" data-page="{{ $next_page }}">
                                                            <a href="#" aria-label="Next" class="page-link">
                                                                <span aria-hidden="true">&#62;</span>
                                                                <span class="sr-only">Next</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                    </section>
                @endif
            </div>

            <aside class="col-lg-4 order-1" id="sidebar">
                <input type="hidden" name="slug" value="{{ $product->slug }}">
                {{ csrf_field() }}
                <div class="box_detail">
                    <figure>
                        @if($product->youtube_video_id)
                            <a href="{{ $product->youtube_url }}" class="video_sidebar" >
                                <i class="arrow_triangle-right"></i>
                                <img src="{{ $product->image_full_url }}" alt="" class="img-fluid">
                            </a>
                        @else
                            <img src="{{ $product->image_full_url }}" alt="" class="img-fluid">
                        @endif
                    </figure>
                    <div class="price">
                        @if(is_null($product->price))

                        @elseif($product->is_discount)
                            {{ $product->formatted_price_after_discount }}
                            <br/>
                            <span class="original_price">
                                <em>{{ $product->formatted_price }}</em>
                            </span>
                            <input type="hidden" id="taken-price" value="{{ $product->formatted_price_after_discount }}">
                        @else
                            {{ $product->formatted_price }}
                            <input type="hidden" id="taken-price" value="{{ $product->formatted_price }}">
                        @endif
                    </div>

                    @if($user_class)
                        @if($product->is_tryout)
                            <a href="{{ $product->tryout_url }}" class="btn_1 full-width">Mulai Tes</a>
                        @else
                            @php
                                $custom_url = ($user_class->lms_custom_url) ? $user_class->lms_custom_url : lmsLearningActivityUrl($user_class->lms_klass_id);
                            @endphp
                            <a href="{{ route('masuk.kelas') . '?masuk_kelas=' . $custom_url }}" class="btn_1 full-width">Masuk Kelas</a>
                        @endif
                    @elseif ($product->is_open_enrollment == 2)
                        <a href="{{ $product->direct_link_url }}" target="_blank" class="btn_2 full-width">Info Selengkapnya</a>
                    @elseif ($product->is_open_enrollment == 3)
                        <a href="{{ route('product.konfirmasi.beli', [$product->slug, 'paket' => $product->selected_bundle_id]) }}" class="btn_2 full-width">
                            {{ ($product->price == 0) ? 'Ambil Paket' : 'Beli Paket' }}</a>
                    @elseif($product->is_open_enrollment && !is_null($product->price))
                        <a href="{{ route('product.konfirmasi.beli', ['slug' => $product->slug]) }}" class="btn_2 full-width">{{ ($product->price == 0) ? 'Mulai Sekarang' : 'Beli Sekarang' }}</a>
                    @else
                        <a href="javascript:scrollToElementWithDistance('#saya-berminat', 0);" class="btn_1 full-width">Saya Berminat</a>
                    @endif

                    @if($bundles)
                        <a href="javascript:scrollToElement('#bundle');" class="btn_2 full-width btn-block outline mb-3">
                            Lihat Paket
                        </a>
                    @endif

                    <div id="list_feat">
                        <ul>
                            @if($product->category_lists)
                                <li><strong>Kategori:</strong> {{ $product->category_lists }}</li>
                            @endif
                            @if($product->category_classification_name)
                                <li><strong>Klasifikasi Kategori:</strong> {{ $product->category_classification_name }}</li>
                            @endif
                            @if($product->learning_method_name)
                                <li><strong>Metode Belajar:</strong> {{ $product->learning_method_name }}</li>
                            @endif
                            @if($product->topic_list)
                                <li><strong>Topik:</strong> {{ $product->topic_list }}</li>
                            @endif
                            @if($product->location_name && $product->location_name != '-')
                                <li><strong>Lokasi:</strong> {{ $product->location_name }}</li>
                            @endif
                            @if($product->quota != 0)
                                <li><strong>Kapasitas Peserta:</strong> {{ $product->quota_text }}</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </aside>
        </div>

        @if($bundles)
            <div class="container margin_60_35" id="bundle">
                <h2>Paket</h2>
                @foreach($bundles as $bundle_detail)
                    <div class="row">
                        <div class="col-12">
                            @php
                                $b_detail = $bundle_detail['bundle'];
                            @endphp
                            <h5 class="float-left pt-2">
                                {{ $b_detail->name }} ({{ $b_detail->formatted_price }})
                            </h5>
                            @if($b_detail->is_purchased)
                                <button class="btn_1 full-width btn-yellow-disabled outline float-right">Telah Dibeli</button>
                            @else
                                @if ($b_detail->price == 0)
                                    <a href="{{ route('product.konfirmasi.beli', [$product->slug, 'paket' => $b_detail->id]) }}" class="btn_2 full-width float-right btn-package-purchase">Ambil Paket</a>
                                @else
                                <a href="{{ route('product.konfirmasi.beli', [$product->slug, 'paket' => $b_detail->id]) }}" class="btn_2 full-width float-right btn-package-purchase">Beli Paket</a>
                                @endif
                            </button>
                            @endif
                        </div>
                        <div class="owl-carousel owl-theme bundle-package-wrapper mt-3">
                            @foreach($bundle_detail['products'] as $b_product)
                                <div class="item">
                                    <div class="box_grid">
                                        <figure>
                                            <a href="{{ $b_product->route_url }}">
                                                <div class="preview"><span>Lihat Program</span></div>
                                                <img src="{{ $b_product->image_full_url }}" class="img-fluid" alt="">
                                            </a>
                                        </figure>
                                        <div class="wrapper">
                                            <h3 class="h-40p">
                                                <a href="{{ $b_product->route_url }}">
                                                    {{ str_limit($b_product->name, 40) }}
                                                </a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<div class="container mb-5">
    <div class="row">
        <div class="col-12">
            {!! $product->seo !!}
        </div>
    </div>
</div>

@if ($product->is_lead_form_active)
    @include('shared.pintaria3.more-info')
@endif
@endsection

@section('additional.scripts')
@if(env('APP_DEBUG') == false)
<script src="https://app.midtrans.com/snap/snap.js" type="text/javascript" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
@else
<script src="https://app.sandbox.midtrans.com/snap/snap.js" type="text/javascript" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
@endif

<script type="text/javascript" src="{{url('pintaria3/js/joobleapi.js')}}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.min.js"></script>

<script type="text/javascript">
var product_type = "{{ $product->type }}";
var is_purchase_process = "{{ Request::get('beli') }}";
var bundle = "{{ Request::get('paket') }}";
var learning_method = "{{ $product->learning_method_name ? $product->learning_method_name : '' }}";
var providers = "{{ $product->providers ? $product->provider_list : '' }}";
var product_id = "{{ $product->id }}";
var product_price = "{{ $product->is_discount ? $product->price_after_discount : $product->price }}";
var referral_reward_data = null;
var promo_reward_data = null;
var productSlug = "{{ $product->slug }}";
var productName = "{{ $product->product_name }}";
var currentPageRatingReview = 1;


$(document).ready(function() {

    $('a[href^="#"]').click(function(e) {
        e.preventDefault();
        var target = this.hash, $target = $(target);
        if ($(window).width() < 960) {
            $('html, body').animate({
                scrollTop: $target.offset().top - 120
            }, 300);
        }
    });

    if(is_purchase_process == true) {
        if(is_login != true) {
            window.location.href = login_url + '?previous_url=' + window.location.href;
        } else {
            if(product_type == 'paid') {
                initModalPurchase(productName, $('#taken-price').val(), learning_method, providers);
            }else{
                buyNow({}, '.btn-buy-now');
            }
        }
    } else if(bundle) {
        if(is_login != true) {
            window.location.href = login_url + '?previous_url=' + window.location.href;
        } else {
            //check if bundle is valid or not
            var is_valid_bundle = false;
            var selected_bundle = {};
            $('button.btn-package-purchase').each(function() {
                if($(this).data('bundle-id') == bundle && is_valid_bundle == false) {
                    is_valid_bundle = true;
                    selected_bundle = {
                        id: $(this).data('bundle-id'),
                        name: $(this).data('bundle-name'),
                        price: $(this).data('bundle-price'),
                        clean_price: $(this).data('bundle-clean-price')
                    };
                }
            });

            if(is_valid_bundle) {
                $('#payment-popup-modal .modal-body button#payment_confirm.btn-pay-now').data('bundle-id', selected_bundle.id);
                $('#payment-popup-modal .modal-body button#payment_confirm.btn-pay-now').data('bundle-clean-price', selected_bundle.clean_price);
                initModalPurchase(selected_bundle.name, selected_bundle.price, '', '');
            } else {
                history.replaceState('', document.title, window.location.pathname, window.location.search);
            }
        }
    }

    $(document).on('click', '.btn-buy-now', function(e) {
        e.preventDefault();
        $('.error').children().html('');

        var current_url = window.location.pathname + '/konfirmasi-beli';
        history.replaceState('', document.title, current_url, window.location.search);
        if(is_login != true) {
            window.location.href=login_url + '?previous_url=' + window.location.href;
            return false;
        }
        
        tracker('product', product_id);

        if(product_type == 'free') {
            buyNow({}, '.btn-buy-now');
        } else if(product_type == 'paid') {
            initModalPurchase(productName, $('#taken-price').val(), learning_method, providers);
        }
    });

    $(document).on('click', 'button.btn-package-purchase', function(e) {
        e.preventDefault();
        var bundle_id = $(this).data('bundle-id');
        var current_url = window.location.pathname + '?paket=' + bundle_id;
        history.replaceState('', document.title, current_url, window.location.search);
        if(is_login != true) {
            window.location.href = login_url + '?previous_url=' + window.location.href;
            return false;
        }

        tracker('bundle', bundle_id);

        $('#payment-popup-modal .modal-body button#payment_confirm.btn-pay-now').data('bundle-id', bundle_id);
        $('#payment-popup-modal .modal-body button#payment_confirm.btn-pay-now').data('bundle-clean-price', $(this).data('bundle-clean-price'));
        initModalPurchase($(this).data('bundle-name'), $(this).data('bundle-price'), '', '');
    });

    $(document).on('click', '#payment-popup-modal #payment_confirm.btn-pay-now', function(e) {
        e.preventDefault();
        var data = {};
        data['phone_number'] = $('#payment-popup-modal #phone-confirm-field #phone-confirm').val();
        buyNow(data, '#payment-popup-modal #payment_confirm.btn-pay-now');
    });

    $(document).on('hidden.bs.modal', '#payment-popup-modal', function() {
        history.replaceState('', document.title, window.location.pathname, window.location.search);
    });

    // Section Referral
    $(document).on('keyup', '#payment-popup-modal div.referral-code-field-wrapper input#referral_code', function(e) {
        var self = $(this);
        $(this).val(self.val().toUpperCase());
    });

    $(document).on('click', '#payment-popup-modal button.btn.btn-referral-code', function (e) {
        e.preventDefault();
        $('#payment-popup-modal .error').children().html('');

        var self = $(this);
        if(self.hasClass('btn_1')) {
            var referral_code = $('#payment-popup-modal div.referral-code-field-wrapper input#referral_code').val();
            if(!referral_code) {
                $('#payment-popup-modal div.referral-code-field-wrapper span.error-referral_code').children().html('Harap memasukkan kode referral.');
                return false;
            }

            disableReferralCodeField();
            var packagePrice = getCurrentPrice();
            checkReferralCode(referral_code, packagePrice.id, packagePrice.type);
        } else {
            referral_reward_data = null;
            resetReferralCode();
        }
    });

    function checkReferralCode(referral_code, id, type) {
        var btn_container = '#payment-popup-modal button.btn.btn-referral-code';
        $(btn_container).attr('disabled', true);

        $.ajax({
            url: baseUrl + '/referral-codes/' + referral_code + '/' + id + '/' + type,
            type: 'GET',
            async: true,
            success:function(response) {
                if(response.status == 200 && response.body.is_valid == true) {
                    referral_reward_data = response.body;
                    appendReward();
                } else {
                    $('#payment-popup-modal div.referral-code-field-wrapper span.error-referral_code').children().html(response.message);
                    resetReferralCode();
                }
                $(btn_container).attr('disabled', false);
            },
            error: function(response) {
                $('#payment-popup-modal div.referral-code-field-wrapper span.error-referral_code').children().html('Kode Referral tidak ditemukan atau sudah tidak berlaku.');
                resetReferralCode();
                $(btn_container).attr('disabled', false);
            }
        });
    }

    function resetReferralCode() {
        $('#payment-popup-modal .modal-body div.referral-code-field-wrapper #referral_code').val('');
        $('#payment-popup-modal .modal-body div.referral-code-field-wrapper #referral_code').attr('disabled', false);
        $('#payment-popup-modal .modal-body div.referral-code-field-wrapper button.btn.btn-referral-code').addClass('btn_1');
        $('#payment-popup-modal .modal-body div.referral-code-field-wrapper button.btn.btn-referral-code').removeClass('btn-danger');
        $('#payment-popup-modal .modal-body div.referral-code-field-wrapper button.btn.btn-referral-code').children().html('Gunakan Kode Referral');
        $('#payment-popup-modal .modal-body .table tr.referrer-code-wrapper .referral-code-discount-nominal').html('');
        $('#payment-popup-modal .modal-body .table tr.referrer-code-wrapper').addClass('d-none');
        appendReward();
    }

    function disableReferralCodeField() {
        $('#payment-popup-modal .modal-body div.referral-code-field-wrapper #referral_code').attr('disabled', true);
        $('#payment-popup-modal .modal-body div.referral-code-field-wrapper button.btn.btn-referral-code').addClass('btn-danger');
        $('#payment-popup-modal .modal-body div.referral-code-field-wrapper button.btn.btn-referral-code').removeClass('btn_1');
        $('#payment-popup-modal .modal-body div.referral-code-field-wrapper button.btn.btn-referral-code').children().html('Batalkan');
    }
    // End Section Referral

    // Section Promo Code
    $(document).on('keyup', '#payment-popup-modal div.promo-code-field-wrapper input#promo_code', function(e) {
        var self = $(this);
        $(this).val(self.val().toUpperCase());
    });

    $(document).on('click', '#payment-popup-modal button.btn.btn-promo-code', function (e) {
        e.preventDefault();
        $('#payment-popup-modal .error').children().html('');

        var self = $(this);
        if(self.hasClass('btn_1')) {
            var promo_code = $('#payment-popup-modal div.promo-code-field-wrapper input#promo_code').val();
            if(!promo_code) {
                $('#payment-popup-modal div.promo-code-field-wrapper span.error-promo_code').children().html('Harap memasukkan kode promo.');
                return false;
            }

            disablePromoCodeField();
            var packagePrice = getCurrentPrice();
            checkPromoCode(promo_code, packagePrice.id, packagePrice.type);
        } else {
            promo_reward_data = null;
            resetPromoCode();
        }
    });

    function checkPromoCode(promo_code, id, type) {
        var btn_container = '#payment-popup-modal button.btn.btn-promo-code';
        $(btn_container).attr('disabled', true);

        $.ajax({
            url: baseUrl + '/promo-codes/' + promo_code + '/' + id + '/' + type,
            type: 'GET',
            async: true,
            success:function(response) {
                if(response.status == 200 && response.body.is_valid == true) {
                    promo_reward_data = response.body;
                    appendReward();
                } else {
                    $('#payment-popup-modal div.promo-code-field-wrapper span.error-promo_code').children().html(response.message);
                    resetPromoCode();
                }
                $(btn_container).attr('disabled', false);
            },
            error: function(response) {
                $('#payment-popup-modal div.promo-code-field-wrapper span.error-promo_code').children().html('Kode Promo tidak ditemukan atau sudah tidak berlaku');
                resetPromoCode();
                $(btn_container).attr('disabled', false);
            }
        });
    }

    function resetPromoCode() {
        $('#payment-popup-modal .modal-body div.promo-code-field-wrapper #promo_code').val('');
        $('#payment-popup-modal .modal-body div.promo-code-field-wrapper #promo_code').attr('disabled', false);
        $('#payment-popup-modal .modal-body div.promo-code-field-wrapper button.btn.btn-promo-code').addClass('btn_1');
        $('#payment-popup-modal .modal-body div.promo-code-field-wrapper button.btn.btn-promo-code').removeClass('btn-danger');
        $('#payment-popup-modal .modal-body div.promo-code-field-wrapper button.btn.btn-promo-code').children().html('Gunakan Kode Promo');
        $('#payment-popup-modal .modal-body .table tr.promo-code-wrapper .promo-code-discount-nominal').html('');
        $('#payment-popup-modal .modal-body .table tr.promo-code-wrapper').addClass('d-none');
        appendReward();
    }

    function disablePromoCodeField() {
        $('#payment-popup-modal .modal-body div.promo-code-field-wrapper #promo_code').attr('disabled', true);
        $('#payment-popup-modal .modal-body div.promo-code-field-wrapper button.btn.btn-promo-code').addClass('btn-danger');
        $('#payment-popup-modal .modal-body div.promo-code-field-wrapper button.btn.btn-promo-code').removeClass('btn_1');
        $('#payment-popup-modal .modal-body div.promo-code-field-wrapper button.btn.btn-promo-code').children().html('Batalkan');
    }
    // End Section Promo Code


    function appendReward() {
        var packagePrice = getCurrentPrice();
        var reward = calculateReward(packagePrice.price);
        if(reward.referral_reward != 0) {
            $('#payment-popup-modal .modal-body .table tr.referrer-code-wrapper').removeClass('d-none');
            var formattedReferralReward = (reward.referral_reward).formatMoney(0, ',', '.');
            $('#payment-popup-modal .modal-body .table tr.referrer-code-wrapper .referral-code-discount-nominal').html('- ' + formattedReferralReward);
        }

        if(reward.promo_reward != 0) {
            $('#payment-popup-modal .modal-body .table tr.promo-code-wrapper').removeClass('d-none');
            var formattedPromoReward = (reward.promo_reward).formatMoney(0, ',', '.');
            $('#payment-popup-modal .modal-body .table tr.promo-code-wrapper .promo-code-discount-nominal').html('- ' + formattedPromoReward);
        }
        var formatted_grand_total = (reward.grand_total).formatMoney(0, ',', '.');
        $('#payment-popup-modal .modal-body .price.blue-text.grand-total strong').html(formatted_grand_total);
    }

    function calculateReward(price) {
        var reward = {
            'referral_reward': 0,
            'promo_reward': 0,
            'grand_total': parseInt(price)
        };

        if(promo_reward_data != null) {
            switch(promo_reward_data.type) {
                case 'Percentage':
                    var value = parseFloat(promo_reward_data.value);
                    reward.promo_reward = ((value / 100.0) * reward.grand_total);
                    reward.grand_total -= reward.promo_reward;
                    break;
                case 'Amount':
                    reward.promo_reward = parseFloat(promo_reward_data.value);
                    reward.grand_total -= reward.promo_reward;
                    break;
            }
        }

        if(referral_reward_data != null) {
            switch(referral_reward_data.type) {
                case 'Percentage':
                    var value = parseFloat(referral_reward_data.value);
                    reward.referral_reward = ((value / 100.0) * reward.grand_total);
                    reward.grand_total -= reward.referral_reward;
                    break;
                case 'Amount':
                    reward.referral_reward = parseFloat(referral_reward_data.value);
                    reward.grand_total -= reward.referral_reward;
                    break;
            }
        }

        return reward;
    }

    function getCurrentPrice() {
        var pricePackage = {
            'id': $('#payment-popup-modal .modal-body button#payment_confirm.btn-pay-now').data('bundle-id'),
            'type': 'bundle',
            'price': $('#payment-popup-modal .modal-body button#payment_confirm.btn-pay-now').data('bundle-clean-price')
        };

        if(!pricePackage.id || pricePackage.id == 0 || pricePackage.id == '') {
            pricePackage.type = 'product';
            pricePackage.id = product_id;
            pricePackage.price = product_price;
        }
        return pricePackage;
    }

    function buyNow(data, btn_container) {
        $(btn_container).attr('disabled', true);
        $('.error').children().html('');

        data['_token'] = $("input[name=_token]").val();
        data['slug'] = $('input[name=slug]').val();
        data['type'] = product_type;
        data['bundle_id'] = $('#payment-popup-modal .modal-body button#payment_confirm.btn-pay-now').data('bundle-id');
        data['referral_code'] = '';
        data['promo_code'] = '';

        if($('#payment-popup-modal button.btn.btn-referral-code').hasClass('btn-danger')) {
            data['referral_code'] = $('#payment-popup-modal div.referral-code-field-wrapper #referral_code').val();
        }

        if($('#payment-popup-modal button.btn.btn-promo-code').hasClass('btn-danger')) {
            data['promo_code'] = $('#payment-popup-modal div.promo-code-field-wrapper #promo_code').val();
        }

        if (data['bundle_id'] != 0){
            object_id = data['bundle_id'];
            object_name = 'click_payment_bundle';
        } else {
            object_id = product_id;
            object_name = 'click_payment_product';
        }
        tracker(object_name, object_id);

        $.ajax({
            url: "{{ route('purchase.kelas') }}",
            type: 'POST',
            async:true,
            data: data,
            success:function(response) {
                if(response.status == 200) {
                    if(response.is_using_midtrans == false) {
                        location.href = "{{ route('kelas.saya') }}";
                    }else{
                        var order_number = response.data.order_number;
                        snap.pay(response.data.token, {
                            onSuccess: function(result) {
                                window.location.href = baseUrl + "/transaksi-pembayaran-berhasil/" + order_number;
                            },
                            onPending:function(result) {
                                window.location.href = baseUrl + "/menunggu-transaksi-pembayaran/" + order_number;
                            },
                            onError:function(result) {
                                window.location.href = baseUrl + '/transaksi-pembayaran-gagal/' + order_number + '?link_pembayaran=' + window.location.href;
                            },
                            onClose:function() {

                            }
                        });
                    }
                } else if(response.status == 401) {
                    location.href="{{ route('masuk') }}" + '?previous_url=' + window.location.href;
                } else {
                    showErrorMessage(response.message);
                }
                $('#payment-popup-modal').modal('hide');
                $(btn_container).attr('disabled', false);
            },
            error:function(response) {
                if(response.status == 422) {
                    if(data.type == 'free') {
                        showErrorMessage('Maaf, saat ini kami sedang kesulitan memproses data anda.');
                    } else {
                        $.each(response.responseJSON, function(key, val) {
                            $('#payment-popup-modal .error.error-'+key).children().html(val[0]);
                        });
                    }
                } else {
                    showErrorMessage('Maaf, silakan mencoba beberapa saat lagi.');
                }
                $(btn_container).attr('disabled', false);
            }
        });
    }

    function initModalPurchase(productTitle, price, learningMethod, modalProviders) {
        $('#payment-popup-modal .error').children().html('');
        referral_reward_data = promo_reward_data = null;
        if (learningMethod == '' && modalProviders == '') {
            $('#payment-popup-modal .modal-body .table span.confirm_partner span img.bullet-sub-title').addClass('d-none');
        }else {
            $('#payment-popup-modal .modal-body button#payment_confirm.btn-pay-now').data('bundle-id', '0');
            $('#payment-popup-modal .modal-body button#payment_confirm.btn-pay-now').data('bundle-clean-price', '0');
            $('#payment-popup-modal .modal-body .table span.confirm_partner span img.bullet-sub-title').removeClass('d-none');
        }

        resetReferralCode();
        resetPromoCode();
        $('#payment-popup-modal .modal-body .title').html(productTitle);
        $('#payment-popup-modal .modal-body .price.blue-text.product-price').html(price);
        $('#payment-popup-modal .modal-body .price.blue-text.grand-total strong').html(price);
        $('#payment-popup-modal .modal-body .confirm_partner .learning-method').html(learningMethod);
        $('#payment-popup-modal .modal-body .confirm_partner span.provider').html(modalProviders);
        $('#payment-popup-modal').modal('show');
    }

    // Rating & Review
    $(document).on('click', '.page-item', function (e) {
        e.preventDefault();
        var page = $(this).data('page');
        if(!$(this).hasClass('disabled') && page && page != currentPageRatingReview) {
            moreRatingReview(page);
        }
    });

    function moreRatingReview(page) {
        var reviewWrapperBodyTag = $('.reviews-container .review-body');
        var reviewWrapperFooterTag = $('.reviews-container .review-footer nav ul.pagination');
        var previousPagination = reviewWrapperFooterTag.html();
        var previousReviewBody = reviewWrapperBodyTag.html();

        reviewWrapperBodyTag.html('');
        scrollToElement('.reviews-container .review-body');
        $('ul.pagination li.page-item').addClass('disabled');

        $.ajax({
            url: "{{ route('api.more.review') }}",
            async: true,
            method: 'GET',
            data: {
                slug: productSlug,
                page: page,
                take: 5
            },
            success:function(response) {
                if(response.status == 200) {
                    currentPageRatingReview = response.data.current_page;
                    handleRatingReviewBody(response.data, reviewWrapperBodyTag);
                    handleRatingReviewPagination(response.data, reviewWrapperFooterTag);
                } else {
                    reviewWrapperBodyTag.html(previousReviewBody);
                    reviewWrapperFooterTag.html(previousPagination);
                }
            },
            error:function(response) {
                reviewWrapperBodyTag.html(previousReviewBody);
                reviewWrapperFooterTag.html(previousPagination);
            }
        });
    }

    function handleRatingReviewBody(data, container) {
        var reviewBody = '';
        $.each(data.reviews, function(key, value) {
            reviewBody += '<div class="review-box clearfix">'+
                                '<figure class="rev-thumb">';
                                if(value.full_profile_picture_url) {
                                    reviewBody += '<img src="'+ value.full_profile_picture_url +'" alt="">';
                                } else {
                                    reviewBody += '<div class="circle">'+
                                                        '<p>'+
                                                            value.reviewer_initial+
                                                        '</p>'+
                                                    '</div>';
                                }
                 reviewBody += '</figure>'+
                                '<div class="rev-content">'+
                                    '<div class="rating">';
                                        for(var i = 0; i < 5; i++) {
                                            reviewBody += '<i class="icon_star ' + ((i < value.rating) ? 'voted' : '') +'"></i>';
                                        }
                        reviewBody +=' </div>'+
                                    '<div class="rev-info">'+
                                        value.reviewer_name + '–' + value.human_review_rating_at + ':'+
                                    '</div>'+
                                    '<div class="rev-text">'+
                                        '<p>'+
                                            value.review+
                                        '</p>'+
                                    '</div>'+
                                '</div>'+
                            '</div>';
        });

        container.html(reviewBody);
    }

    function handleRatingReviewPagination(data, container) {
        var currentPage = data.current_page;
        var totalPage = data.total_pagination;
        var isPrevDisabled = 'disabled';
        var prevPage = '';
        if(currentPage > 1) {
            isPrevDisabled = '';
            prevPage = currentPage - 1;
        }

        var isNextDisabled = '';
        var nextPage = '';
        if(currentPage == totalPage) {
            isNextDisabled = 'disabled';
        }
        if(currentPage < totalPage) {
            nextPage = currentPage + 1;
        }

        var max_left_nearest_page_phone = currentPage - 1;
        if(max_left_nearest_page_phone < 1) {
            max_left_nearest_page_phone = 1;
        }

        var max_right_nearest_page_phone = currentPage + 1;
        if(max_right_nearest_page_phone > totalPage) {
            max_right_nearest_page_phone = totalPage;
        }

        var max_left_nearest_page = currentPage - 2;
        if(max_left_nearest_page < 1) {
            max_left_nearest_page = 1;
        }

        var max_right_nearest_page = currentPage + 2;
        if(max_right_nearest_page > totalPage) {
            max_right_nearest_page = totalPage;
        }

        var reviewFooter = '<li class="page-item '+ isPrevDisabled +'" data-page="'+ prevPage +'">'+
                                '<a href="#" aria-label="Previous" class="page-link">'+
                                    '<span aria-hidden="true">&#60;</span>'+
                                    '<span class="sr-only">Previous</span>'+
                                '</a>'+
                            '</li>';

                        if(max_left_nearest_page != 1) {
                            reviewFooter += '<li class="page-item" data-page="1">'+
                                                '<a href="#" aria-label="1" class="page-link">'+
                                                    '1'+
                                                '</a>'+
                                            '</li>';
                            if((max_left_nearest_page - 1) != 1) {
                                reviewFooter += '<li class="page-item">'+
                                                    '<a href="#" class="no-border-top no-border-bottom page-link">'+
                                                        '..'+
                                                    '</a>'+
                                                '</li>';
                            }
                        }


                        for(var i = max_left_nearest_page; i <= currentPage; i++) {
                            reviewFooter += '<li class="page-item '+ (i == currentPage ? 'active': '') +'" data-page="'+ i +'">'+
                                                '<a href="#" aria-label="'+ i +'" class="page-link">'+
                                                    i+
                                                '</a>'+
                                            '</li>';
                        }

                        for(var i = (currentPage + 1); i <= max_right_nearest_page; i++) {
                            reviewFooter += '<li class="page-item '+ (i == currentPage ? 'active': '') +'" data-page="'+ i +'">'+
                                                '<a href="#" aria-label="'+ i +'" class="page-link">'+
                                                    i+
                                                '</a>'+
                                            '</li>';
                        }


                        if(max_right_nearest_page != totalPage) {
                            if((max_right_nearest_page + 1) != totalPage) {
                                reviewFooter += '<li class="page-item">'+
                                                    '<a href="#" class="no-border-top no-border-bottom page-link">'+
                                                        '..'+
                                                    '</a>'+
                                                '</li>';
                            }
                            reviewFooter += '<li class="page-item" data-page="'+ totalPage +'">'+
                                                '<a href="#" aria-label="'+ totalPage +'" class="page-link">'+
                                                    totalPage+
                                                '</a>'+
                                            '</li>';
                        }

                        reviewFooter += '<li class="page-item '+ isNextDisabled +'" data-page="'+ nextPage +'">'+
                                            '<a href="#" aria-label="Next" class="page-link">'+
                                                '<span aria-hidden="true">&#62;</span>'+
                                                '<span class="sr-only">Next</span>'+
                                            '</a>'+
                                        '</li>';
        container.html('');
        container.html(reviewFooter);
    }

    // Handle the accordion
    $(document).on('click', '#materi-belajar #accordion p.header', function(e) {
        var self = $(this).find('i');
        if(self.hasClass('fa-plus')) {
            $('#materi-belajar #accordion p.header i.fa').removeClass('fa-minus').addClass('fa-plus');
            self.removeClass('fa-plus').addClass('fa-minus');
        } else {
            self.removeClass('fa-minus').addClass('fa-plus');
        }
    });
    // End Handle the accordion

    // Carousel
    $('.bundle-package-wrapper').owlCarousel({
        items: 2,
        margin: 0,
        responsive: {
            0: {
                items: 1
            },
            767: {
                items: 2
            },
            1000: {
                items: 3
            },
            1400: {
                items: 4
            }
        }
    });
    // End Carousel

    $("#shareNative").jsSocials({
        showCount: false,
        showLabel: true,
        url: "{{ Request::url() }}",
        text: "Saya Mengikuti Kelas {{ $product->product_name }} melalui Pintaria.com. ",
        shares: [
            { share: "facebook", label: "Share" },
            "twitter",
            { share: "googleplus", label: "Share" },
            "linkedin",
        ]
    });

});
</script>
@endsection
