<script src="https://cdn.ravenjs.com/3.16.1/raven.min.js" crossorigin="anonymous"></script>
<script type="text/javascript">
  Raven.config('{{ config('sentry.public_dsn') }}').install();
  @if (!empty(auth()->user()))
    Raven.setUserContext({
        email: '{{ auth()->user()->email }}',
        id: '{{ auth()->user()->id }}'
    })
  @endif
</script>