@if(Session::has('message-success'))
    <div class="container">
        <div class="alert alert-success">
            <span class="message-flash">{{ Session::get('message-success') }}</span>
        </div>
    </div>
@endif

@if(Session::has('message-error'))
    <div class="container">
        <div class="alert alert-warning">
            <span class="message-flash">{{ Session::get('message-error') }}</span>
        </div>
    </div>
@endif
