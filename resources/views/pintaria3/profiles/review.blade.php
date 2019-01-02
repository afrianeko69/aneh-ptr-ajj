@extends('layouts.pintaria3.master')

@section('title')
Pintaria - Portal Edukasi Indonesia
@endsection
@section('meta_description')Info Kuliah, Kursus Online, Kelas Karyawan, Kuliah Karyawan, Kuliah Blended dan Pendidikan di Indonesia, semuanya ada di Pintaria.com @endsection

@section('content')
<section id="hero_in" class="courses">
    <div class="wrapper">
        <div class="container">
            <h1 class="fadeInUp"><span></span>Ulasan</h1>
        </div>
    </div>
</section>

<div class="container">
    <div class="container-message-flash-danger">
        <div class="col-12 d-none">
        </div>
    </div>
</div>
<div class="bg_color_1">
    <div class="container margin_60_35 pt-2">
        <div class="row">
            <div class="col-lg-8 order-2 order-lg-1">
                <div class="more mt-3">
                    <form class="form-horizontal" method="POST" action="{{ route('user.product.review.submit', [$product->slug]) }}">
                        {{ csrf_field() }}
                        <span>Berikan penilaian mengenai kelas ini secara keseluruhan</span>
                        <div class="form-group">
                            <div class="row justify-content-center">
                                <fieldset class="rating">
                                    <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5"></label>
                                    <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4"></label>
                                    <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3"></label>
                                    <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2"></label>
                                    <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1"></label>
                                </fieldset>
                            </div>
                            <div class="row justify-content-center">
                                <span class="text-danger error error-rating">
                                    <small>
                                        @foreach($errors->get('rating') as $ref)
                                            {{ $ref }}
                                        @endforeach
                                    </small>
                                </span>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <p>Berikan ulasan untuk kelas ini</p>
                                    <span class="input">
                                        <textarea class="input_field my-4" name="review" rows="3"></textarea>
                                        <label class="input_label">
                                            <span class="input__label-content">Tulis ulasan Anda...</span>
                                        </label>
                                    </span>
                                    <span class="text-danger error error-review">
                                        <small>
                                            @foreach($errors->get('review') as $ref)
                                                {{ $ref }}
                                            @endforeach
                                        </small>
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <p>
                                        Ulasan Anda akan melalui proses moderasi oleh Administrator kami untuk menghindari konten-konten
                                         yang melanggar 
                                         <a href="{{ route('perjanjian.pengguna') }}" target="_blank">
                                            <strong>
                                                Perjanjian Pengguna
                                            </strong>
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <div class="row float-right">
                                <div class="col-12 mb-3">
                                    <a href="{{ route('kelas.saya') }}" class="btn-danger-rounded mr-3">
                                        Batal
                                    </a>
                                    <button class="btn_1 rounded submit-rating-review">Kirim</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <aside class="col-lg-4 order-1" id="sidebar">
                <div class="box_detail">
                    <figure>
                        <img src="{{ $product->image_full_url }}" alt="" class="img-fluid">
                    </figure>

                    <div id="list_feat">
                        <ul>
                            <li>
                                <strong>
                                    <a href="{{ $product->route_url }}" target="_blank">
                                        {{ $product->name }}
                                    </a>
                                </strong>
                            </li>
                            <li>
                                {{ $product->provider_list }}
                            </li>
                        </ul>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection

@section('additional.scripts')
<script type="text/javascript">
var submitRatingReviewUrl = "{{ route('user.product.review.submit', [$product->slug]) }}";
$(document).ready(function() {
    $(document).on('click', '.submit-rating-review', function(e) {
        e.preventDefault();
        $('.error').children().html('');
        var btnContainer = '.submit-rating-review';
        $(btnContainer).attr('disabled', true);

        $.ajax({
            url: submitRatingReviewUrl,
            type: 'POST',
            async: true,
            data: $('.form-horizontal').serialize(),
            success:function(response) {
                if(response.status == 200) {
                    showSuccessMessage(response.message);
                    setTimeout(function() {
                        window.location.href="{{ route('kelas.saya') }}";
                    }, 3000);
                } else {
                    showErrorMessage(response.message);
                }
                $(btnContainer).attr('disabled', false);
            },
            error:function(response) {
                if(response.status == 422) {
                    $.each(response.responseJSON, function (key, value) {
                        $('.error.error-' + key).children().html(value[0]);
                    });
                } else {
                    showErrorMessage('Maaf, kami sedang kesulitan memproses ulasan Anda.');
                }
                $(btnContainer).attr('disabled', false);
            }
        });
    });
});
</script>
@endsection