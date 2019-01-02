@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> @if(isset($dataTypeContent->id)){{ 'Edit' }}@else{{ 'New' }}@endif {{ $dataType->display_name_singular }}
    </h1>
@stop
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">

                    <div class="panel-heading">
                        <h3 class="panel-title">@if(isset($dataTypeContent->id)){{ 'Edit' }}@else{{ 'Add New' }}@endif {{ $dataType->display_name_singular }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-edit-add" role="form"
                          action="@if(isset($dataTypeContent->id)){{ route('voyager.'.$dataType->slug.'.update', $dataTypeContent->id) }}@else{{ route('voyager.'.$dataType->slug.'.store') }}@endif"
                          method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->
                        @if(isset($dataTypeContent->id))
                            {{ method_field("PUT") }}
                        @endif

                        <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name"
                                    placeholder="Name" id="name"
                                    value="@if(isset($dataTypeContent->name)){{ old('name', $dataTypeContent->name) }}@else{{old('name')}}@endif">
                            </div>

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title"
                                    placeholder="Title" id="title"
                                    value="@if(isset($dataTypeContent->title)){{ old('title', $dataTypeContent->title) }}@else{{old('title')}}@endif">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email"
                                    placeholder="Email" id="email"
                                    value="@if(isset($dataTypeContent->email)){{ old('email', $dataTypeContent->email) }}@else{{old('email')}}@endif">
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control richTextBox" name="description" placeholder="Description" id="description">@if(isset($dataTypeContent->description)){{ old('description', $dataTypeContent->description) }}@else{{old('description')}}@endif</textarea>
                            </div>

                            <div class="form-group">
                                <label for="profile_picture">Profile Picture (360 x 233)</label>
                                @isset($dataTypeContent->profile_picture)
                                    <img src="{{ asset_cdn($dataTypeContent->profile_picture) }}"
                                        class="img-responsive"
                                        style="width:200px;">
                                @endisset
                                <input type="file" class="form-control" name="profile_picture"
                                    placeholder="Profile Picture" id="profile_picture">
                            </div>

                            <div class="form-group">
                                <label for="signature">Signature</label>
                                @isset($dataTypeContent->signature)
                                    <img src="{{ route('pintaria.asset', [$dataTypeContent->signature]) }}"
                                        class="img-responsive"
                                        style="width:200px;">
                                @endisset
                                <input type="file" class="form-control" name="signature"
                                    placeholder="Signature" id="signature">
                            </div>

                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script src="{{ voyager_asset('lib/js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ voyager_asset('js/voyager_tinymce.js') }}"></script>
    <script>
        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();
        });
    </script>
@stop
