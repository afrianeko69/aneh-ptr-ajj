@extends('layouts.pintaria.master')

@section('title') {{ !empty($product->seo_title) ? $product->seo_title : 'Pintaria - Portal Edukasi Indonesia' }} @endsection

@section('meta_description') {{ !empty($product->meta_description) ? $product->meta_description : '' }} @endsection

@section('additional.styles')
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.css" />
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-flat.css" />
@endsection

@section('content')
<!-- BEGIN: PAGE CONTENT -->
<!-- BEGIN: CONTENT/SHOPS/SHOP-PRODUCT-DETAILS-2 -->
<div class="hide container container-message-flash-danger-register">
</div>
<div class="c-content-box c-size-sm c-overflow-hide c-bg-white">
    <div class="container">
        Bagikan :<br>
        <div id="shareNative" class="jssocials"></div>
        <br clear="both">
        <div class="c-shop-product-details-2">
            <div class="row">
                <div class="col-md-6">
                    <div class="c-product-gallery">
                        @if(is_null($product->youtube_video_id))
                            <img src="{{ $product->image_full_url }}" class="img-responsive">
                        @else
                            <div class="embed-responsive embed-responsive-4by3">
                                <iframe class="embed-responsive-item" src="{{ $product->youtube_url }}"></iframe>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="c-product-meta">
                        <div class="c-content-title-1">
                            <h3 class="c-font-uppercase c-font-bold product-name product-info">{{ $product->product_name }}</h3>
                            <div class="c-line-left"></div>
                        </div>
                        <!-- <div class="c-product-badge">
                            <div class="c-product-sale">Sale</div>
                            <div class="c-product-new">New</div>
                        </div> -->
                        <!-- <div class="c-product-review">
                            <div class="c-product-rating">
                                <i class="fa fa-star c-font-red"></i>
                                <i class="fa fa-star c-font-red"></i>
                                <i class="fa fa-star c-font-red"></i>
                                <i class="fa fa-star c-font-red"></i>
                                <i class="fa fa-star-half-o c-font-red"></i>
                            </div>
                            <div class="c-product-write-review">
                                <a class="c-font-red" href="#">Write a review</a>
                            </div>
                        </div> -->
                        <div class="clearfix"></div>
                        {{ csrf_field() }}
                        <input type="hidden" name="slug" value="{{ Request::segment(1) }}">
                        @if(is_null($product->price))

                        @elseif($product->is_discount)
                            <span class="c-product-price c-font-line-through c-font-red"><small>{{ $product->formatted_price }}</small></span>
                            <p class="c-product-price">{{ $product->formatted_price_after_discount }}</p>
                            <input type="hidden" id="taken-price" value="{{ $product->formatted_price_after_discount }}">
                        @else
                            <div class="c-product-price">{{ $product->formatted_price }}</div>
                            <input type="hidden" id="taken-price" value="{{ $product->formatted_price }}">
                        @endif
                        <div class="row c-product-variant">
                            @if($product->category_name)
                                <div class="col-sm-12 col-xs-12">
                                    <p class="c-product-meta-label c-product-margin-1"><strong>Kategori:</strong> {{ $product->category_name }}</p>
                                </div>
                            @endif
                            @if($product->learning_method_name)
                                <div class="col-sm-12 col-xs-12">
                                    <p class="c-product-meta-label c-product-margin-1"><strong>Metode Belajar:</strong> {{ $product->learning_method_name }}</p>
                                </div>
                            @endif
                            @if($product->provider_list)
                                <div class="col-sm-12 col-xs-12">
                                    <p class="c-product-meta-label c-product-margin-1"><strong>Penyelenggara:</strong> {{ $product->provider_list }}</p>
                                </div>
                            @endif
                            @if($product->topic_list)
                                    <div class="col-sm-12 col-xs-12">
                                        <p class="c-product-meta-label c-product-margin-1"><strong>Topik:</strong> {{ $product->topic_list }}</p>
                                </div>
                            @endif
                            @if($product->location_name && ($product->location_name != '-'))
                                <div class="col-sm-12 col-xs-12">
                                    <p class="c-product-meta-label c-product-margin-1"><strong>Lokasi:</strong>  {{ $product->location_name }}</p>
                                </div>
                            @endif
                            @if($product->quota != 0)
                                <div class="col-sm-12 col-xs-12">
                                    <p class="c-product-meta-label c-product-margin-1"><strong>Kapasitas Peserta:</strong> {{ $product->quota_text }}</p>
                                </div>
                            @endif
                        </div>
                        <div class="c-product-add-cart c-margin-t-20">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 c-margin-t-20">
                                    @if($is_already_enrolled && $is_already_enrolled['status'] == 200 && $is_already_enrolled['body']->enrolled)
                                        @php
                                            $body = $is_already_enrolled['body'];
                                            $custom_url = lmsLearningActivityUrl($body->klass_id);
                                            if($body->custom_url_lms){
                                                $custom_url = $body->custom_url_lms;
                                            }
                                        @endphp
                                        <a href="{{ route('masuk.kelas') . '?masuk_kelas=' . $custom_url }}" class="btn c-btn btn-lg c-font-bold c-font-white c-theme-btn c-btn-square c-font-uppercase btn-masuk-kelas">MASUK KELAS</a>
                                    @elseif($product->is_open_enrollment && !is_null($product->price))
                                        <button class="btn c-btn btn-lg c-font-bold c-font-white c-theme-btn c-btn-square c-font-uppercase btn-buy-now">BELI SEKARANG</button>
                                    @else
                                        <a href="javascript:scrollToElement('#saya-berminat');" class="btn c-btn btn-lg c-font-bold c-font-white c-theme-btn c-btn-square c-font-uppercase">Saya Berminat</a>
                                    @endif
                                    @if($bundles)
                                        <a href="javascript:scrollToElement('#bundle');" class="btn c-btn btn-lg c-font-bold c-theme-btn c-btn-square c-font-uppercase bg-medium-yellow no-padding mt-xs-1">Lihat Paket</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- END: CONTENT/SHOPS/SHOP-PRODUCT-DETAILS-2 -->
<!-- BEGIN: CONTENT/SHOPS/SHOP-PRODUCT-TAB-1 -->
<div class="c-content-box c-size-md c-no-padding">
    <div class="c-shop-product-tab-1" role="tabpanel">
        <div class="container">
            <ul class="nav nav-justified" role="tablist">
                <li role="presentation" class="active">
                    <a class="c-font-uppercase c-font-bold" href="#tab-1" role="tab" data-toggle="tab">DESKRIPSI</a>
                </li>
                <li role="presentation">
                    <a class="c-font-uppercase c-font-bold" href="#tab-2" role="tab" data-toggle="tab">PENYELENGGARA</a>
                </li>
                @if(!$product->instructors->isEmpty())
                    <li role="presentation">
                        <a class="c-font-uppercase c-font-bold" href="#tab-3" role="tab" data-toggle="tab">INSTRUKTUR</a>
                    </li>
                @endif

                @if (!empty($product->career))
                <li role="presentation">
                    <a class="c-font-uppercase c-font-bold" href="#tab-4" role="tab" data-toggle="tab">KARIR</a>
                </li>
                @endif

                @if (!empty($product->jobs))
                <li role="presentation">
                    <a class="c-font-uppercase c-font-bold" href="#tab-5" role="tab" data-toggle="tab">LOWONGAN PEKERJAAN</a>
                </li> 
                @endif
                <li role="presentation">
                    <a class="c-font-uppercase c-font-bold" href="#tab-6" role="tab" data-toggle="tab">ULASAN</a>
                </li>
            </ul>
        </div>

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="tab-1">
                <div class="c-product-desc">
                    <div class="container rich-text-editor">
                        {!! $product->description !!}
                    </div>
                </div>
            </div>

            <div role="tabpanel" class="tab-pane fade" id="tab-2">
                <div class="c-content-box c-size-md c-bg-white">
                    <div class="container">
                        @forelse($product->providers as $provider)
                            <div class="row c-margin-b-40">
                                <div class="c-content-product-2 c-bg-white">
                                    <div class="col-md-4">
                                        <div class="c-content-overlay">
                                            <div class="c-bg-img-center c-overlay-object" data-height="height" style="height: 230px; background-image: url({{ $provider->logo_full_url }});"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="c-info-list rich-text-editor">
                                            <h3 class="c-title c-font-bold c-font-22 c-font-dark">
                                                {{ $provider->name }}
                                            </h3>
                                            <p class="c-price c-font-16 c-font-thin">{{ $provider->tagline }}</p>
                                            <p class="c-price c-font-26 c-font-thin">{!! $provider->description !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>

            <div role="tabpanel" class="tab-pane fade" id="tab-3">
                <div class="c-content-box c-size-md c-bg-white">
                    <div class="container">
                        @forelse($product->instructors as $instructor)
                            <div class="row c-margin-b-40">
                                <div class="c-content-product-2 c-bg-white">
                                    <div class="col-md-4">
                                        <div class="c-content-overlay">
                                            <div class="c-bg-img-center c-overlay-object" data-height="height" style="height: 230px; background-image: url({{ $instructor->profile_picture_full_url }});"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="c-info-list rich-text-editor">
                                            <h3 class="c-title c-font-bold c-font-22 c-font-dark">
                                                {{ $instructor->name }}
                                            </h3>
                                            <p class="c-desc c-font-16 c-font-thin">{{ $instructor->title }}</p>
                                            <p class="c-price c-font-26 c-font-thin">{!! $instructor->description !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>

            @if (!empty($product->career))
            <div role="tabpanel" class="tab-pane fade" id="tab-4">
                <div class="container rich-text-editor">
                {!! $product->career !!}
                </div>
            </div>
            @endif
            @if (!empty($product->jobs))
            <div role="tabpanel" class="tab-pane fade" id="tab-5">
                <div class="container rich-text-editor">
                     {!! $product->jobs !!}
                </div>
            </div>
            @endif

            <div role="tabpanel" class="tab-pane fade" id="tab-6">
                <div class="container">
                    @php
                        $rating = $product->rating_review;
                    @endphp
                    @if($rating['review']['reviews']->isEmpty())
                        <p>Belum ada ulasan untuk produk ini.</p>
                    @else
                        <div class="col-md-10 col-md-offset-1">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <strong>
                                        Nilai Produk
                                    </strong>
                                </div>
                                <div class="panel-body">
                                    <div class="col-md-3 col-sm-3 text-center mb-2">
                                        <div class="row">
                                            <span class="md-font c-font-bold">
                                                {{ $rating['avg_rating'] }}
                                            </span><span class="sm-font">/ &nbsp;&nbsp;5</span>
                                        </div>
                                        <div class="row">
                                            @php
                                                $golden_stars = (int) $rating['avg_rating'];
                                            @endphp
                                            @for($i = 0; $i < $golden_stars; $i++)
                                                <i class="fa fa-star c-font-yellow-4"></i>
                                            @endfor
                                            @for($i = 0; $i < (5 - $golden_stars); $i++)
                                                <i class="fa fa-star-o"></i>
                                            @endfor
                                        </div>
                                        <div class="row">
                                            <span>{{ $rating['total_reviewer'] }} Ulasan</span>
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-sm-9 border-left border-left-sm-hidden">
                                        @for($j = 5; $j > 0; $j--)
                                            @php
                                                $rate = $rating['ratings'][$j];
                                            @endphp
                                            <div class="row">
                                                <div class="col-md-3 col-sm-4 col-xs-5 no-padding-sm">
                                                    @for($i = 0; $i < $j; $i++)
                                                        <i class="fa fa-star c-font-yellow-4"></i>
                                                    @endfor
                                                    @for($i = 0; $i < (5 - $j); $i++)
                                                        <i class="fa fa-star-o"></i>
                                                    @endfor
                                                </div>
                                                <div class="col-md-8 col-sm-7 hidden-xs">
                                                    <div class="progress rating-review">
                                                        <div class="progress-bar progress-bar-yellow-4" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$rate['avg']}}%;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-1 col-sm-1 col-sm-offset-0 col-xs-2 col-xs-offset-5 no-padding-sm">
                                                    <div class="row">
                                                        <p class="text-center">
                                                            {{ $rate['count'] }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <h3 class="c-font-uppercase c-font-bold">Ulasan Paling Membantu</h3>
                                </div>
                                <div class="review-wrapper">
                                    @php
                                        $reviewer = $rating['review'];
                                    @endphp
                                    <div class="review-body">
                                        @foreach($reviewer['reviews'] as $review)
                                            <div class="row">
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <div class="col-md-2 col-sm-2 hidden-xs">
                                                            @if($review->full_profile_picture_url)
                                                                <img src="{{ $review->full_profile_picture_url }}" class="img-responsive img-50" />
                                                            @else
                                                                <div class="circle">
                                                                    <strong>
                                                                        <p class="text-center">
                                                                            {{ $review->reviewer_initial }}
                                                                        </p>
                                                                    </strong>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-3 col-sm-3 col-xs-5 pt-sm text-right">
                                                            <h6>{{ $review->human_review_rating_at }}</h6>
                                                            <h3>{{ $review->reviewer_name }}</h3>
                                                        </div>
                                                        <div class="col-md-6 col-md-offset-1 col-sm-6 col-sm-offset-1 col-xs-7 pt-sm text-left">
                                                            <div class="row">
                                                                @for($i = 0; $i < $review->rating; $i++)
                                                                    <i class="fa fa-star c-font-yellow-4"></i>
                                                                @endfor
                                                                @for($i = 0; $i < (5 - $review->rating); $i++)
                                                                    <i class="fa fa-star-o"></i>
                                                                @endfor
                                                            </div>
                                                            <div class="row">
                                                                {{ $review->review }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="review-footer">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <nav class="pull-right">
                                                    @php
                                                        $total_pagination = $reviewer['total_pagination'];
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
                                                        <li class="disabled pagination-nav">
                                                            <a href="#" aria-label="Previous">
                                                                <i class="glyphicon glyphicon-chevron-left"></i>
                                                            </a>
                                                        </li>
                                                        @for($i = 1; $i <= $max_right_nearest_page; $i++)
                                                            <li class="pagination-nav {{ $i == 1 ? 'active' : '' }}" data-page="{{ $i }}">
                                                                <a href="#" aria-label="{{ $i }}">
                                                                    {{ $i }}
                                                                </a>
                                                            </li>
                                                        @endfor
                                                        @if($max_right_nearest_page != $total_pagination)
                                                            <li class="pagination-nav">
                                                                <a href="#" class="no-border-top no-border-bottom">
                                                                    ..
                                                                </a>
                                                            </li>
                                                            <li class="pagination-nav" data-page="{{ $total_pagination }}">
                                                                <a href="#" aria-label="{{ $total_pagination }}">
                                                                    {{ $total_pagination }}
                                                                </a>
                                                            </li>
                                                        @endif
                                                        <li class="pagination-nav {{ $is_class_disabled_for_next }}" data-page="{{ $next_page }}">
                                                            <a href="#" aria-label="Next">
                                                                <i class="glyphicon glyphicon-chevron-right"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div><!-- END: CONTENT/SHOPS/SHOP-PRODUCT-TAB-1 -->
<!-- Bundle -->
<div class="container">
    @include('shared.bundle')
</div>
<a id="saya-berminat"></a>
<div class="c-content-title-1">
    <h3 class="c-center c-font-uppercase c-font-bold">Saya Berminat</h3>
</div>
@include('shared.more-info')
<div class="container">
    <div class="row c-margin-t-40 c-margin-b-40">
        <div class="col-md-12 text-justify">
            {!! $product->seo !!}
        </div>
    </div>
</div>

@endsection

@section('additional.scripts')
@if(env('APP_DEBUG') == false)
<script src="https://app.midtrans.com/snap/snap.js" type="text/javascript" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
@else
<script src="https://app.sandbox.midtrans.com/snap/snap.js" type="text/javascript" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
@endif
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
var currentPageRatingReview = 1;

$(document).ready(function() {
    if(is_purchase_process == true) {
        if(is_login != true) {
            window.location.href = login_url + '?previous_url=' + window.location.href;
        } else {
            if(product_type == 'paid') {
                initModalPurchase($('.product-name.product-info').html(), $('#taken-price').val(), learning_method, providers);
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

        if(product_type == 'free') {
            buyNow({}, '.btn-buy-now');
        } else if(product_type == 'paid') {
            var current_url = window.location.pathname + '?beli=1';
            history.replaceState('', document.title, current_url, window.location.search);
            if(is_login != true) {
                window.location.href=login_url + '?previous_url=' + window.location.href;
                return false;
            }
            initModalPurchase($('.product-name.product-info').html(), $('#taken-price').val(), learning_method, providers);
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
    $(document).on('keyup', '#payment-popup-modal div.referral-code input#referral_code', function(e) {
        var self = $(this);
        $(this).val(self.val().toUpperCase());
    });

    $(document).on('click', '#payment-popup-modal button.btn.btn-referral-code', function (e) {
        e.preventDefault();
        $('#payment-popup-modal .error').children().html('');

        var self = $(this);
        if(self.hasClass('btn-primary')) {
            var referral_code = $('#payment-popup-modal div.referral-code input#referral_code').val();
            if(!referral_code) {
                $('#payment-popup-modal div.referral-code span.error-referral_code').children().html('Harap memasukkan kode referral.');
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
        var spin = caseShowLoadingSpin('#payment-popup-modal', 'default');
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
                    $('#payment-popup-modal div.referral-code span.error-referral_code').children().html(response.message);
                    resetReferralCode();
                }
                removeSpinAndDisabled(spin, btn_container);
            },
            error: function(response) {
                $('#payment-popup-modal div.referral-code span.error-referral_code').children().html('Kode Referral tidak ditemukan atau sudah tidak berlaku.');
                resetReferralCode();
                removeSpinAndDisabled(spin, btn_container);
            }
        });
    }

    function resetReferralCode() {
        $('#payment-popup-modal .modal-body div.referral-code #referral_code').val('');
        $('#payment-popup-modal .modal-body div.referral-code #referral_code').attr('disabled', false);
        $('#payment-popup-modal .modal-body div.referral-code button.btn.btn-referral-code').addClass('btn-primary');
        $('#payment-popup-modal .modal-body div.referral-code button.btn.btn-referral-code').removeClass('btn-danger');
        $('#payment-popup-modal .modal-body div.referral-code button.btn.btn-referral-code').children().html('Gunakan Kode Referral');
        $('#payment-popup-modal .modal-body .table tr.referrer-code-wrapper .referral-code-discount-nominal').html('');
        $('#payment-popup-modal .modal-body .table tr.referrer-code-wrapper').addClass('hide');
        appendReward();
    }

    function disableReferralCodeField() {
        $('#payment-popup-modal .modal-body div.referral-code #referral_code').attr('disabled', true);
        $('#payment-popup-modal .modal-body div.referral-code button.btn.btn-referral-code').addClass('btn-danger');
        $('#payment-popup-modal .modal-body div.referral-code button.btn.btn-referral-code').removeClass('btn-primary');
        $('#payment-popup-modal .modal-body div.referral-code button.btn.btn-referral-code').children().html('Batalkan');
    }
    // End Section Referral

    // Section Promo Code
    $(document).on('keyup', '#payment-popup-modal div.promo-code input#promo_code', function(e) {
        var self = $(this);
        $(this).val(self.val().toUpperCase());
    });

    $(document).on('click', '#payment-popup-modal button.btn.btn-promo-code', function (e) {
        e.preventDefault();
        $('#payment-popup-modal .error').children().html('');

        var self = $(this);
        if(self.hasClass('btn-primary')) {
            var promo_code = $('#payment-popup-modal div.promo-code input#promo_code').val();
            if(!promo_code) {
                $('#payment-popup-modal div.promo-code span.error-promo_code').children().html('Harap memasukkan kode promo.');
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
        var spin = caseShowLoadingSpin('#payment-popup-modal', 'default');
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
                    $('#payment-popup-modal div.promo-code span.error-promo_code').children().html(response.message);
                    resetPromoCode();
                }
                removeSpinAndDisabled(spin, btn_container);
            },
            error: function(response) {
                $('#payment-popup-modal div.promo-code span.error-promo_code').children().html('Kode Promo tidak ditemukan atau sudah tidak berlaku');
                resetPromoCode();
                removeSpinAndDisabled(spin, btn_container);
            }
        });
    }

    function resetPromoCode() {
        $('#payment-popup-modal .modal-body div.promo-code #promo_code').val('');
        $('#payment-popup-modal .modal-body div.promo-code #promo_code').attr('disabled', false);
        $('#payment-popup-modal .modal-body div.promo-code button.btn.btn-promo-code').addClass('btn-primary');
        $('#payment-popup-modal .modal-body div.promo-code button.btn.btn-promo-code').removeClass('btn-danger');
        $('#payment-popup-modal .modal-body div.promo-code button.btn.btn-promo-code').children().html('Gunakan Kode Promo');
        $('#payment-popup-modal .modal-body .table tr.promo-code-wrapper .promo-code-discount-nominal').html('');
        $('#payment-popup-modal .modal-body .table tr.promo-code-wrapper').addClass('hide');
        appendReward();
    }

    function disablePromoCodeField() {
        $('#payment-popup-modal .modal-body div.promo-code #promo_code').attr('disabled', true);
        $('#payment-popup-modal .modal-body div.promo-code button.btn.btn-promo-code').addClass('btn-danger');
        $('#payment-popup-modal .modal-body div.promo-code button.btn.btn-promo-code').removeClass('btn-primary');
        $('#payment-popup-modal .modal-body div.promo-code button.btn.btn-promo-code').children().html('Batalkan');
    }
    // End Section Promo Code


    function appendReward() {
        var packagePrice = getCurrentPrice();
        var reward = calculateReward(packagePrice.price);
        if(reward.referral_reward != 0) {
            $('#payment-popup-modal .modal-body .table tr.referrer-code-wrapper').removeClass('hide');
            var formattedReferralReward = (reward.referral_reward).formatMoney(0, ',', '.');
            $('#payment-popup-modal .modal-body .table tr.referrer-code-wrapper .referral-code-discount-nominal').html('- ' + formattedReferralReward);
        }

        if(reward.promo_reward != 0) {
            $('#payment-popup-modal .modal-body .table tr.promo-code-wrapper').removeClass('hide');
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
        var spin = caseShowLoadingSpin('#payment-popup-modal', 'default');
        $(btn_container).attr('disabled', true);
        $('.error').children().html('');

        data['_token'] = $("input[name=_token]").val();
        data['slug'] = $('input[name=slug]').val();
        data['type'] = product_type;
        data['bundle_id'] = $('#payment-popup-modal .modal-body button#payment_confirm.btn-pay-now').data('bundle-id');
        data['referral_code'] = '';
        data['promo_code'] = '';

        if($('#payment-popup-modal button.btn.btn-referral-code').hasClass('btn-danger')) {
            data['referral_code'] = $('#payment-popup-modal div.referral-code #referral_code').val();
        }

        if($('#payment-popup-modal button.btn.btn-promo-code').hasClass('btn-danger')) {
            data['promo_code'] = $('#payment-popup-modal div.promo-code #promo_code').val();
        }

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
                    showErrorMessage('.container-message-flash-danger-register', response.message, true);
                }
                $('#payment-popup-modal').modal('hide');
                removeSpinAndDisabled(spin, btn_container);
            },
            error:function(response) {
                if(response.status == 422) {
                    if(data.type == 'free') {
                        showErrorMessage('.container-message-flash-danger-register', 'Maaf, saat ini kami sedang kesulitan memproses data anda.', true);
                    } else {
                        $.each(response.responseJSON, function(key, val) {
                            $('#payment-popup-modal .error.error-'+key).children().html(val[0]);
                        });
                    }
                }
                removeSpinAndDisabled(spin, btn_container);
            }
        });
    }

    function initModalPurchase(productTitle, price, learningMethod, modalProviders) {
        $('#payment-popup-modal .error').children().html('');
        referral_reward_data = promo_reward_data = null;
        if (learningMethod == '' && modalProviders == '') {
            $('#payment-popup-modal .modal-body .table span.confirm_partner span img.bullet-sub-title').addClass('hide');
        }else {
            $('#payment-popup-modal .modal-body button#payment_confirm.btn-pay-now').data('bundle-id', '0');
            $('#payment-popup-modal .modal-body button#payment_confirm.btn-pay-now').data('bundle-clean-price', '0');
            $('#payment-popup-modal .modal-body .table span.confirm_partner span img.bullet-sub-title').removeClass('hide');
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

    $(document).on('click', '.pagination-nav', function (e) {
        e.preventDefault();
        var page = $(this).data('page');
        if(!$(this).hasClass('disabled') && page && page != currentPageRatingReview) {
            moreRatingReview(page);
        }
    });

    function moreRatingReview(page) {
        var spin = caseShowLoadingSpin('.review-wrapper', '50');
        var reviewWrapperBodyTag = $('.review-wrapper .review-body');
        var reviewWrapperFooterTag = $('.review-wrapper .review-footer');
        var previousPagination = reviewWrapperFooterTag.html();
        var previousReviewBody = reviewWrapperBodyTag.html();

        reviewWrapperBodyTag.html('');
        scrollToElement('.review-wrapper .review-body');
        $('ul.pagination li.pagination-nav').addClass('disabled');

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
                spin.stop();
            },
            error:function(response) {
                reviewWrapperBodyTag.html(previousReviewBody);
                reviewWrapperFooterTag.html(previousPagination);
                spin.stop();
            }
        });
    }

    function handleRatingReviewBody(data, container) {
        var reviewBody = '';
        $.each(data.reviews, function(key, value) {
            reviewBody += '<div class="row">'+
                             '<div class="panel panel-default">'+
                                '<div class="panel-body">'+
                                    '<div class="col-md-2 col-sm-2 hidden-xs">';
                                    if(value.full_profile_picture_url) {
                                        reviewBody += '<img src="'+ value.full_profile_picture_url +'" class="img-responsive img-50" />';
                                    } else {
                                        reviewBody += '<div class="circle">'+
                                                            '<strong>'+
                                                                '<p class="text-center">'+
                                                                    value.reviewer_initial +
                                                                '</p>'+
                                                            '</strong>'+
                                                        '</div>';
                                    }
                      reviewBody += '</div>'+
                                    '<div class="col-md-3 col-sm-3 col-xs-5 pt-sm text-right">'+
                                        '<h6>'+ value.human_review_rating_at +'</h6>'+
                                        '<h3>'+ value.reviewer_name +'</h3>'+
                                    '</div>'+
                                    '<div class="col-md-6 col-md-offset-1 col-sm-6 col-sm-offset-1 col-xs-7 pt-sm text-left">'+
                                        '<div class="row">';
                                            for(var i = 0; i < value.rating; i++) {
                                                reviewBody += '<i class="fa fa-star c-font-yellow-4"></i>';
                                            }
                                            for(var i = 0; i < (5 - value.rating); i++) {
                                                reviewBody += '<i class="fa fa-star-o"></i>';
                                            }
                          reviewBody += '</div>'+
                                        '<div class="row">'+
                                            value.review+
                                       '</div>'+
                                    '</div>'+
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

        var reviewFooter = '<div class="col-md-12">'+
                                '<div class="row">'+
                                    '<nav class="pull-right">'+
                                        '<ul class="pagination">'+
                                            '<li class="pagination-nav '+ isPrevDisabled +'" data-page="'+ prevPage +'">'+
                                                '<a href="#" aria-label="Previous">'+
                                                    '<i class="glyphicon glyphicon-chevron-left"></i>'+
                                                '</a>'+
                                            '</li>';

                        // start mobile
                        if(max_left_nearest_page_phone != 1) {
                            reviewFooter += '<li class="pagination-nav hidden-lg hidden-md hidden-sm" data-page="1">'+
                                                '<a href="#" aria-label="1">'+
                                                    '1'+
                                                '</a>'+
                                            '</li>';
                            if((max_left_nearest_page_phone - 1) != 1) {
                                reviewFooter += '<li class="pagination-nav hidden-lg hidden-md hidden-sm">'+
                                                    '<a href="#" class="no-border-top no-border-bottom">'+
                                                        '..'+
                                                    '</a>'+
                                                '</li>';
                            }
                        }

                        for(var i = max_left_nearest_page_phone; i <= currentPage; i++) {
                            reviewFooter += '<li class="pagination-nav hidden-lg hidden-md hidden-sm '+ (i == currentPage ? 'active': '') +'" data-page="'+ i +'">'+
                                                '<a href="#" aria-label="'+ i +'">'+
                                                    i+
                                                '</a>'+
                                            '</li>';
                        }

                        for(var i = (currentPage + 1); i <= max_right_nearest_page_phone; i++) {
                            reviewFooter += '<li class="pagination-nav hidden-lg hidden-md hidden-sm '+ (i == currentPage ? 'active': '') +'" data-page="'+ i +'">'+
                                                '<a href="#" aria-label="'+ i +'">'+
                                                    i+
                                                '</a>'+
                                            '</li>';
                        }


                        if(max_right_nearest_page_phone != totalPage) {
                            if((max_right_nearest_page_phone + 1) != totalPage) {
                                reviewFooter += '<li class="pagination-nav hidden-lg hidden-md hidden-sm">'+
                                                    '<a href="#" class="no-border-top no-border-bottom">'+
                                                        '..'+
                                                    '</a>'+
                                                '</li>';
                            }
                            reviewFooter += '<li class="pagination-nav hidden-lg hidden-md hidden-sm" data-page="'+ totalPage +'">'+
                                                '<a href="#" aria-label="'+ totalPage +'">'+
                                                    totalPage+
                                                '</a>'+
                                            '</li>';
                        }
                        // end mobile

                        // desktop start
                        if(max_left_nearest_page != 1) {
                            reviewFooter += '<li class="pagination-nav hidden-xs" data-page="1">'+
                                                '<a href="#" aria-label="1">'+
                                                    '1'+
                                                '</a>'+
                                            '</li>';
                            if((max_left_nearest_page - 1) != 1) {
                                reviewFooter += '<li class="pagination-nav hidden-xs">'+
                                                    '<a href="#" class="no-border-top no-border-bottom">'+
                                                        '..'+
                                                    '</a>'+
                                                '</li>';
                            }
                        }


                        for(var i = max_left_nearest_page; i <= currentPage; i++) {
                            reviewFooter += '<li class="pagination-nav hidden-xs '+ (i == currentPage ? 'active': '') +'" data-page="'+ i +'">'+
                                                '<a href="#" aria-label="'+ i +'">'+
                                                    i+
                                                '</a>'+
                                            '</li>';
                        }

                        for(var i = (currentPage + 1); i <= max_right_nearest_page; i++) {
                            reviewFooter += '<li class="pagination-nav hidden-xs '+ (i == currentPage ? 'active': '') +'" data-page="'+ i +'">'+
                                                '<a href="#" aria-label="'+ i +'">'+
                                                    i+
                                                '</a>'+
                                            '</li>';
                        }


                        if(max_right_nearest_page != totalPage) {
                            if((max_right_nearest_page + 1) != totalPage) {
                                reviewFooter += '<li class="pagination-nav hidden-xs">'+
                                                    '<a href="#" class="no-border-top no-border-bottom">'+
                                                        '..'+
                                                    '</a>'+
                                                '</li>';
                            }
                            reviewFooter += '<li class="pagination-nav hidden-xs" data-page="'+ totalPage +'">'+
                                                '<a href="#" aria-label="'+ totalPage +'">'+
                                                    totalPage+
                                                '</a>'+
                                            '</li>';
                        }
                        // desktop end

                            reviewFooter += '<li class="pagination-nav '+ isNextDisabled +'" data-page="'+ nextPage +'">'+
                                                '<a href="#" aria-label="Next">'+
                                                    '<i class="glyphicon glyphicon-chevron-right"></i>'+
                                                '</a>'+
                                            '</li>'+
                                        '</ul>'+
                                    '</nav>'+
                                '</div>'+
                            '</div>';
        container.html('');
        container.html(reviewFooter);
    }

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