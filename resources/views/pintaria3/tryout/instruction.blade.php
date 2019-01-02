@extends('layouts.pintaria3.tryout.master')
@section('title') Pintaria - {{$product->name}} @endsection
@section('meta_description')Info Kuliah, Kursus Online, Kelas Karyawan, Kuliah Karyawan, Kuliah Blended dan Pendidikan di Indonesia, semuanya ada di Pintaria.com @endsection
@section('content')
<div class="container">
    <div class="col-12">
        <div class="row mt-3 rich-text-editor">
            {!! $product->instruction !!}
        </div>
        <div class="row">
            <div class="col-12">
            <p class="text-center">
                <a href="{{ $product->quiz_url }}">
                    <button class="btn-tryout">
                        {{ $product->button_name }}
                    </button>
                </a>
            </p>
            </div>
        </div>
    </div>
</div>
@endsection