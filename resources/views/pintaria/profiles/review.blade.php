@extends('layouts.pintaria.master')

@section('title')
Pintaria - Portal Edukasi Indonesia
@endsection

@section('content')
<div class="container container-message-flash-danger">
</div>
<div class="c-content-box c-size-md c-bg-white">
    <div class="container">
        <div class="c-content-title-1">
            <h3 class="c-center c-font-uppercase c-font-bold">Ulasan</h3>
            <div class="c-line-center"></div>
        </div>
        <form class="form-horizontal" method="POST" action="{{ route('user.product.review.submit', [$product->slug]) }}">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-3 col-lg-pull-1 col-md-4 col-sm-4 col-sm-offset-0 col-xs-8 col-xs-offset-2 mb-2 pull-right-sm-up">
                    <div class="card-border">
                        <img class="img-responsive" src="{{ $product->image_full_url }}" />
                        <div class="info">
                            <p class="c-title c-font-16 c-font-slim">
                                <strong>
                                    <a href="{{ $product->route_url }}" class="base-color" target="_blank">
                                        {{ $product->name }}
                                    </a>
                                </strong>
                            </p>
                            <p class="c-price c-font-14 c-font-slim">
                                {{ $product->provider_list }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-lg-offset-1 col-md-8 col-sm-8 col-xs-12">
                    <div class="form-group">
                        <p>Berikan penilaian mengenai kelas ini secara keseluruhan</p>
                        <fieldset class="rating">
                            <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5"></label>
                            <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4"></label>
                            <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3"></label>
                            <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2"></label>
                            <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1"></label>
                        </fieldset>
                        <div class="text-danger error error-rating text-center">
                            <small>
                                @foreach($errors->get('rating') as $ref)
                                    {{ $ref }}
                                @endforeach
                            </small>
                        </div>
                    </div>
                    <div class="form-group">
                        <p>Berikan ulasan untuk kelas ini</p>
                        <textarea class="form-control mb-1 input-lg c-square c-theme" name="review" placeholder="Tulis ulasan Anda..." rows="5"></textarea>
                        <span class="text-danger error error-review">
                            <small>
                                @foreach($errors->get('review') as $ref)
                                    {{ $ref }}
                                @endforeach
                            </small>
                        </span>
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
                    <div class="pull-right">
                        <a href="{{ route('kelas.saya') }}" class="btn c-btn-white c-btn-uppercase btn-lg c-btn-bold c-btn-square">
                            Batal
                        </a>
                        <button class="btn c-theme-btn c-btn-uppercase btn-lg c-btn-bold c-btn-square submit-rating-review">Kirim</button>
                    </div>
                </div>
            </div>
        </form>
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
        var spin = caseShowLoadingSpin('.form-horizontal', '50');

        $.ajax({
            url: submitRatingReviewUrl,
            type: 'POST',
            async: true,
            data: $('.form-horizontal').serialize(),
            success:function(response) {
                if(response.status == 200) {
                    window.location.href="{{ route('kelas.saya') }}";
                } else {
                    showErrorMessage('.container-message-flash-danger', response.message, true);
                }
                removeSpinAndDisabled(spin, btnContainer);
            },
            error:function(response) {
                if(response.status == 422) {
                    $.each(response.responseJSON, function (key, value) {
                        $('.error.error-' + key).children().html(value[0]);
                    });
                } else {
                    showErrorMessage('.container-message-flash-danger', 'Kami sedang kesulitan memproses ulasan Anda.', true);
                }
                removeSpinAndDisabled(spin, btnContainer);
            }
        });
    });
});
</script>
@endsection