<div class="call_section" id="saya-berminat" style="background: url({{ asset_cdn('pintaria/background/BG-form-bottom-ath-homepage.jpg') }}) center center no-repeat fixed;">

    <div class="container clearfix">
        <div class="float-right wow content-wrapper" data-wow-offset="250">
            <div class="block-reveal">
                <div class="block-vertical"></div>
                <div class="box_1 px-4 px-sm-5">
                    <form class="form-horizontal form-saya-berminat" id="form-saya-berminat">
                        {{ csrf_field() }}
                        <h5>
                            DATA MOHON INFO
                        </h5>
                        <div class="form-group">

                            <span class="input">
                                <input class="input_field" name="name" type="text" value="{{ old('name') }}" />
                                <label class="input_label">
                                    <span class="input__label-content">Nama*</span>
                                </label>
                            </span>
                            <span class="text-danger error error-name">
                                <small>
                                    @foreach($errors->get('name') as $ref)
                                        {{ $ref }}
                                    @endforeach
                                </small>
                            </span>

                            <span class="input">
                                <input class="input_field" name="email" type="text" value="{{ old('email') }}" />
                                <label class="input_label">
                                    <span class="input__label-content">Email*</span>
                                </label>
                            </span>
                            <span class="text-danger error error-email">
                                <small>
                                    @foreach($errors->get('email') as $ref)
                                        {{ $ref }}
                                    @endforeach
                                </small>
                            </span>

                            <span class="input">
                                <input class="input_field" name="phone" type="text" value="{{ old('phone') }}" />
                                <label class="input_label">
                                    <span class="input__label-content">Nomor ponsel*</span>
                                </label>
                            </span>
                            <span class="text-danger error error-phone">
                                <small>
                                    @foreach($errors->get('phone') as $ref)
                                        {{ $ref }}
                                    @endforeach
                                </small>
                            </span>

                            <span class="input">
                                @if(isset($locations))
                                    <select class="input_field" name="location">
                                        <option value=""></option>
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
                                    <input class="input_field" name="location" type="text" value="{{ old('location') }}" />
                                @endif
                                <label class="input_label">
                                    <span class="input__label-content">Lokasi*</span>
                                </label>
                            </span>
                            <span class="text-danger error error-location">
                                <small>
                                    @foreach($errors->get('location') as $ref)
                                        {{ $ref }}
                                    @endforeach
                                </small>
                            </span>
                            <span class="input">
                                @if(isset($mohon_info_products))
                                    <select class="input_field" name="product">
                                        <option value=""></option>
                                        @forelse($mohon_info_products as $k => $product)
                                            <optgroup label="{{ucfirst($k)}}">
                                                @foreach ($product as $p)
                                                    @if(!empty($p->crm_interest_name))
                                                        <option value="{{ $p->crm_interest_name }}">{{ $p->crm_interest_name }}</option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                        @empty
                                        @endforelse
                                    </select>
                                @elseif(isset($product->crm_interest_name) && (!empty($product->crm_interest_name)))
                                    <input class="input_field" name="product" type="text" value="{{ $product->crm_interest_name }}" readonly="true"/>
                                @elseif(isset($product->product_name))
                                    <input class="input_field" name="product" type="text" value="{{ $product->product_name }}" readonly="true"/>
                                @elseif(isset($product->name))
                                    <input class="input_field" name="product" type="text" value="{{ $product->name }}" readonly="true"/>
                                @else
                                    <input class="input_field" name="product" type="text" value="{{ old('product') }}" />
                                @endif
                                <label class="input_label">
                                    <span class="input__label-content">Produk*</span>
                                </label>
                            </span>
                            <span class="text-danger error error-product">
                                <small>
                                    @foreach($errors->get('product') as $ref)
                                        {{ $ref }}
                                    @endforeach
                                </small>
                            </span>

                            @if (isset($applicant_categories))
                                <span class="input">
                                    <span class="label-above-radio">Kategori pendaftar*</span>
                                    @foreach ($applicant_categories as $k => $applicant_cat)
                                        <input type="radio" id="{{ $k }}" name="applicant_category" value="{{ $applicant_cat }}" {{ $applicant_cat == 'Individu'? 'checked' : '' }} />
                                        <label class="radio_field" for="{{ $k }}">{{ $applicant_cat }}</label>
                                    @endforeach
                                </span>
                                <span class="text-danger error error-applicant_category">
                                    <small>
                                        @foreach($errors->get('applicant_category') as $ref)
                                            {{ $ref }}
                                        @endforeach
                                    </small>
                                </span>
                            @endif

                            <div id="number_of_applicants">
                                <span class="input"> 
                                    <input class="input_field" name="number_of_applicants" type="number" value="{{ old('number_of_applicants') }}" />
                                    <label class="input_label">
                                        <span class="input__label-content">Jumlah karyawan yang akan didaftarkan*</span>
                                    </label>
                                </span>
                                <span class="text-danger error error-number_of_applicants">
                                    <small>
                                        @foreach($errors->get('number_of_applicants') as $ref)
                                            {{ $ref }}
                                        @endforeach
                                    </small>
                                </span>
                            </div>

                            <span class="input">
                                <select class="input_field" name="interest">
                                    <option value=""></option>
                                    @php $study_plan = ['Sekarang', '1 bulan dari sekarang', '3 bulan dari sekarang', '6 bulan dari sekarang', '12 bulan dari sekarang']; @endphp
                                    @foreach($study_plan as $plan)
                                        @if($plan == old('plan'))
                                            <option value="{{ $plan }}" selected>{{ $plan }}</option>
                                        @else
                                            <option value="{{ $plan }}">{{ $plan }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <label class="input_label">
                                    <span class="input__label-content">Rencana belajar*</span>
                                </label>
                            </span>
                            <span class="text-danger error error-interest">
                                <small>
                                    @foreach($errors->get('interest') as $ref)
                                        {{ $ref }}
                                    @endforeach
                                </small>
                            </span>
                            <div id="referral_code">
                                <span class="input">
                                    <input class="input_field" name="referral_code" type="text" value="{{ old('referral_code') }}" />
                                    <label class="input_label">
                                        <span class="input__label-content">Kode promo/referral (opsional)</span>
                                    </label>
                                </span>
                                <span class="text-danger error error-referral_code">
                                    <small>
                                        @foreach($errors->get('referral_code') as $ref)
                                            {{ $ref }}
                                        @endforeach
                                    </small>
                                </span>
                            </div>
                        </div>
                        <div class="form-group recaptcha-overflow-hidden">
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
                        @if (isset($product) && isset($product->category_classification_name))
                            <input type="hidden" name="product_category" value="{{ $product->category_classification_name }}">
                        @endif
                        <div class="form-group">
                            <button type="submit" id="submit" class="btn_1 rounded outline full-width btn-saya-berminat btn-below-recaptcha"  onClick="tracker('button_kirim_mohon_info', '', 'button', 'kirim' , 'mohon_info' );" >Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">

    var onloadCallback = function() {
        grecaptcha.render('submit', {
            'sitekey' : '{{env("RECAPTCHA_CLIENT_KEY")}}',
            'callback' : onSubmit
        });
    };
    var onSubmit = function(token) {
        $("#form-saya-berminat").submit();
    };

    $(document).ready(function () {
        toggleNumOfApplicants();
        $("input[name='applicant_category']").change(function () {
            toggleNumOfApplicants();
        });

    });

    function addProductCategoryToInput() {
        $("select[name='product'] option:selected").each(function () {
            var html = '<input type="hidden" name="product_category" value="' + $(this).parent().prop("label") + '">';
            $('.form-saya-berminat .form-group').append(html);
        });
    }

    function toggleNumOfApplicants() {
        if ($('input[name="applicant_category"]:checked').val() == 'Perusahaan/Kolektif') {
           $("#number_of_applicants").attr('required', true).show("fast");
        } else {
           $("#number_of_applicants").attr('required', false).hide("fast");
        }
    }

    function isValueInObject(val, obj, key) {
        for (var prop in obj) {
            if (prop == key) {
                if (obj[prop] == val) return true; 
            }
        }
        return false;
    }
</script>
@endpush
