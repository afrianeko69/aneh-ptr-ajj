<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit&hl=id" async defer></script>
<script type="text/javascript">
    var sayaBerminatURL = "{{ route('submit.saya.berminat') }}";
    var newsletterURL = "{{ route('newsletter.store') }}";
    var mohonInfoURL = "{{ route('mohon.info.thankyou') }}";
    var baseUrl = "{{ url('') }}";
    var is_login = "{{ (\Auth::check()) ? true : false }}";
    var login_url = "{{ route('daftar') }}";
    var formToken = "{{ csrf_token() }}";
    var trackerURL = "{{ route('home.tracker') }}";
</script>