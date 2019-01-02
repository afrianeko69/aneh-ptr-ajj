@extends('layouts.affiliate.master') 
@section('content')

<div class="container">
    <div class="row">
        @include('layouts.affiliate.partials.sidebar')
        <div class="col-md-9 bg_color_1 add_padding_20">
            <div class="c-content-title-1">
                <h3 class="c-font-uppercase c-font-bold">Products</h3>
                <div class="c-line-left"></div>
            </div>
            <br clear="both" />
            <div class="col-md-12 add_padding_20">
                {{ Form::open(['url' => route('affiliate-product.update')]) }}
                <h3 class="c-font-uppercase c-font-bold">KULIAH</h3>
                <div class="row">
                    @if($products[\App\Product::CATEGORY_KULIAH_NAME]) 
                    @foreach($products[\App\Product::CATEGORY_KULIAH_NAME] as $product)
                    <div class="col-md-3 col-sm-6 c-margin-b-20">
                        <div class="c-content-product-2 c-bg-white c-border">
                            <div class="c-info">
                                <p class="c-title c-font-16 c-font-slim">
                                    <div class="c-checkbox">
                                        <input type="checkbox" id="checkbox{{$product->id}}" class="c-check" name="product_id[]" value="{{$product->id}}" {{(in_array($product->id,$affiliate) ? "checked='checked'" : '')}}>
                                        <label for="checkbox{{$product->id}}">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span>
                                        </label>
                                    </div>
                                    <a href="{{ $product->route_url }}"> {{ $product->name }}</a>
                                </p>
                                @if (is_null($product->price))
                                <span class="c-price c-font-16 c-font-slim">&nbsp;</span>
                                <p class="c-price c-font-16 c-font-slim">&nbsp;</p>
                                @elseif ($product->is_discount)
                                <span class="c-font-16 c-font-line-through c-font-red">
                                    <small>
                                        {{ $product->formatted_price }}
                                    </small>
                                </span>
                                <p class="c-price c-font-16 c-font-slim">{{ $product->formatted_price_after_discount }} &nbsp;</p>
                                @else
                                <p class="c-price c-font-16 c-font-slim">{{ $product->formatted_price }} &nbsp;</p>
                                @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach @else
                    <p class="c-center">Belum ada produk.</p>
                    @endif
                </div>

                <h3 class="c-font-uppercase c-font-bold">KURSUS/PELATIHAN</h3>
                <br clear="both">
                <div class="row">
                    @if($products[\App\Product::CATEGORY_KURSUS]) 
                    @foreach($products[\App\Product::CATEGORY_KURSUS] as $product)
                    <div class="col-md-3 col-sm-6 c-margin-b-20">
                        <div class="c-content-product-2 c-bg-white c-border">
                            <div class="c-info">
                                <p class="c-title c-font-16 c-font-slim">
                                    <div class="c-checkbox">
                                        <input type="checkbox" id="checkbox{{$product->id}}" class="c-check" name="product_id[]" value="{{$product->id}}" {{(in_array($product->id,$affiliate) ? "checked='checked'" : '')}}>
                                        <label for="checkbox{{$product->id}}">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span>
                                        </label>
                                    </div>
                                    <a href="{{ $product->route_url }}">{{ $product->name }}</a>
                                </p>
                                @if (is_null($product->price))
                                <span class="c-price c-font-16 c-font-slim">&nbsp;</span>
                                <p class="c-price c-font-16 c-font-slim">&nbsp;</p>
                                @elseif ($product->is_discount)
                                <span class="c-font-16 c-font-line-through c-font-red">
                                    <small>
                                        {{ $product->formatted_price }}
                                    </small>
                                </span>
                                <p class="c-price c-font-16 c-font-slim">{{ $product->formatted_price_after_discount }} &nbsp;</p>
                                @else
                                <p class="c-price c-font-16 c-font-slim">{{ $product->formatted_price }} &nbsp;</p>
                                @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach @else
                    <p class="c-center">Belum ada produk.</p>
                    @endif
                </div>
                <br clear="both">
                <button class="btn_1 rounded full-width add_top_30 btn-update">Simpan</button>
                {{ Form::close()}}
            </div>
        </div>
    </div>
</div>
@endsection 

@section('additional.scripts') 
@endsection
