@extends('layouts.pintaria3.tryout.master')
@section('title') Pintaria - {{$product->name}} @endsection
@section('meta_description')Info Kuliah, Kursus Online, Kelas Karyawan, Kuliah Karyawan, Kuliah Blended dan Pendidikan di Indonesia, semuanya ada di Pintaria.com @endsection
@section('content')
<div class="overlay">
</div>
<img src="{{ asset('img/fancybox_loading.gif') }}" class="loader">
<div class="col-12">
    <div class="row my-5">
        <div class="col-12">
            <div class="iframe-height">{!! $product->embed_link !!}</div>
        </div>
        <div class="col-12">
            <br clear="both" />
            <p class="text-center">
                @if($product->is_last_quiz)
                    <a href="{{ route('kelas.saya') }}">
                        <button class="btn-tryout d-none">
                            Kelas Saya
                        </button>
                    </a>
                @else
                    <a href="{{ $product->quiz_url }}">
                        <button class="btn-tryout d-none">
                            {{ $product->button_name }}
                        </button>
                    </a>
                @endif
            </p>
        </div>
    </div>
</div>
@endsection
@push('additional.script')
<script type="text/javascript">
$(document).ready(function() {
    var counter = 0;
    var intervalId = setInterval(function() {
        counter += 50;

        if(counter > 5000) {
            $('.loader').remove();
            $('.overlay').remove();
            $('.btn-tryout').removeClass('d-none');
        }
        var smcxEmbed = $('.smcx-embed');
        var smcxIframeContainer = $('.smcx-iframe-container');

        if(smcxEmbed.html() && smcxIframeContainer.html()) {
            smcxEmbed.css('max-width', '100%');
            smcxIframeContainer.css('max-width', '100%');
            $('.loader').remove();
            $('.overlay').remove();
            $('.btn-tryout').removeClass('d-none');
            clearInterval(intervalId);
        }
    }, 50);
});
</script>
@endpush