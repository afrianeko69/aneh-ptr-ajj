@extends('layouts.pintaria.master') 
@section('title') 
Pintaria - Portal Edukasi Indonesia 
@endsection 

@section('additional.styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.css" rel="stylesheet" type="text/css"/>
@endsection

@section('content')

<div class="container">

    <div class="c-layout-sidebar-menu c-theme ">

        <form class="form-horizontal" action="{{route('product.search')}}">
            <!-- BEGIN: CONTENT/SHOPS/SHOP-FILTER-SEARCH-1 -->
            <ul class="c-shop-filter-search-1 list-unstyled">
                <li>
                    <label class="control-label c-font-uppercase c-font-bold">Nama Produk</label>
                    <input type="text" name="nama" class="form-control c-square c-theme input-lg" placeholder="Masukkan Nama Produk" value="{{ !empty($get[\App\Product::NAME]) ? $get[\App\Product::NAME] : '' }}">
                </li>
                <li>
                    <label class="control-label c-font-uppercase c-font-bold">Kategori</label>
                    <select class="form-control c-square c-theme" name="{{\App\Product::CATEGORY}}">
                        <option value="">Semua Kategori</option>
                        @foreach($product_categories as $category)
                        <option value="{{$category->name}}" {{ ( !empty($get[\App\Product::CATEGORY]) && ($category->name == $get[\App\Product::CATEGORY]) ) ? 'selected="selected"' : ''}}>{{ucfirst($category->name)}}</option>
                        @endforeach
                    </select>
                </li>
                <li>
                    <label class="control-label c-font-uppercase c-font-bold">Harga</label>
                    <div class="c-price-range-box input-group">
                        <div class="c-price input-group col-md-6 pull-left">
                            <span class="input-group-addon c-square c-theme">Rp.</span>
                            <input type="text" name="min" class="form-control c-square c-theme" placeholder="Terendah" value="{{!empty($get['min']) ? $get['min'] : '' }}">
                        </div>
                        <div class="c-price input-group col-md-6 pull-left">
                            <span class="input-group-addon c-square c-theme">Rp.</span>
                            <input type="text" name="max" class="form-control c-square c-theme" placeholder="Tertinggi" value="{{!empty($get['max']) ? $get['max'] : '' }}">
                        </div>
                    </div>
                    <div class="c-checkbox sidebar-search-check">
                        <input type="checkbox" id="checkbox-sidebar-3-1" class="c-check" name="{{\App\Product::DISCOUNT}}" value="1" {{!empty($get[\App\Product::DISCOUNT]) ? "checked='checked'" : '' }} > <label for="checkbox-sidebar-3-1">
                            <span class="inc"></span> <span class="check"></span> <span class="box"></span>
                            <p>Diskon</p>
                        </label>
                    </div>
                </li>
            </ul>
            <br clear="both" />
            <center>
                <div class="form-group" role="group">
                    <button type="submit" class="btn btn-lg c-theme-btn c-btn-square c-btn-uppercase c-btn-bold"><i class="fa fa-search"></i>Cari</button>
                </div>
            </center>
            <!-- END: CONTENT/SHOPS/SHOP-FILTER-SEARCH-1 -->
        </form>
    </div>

    <div class="c-layout-sidebar-content ">
        <div class="c-margin-t-20"></div>
        <!-- BEGIN: CONTENT/SHOPS/SHOP-2-8 -->
        @forelse ($products as $product)
        <div class="row c-margin-b-40">
            <div class="c-content-product-2 c-bg-white">
                <div class="col-md-4">
                    <div class="c-content-overlay">
                        <div class="c-overlay-wrapper">
                            <div class="c-overlay-content">
                                <a href="{{ !empty($product->route_url) ? $product->route_url : '' }}" class="btn btn-md c-btn-grey-1 c-btn-uppercase c-btn-bold c-btn-border-1x c-btn-square">INFO</a>
                            </div>
                        </div>
                        <div class="c-bg-img-center c-overlay-object" data-height="height" style="height: 230px; background-image: url({{ !empty($product->image_full_url) ? $product->image_full_url : '' }});"></div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="c-info-list">
                        <h3 class="c-title c-font-bold c-font-22 c-font-dark">
                            <a class="c-theme-link" href="{{ !empty($product->route_url) ? $product->route_url : '' }}">{{ !empty($product->name) ? $product->name : '' }}</a>
                        </h3>
                        <p class="c-desc c-font-16 c-font-thin">{!! !empty($product->description) ?  str_limit(strip_tags($product->description),300) : '' !!}</p>
                        @if (isset($product->price) && is_null($product->price))
                            <span class="c-price c-font-16 c-font-slim">&nbsp;</span>
                            <p class="c-price c-font-16 c-font-slim">&nbsp;</p>
                        @elseif (isset($product->price) && $product->is_discount)
                            <span class="c-font-16 c-font-line-through c-font-red">
                                <small>
                                {{ !empty($product->formatted_price) ? $product->formatted_price : '' }}
                                </small>
                            </span>
                            <p class="c-price c-font-16 c-font-slim">{{ !empty($product->formatted_price_after_discount) ? $product->formatted_price_after_discount : '' }}&nbsp;</p>
                        @else
                            <span class="c-font-16 c-font-red">&nbsp;</span>
                            <p class="c-price c-font-16 c-font-slim">{{ !empty($product->formatted_price) ? $product->formatted_price : '' }} &nbsp;</p>
                        @endif
                    </div>
                    <div>
                        @if(!is_null($product->price) && ($product->is_open_enrollment))
                        <a href="{{ $product->route_purchase_url }}" type="submit" class="btn btn-sm c-theme-btn c-btn-square c-btn-uppercase c-btn-bold">Beli!</a>
                        @else
                        <a href="{{ $product->route_url }}" type="submit" class="btn btn-sm c-theme-btn c-btn-square c-btn-uppercase c-btn-bold">Info</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="row c-margin-b-40">
            <center>Hasil pencarian kosong, silakan ubah filter pencarian atau lihat semua <b><a href="{{route('product.search')}}">Produk</a></b>.</center>
        </div>
        @endforelse
        <!-- END: CONTENT/SHOPS/SHOP-2-8 -->

        <div class="c-margin-t-20"></div>
        <center>
            {{ $products->links() }}
        </center>
        <!-- END: PAGE CONTENT -->
    </div>
</div>

@endsection

@section('additional.scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
    $('input[name="nama"]').autoComplete({
        minChars: 2,
        source: function(term, response){
            $.getJSON("{{route('product.autocomplete')}}", { q: term }, function(data){ response(data); });
        }
    });
});
</script>
@endsection