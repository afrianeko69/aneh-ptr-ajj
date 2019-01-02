@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if (isset($dataTypeContent->is_open_enrollment) && ($dataTypeContent->is_open_enrollment != 2))
    <style>
    .direct_url_input{display:none;}
    </style>
    @endif
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
                        @php
                            $categories = $industries = $topics = $providers = $instructors = $professions = $tryouts = $participant_discounts = $related_review_products = [];
                            $all_provider = App\Provider::select(['name', 'id'])->get();
                            $all_instructor = App\Instructor::select(['name', 'id'])->get();
                            $active_review_products = App\Product::activeReview()->select(['id', 'name'])->get();
                        @endphp
                        @if(isset($dataTypeContent->id))
                            {{ method_field("PUT") }}
                            @php
                                $categories = $dataTypeContent->category()->get();
                                $industries = $dataTypeContent->industries()->get();
                                $topics = $dataTypeContent->topics()->get();
                                $providers = $dataTypeContent->providers()->get();
                                $instructors = $dataTypeContent->instructors()->get();
                                $professions = $dataTypeContent->professions()->get();
                                $tryouts = $dataTypeContent->tryouts()->get();
                                $participant_discounts = $dataTypeContent->user_participant_discounts()->get();
                                $related_review_products = $dataTypeContent->related_review_products()->get();
                            @endphp
                        @endif

                        <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-body">
                            <div class="form-group">
                                <label for="name">Product Name</label>
                                <input type="text" class="form-control" name="name"
                                    placeholder="Product Name" id="name"
                                    value="@if(isset($dataTypeContent->name)){{ old('name', $dataTypeContent->name) }}@else{{old('name')}}@endif">
                            </div>

                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" class="form-control" name="slug"
                                    placeholder="Product Slug" id="slug"
                                    value="@if(isset($dataTypeContent->slug)){{ old('slug', $dataTypeContent->slug) }}@else{{old('slug')}}@endif">
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control richTextBox" name="description" placeholder="Description" id="description">@if(isset($dataTypeContent->description)){{ old('description', $dataTypeContent->description) }}@else{{old('description')}}@endif</textarea>
                            </div>

                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" class="form-control" name="price"
                                    placeholder="Product price" id="price"
                                    value="@if(isset($dataTypeContent->price)){{ old('price', $dataTypeContent->price) }}@else{{old('price')}}@endif">
                            </div>

                            <div class="form-group">
                                <label for="discount_percentage">Discount Percentage</label>
                                <input type="number" class="form-control" name="discount_percentage"
                                    placeholder="Discount Percentage" id="discount_percentage"
                                    value="@if(isset($dataTypeContent->discount_percentage)){{ old('discount_percentage', $dataTypeContent->discount_percentage) }}@else{{old('discount_percentage')}}@endif">
                            </div>

                            <div class="form-group">
                                <label for="discount_start_at">Discount Start At</label>
                                <input type="text" class="form-control datepicker" name="discount_start_at"
                                    placeholder="Discount Start At" id="discount_start_at"
                                    value="@if(!empty($dataTypeContent->discount_start_at)){{ old('discount_start_at', $dataTypeContent->discount_start_at->format('m/d/Y g:i A')) }}@else{{old('discount_start_at')}}@endif">
                            </div>

                            <div class="form-group">
                                <label for="discount_end_at">Discount End At</label>
                                <input type="text" class="form-control datepicker" name="discount_end_at"
                                    placeholder="Discount End At" id="discount_end_at"
                                    value="@if(!empty($dataTypeContent->discount_end_at)){{ old('discount_end_at', $dataTypeContent->discount_end_at->format('m/d/Y g:i A')) }}@else{{old('discount_end_at')}}@endif">
                            </div>

                            <div class="form-group">
                                <label for="participant_discounts">Multiple Participants Discount</label>
                                <table class="table table-responsive participant_discounts" id="participant_discounts">
                                    <thead>
                                        <th width="20%">Number of Participants</th>
                                        <th width="20%">Multiple Participants Discounted Price</th>
                                        <th width="20%">Start At</th>
                                        <th width="20%">End At</th>
                                        <th width="20%">Require from the Same Company?</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @forelse($participant_discounts as $product_participant_discounts)
                                            <tr class="participant_discount">
                                                <td>
                                                    <input type="number" name="user_participant_discounts[]" class="form-control" min="0" value="{{ $product_participant_discounts->participant_number }}">
                                                </td>
                                                <td>
                                                    <input type="number" name="participant_prices[]" class="form-control" min="0" value="{{ $product_participant_discounts->discounted_price }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control datepicker" placeholder="Discount start at" name="participant_discount_start_ats[]" value="{{ date('m/d/Y g:i A', strtotime($product_participant_discounts->start_at)) }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control datepicker" name="participant_discount_end_ats[]" value="{{ date('m/d/Y g:i A', strtotime($product_participant_discounts->end_at)) }}">
                                                </td>
                                                <td>
                                                    <select class="form-control select2" name="participant_is_same_providers[]">
                                                        <option value="0" {{ $product_participant_discounts->is_same_provider == 0 ? 'selected': '' }}>Same company is not required</option>
                                                        <option value="1" {{ $product_participant_discounts->is_same_provider == 1 ? 'selected': '' }}>Same company is required</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger remove-participant_discount">Remove</button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="participant_discount">
                                                <td>
                                                    <input type="number" name="user_participant_discounts[]" class="form-control" min="0" value="">
                                                </td>
                                                <td>
                                                    <input type="number" name="participant_prices[]" class="form-control" min="0" value="">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control datepicker" name="participant_discount_start_ats[]" value="">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control datepicker" name="participant_discount_end_ats[]" value="">
                                                </td>
                                                <td>
                                                    <select class="form-control select2" name="participant_is_same_providers[]">
                                                        <option value="0">Same company is not required</option>
                                                        <option value="1">Same company is required</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger remove-participant_discount">Remove</button>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-primary pull-right add-new-participant_discount">Add New Multiple Participants Discount</button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="seo">SEO</label>
                                <textarea class="form-control" name="seo" placeholder="SEO" id="seo">@if(isset($dataTypeContent->seo)){{ old('seo', $dataTypeContent->seo) }}@else{{old('seo')}}@endif</textarea>
                            </div>

                            <div class="form-group">
                                <label for="category">Categories</label>
                                <select class="form-control select2" name="category[]" id="category" multiple required>
                                    @foreach(\App\Category::select(['id', 'name'])->get() as $category)
                                        @php $created = false; @endphp
                                        @foreach($categories as $key => $product_category)
                                            @if($product_category->id == $category->id)
                                                <option value="{{ $category->id }}" selected>{{$category->name}}</option>
                                                @php
                                                    $created = true;
                                                    unset($categories[$key]);
                                                @endphp

                                                @break
                                            @endif
                                        @endforeach
                                        @if(!$created)
                                            <option value="{{ $category->id }}">{{$category->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="learning_method_id">Learning Method</label>
                                <select class="form-control select2" name="learning_method_id" id="learning_method_id">
                                    @foreach(\App\LearningMethod::select(['id', 'name'])->get() as $learning_method)
                                        <option value="{{ $learning_method->id }}" {{ (isset($dataTypeContent->learning_method_id) && $dataTypeContent->learning_method_id == $learning_method->id ? 'selected' : '') }}>{{$learning_method->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="industries">Industries</label>
                                <select class="form-control select2" name="industries[]" id="industries" multiple>
                                    @foreach(\App\Industry::select(['id', 'name'])->get() as $industry)
                                        @php $created = false; @endphp
                                        @foreach($industries as $key => $product_industry)
                                            @if($product_industry->id == $industry->id)
                                                <option value="{{ $industry->id }}" selected>{{$industry->name}}</option>
                                                @php
                                                    $created = true;
                                                    unset($industries[$key]);
                                                @endphp
                                                @break
                                            @endif
                                        @endforeach
                                        @if(!$created)
                                            <option value="{{ $industry->id }}">{{$industry->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="topics">Topics</label>
                                <select class="form-control select2" name="topics[]" id="topics" multiple>
                                    @foreach(\App\Topic::select(['id', 'name'])->get() as $topic)
                                        @php $created = false; @endphp
                                        @foreach($topics as $key => $product_topic)
                                            @if($product_topic->id == $topic->id)
                                                <option value="{{ $topic->id }}" selected>{{$topic->name}}</option>
                                                @php
                                                    $created = true;
                                                    unset($topics[$key]);
                                                @endphp
                                                @break
                                            @endif
                                        @endforeach
                                        @if(!$created)
                                            <option value="{{ $topic->id }}">{{$topic->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="providers">Providers</label>
                                <table class="table table-responsive providers" id="providers">
                                    <thead>
                                        <th width="30%">Provider</th>
                                        <th width="20%">Sort</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @forelse($providers as $product_provider)
                                            <tr class="provider">
                                                <td>
                                                    <select class="form-control select2" name="providers[]">
                                                        @foreach($all_provider as $provider)
                                                            @if($provider->id == $product_provider->id)
                                                                <option value="{{ $provider->id }}" selected>{{ $provider->name }}</option>
                                                            @else
                                                                <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" name="provider_sort[]" class="form-control" value="{{ $product_provider->pivot->sort }}">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger remove-provider">Remove</button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="provider">
                                                <td>
                                                    <select class="form-control select2" name="providers[]">
                                                        <option value="">Select Provider</option>
                                                        @foreach($all_provider as $provider)
                                                            <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" name="provider_sort[]" class="form-control">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger remove-provider">Remove</button>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-primary pull-right add-new-provider">Add New Provider</button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="instructors">Instructors</label>
                                <table class="table table-responsive instructors" id="instructors">
                                    <thead>
                                        <th width="30%">Instructor</th>
                                        <th width="20%">Show at Program Detail</th>
                                        <th>Sort</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @forelse($instructors as $key => $product_instructor)
                                            <tr class="instructor">
                                                <td>
                                                    <select class="form-control select2" name="instructors[]">
                                                        @foreach($all_instructor as $instructor)
                                                            @if($product_instructor->id == $instructor->id)
                                                                <option value="{{ $instructor->id }}" selected>{{$instructor->name}}</option>
                                                            @else
                                                                <option value="{{ $instructor->id }}">{{$instructor->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control select2" name="instructor_showed[]">
                                                        <option value="1" {{ $product_instructor->pivot->is_showed == 1 ? 'selected': '' }}>Show</option>
                                                        <option value="0" {{ $product_instructor->pivot->is_showed == 0 ? 'selected': '' }}>Not Show</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" name="instructor_sort[]" class="form-control" value="{{ $product_instructor->pivot->sort }}">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger remove-instructor">Remove</button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="instructor">
                                                <td>
                                                    <select class="form-control select2" name="instructors[]">
                                                        <option value="">Select Instructor</option>
                                                        @foreach($all_instructor as $instructor)
                                                            <option value="{{ $instructor->id }}">{{$instructor->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control select2" name="instructor_showed[]">
                                                        <option value="1">Show</option>
                                                        <option value="0">Not Show</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" name="instructor_sort[]" class="form-control">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger remove-instructor">Remove</button>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-primary pull-right add-new-instructor">Add New Instructor</button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="location_id">Location</label>
                                <select class="form-control select2" name="location_id" id="location_id">
                                    @foreach(\App\Location::select(['id', 'name'])->get() as $location)
                                        <option value="{{ $location->id }}" {{ (isset($dataTypeContent->location_id) && $dataTypeContent->location_id == $location->id ? 'selected' : '') }}>{{$location->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="location_detail">Location Detail</label>
                                <textarea class="form-control" name="location_detail" placeholder="Location Detail" id="location_detail">@if(isset($dataTypeContent->location_detail)){{ old('location_detail', $dataTypeContent->location_detail) }}@else{{old('location_detail')}}@endif</textarea>
                            </div>

                            <div class="form-group">
                                <label for="map">Map</label>
                                <input type="text" class="form-control" name="map"
                                    placeholder="Map" id="map"
                                    value="@if(isset($dataTypeContent->map)){{ old('map', $dataTypeContent->map) }}@else{{old('map')}}@endif">
                            </div>

                            <div class="form-group">
                                <label for="image">Image (800 x 533)</label>
                                @isset($dataTypeContent->image)
                                    <img src="{{ asset_cdn($dataTypeContent->image) }}" class="img-responsive">
                                @endisset
                                <input type="file" class="form-control" name="image"
                                    placeholder="Image" id="image">
                            </div>

                            <div class="form-group">
                                <label for="youtube_video_id">Youtube Video ID</label>
                                <input type="text" class="form-control" name="youtube_video_id"
                                    placeholder="youtube_video" id="youtube_video_id"
                                    value="@if(isset($dataTypeContent->youtube_video_id)){{ old('youtube_video_id', $dataTypeContent->youtube_video_id) }}@else{{old('youtube_video_id')}}@endif">
                            </div>

                            <div class="form-group">
                                <label for="course_start_at">Course Start At</label>
                                <input type="text" class="form-control datepicker" name="course_start_at"
                                    placeholder="Course Start At" id="course_start_at"
                                    value="@if(!empty($dataTypeContent->course_start_at)){{ old('course_start_at', $dataTypeContent->course_start_at->format('m/d/Y g:i A')) }}@else{{old('course_start_at')}}@endif">
                            </div>

                            <div class="form-group">
                                <label for="course_end_at">Course End At</label>
                                <input type="text" class="form-control datepicker" name="course_end_at"
                                    placeholder="Course End At" id="course_end_at"
                                    value="@if(!empty($dataTypeContent->course_end_at)){{ old('course_end_at', $dataTypeContent->course_end_at->format('m/d/Y g:i A')) }}@else{{old('course_end_at')}}@endif">
                            </div>

                            <div class="form-group">
                                <label for="show_start_at">Periode Tayang Awal</label>
                                <input type="text" class="form-control datepicker" name="show_start_at"
                                    placeholder="Periode Tayang Awal" id="show_start_at"
                                    value="@if(!empty($dataTypeContent->show_start_at)){{ old('show_start_at', $dataTypeContent->show_start_at->format('m/d/Y g:i A')) }}@else{{old('show_start_at')}}@endif">
                            </div>

                            <div class="form-group">
                                <label for="show_end_at">Periode Tayang Akhir</label>
                                <input type="text" class="form-control datepicker" name="show_end_at"
                                    placeholder="Periode Tayang Akhir" id="show_end_at"
                                    value="@if(!empty($dataTypeContent->show_end_at)){{ old('show_end_at', $dataTypeContent->show_end_at->format('m/d/Y g:i A')) }}@else{{old('show_end_at')}}@endif">
                            </div>

                            <div class="form-group">
                                <label for="quota">Kapasitas Peserta</label>
                                <input type="number" class="form-control" name="quota"
                                    placeholder="Kapasitas Peserta" id="quota"
                                    value="@if(isset($dataTypeContent->quota)){{ old('quota', $dataTypeContent->quota) }}@else{{old('quota')}}@endif">
                            </div>

                            <div class="form-group">
                                <label for="is_open_enrollment">Is Open Enrollment (Button on Product Detail Page: OE - Beli Sekarang, OBE - Beli Paket, NOE - Saya Berminat, DL - Info Selengkapnya)</label>
                                <select class="form-control select2" name="is_open_enrollment" id="is_open_enrollment">
                                    @foreach(['Not Open Enrollment', 'Open Enrollment', 'Direct Link', 'Open Bundle Enrollment'] as $key => $value)
                                        <option value="{{ $key }}" {{ (isset($dataTypeContent->is_open_enrollment) && $dataTypeContent->is_open_enrollment == $key) ? 'selected' : '' }}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group bundle_input">
                                <label for="selected_bundle_id">Bundle Enrollment</label>
                                <select class="form-control select2" name="selected_bundle_id" id="selected_bundle">
                                    @forelse(\App\Bundle::get() as $bundle)
                                        <option value="{{ $bundle->id }}" {{ (isset($dataTypeContent->selected_bundle_id) && $dataTypeContent->selected_bundle_id == $bundle->id) ? 'selected' : '' }}>{{$bundle->name}}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>

                            <div class="form-group direct_url_input">
                                <label for="direct_link_url">Direct Link URL</label>
                                <input type="text" class="form-control" name="direct_link_url"
                                    placeholder="Direct Link URL" id="direct_link_url"
                                    value="@if(isset($dataTypeContent->direct_link_url)){{ old('direct_link_url', $dataTypeContent->direct_link_url) }}@else{{old('direct_link_url')}}@endif" {{ (isset($dataTypeContent->is_open_enrollment) && ($dataTypeContent->is_open_enrollment == 2)) ? 'required' : '' }}>
                            </div>

                            <div class="form-group">
                                <label for="is_content_ready">Is Content Ready (Content not ready will cause the product can not be accessed)</label>
                                <select class="form-control select2" name="is_content_ready" id="is_content_ready">
                                    @foreach(['Not Ready', 'Content Ready'] as $key => $value)
                                        <option value="{{ $key }}" {{ (isset($dataTypeContent->is_content_ready) && $dataTypeContent->is_content_ready == $key) ? 'selected' : '' }}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="jobs">Jobs</label>
                                <textarea class="form-control richTextBox" name="jobs" placeholder="Jobs" id="jobs">@if(isset($dataTypeContent->jobs)){{ old('jobs', $dataTypeContent->jobs) }}@else{{old('jobs')}}@endif</textarea>
                            </div>

                            <div class="form-group">
                                <label for="career">Career</label>
                                <textarea class="form-control richTextBox" name="career" placeholder="Career" id="career">@if(isset($dataTypeContent->career)){{ old('career', $dataTypeContent->career) }}@else{{old('career')}}@endif</textarea>
                            </div>

                            <div class="form-group">
                                <label for="seo_title">SEO Title</label>
                                <input type="text" class="form-control" name="seo_title"
                                    placeholder="SEO Title" id="seo_title"
                                    value="@if(isset($dataTypeContent->seo_title)){{ old('seo_title', $dataTypeContent->seo_title) }}@else{{old('seo_title')}}@endif">
                            </div>

                            <div class="form-group">
                                <label for="meta_description">Meta Description</label>
                                <textarea class="form-control" name="meta_description" placeholder="Meta Description" id="meta_description">@if(isset($dataTypeContent->meta_description)){{ old('meta_description', $dataTypeContent->meta_description) }}@else{{old('meta_description')}}@endif</textarea>
                            </div>

                            <div class="form-group">
                                <label for="professions">Profession</label>
                                <select class="form-control select2" name="professions[]" id="professions" multiple>
                                    @foreach(\App\Profession::select(['id', 'name'])->get() as $profession)
                                        @php $created = false; @endphp
                                        @foreach($professions as $key => $product_profession)
                                            @if($product_profession->id == $profession->id)
                                                <option value="{{ $profession->id }}" selected>{{$profession->name}}</option>
                                                @php
                                                    $created = true;
                                                    unset($professions[$key]);
                                                @endphp
                                                @break
                                            @endif
                                        @endforeach
                                        @if(!$created)
                                            <option value="{{ $profession->id }}">{{$profession->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="sort">Popular Product Sort</label>
                                <input type="number" class="form-control" name="sort"
                                    placeholder="Popular Product Sort" id="sort"
                                    value="@if(isset($dataTypeContent->sort)){{ old('sort', $dataTypeContent->sort) }}@else{{old('sort')}}@endif">
                            </div>

                            <div class="form-group">
                                <label for="category_classification_id">Category Classification</label>
                                <select class="form-control select2" name="category_classification_id" id="category_classification_id">
                                    @foreach(\App\CategoryClassification::select(['id', 'name'])->get() as $category_classification)
                                        <option value="{{ $category_classification->id }}" {{ (isset($dataTypeContent->category_classification_id) && $dataTypeContent->category_classification_id == $category_classification->id ? 'selected' : '') }}>{{$category_classification->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="banner">Banner Image (1600 x 527)</label>
                                @isset($dataTypeContent->banner)
                                    <img src="{{ asset_cdn($dataTypeContent->banner) }}" class="img-responsive">
                                @endisset
                                <input type="file" class="form-control" name="banner"
                                    placeholder="Banner Image" id="banner">
                            </div>

                            <div class="form-group">
                                <label for="crm_interest_name">CRM Interest Field</label>
                                <input type="text" class="form-control" name="crm_interest_name"
                                    placeholder="CRM Interest Field" id="crm_interest_name"
                                    value="@if(isset($dataTypeContent->crm_interest_name)){{ old('crm_interest_name', $dataTypeContent->crm_interest_name) }}@else{{old('crm_interest_name')}}@endif">
                            </div>

                            <div class="form-group">
                                <label for="is_learning_material_showed">Materi Belajar</label>
                                <select class="form-control select2" name="is_learning_material_showed" id="is_learning_material_showed">
                                    @foreach(['Do not show Materi Belajar', 'Show Materi Belajar'] as $key => $value)
                                        <option value="{{ $key }}" {{ (isset($dataTypeContent->is_learning_material_showed) && $dataTypeContent->is_learning_material_showed == $key) ? 'selected' : '' }}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="is_tryout">Is Tryout?</label>
                                <select class="form-control select2" name="is_tryout" id="is_tryout">
                                    @foreach(['Is Not Tryout', 'Is Tryout'] as $key => $value)
                                        <option value="{{ $key }}" {{ (isset($dataTypeContent->is_tryout) && $dataTypeContent->is_tryout == $key) ? 'selected' : '' }}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group instruction {{ isset($dataTypeContent->is_tryout) && $dataTypeContent->is_tryout ? '': 'hide' }}">
                                <label for="instruction">Instructions</label>
                                <textarea class="form-control richTextBox" name="instruction" placeholder="Instruction" id="instruction">@if(isset($dataTypeContent->instruction)){{ old('instruction', $dataTypeContent->instruction) }}@else{{old('instruction')}}@endif</textarea>
                            </div>

                            <div class="form-group tryout-details {{ isset($dataTypeContent->is_tryout) && $dataTypeContent->is_tryout ? '': 'hide' }}">
                                <label for="tryout">Tryout</label>
                                <table class="table table-responsive" id="tryout">
                                    <thead>
                                        <th width="20%">Button Name</th>
                                        <th width="40%">Tryout Embed Link</th>
                                        <th>Sort</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach($tryouts as $key => $tryout)
                                            <tr>
                                                <input type="hidden" name="product_tryout_id[]" value="{{ $tryout->id }}">
                                                <td>
                                                    <input type="text" name="product_tryout_button[]" class="form-control" value="{{ $tryout->button_name }}" />
                                                </td>
                                                <td>
                                                    <textarea class="form-control" name="product_tryout_embed_link[]">{{ $tryout->embed_link }}</textarea>
                                                </td>
                                                <td>
                                                    <input type="number" name="product_tryout_sort[]" class="form-control" value="{{ $tryout->sort }}" />
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger remove-tryout-detail">Remove</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-primary pull-right add-new-tryout-detail">Add More</button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="module_number">Module Number</label>
                                <input type="number" class="form-control" name="module_number"
                                    placeholder="Module Number" id="module_number"
                                    value="@if(isset($dataTypeContent->module_number)){{ old('module_number', $dataTypeContent->module_number) }}@else{{old('module_number')}}@endif">
                            </div>

                            <div class="form-group">
                                <label for="excerpt">Excerpt</label>
                                <textarea class="form-control" name="excerpt" placeholder="Excerpt" id="excerpt"  maxlength="100">@if(isset($dataTypeContent->excerpt)){{ old('excerpt', $dataTypeContent->excerpt) }}@else{{old('excerpt')}}@endif</textarea>
                            </div>

                            <div class="form-group">
                                <label for="is_review_shown">Is Review Active? (If not active, Ulasan is hidden on the Product Detail and Kelas Saya)</label>
                                <select class="form-control select2" name="is_review_shown" id="is_review_shown">
                                    @foreach(['Review Not Active', 'Review Active'] as $key => $value)
                                        <option value="{{ $key }}" {{ (isset($dataTypeContent->is_review_shown) && $dataTypeContent->is_review_shown == $key) ? 'selected' : '' }}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group" id="related-reviews">
                                <label for="related_reviews">Show reviews from other products?</label>
                                <table class="table table-responsive related_reviews" id="related_reviews">
                                    <thead>
                                        <th width="40%">Product</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @forelse($related_review_products as $related_product)
                                            <tr class="related_review">
                                                <td>
                                                    <select class="form-control select2" name="related_review_products[]">
                                                        <option value="">Select Product</option>
                                                        @foreach($active_review_products as $active_review_product)
                                                            @continue(isset($dataTypeContent->id) && $active_review_product->id == $dataTypeContent->id)

                                                            @if($active_review_product->id == $related_product->id)
                                                                <option value="{{ $active_review_product->id }}" selected>{{$active_review_product->name}}</option>
                                                            @else
                                                                <option value="{{ $active_review_product->id }}">{{$active_review_product->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger remove-related_review">Remove</button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="related_review">
                                                <td>
                                                    <select class="form-control select2" name="related_review_products[]">
                                                        <option value="">Select Product</option>
                                                        @foreach($active_review_products as $active_review_product)
                                                            @continue(isset($dataTypeContent->id) && $active_review_product->id == $dataTypeContent->id)

                                                            <option value="{{ $active_review_product->id }}">{{$active_review_product->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger remove-related_review">Remove</button>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-primary pull-right add-new-related_review">Add New Product</button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="is_lead_form_active">Is Lead Form Active? (If not active, Mohon Info Form is hidden on the Product Detail and Produk option on Homepage Mohon Info Form)</label>
                                <select class="form-control select2" name="is_lead_form_active" id="is_lead_form_active">
                                    @foreach(['Lead Form Not Active', 'Lead Form Active'] as $key => $value)
                                        <option value="{{ $key }}" {{ (isset($dataTypeContent->is_lead_form_active) && $dataTypeContent->is_lead_form_active == $key) ? 'selected' : '' }}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="training_code">Training Code</label>
                                <input type="text" class="form-control" name="training_code"
                                    placeholder="Training Code" id="training_code"
                                    value="@if(isset($dataTypeContent->training_code)){{ old('training_code', $dataTypeContent->training_code) }}@else{{old('training_code')}}@endif">
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
    <script src="{{ voyager_asset('lib/js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ voyager_asset('js/voyager_tinymce.js') }}"></script>
    <script>
        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();

            toggleHiddenForm();

            var instructors = <?php echo json_encode($all_instructor); ?>;
            var providers = <?php echo json_encode($all_provider); ?>;
            var active_review_products = <?php echo json_encode($active_review_products); ?>;
            var data_id = <?php echo json_encode(isset($dataTypeContent->id) ? $dataTypeContent->id : null); ?>;

            $(document).on('click', '.remove-instructor', function(e) {
                e.preventDefault();
                $(this).parents('.instructor').remove();
            });

            $(document).on('click', '.add-new-instructor', function(e) {
                e.preventDefault();
                var html = '<tr class="instructor">'+
                                '<td>'+
                                    '<select class="form-control select2" name="instructors[]">'+
                                        '<option value="">Select Instructor</option>';
                                        $.each(instructors, function(key, value) {
                                            html += '<option value="'+ value.id +'">'+ value.name + '</option>';
                                        });

                            html += '</select>'+
                                '</td>'+
                                '<td>'+
                                    '<select class="form-control select2" name="instructor_showed[]">'+
                                        '<option value="1">Show</option>'+
                                        '<option value="0">Not Show</option>'+
                                    '</select>'+
                                '</td>'+
                                '<td>'+
                                    '<input type="number" name="instructor_sort[]" class="form-control">'+
                                '</td>'+
                                '<td>'+
                                    '<button type="button" class="btn btn-danger remove-instructor">Remove</button>'+
                                '</td>'+
                            '</tr>';

                $('table.instructors tbody').append(html);
                $('table.instructors tbody tr.instructor select').select2();
            });

            $(document).on('click', '.remove-related_review', function(e) {
                e.preventDefault();
                $(this).parents('.related_review').remove();
            })

            $(document).on('click', '.add-new-related_review', function(e) {
                var html = '<tr class="related_review">'+
                                '<td>'+
                                    '<select class="form-control select2" name="related_review_products[]">'+
                                        '<option value="">Select Product</option>';
                                        $.each(active_review_products, function(key, value) {
                                            if (data_id && value.id == data_id) {
                                                return true;
                                            }

                                            html += '<option value="'+ value.id +'">'+ value.name +'</option>';
                                        });
                            html += '</select>'+
                                '</td>'+
                                '<td>'+
                                    '<button type="button" class="btn btn-danger remove-related_review">Remove</button>'+
                                '</td>'+
                            '</tr>';

                $('table.related_reviews tbody').append(html);
                $('table.related_reviews tbody tr.related_review select').select2();
            });

            $(document).on('click', '.remove-provider', function(e) {
                e.preventDefault();
                $(this).parents('.provider').remove();
            })

            $(document).on('click', '.add-new-provider', function(e) {
                var html = '<tr class="provider">'+
                                '<td>'+
                                    '<select class="form-control select2" name="providers[]">'+
                                        '<option value="">Select Provider</option>';
                                        $.each(providers, function(key, value) {
                                            html += '<option value="'+ value.id +'">'+ value.name +'</option>';
                                        });
                            html += '</select>'+
                                '</td>'+
                                '<td>'+
                                    '<input type="number" name="provider_sort[]" class="form-control">'+
                                '</td>'+
                                '<td>'+
                                    '<button type="button" class="btn btn-danger remove-provider">Remove</button>'+
                                '</td>'+
                            '</tr>';

                $('table.providers tbody').append(html);
                $('table.providers tbody tr.provider select').select2();
            });

            $(document).on('click', '.remove-participant_discount', function(e) {
                e.preventDefault();
                $(this).parents('.participant_discount').remove();
            })

            $(document).on('click', '.add-new-participant_discount', function(e) {
                var html = '<tr class="participant_discount">';
                html += '<td>'+
                            '<input type="number" name="user_participant_discounts[]" class="form-control" min="0" value="">'+
                        '</td>';
                html += '<td>'+
                            '<input type="number" name="participant_prices[]" class="form-control" min="0" value="">' +
                        '</td>';
                html += '<td>'+
                            '<input type="text" class="form-control datepicker" name="participant_discount_start_ats[]" value="">'+
                        '</td>';
                html += '<td>'+
                            '<input type="text" class="form-control datepicker" name="participant_discount_end_ats[]" value="">'+
                        '</td>';
                html += '<td>'+
                            '<select class="form-control select2" name="participant_is_same_providers[]">'+
                                '<option value="0">Same company is not required</option>'+
                                '<option value="1">Same company is required</option>'+
                            '</select>'+
                        '</td>';
                html += '<td>'+
                            '<button type="button" class="btn btn-danger remove-participant_discount">Remove</button>'+
                        '</td>';
                html += '</tr>';

                $('table.participant_discounts tbody').append(html);
                $('table.participant_discounts tbody tr.participant_discount select').select2();
                $('table.participant_discounts tbody tr.participant_discount .datepicker').datetimepicker();
            });

            $(document).on('click', '.remove-tryout-detail', function(e) {
                $(this).parents('tr').remove();
            });

            $(document).on('click', '.add-new-tryout-detail', function(e) {
                var html = '';

                html += '<tr>'+
                            '<td>'+
                                '<input type="text" name="product_tryout_button[]" class="form-control" />'+
                            '</td>'+
                            '<td>'+
                                '<textarea class="form-control" name="product_tryout_embed_link[]"></textarea>'+
                            '</td>'+
                            '<td>'+
                                '<input type="number" name="product_tryout_sort[]" class="form-control" />'+
                            '</td>'+
                            '<td>'+
                                '<button type="button" class="btn btn-danger remove-tryout-detail">Remove</button>'+
                            '</td>'+
                        '</tr>';

                $('table#tryout tbody').append(html);
            });

            $(document).on('change', '#is_tryout', function(e) {
                var self = $(this);

                if(self.val() == 0) {
                    $('.tryout-details').addClass('hide');
                    $('.instruction').addClass('hide');
                    $('table#tryout tbody').empty();
                } else {
                    $('.tryout-details').removeClass('hide');
                    $('.instruction').removeClass('hide');
                }
            });

            $(document).on('change', '#is_open_enrollment', function(e) {
                if ($(this).val() == 2) {
                    $('.direct_url_input').show();
                    $('#direct_link_url').prop('required',true);
                } 

                toggleHiddenForm();
            });

            $(document).on('change', '#is_review_shown', function(e) {
                toggleHiddenForm();
            });
        });

        function toggleHiddenForm() {
            if ($('#is_open_enrollment').val() == 3) { // open bundle
                $('.bundle_input').show();
                $('#selected_bundle').prop('required', true);
            } else {
                $('.bundle_input').hide();
                $('#selected_bundle').prop('required', false);
            }

            if ($('#is_review_shown').val() == 1) {
                $('#related-reviews').show();
            } else {
                $('#related-reviews').hide();
            }
        }
    </script>
@stop
