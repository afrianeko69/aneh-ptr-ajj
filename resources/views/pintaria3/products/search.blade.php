@extends('layouts.pintaria3.master') 
@section('title') 
Pintaria - Portal Edukasi Indonesia 
@endsection 
@section('meta_description')Info Kuliah, Kursus Online, Kelas Karyawan, Kuliah Karyawan, Kuliah Blended dan Pendidikan di Indonesia, semuanya ada di Pintaria.com @endsection

@section('additional.styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.css" rel="stylesheet" type="text/css"/>
@if(!empty($get['kategori_program']) && ($category) && empty($get['industri_program'])  && empty($get['kategori']))
<style type="text/css">
    #hero_in.courses-2:before {
      background: url("{{asset_cdn($category->image)}}") center center no-repeat;
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
    }
</style>
@elseif(!empty($get['industri_program']) && ($industry) && empty($get['kategori_program']) && empty($get['kategori']))
<style type="text/css">
    #hero_in.courses-2:before {
      background: url("{{asset_cdn($industry->banner)}}") center center no-repeat;
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
    }
</style>
@endif
@endsection

@section('content')
<main>
    <section id="hero_in" class="static class-banner-header courses-2 program-banner">
        <div class="wrapper">
            <div class="container">
                <h1 class="fadeInUp"><span></span>
                @if (!empty($get['kategori_program']) && ($category) && empty($get['industri_program'])  && empty($get['kategori']))
                {{$category->name}}
                @elseif (!empty($get['industri_program']) && ($industry) && empty($get['kategori_program']) && empty($get['kategori']))
                {{$industry->name}}
                @else
                Program Kami
                @endif
                </h1>
            </div>
        </div>
    </section>
    <!--/hero_in-->

    <div class="filters_listing sticky_horizontal d-none d-lg-block">
        <div class="container">
            <ul class="clearfix">
                <li>
                </li>
                <li>
                    <div class="layout_view">
                        <a href="{{route('product.search', array_merge($get,['show' => 'grid']))}}"><i class="icon-th"></i></a>
                        <a href="#" class="active"><i class="icon-th-list"></i></a>
                    </div>
                </li>
                <li>
                </li>
            </ul>
        </div>
        <!-- /container -->
    </div>
    <!-- /filters -->

    <div class="container margin_60_35">
        <div class="row">
            <aside class="col-lg-3" id="sidebar">
                <div id="filters_col"> <a data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt">Filter</a>
                    <div class="collapse show" id="collapseFilters">
                        <div class="filter_type">
                            <br clear="both" />
                            <form class="form-horizontal" action="{{route('product.search')}}">
                                <ul>
                                    <li>
                                        <label class="control-label ">Nama Program</label>
                                        <input type="text" name="nama" class="form-control input-lg" placeholder="Masukkan Nama Program" value="{{ !empty($get[\App\Product::NAME]) ? $get[\App\Product::NAME] : '' }}">
                                    </li>
                                    <li>
                                        <label class="control-label ">Kategori</label>
                                        <select class="form-control" name="{{\App\Product::CATEGORY_PROGRAM}}">
                                            <option value="">Semua Kategori</option>
                                            @foreach($categories as $cat)
                                            <option value="{{$cat->name}}" {{ ( !empty($get[\App\Product::CATEGORY_PROGRAM]) && ($cat->name == $get[\App\Product::CATEGORY_PROGRAM]) ) ? 'selected="selected"' : ''}}>{{ucfirst($cat->name)}}</option>
                                            @endforeach
                                        </select>
                                    </li>
                                    <li>
                                        <label class="control-label ">Klasifikasi Kategori</label>
                                        <select class="form-control" name="{{\App\Product::CATEGORY}}">
                                            <option value="">Semua Kategori</option>
                                            @foreach($product_categories as $category)
                                            <option value="{{$category->name}}" {{ ( !empty($get[\App\Product::CATEGORY]) && ($category->name == $get[\App\Product::CATEGORY]) ) ? 'selected="selected"' : ''}}>{{ucfirst($category->name)}}</option>
                                            @endforeach
                                        </select>
                                    </li>
                                    <li>
                                        <label class="control-label ">Industri</label>
                                        <select class="form-control" name="{{\App\Product::INDUSTRY_PROGRAM}}">
                                            <option value="">Semua Industri</option>
                                            @foreach($product_industries as $industry)
                                            <option value="{{$industry->name}}" {{ ( !empty($get[\App\Product::INDUSTRY_PROGRAM]) && ($industry->name == $get[\App\Product::INDUSTRY_PROGRAM]) ) ? 'selected="selected"' : ''}}>{{ucfirst($industry->name)}}</option>
                                            @endforeach
                                        </select>
                                    </li>
                                    <li style="font-size:12px">
                                        <label class="control-label ">Harga</label>
                                            <div class="row">
                                                <div class=" input-group col-md-12 pull-left">
                                                    <span class="input-group-addon">Rp.</span>
                                                    <input type="text" name="min" class="form-control" placeholder="Terendah" value="{{isset($get['min']) ? $get['min'] : '' }}">
                                                </div>
                                            </div>
                                            <br clear="both" />
                                            <div class="row">
                                                <div class=" input-group col-md-12 pull-left">
                                                    <span class="input-group-addon">Rp.</span>
                                                    <input type="text" name="max" class="form-control" placeholder="Tertinggi" value="{{!empty($get['max']) ? $get['max'] : '' }}">
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
                                <div class="form-group pull-right" role="group">
                                    <button type="submit" class="btn_1 rounded"><i class="fa fa-search"></i> Cari</button>
                                </div>
                                <br clear="both">
                                <!-- END: CONTENT/SHOPS/SHOP-FILTER-SEARCH-1 -->
                            </form>
                        </div>
                    </div>
                    <!--/collapse -->
                </div>
                <!--/filters col-->
            </aside>
            <!-- /aside -->

            <div class="col-lg-9" id="list_sidebar">
                @if(!$products->isEmpty())
                    @forelse ($products as $product)
                    <div class="box_list wow">
                        <div class="row no-gutters">
                            <div class="col-lg-5">
                                <figure class="block-reveal">
                                    <div class="block-horizzontal"></div>
                                    <a href="{{ !empty($product->route_url) ? $product->route_url : '' }}">
                                        <img data-src="{{ !empty($product->image_full_url) ? $product->image_full_url : '' }}" alt="">
                                    </a>
                                    @if (is_null($product->price))
                                        &nbsp;
                                        &nbsp;
                                    @elseif ($product->is_discount)
                                        <div class="price"><strike>{{ $product->formatted_price }}</strike><br>{{ $product->formatted_price_after_discount }} &nbsp;</div>
                                    @else
                                        <div class="price">{{ $product->formatted_price }}</div>
                                    @endif
                                </figure>
                            </div>
                            <div class="col-lg-7">
                                <div class="wrapper">
                                    <small>{{ !empty($product->category_name) ? $product->category_name : ''}}</small>
                                    <h3>{{ !empty($product->name) ? $product->name : '' }}</h3>
                                    {{ $product->excerpt }}
                                </div>
                                <ul>
                                    <li><a href="{{ !empty($product->route_url) ? $product->route_url : '' }}">Selengkapnya</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @empty
                    <center>Hasil pencarian kosong, silakan ubah filter pencarian atau lihat semua <b><a href="{{route('product.search')}}">Produk</a></b>.</center>
                    @endforelse
                @else
                    <center>Hasil pencarian kosong, silakan ubah filter pencarian atau lihat semua <b><a href="{{route('product.search')}}">Produk</a></b>.</center>
                @endif

                <nav aria-label="...">
                    {{ $products->links() }}
                </nav>
                
            </div>
            <!-- /col -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</main>
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