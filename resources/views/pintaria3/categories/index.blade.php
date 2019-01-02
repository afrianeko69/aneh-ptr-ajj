@extends('layouts.pintaria3.master')

@section('title') Pintaria - Portal Edukasi Indonesia @endsection
@section('meta_description')Info Kuliah, Kursus Online, Kelas Karyawan, Kuliah Karyawan, Kuliah Blended dan Pendidikan di Indonesia, semuanya ada di Pintaria.com @endsection

@section('content')
    <section id="hero_in" class="static category-banner-header">
        <div class="wrapper">
            <div class="container">
                <h1 class="fadeInUp"><span></span>Kategori Program</h1>
            </div>
        </div>
    </section>

    <div class="container add_top_30    ">
        <div class="main_title_2">
            <p>Program online menawarkan cara untuk menemukan subjek yang kamu minati. Temukan kategori program yang kami sediakan</p>
        </div>
        <div class="container margin_30_95">
            <div class="row">
                @forelse ($categories as $category)
                <div class="col-lg-4 col-md-6 wow" data-wow-offset="150">
                    <a href="{{route('product.search')}}?{{\App\Product::CATEGORY_PROGRAM . '=' . urlencode($category->name)}}" class="grid_item">
                        <figure class="block-reveal">
                            <div class="block-horizzontal"></div>
                            <img data-src="{{ asset_cdn($category->thumbnail_image) }}" class="img-fluid" alt="">
                            <div class="info">
                                <small><i class="ti-layers"></i>{{$category->total_product}} Program</small>
                                <h3>{{$category->name}}</h3>
                            </div>
                        </figure>
                    </a>
                </div>
                @empty
                <center>Data Kosong</center>
                @endforelse
            </div>
        </div>

        <center>
            <div class="new_pagination">
                {{ $categories->links() }}
            </div>
        </center>
        <!--/row-->
    </div>
    <!-- /container -->
@endsection