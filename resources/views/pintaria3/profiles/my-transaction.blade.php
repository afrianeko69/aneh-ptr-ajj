@extends('layouts.pintaria3.master')

@section('title') Pintaria - Portal Edukasi Indonesia @endsection
@section('meta_description')Info Kuliah, Kursus Online, Kelas Karyawan, Kuliah Karyawan, Kuliah Blended dan Pendidikan di Indonesia, semuanya ada di Pintaria.com @endsection
@section('content')
<section id="hero_in" class="courses">
    <div class="wrapper">
        <div class="container">
            <h1 class="fadeInUp"><span></span>Transaksi Saya</h1>
        </div>
    </div>
</section>

<div class="bg_color_1">
    @include('layouts.pintaria3.partials.profiles.sidebar')
    <div class="container margin_60_35">
        <div class="row">
            <aside class="col-lg-4" id="sidebar">
                <div class="box_detail">
                    <form>
                        <div class="form-group">
                            <label>Filter</label>&nbsp;:
                        </div>
                        <div class="input-group-sm mb-2">
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
                        <div class="row">
                            <div class="col-12">
                                <button class="btn_1 rounded float-right">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
            </aside>
            <div class="col-lg-8">
                <section>
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
                        <p class="text-center">
                            Belum ada transaksi yang ditemukan.<br />Yuk klik <a href="{{ route('home') }}"><strong>Beranda</strong></a> untuk melihat beragam produk-produk menarik di Pintaria :)
                        </p>
                    @endif
                </section>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('.scroll-tab').scrollLeft(200);
    })
</script>
@endpush