@extends('layouts.pintaria3.master')

@section('title') {{(empty($pages->title_tag)?'Pintaria - Portal Edukasi Indonesia':$pages->title_tag)}} @endsection
@section('meta_description')Info Kuliah, Kursus Online, Kelas Karyawan, Kuliah Karyawan, Kuliah Blended dan Pendidikan di Indonesia, semuanya ada di Pintaria.com @endsection
@section('content')
    <section id="hero_in" class="static profession-banner-header">
        <div class="wrapper">
            <div class="container">
                <h1 class="fadeInUp"><span></span>Profesi</h1>
            </div>
        </div>
    </section>

    <div class="container add_top_30    ">
        <div class="main_title_2">
            <p>Temukan karir Anda disini. Pastikan profesi yang Anda pilih sesuai dengan minat dan kemampuan Anda.</p>
        </div>
        <div class="container margin_30_95">
            <div class="row">
                @forelse ($professions as $profession)
                <div class="col-lg-4 col-md-6 wow" data-wow-offset="150">
                    <a href="{{url('profesi/'.str_slug($profession->name))}}" class="grid_item">
                        <figure class="block-reveal">
                            <div class="block-horizzontal"></div>
                            <img data-src="{{asset_cdn($profession->image)}}" class="img-fluid" alt="">
                            <div class="info">
                                <h3>{{$profession->name}}</h3>
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
                {{ $professions->links() }}
            </div>
        </center>
        <!--/row-->
    </div>
    <!-- /container -->
@endsection