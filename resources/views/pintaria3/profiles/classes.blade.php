@extends('layouts.pintaria3.master')

@section('title') Pintaria - Portal Edukasi Indonesia @endsection
@section('meta_description')Info Kuliah, Kursus Online, Kelas Karyawan, Kuliah Karyawan, Kuliah Blended dan Pendidikan di Indonesia, semuanya ada di Pintaria.com @endsection
@section('content')
<section id="hero_in" class="class">
    <div class="wrapper">
        <div class="container">
            <h1 class="fadeInUp"><span></span>Kelas Saya</h1>
        </div>
    </div>
</section>
<div class="filters_listing sticky_horizontal">
    <div class="container">
        <form method="GET">
            <ul class="clearfix">
                <li class="float-right w-150p">
                    <select name="{{ \App\Product::CATEGORY }}" class="selectbox" onchange="this.form.submit()">
                        <option value="">Semua kategori</option>
                        @forelse ($categories as $category)
                            <option value="{{ $category->name }}" @if($category->name == Request::get(\App\Product::CATEGORY)) selected='selected' @endif>{{ $category->name }}</option>
                        @empty
                            <option>Tidak ada category</option>
                        @endforelse
                    </select>
                </li>
            </ul>
        </form>
    </div>
</div>

<div class="container margin_60_35">
    <div class="row">
        @forelse($courses as $course)
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="box_grid wow">
                    <figure class="block-reveal">
                        <div class="block-horizzontal"></div>
                        <a href="{{ $course->route_url }}">
                            <img src="{{ $course->full_course_thumbnail_url }}" class="img-fluid" alt="">
                        </a>
                        @if ($course->learning_method == \App\Product::OFFLINE_COURSE)
                            <div class="price p-label">Tatap Muka</div>
                        @endif
                    </figure>
                    <div class="wrapper">
                        <h3 class="h-65p"><a href="{{ $course->route_url }}">{{ str_limit($course->course_name, 50) }}</a></h3>
                        @if ($course->is_review_shown)
                            <div class="rating">
                                @for($i = 0; $i < 5; $i++)
                                    <i class="icon_star {{ ($i < $course->rating['avg_rating']) ? 'voted': '' }}"></i>
                                @endfor
                                <small>({{ $course->rating['total_reviewer'] }})</small>
                            </div>
                            @if($course->is_reviewable)
                                <a href="{{ $course->review_url }}">Tulis Ulasan</a>
                            @else
                                &nbsp;
                            @endif
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <ul class="pb-0 h-40p">
                                @if($course->is_certificate_available)
                                    <li class="pt-2">
                                        <a href="{{ $course->certificate_url }}" class="d-block hide-xs" target="_blank">Lihat E-Certificate</a>
                                        <a href="{{ $course->certificate_url }}" class="d-none show-xs" target="_blank">E-Certificate</a>
                                    </li>
                                @else
                                    &nbsp;
                                @endif
                                <li>
                                    @if($course->is_tryout)
                                        <a class="text-center" href="{{ $course->tryout_url }}">Mulai Tes</a>
                                    @elseif($course->learning_method == \App\Product::OFFLINE_COURSE && isset($course->attendee_card_url) && !empty($course->attendee_card_url)) 
                                        <a class="text-center" href="{{ $course->attendee_card_url }}" target="_blank">Info Kelas</a>
                                    @else
                                        <a class="text-center" href="{{ $course->masuk_kelas_url }}">Masuk Kelas</a>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center">
                    Belum ada kelas. Silakan cari kelas di <strong><a href="{{ route('home') }}">Beranda</a></strong>.
                </p>
            </div>
        @endforelse
    </div>
</div>
@endsection
@section('additional.scripts')
<script type="text/javascript">
var message = "{{ Session::get('message-success') }}";
if(message) {
    showSuccessMessage(message);
}
</script>
@endsection
