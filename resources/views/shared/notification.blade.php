@if(Session::has('message-success'))
    <div class="container">
        <div class="alert alert-info">
            <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <span class="message-flash">{{ Session::get('message-success') }}</span>
        </div>
    </div>
@endif

@if(Session::has('message-error'))
    <div class="container">
        <div class="alert alert-warning">
            <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <span class="message-flash">{{ Session::get('message-error') }}</span>
        </div>
    </div>
@endif

@if(Session::has('message-danger'))
    <div class="container">
        <div class="alert alert-danger">
            <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <span class="message-flash">{{ Session::get('message-danger') }}</span>
        </div>
    </div>
@endif

<div class="hide container container-notification"></div>