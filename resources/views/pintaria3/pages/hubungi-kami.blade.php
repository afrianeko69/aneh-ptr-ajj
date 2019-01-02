@extends('layouts.pintaria3.master')

@section('title') {{(empty($pages->title_tag)?'Pintaria - Portal Edukasi Indonesia':$pages->title_tag)}} @endsection

@section('meta_description') {{(empty($pages->meta_description)?'':$pages->meta_description)}} @endsection
@section('additional.styles')
<style>
.error{color:#ff0000}
</style>
@endsection
@section('content')
    <section id="hero_in" class="static contact-banner-header">
        <div class="wrapper">
            <div class="container">
                <h1 class="fadeInUp"><span></span>{{$pages->title}}</h1>
            </div>
        </div>
    </section>

    <div class="contact_info">
        <div class="contact_body">
            {!!$pages->body!!}
        </div>
            <ul class="clearfix">
                <li>
                    <i class="pe-7s-map-marker"></i>
                    <h4>Address</h4>
                    PT. Haruka Evolusi Digital Utama<br><br>

                    Office8, Level 18A<br>
                    Jl. Jenderal Sudirman Kav. 52-53 (access from Jl. Senopati Raya No. 8B)<br>
                    Sudirman Central Business District (SCBD)<br>
                    Jakarta Selatan - 12190<br>
                    info@pintaria.com<br>
                    
                </li>
                <li>
                    <i class="pe-7s-mail-open-file"></i>
                    <h4>Email</h4>
                    <span>info@pintaria.com</span>

                </li>
                <li>
                    <i class="pe-7s-phone"></i>
                    <h4>Hubungi Kami</h4>
                    <span>+6281382765493</span><br>
                    <span>Line : @pintariaid</span>
                </li>
            </ul>
    </div>

    <div class="bg_color_1">
        <div class="container margin_120_95">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="map_contact">
                    </div>
                </div>
                <div class="col-lg-6">
                    <h4>Hubungi Kami</h4>
                    <div id="message-contact"></div>
                    <form method="post" id="contactform" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <span class="input">
                                    <input class="input_field" type="text" id="name_contact" name="first_name_contact" >
                                    <label class="input_label">
                                        <span class="input__label-content">Nama Depan</span>
                                    </label>
                                    <div class="first_name_error error"></div>
                                </span>
                            </div>
                            <div class="col-md-6">
                                <span class="input">
                                    <input class="input_field" type="text" id="lastname_contact" name="last_name_contact" >
                                    <label class="input_label">
                                        <span class="input__label-content">Nama Belakang</span>
                                    </label>
                                    <div class="last_name_error error"></div>
                                </span>
                            </div>
                        </div>
                        <!-- /row -->
                        <div class="row">
                            <div class="col-md-6">
                                <span class="input">
                                    <input class="input_field" type="email" id="email_contact" name="email_contact" >
                                    <label class="input_label">
                                        <span class="input__label-content">Email</span>
                                    </label>
                                    <div class="email_error error"></div>
                                </span>
                            </div>
                            <div class="col-md-6">
                                <span class="input">
                                    <input class="input_field" type="text" id="phone_contact" name="phone_contact" >
                                    <label class="input_label">
                                        <span class="input__label-content">Telepon</span>
                                    </label>
                                    <div class="phone_error error"></div>
                                </span>
                            </div>
                        </div>
                        <!-- /row -->
                        <span class="input mb-4">
                                <textarea class="input_field" id="message_contact" name="message_contact" style="height:150px;"></textarea>
                                <label class="input_label">
                                    <span class="input__label-content">Pesan</span>
                                </label>
                                <div class="description_error error"></div>
                        </span>
                        
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
                        <p class="add_top_30"><input type="submit" value="Kirim" class="btn_1 rounded btn-below-recaptcha" id="submit-contact"></p>
                    </form>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!--/bg_color_1-->

@endsection

@section('additional.scripts')
	<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key={{ENV('GOOGLE_MAPS_KEY')}}"></script>
	<script type="text/javascript" src="{{ url('pintaria3/js/mapmarker.jquery.js')}}"></script>

    <script>
        var onloadCallback = function() {
            grecaptcha.render('html_element', {
                'sitekey' : "{{ config('services.recaptcha_client_key') }}"
            });
        };

        $(document).ready(function(){
            //set up markers 
            var myMarkers = {"markers": [
                    {"latitude": "-6.229897", "longitude":"106.8056787", "icon": "{{url('pintaria3/img/map-marker.png')}}"}
                ]
            };
            
            //set up map options
            $(".map_contact").mapmarker({
                zoom	: 14,
                center	: '8 Jl. Senopati',
                markers	: myMarkers
            });
        });

        $(document).on('submit', '#contactform', function(e) {
            e.preventDefault();
            $('.error').html('');
            var first_name = $('input[name=first_name_contact]').val();
            var last_name = $('input[name=last_name_contact]').val();
            var email = $('input[name=email_contact]').val();
            var phone = $('input[name=phone_contact]').val();
            var description = $('textarea[name=message_contact]').val();
            var recaptcha = grecaptcha.getResponse();
            if(email == '') {
                $('.email_error').html('Kolom email harus diisi.');
            }
            if(first_name == '') {
                $('.first_name_error').html('Kolom Nama Depan harus diisi.');
            }
            if(last_name == '') {
                $('.last_name_error').html('Kolom Nama Depan harus diisi.');
            }
            if(phone == '') {
                $('.phone_error').html('Kolom Telepon harus diisi.');
            }
            if(description == '') {
                $('.description_error').html('Kolom Pesan harus diisi.');
            }
            if (recaptcha == ''){
                $('.error-g-recaptcha-response').html('Mohon dicentang')
            }
            if ( (email == '') || (first_name == '') || (last_name == '') || (phone == '') || (description == '') || (recaptcha == '') ){
                return false;    
            }
            
            $.ajax({
                url: "{{route('submit.hubungi.kami')}}",
                type: "POST",
                async: true,
                data: $(this).serialize(),
                success:function(response) {
                    if(response.status == 201) {
                        
                        showSuccessMessage('Terima kasih telah menghubungi kami.');
                        setTimeout(function(){ location.reload(); }, 5000);
                    } else if(response.status == 422) {
                        $('.error-g-recaptcha-response').html(response.message);
                    } else {
                        showErrorMessage('Terjadi kesalahan.');
                    }
                },
                error:function(response){
                    showErrorMessage('Terjadi kesalahan.');
                }
            });
        });
        
    </script>
@endsection
