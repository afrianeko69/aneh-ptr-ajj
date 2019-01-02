@extends('layouts.pintaria3.master') 
@section('title') 
Pintaria - Portal Edukasi Indonesia 
@endsection 
@section('meta_description')Info Kuliah, Kursus Online, Kelas Karyawan, Kuliah Karyawan, Kuliah Blended dan Pendidikan di Indonesia, semuanya ada di Pintaria.com @endsection

@section('content')
<main>
    <section id="hero_in" class="static class-banner-header program-banner">
        <div class="wrapper">
            <div class="container">
                <h1 class="fadeInUp"><span></span>Program Kami</h1>
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
                        <a href="#" class="active"><i class="icon-th"></i></a>
                        <a href="{{route('product.search', array_merge($get,['show' => 'list']))}}"><i class="icon-th-list"></i></a>
                    </div>
                </li>
                <li>
                </li>
            </ul>
        </div>
        <!-- /container -->
    </div>

    <div class="container margin_60_35">
        <div class="row">
            @forelse ($products as $product)
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="box_grid wow">
                    <figure class="block-reveal">
                        <div class="block-horizzontal"></div>
                        <a href="{{ !empty($product->route_url) ? $product->route_url : '' }}"><img data-src="{{ !empty($product->image_full_url) ? $product->image_full_url : '' }}" alt="" style="width:100%;"></a>
                            @if (isset($product->price) && is_null($product->price))
                                &nbsp;
                                &nbsp;
                            @elseif (isset($product->price) && $product->is_discount)
                                <div class="price">
                                    <strike>{{ !empty($product->formatted_price) ? $product->formatted_price : '' }}</strike><br>
                                    {{ !empty($product->formatted_price_after_discount) ? $product->formatted_price_after_discount : '' }}
                                </div>
                            @else
                                <div class="price">{{ !empty($product->formatted_price) ? $product->formatted_price : '' }}</div>
                            @endif
                    </figure>
                    <div class="wrapper">
                        <small>{{ !empty($product->category_name) ? $product->category_name : ''}}</small>
                        <h3>{{ !empty($product->name) ? $product->name : '' }}</h3>
                        {{ $product->excerpt }}
                    </div>
                    <ul class="clearfix">
                        <li><a href="{{ !empty($product->route_url) ? $product->route_url : '' }}">Selengkapnya</a></li>
                    </ul>
                </div>
            </div>
            @empty
            <center>Hasil pencarian kosong, silakan ubah filter pencarian atau lihat semua <b><a href="{{route('product.search')}}">Produk</a></b>.</center>
            @endforelse
        </div>
        
        <nav aria-label="...">
            {{ $products->links() }}
        </nav>

    </div>
    <!-- /container -->
</main>
<!--/main-->
@endsection
