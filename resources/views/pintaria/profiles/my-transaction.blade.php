@extends('layouts.pintaria.master')

@section('title') Pintaria - Portal Edukasi Indonesia @endsection

@section('content')
<div class="container">
    @include('layouts.pintaria.partials.profile.sidebar')
    <div class="c-layout-sidebar-content ">
        <div class="c-content-title-1">
            <h3 class="c-font-uppercase"><strong>Transaksi Saya</strong></h3>
            <div class="c-line-left"></div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="row mb-2">
                    <form class="form-horizontal">
                        <div class="col-md-2">
                            <label>Filter</label>&nbsp;:
                        </div>
                        <div class="col-md-4 mb-1">
                            <select class="form-control" name="filter">
                                <option value="Semua Transaksi">Semua Transaksi</option>
                                @foreach($order_status_list as $key => $list)
                                    @if(Request::get('filter') && $list == Request::get('filter'))
                                        <option value="{{ $list }}" selected>{{ $list }}</option>
                                    @elseif(!Request::get('filter') && $list == $default_filter)
                                        <option value="{{ $list }}" selected>{{ $list }}</option>
                                    @else
                                        <option value="{{ $list }}">{{ $list }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn c-theme-btn c-btn-square c-btn-uppercase c-btn-bold">Cari</button>
                        </div>
                    </form>
                </div>
                @if($orders)
                    <div class="table-responsive">
                        <table class="table scrollable">
                            <thead>
                                <tr>
                                    <th>Tanggal Transaksi</th>
                                    <th>No. Pesanan</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Batas Pembayaran</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Status Pembayaran</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order['order_created_date'] }} <br/> {{ $order['order_created_time'] }}</td>
                                        <td>{{ $order['order_number'] }}</td>
                                        <td>
                                            @if($order['bundle_name'])
                                                {{ $order['bundle_name'] }}:
                                                <ul>
                                                    @foreach($order['order_details'] as $detail)
                                                        <li>
                                                            <a href="{{ $detail['product_route'] }}">
                                                                {{ $detail['product_name'] }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                @foreach($order['order_details'] as $detail)
                                                    <a href="{{ $detail['product_route'] }}">
                                                        {{ $detail['product_name'] }}
                                                    </a>
                                                @endforeach
                                            @endif

                                        </td>
                                        <td>{{ $order['display_amount'] }}</td>
                                        <td>{{ $order['order_expired_date'] }} <br/> {{ $order['order_expired_time'] }}</td>
                                        <td>{{ $order['order_paid_date'] }} <br/> {{ $order['order_paid_time'] }}</td>
                                        <td>{{ $order['order_status'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="row">
                        <p class="text-center mt-2 mb-3">
                            Belum ada transaksi yang ditemukan.<br />Yuk klik <a href="{{ route('home') }}"><strong>Beranda</strong></a> untuk melihat beragam produk-produk menarik di Pintaria :)
                        </p>
                    </div>
                @endif
            </div>
        </div>
            
    </div>
</div>
@endsection