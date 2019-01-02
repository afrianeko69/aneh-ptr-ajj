<style type="text/css">
    .row .col-lg-6.col-md-6.col-md-offset-1 p {
        padding-top: 2rem;
    }
    @media(max-width: 1199px) {
        .row .col-lg-6.col-md-6.col-md-offset-1 p {
            padding-top: 0.5rem;
        }
    }
</style>

<div class="container">
    <div class="col-lg-6 col-md-6 hidden-sm hidden-xs">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <img class="img-responsive" src="{{ asset('pintaria/img/shared/cs.png') }}">
            </div>
            <div class="col-lg-6 col-md-6 col-md-offset-1">
                <p class="text-justify">
                    Mendapatkan informasi lengkap seputar program persiapan, kuliah dan pelatihan
                </p>
            </div>
        </div>
        <div class="clearfix">&nbsp;</div>
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <img class="img-responsive" src="{{ asset('pintaria/img/shared/message.png') }}">
            </div>
            <div class="col-lg-6 col-md-6 col-md-offset-1">
                <p class="text-justify">
                    Memperoleh saran mengenai metode belajar yang sesuai dengan kebutuhan
                </p>
            </div>
        </div>
        <div class="clearfix">&nbsp;</div>
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <img class="img-responsive" src="{{ asset('pintaria/img/shared/book.png') }}">
            </div>
            <div class="col-lg-6 col-md-6 col-md-offset-1">
                <p class="text-justify">
                    Mendapatkan bantuan dalam proses pendaftaran program yang tersedia
                </p>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <form class="form-horizontal form-saya-berminat">
            {{ csrf_field() }}
            <div class="row">
                <p class="c-font-uppercase c-font-bold">
                    Data Registrasi
                </p>
            </div>
            <div class="form-group">
                <input class="form-control c-square c-theme input-lg" name="name" placeholder="Nama" type="text" value="{{ old('name') }}" />
                <span class="text-danger error error-name">
                    <small>
                        @foreach($errors->get('name') as $ref)
                            {{ $ref }}
                        @endforeach
                    </small>
                </span>
            </div>
            <div class="form-group">
                <input class="form-control c-square c-theme input-lg" name="email" placeholder="Email" type="text" value="{{ old('email') }}" />
                <span class="text-danger error error-email">
                    <small>
                        @foreach($errors->get('email') as $ref)
                            {{ $ref }}
                        @endforeach
                    </small>
                </span>
            </div>
            <div class="form-group">
                <input class="form-control c-square c-theme input-lg" name="phone" placeholder="Nomor ponsel" type="text" value="{{ old('phone') }}" />
                <span class="text-danger error error-phone">
                    <small>
                        @foreach($errors->get('phone') as $ref)
                            {{ $ref }}
                        @endforeach
                    </small>
                </span>
            </div>
            <div class="form-group">
                @if(isset($locations))
                    <select class="form-control c-square c-theme input-lg" name="location">
                        <option value="">Lokasi</option>
                        @forelse($locations as $location)
                            @if($location->name == old('location'))
                                <option value="{{ $location->name }}" selected>{{ $location->name }}</option>
                            @else
                                <option value="{{ $location->name }}">{{ $location->name }}</option>
                            @endif
                        @empty
                        @endforelse
                    </select>
                @else
                    <input class="form-control c-square c-theme input-lg" name="location" placeholder="Lokasi" type="text" value="{{ old('location') }}" />
                @endif
                <span class="text-danger error error-location">
                    <small>
                        @foreach($errors->get('location') as $ref)
                            {{ $ref }}
                        @endforeach
                    </small>
                </span>
            </div>
            
            <div class="form-group">

                @if(isset($products))
                    <select class="form-control c-square c-theme input-lg" name="product">
                        <option value="">Produk</option>
                        @forelse($products as $k => $product)
                            <optgroup label="{{ucfirst($k)}}">
                                @foreach ($product as $p)
                                    @if($p->name == old('product_name'))
                                        <option value="{{ $p->name }}" selected>{{ $p->name }}</option>
                                    @else
                                        <option value="{{ $p->name }}">{{ $p->name }}</option>
                                    @endif
                                @endforeach
                            </optgroup>
                        @empty
                        @endforelse
                    </select>
                @elseif(isset($product->product_name))
                    <input class="form-control c-square c-theme input-lg" name="product" placeholder="Nama Produk" type="text" value="{{ $product->product_name }}" readonly="true"/>
                @elseif(isset($product->name))
                    <input class="form-control c-square c-theme input-lg" name="product" placeholder="Nama Produk" type="text" value="{{ $product->name }}" readonly="true"/>
                @else
                    <input class="form-control c-square c-theme input-lg" name="product" placeholder="Nama Produk" type="text" value="{{ old('product') }}" />
                @endif
                <span class="text-danger error error-product">
                    <small>
                        @foreach($errors->get('product') as $ref)
                            {{ $ref }}
                        @endforeach
                    </small>
                </span>
            </div>
            <div class="form-group">
                <select class="form-control c-square c-theme input-lg" name="interest">
                    <option value="">Rencana belajar</option>
                    @php $study_plan = ['Sekarang', '1 bulan dari sekarang', '3 bulan dari sekarang', '6 bulan dari sekarang', '12 bulan dari sekarang']; @endphp
                    @foreach($study_plan as $plan)
                        @if($plan == old('plan'))
                            <option value="{{ $plan }}" selected>{{ $plan }}</option>
                        @else
                            <option value="{{ $plan }}">{{ $plan }}</option>
                        @endif
                    @endforeach
                </select>
                <span class="text-danger error error-interest">
                    <small>
                        @foreach($errors->get('interest') as $ref)
                            {{ $ref }}
                        @endforeach
                    </small>
                </span>
            </div>
            <div class="form-group">
                <input class="form-control c-square c-theme input-lg" name="reference_name" placeholder="Nama pemberi referensi" type="text" value="{{ old('reference_name') }}" />
            </div>
            <div class="form-group">
                <input class="form-control c-square c-theme input-lg" name="reference_email" placeholder="Email pemberi referensi" type="text" value="{{ old('reference_email') }}" />
                <span class="text-danger error error-reference_email">
                    <small>
                        @foreach($errors->get('reference_email') as $ref)
                            {{ $ref }}
                        @endforeach
                    </small>
                </span>
            </div>
            <div class="form-group">
                <div id="html_element" class="g-recaptcha"></div>
                <span class="text-danger error error-g-recaptcha-response">
                    <small>
                        @foreach($errors->get('g-recaptcha-response') as $ref)
                            {{ $ref }}
                        @endforeach
                    </small>
                </span>
            </div>
            <input type="hidden" name="url" value="{{url()->full()}}" id="url">
            <div class="form-group">
                <button type="submit" class="btn c-theme-btn c-btn-uppercase btn-lg c-btn-bold c-btn-square btn-saya-berminat">Kirim</button>
            </div>
        </form>
    </div>
</div>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
<script type="text/javascript">
    var onloadCallback = function() {
        grecaptcha.render('html_element', {
          'sitekey' : '{{env("RECAPTCHA_CLIENT_KEY")}}'
        });
    };
</script>