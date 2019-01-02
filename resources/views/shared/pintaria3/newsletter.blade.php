<div id="newsletter" class="newsletter">
    <h5>{{ $newsletter->title }}</h5>
    <div class="form-group">
        <input type="email" name="email_newsletter" id="email_newsletter" class="form-control email-newsletter" placeholder="Masukkan email">
        <input type="button" value="DAFTAR" id="submit-newsletter" class="daftar-newsletter btn_submit">
    </div>
    <span class="text-danger error error-email-newsletter"></span>
    <div class="rich-text-editor">
        {!!$newsletter->description!!}
    </div>
</div>