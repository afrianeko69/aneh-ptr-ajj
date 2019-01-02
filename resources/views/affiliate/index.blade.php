@extends('layouts.affiliate.master')

@section('content')

    <div class="container add_top_90 add_bottom_60   ">
        <div class="main_title_2 add_top_90">
            <h1>Login</h1>
        </div>
        <div class="row ">
            <div class="col-md-4 col-xs-12 mx-auto">
                <form class="c-form-login" method="POST" action="{{route('affiliate.login')}}">
                    {{ csrf_field() }}
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control c-square c-theme input-lg" placeholder="Email" name="email">
                        <span class="glyphicon glyphicon-user form-control-feedback c-font-grey"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control c-square c-theme input-lg" placeholder="Password" name="password">
                        <span class="glyphicon glyphicon-lock form-control-feedback c-font-grey"></span>
                    </div>
                    
                    <button type="submit" class="btn_1 rounded full-width add_top_30 float-right  ">Login</button>
                </form>
            </div>
        </div>
        <!--/row-->
    </div>
    <!-- /container -->

@endsection

@section('additional.scripts')
@endsection
