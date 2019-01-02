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
                    @php
                        $is_edit = false;
                        if(isset($dataTypeContent->id)) {
                            $is_edit = true;
                        }
                    @endphp
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
                                <label for="reviewer_name">Reviewer Name</label>
                                <input type="text" class="form-control" name="reviewer_name"
                                    placeholder="Reviewer Name" id="reviewer_name"
                                    value="@if(isset($dataTypeContent->reviewer_name)){{ old('reviewer_name', $dataTypeContent->reviewer_name) }}@else{{old('reviewer_name')}}@endif"
                                     {{ ($is_edit) ? 'readonly': '' }}>
                            </div>

                            <div class="form-group">
                                <label for="reviewer_email">Reviewer Email</label>
                                <input type="text" class="form-control" name="reviewer_email"
                                    placeholder="Reviewer Email" id="reviewer_email"
                                    value="@if(isset($dataTypeContent->reviewer_email)){{ old('reviewer_email', $dataTypeContent->reviewer_email) }}@else{{old('reviewer_email')}}@endif"
                                     {{ ($is_edit) ? 'readonly': '' }}>
                            </div>

                            <div class="form-group">
                                <label for="product_id">Product</label>
                                <select class="form-control select2" name="product_id" id="product_id" {{ $is_edit ? 'disabled': '' }}>
                                    @foreach(\App\Product::select(['id', 'name'])->get() as $product)
                                        <option value="{{ $product->id }}" {{ (isset($dataTypeContent->product_id) && $dataTypeContent->product_id == $product->id ? 'selected' : '') }}>{{$product->name}}</option>
                                    @endforeach
                                </select>
                                @if($is_edit)
                                    <input type="hidden" name="product_id" value="{{ $dataTypeContent->product_id }}">
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="review">Review</label>
                                <textarea class="form-control" name="review"
                                    placeholder="Review" id="review"
                                     {{ ($is_edit) ? 'readonly': '' }}>@if(isset($dataTypeContent->review)){!! old('review', $dataTypeContent->review) !!}@else{!! old('review') !!}@endif</textarea>
                            </div>

                            <div class="form-group">
                                <label for="rating">Rating</label>
                                <input type="text" class="form-control" name="rating"
                                    placeholder="Rating" id="rating"
                                    value="@if(isset($dataTypeContent->rating)){{ old('rating', $dataTypeContent->rating) }}@else{{old('rating')}}@endif"
                                     {{ ($is_edit) ? 'readonly': '' }}>
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                @php
                                    $status_options = json_decode($dataType->rows()->where('field', 'status')->first()->details);
                                @endphp
                                <select class="form-control select2" name="status" id="status">
                                    @foreach($status_options->options as $key => $option)
                                        <option value="{{ $key }}" {{ (isset($dataTypeContent->status) && $dataTypeContent->status == $key ? 'selected' : ($status_options->default == $key ? 'selected': '')) }}>{{$option}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();
        });
    </script>
    <script src="{{ voyager_asset('lib/js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ voyager_asset('js/voyager_tinymce.js') }}"></script>
@stop
