<div class="c-container c-bg-grey-1 c-bg-img-bottom-right" style="background-image:url({{url('pintaria/img/content/misc/feedback_box_2.png')}} ); padding:20px;">
    <div class="c-content-title-1">
        <h3 class="c-font-uppercase c-font-bold">{{$newsletter->title}}</h3>
        <div class="c-line-left"></div>
        <div class="input-group input-group-lg c-square">
            <input type="text" class="form-control c-square email-newsletter" placeholder="Alamat email" name="email_newsletter" required="required" />
            <span class="input-group-btn">
                <a class="btn c-theme-btn c-btn-square c-btn-uppercase c-font-bold daftar-newsletter">DAFTAR</a>
            </span>
        </div>
        <span class="text-danger error error-email-newsletter"></span>
        <br clear="both">
        <br clear="both">
        <div class="rich-text-editor">
            {!!$newsletter->description!!}
        </div>
    </div>
</div>