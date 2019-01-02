@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@if(isset($dataTypeContent->id))
    @section('page_title','Edit '.$dataType->display_name_singular)
@else
    @section('page_title','Add '.$dataType->display_name_singular)
@endif

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> @if(isset($dataTypeContent->id)){{ 'Edit' }}@else{{ 'New' }}@endif {{ $dataType->display_name_singular }}
    </h1>
    @include('voyager::multilingual.language-selector')
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
                    <form role="form"
                            class="form-edit-add-multiple-data"
                            action="@if(isset($dataTypeContent->id)){{ route('voyager.'.$dataType->slug.'.update', $dataTypeContent->id) }}@else{{ route('voyager.'.$dataType->slug.'.store') }}@endif"
                            method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->
                        @php
                            $testimonies = $interests = $icons = $universities = [];
                        @endphp
                        @if(isset($dataTypeContent->id))
                            {{ method_field("PUT") }}
                            @php
                                $interests = $dataTypeContent->landing_page_interests()->get();
                                $icons = $dataTypeContent->landing_page_icons()->get();
                                $testimonies = $dataTypeContent->landing_page_testimonies()->get();
                                $universities = $dataTypeContent->landing_page_universities()->get();
                            @endphp
                        @endif

                        <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-body">
                            <div class="form-group">
                                <label for="slug">Slug (ex. pintaria.com/kuliah/online/kelas-karyawan/[slug])</label>
                                <input type="text" class="form-control" name="slug"
                                    placeholder="Slug" id="slug"
                                    value="@if(isset($dataTypeContent->slug)){{ old('slug', $dataTypeContent->slug) }}@else{{old('slug')}}@endif">
                            </div>

                            <div class="form-group">
                                <label for="name">Title tag</label>
                                <input type="text" class="form-control" name="title"
                                    placeholder="Title" id="name"
                                    value="@if(isset($dataTypeContent->title)){{ old('title', $dataTypeContent->title) }}@else{{old('title')}}@endif">
                            </div>

                            <div class="form-group">
                                <label for="meta_description">Meta description</label>
                                <textarea class="form-control" name="meta_description" placeholder="Meta description" id="meta_description">@if(isset($dataTypeContent->meta_description)){{ old('meta_description', $dataTypeContent->meta_description) }}@else{{old('meta_description')}}@endif</textarea>
                            </div>

                            <!--Interests go here-->
                            <div class="form-group">
                                <label for="interests">Interest</label>
                                <table class="table table-responsive interests" id="interests">
                                    <thead>
                                        <th width="35%">Interest name</th>
                                        <th width="15%">Sort</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @forelse($interests as $interest)
                                            <tr class="interest">
                                                <input type="hidden" name="interest_ids[]" value="{{ $interest->id }}">
                                                <td>
                                                    <input type="text" class="form-control" name="landing_page_interests[]" value="{{ $interest->name }}">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name="interest_sorts[]" value="{{ $interest->sort }}">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger remove-interest">Remove</button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="interest">
                                                <td>
                                                    <input type="text" class="form-control" name="landing_page_interests[]" value="">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name="interest_sorts[]" value="">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger remove-interest">Remove</button>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-primary pull-right add-new-interest">Add New Interest</button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="main_title">Title #1</label>
                                <textarea class="form-control richTextBox" name="main_title" placeholder="Title #1" id="main_title">@if(isset($dataTypeContent->main_title)){{ old('main_title', $dataTypeContent->main_title) }}@else{{old('main_title')}}@endif</textarea>
                            </div>

                            <div class="form-group">
                                <label for="main_description">Description #1</label>
                                <textarea class="form-control richTextBox" name="main_description" placeholder="Description #1" id="main_description">@if(isset($dataTypeContent->main_description)){{ old('main_description', $dataTypeContent->main_description) }}@else{{old('main_description')}}@endif</textarea>
                            </div>

                            <div class="form-group">
                                <label for="main_image">Main Image (1920x1152)</label>
                                @isset($dataTypeContent->main_image)
                                    <img src="{{ asset_cdn($dataTypeContent->main_image) }}" class="img-responsive">
                                @endisset
                                <input type="file" class="form-control" name="main_image"
                                    placeholder="Image" id="main_image" accept=".jpg,.jpeg,.png,.ico,.svg">
                            </div>

                            <div class="form-group">
                                <label for="feature_bg_color">Background Hexa Color</label>
                                <input type="text" class="form-control" name="feature_bg_color" placeholder="#1168f2" id="feature_bg_color" value="@if(isset($dataTypeContent->feature_bg_color)){{ old('feature_bg_color', $dataTypeContent->feature_bg_color) }}@else{{old('feature_bg_color')}}@endif">
                            </div>

                            <div class="form-group">
                                <label for="feature_title">Title #2</label>
                                <textarea class="form-control richTextBox" name="feature_title" placeholder="Title #2" id="feature_title">@if(isset($dataTypeContent->feature_title)){{ old('feature_title', $dataTypeContent->feature_title) }}@else{{old('feature_title')}}@endif</textarea>
                            </div>

                            <div class="form-group">
                                <label for="feature_description">Description #2</label>
                                <textarea class="form-control richTextBox" name="feature_description" placeholder="Description #2" id="feature_description">@if(isset($dataTypeContent->feature_description)){{ old('feature_description', $dataTypeContent->feature_description) }}@else{{old('feature_description')}}@endif</textarea>
                            </div>

                            <!--Icons go here-->
                            <div class="form-group">
                                <label for="icons">Icons</label>
                                <table class="table table-responsive icons" id="icons">
                                    <thead>
                                        <th width="20%">Icon title</th>
                                        <th width="35%">Icon description</th>
                                        <th width="25%">Icon image (200x200)</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($icons as $icon)
                                            <tr class="icon">
                                                <input type="hidden" name="icon_ids[]" value="{{ $icon->id }}">
                                                <td>
                                                    <input type="text" class="form-control" name="landing_page_icons[]" placeholder="Title #{{ $loop->iteration }}" id="icons" value="{{ $icon->title }}">
                                                </td>
                                                <td>
                                                    <textarea class="form-control richTextBox" name="icon_descriptions[]" placeholder="Description #{{ $loop->iteration }}" id="icon_descriptions">{{ $icon->description }}</textarea>
                                                </td>
                                                <td>
                                                    @if (!empty($icon->image))
                                                        <img src="{{ asset_cdn($icon->image) }}" class="img-responsive">
                                                    @endif
                                                    <input type="hidden" name="icon_images_old[]" value="{{ $icon->image }}">
                                                    <input type="file" class="form-control" name="icon_images[]" placeholder="Image" id="icon_images" accept=".jpg,.jpeg,.png,.ico,.svg">
                                                </td>
                                            </tr>
                                        @endforeach
                                        @for ($i = count($icons); $i < \App\LandingPage::ICON_COUNT; $i++)
                                            <tr class="icon">
                                                <td>
                                                    <input type="text" class="form-control" name="landing_page_icons[]" placeholder="Title #{{ $i + 1 }}" id="icons" value="">
                                                </td>
                                                <td>
                                                    <textarea class="form-control richTextBox" name="icon_descriptions[]" placeholder="Description #{{ $i + 1 }}" id="icon_descriptions"></textarea>
                                                </td>
                                                <td>
                                                    <input type="file" class="form-control" name="icon_images[]" placeholder="Image" id="icon_images" accept=".jpg,.jpeg,.png,.ico,.svg">
                                                </td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>

                            <div class="form-group">
                                <label for="testimony_title">Title #3</label>
                                <textarea class="form-control richTextBox" name="testimony_title" placeholder="Title #3" id="testimony_title">@if(isset($dataTypeContent->testimony_title)){{ old('testimony_title', $dataTypeContent->testimony_title) }}@else{{old('testimony_title')}}@endif</textarea>
                            </div>

                            <div class="form-group">
                                <label for="testimony_description">Description #3</label>
                                <textarea class="form-control richTextBox" name="testimony_description" placeholder="Description #3" id="testimony_description">@if(isset($dataTypeContent->testimony_description)){{ old('testimony_description', $dataTypeContent->testimony_description) }}@else{{old('testimony_description')}}@endif</textarea>
                            </div>

                            <!--Testimonials go here-->
                            <div class="form-group">
                                <label for="testimonies">Testimonials</label>
                                <table class="table table-responsive testimonies" id="testimonies">
                                    <thead>
                                        <th width="15%">Person name</th>
                                        <th width="15%">Person title</th>
                                        <th width="25%">Testimonial description</th>
                                        <th width="15%">Person image (200x200)</th>
                                    </thead>
                                    <tbody>
                                        @foreach($testimonies as $testimony)
                                            <tr class="testimony">
                                                <input type="hidden" name="testimony_ids[]" value="{{ $testimony->id }}">
                                                <td>
                                                    <input type="text" class="form-control" name="landing_page_testimonies[]" placeholder="Person name #{{ $loop->iteration }}" value="{{ $testimony->person_name }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="testimony_titles[]" placeholder="Person name #{{ $loop->iteration }}" value="{{ $testimony->person_title }}">
                                                </td>
                                                <td>
                                                    <textarea class="form-control" name="testimony_descriptions[]" placeholder="Person name #{{ $loop->iteration }}" class="form-control">{{ $testimony->description }}</textarea>
                                                </td>
                                                <td>
                                                    @if (!empty($testimony->person_image))
                                                        <img src="{{ asset_cdn($testimony->person_image) }}" class="img-responsive">
                                                    @endif
                                                    <input type="hidden" name="testimony_images_old[]" value="{{ $testimony->person_image }}">
                                                    <input type="file" class="form-control" name="testimony_images[]" accept=".jpg,.jpeg,.png,.ico,.svg">
                                                </td>
                                            </tr>
                                        @endforeach
                                        @for ($i = count($testimonies); $i < \App\LandingPage::TESTIMONY_COUNT; $i++)
                                            <tr class="testimony">
                                                <td>
                                                    <input type="text" class="form-control" name="landing_page_testimonies[]" placeholder="Person name #{{ $i + 1 }}" value="">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="testimony_titles[]" placeholder="Person title #{{ $i + 1 }}" value="">
                                                </td>
                                                <td>
                                                    <textarea class="form-control" name="testimony_descriptions[]" placeholder="Testimonial description #{{ $i + 1 }}" class="form-control"></textarea>
                                                </td>
                                                <td>
                                                    <input type="file" class="form-control" name="testimony_images[]" accept=".jpg,.jpeg,.png,.ico,.svg">
                                                </td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>

                            <div class="form-group">
                                <label for="university_title">Title #4</label>
                                <textarea class="form-control richTextBox" name="university_title" placeholder="Title #4" id="university_title">@if(isset($dataTypeContent->university_title)){{ old('university_title', $dataTypeContent->university_title) }}@else{{old('university_title')}}@endif</textarea>
                            </div>

                            <!--Universities go here-->
                            <div class="form-group">
                                <label for="universities">Universities</label>
                                <table class="table table-responsive universities" id="universities">
                                    <thead>
                                        <th width="25%">University/Degree name</th>
                                        <th width="25%">Location</th>
                                        <th width="25%">Image (400x206)</th>
                                        <th width="10%">Sort</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @forelse($universities as $university)
                                            <tr class="university">
                                                <input type="hidden" name="university_ids[]" value="{{ $university->id }}">
                                                <td>
                                                    <input type="text" class="form-control" name="landing_page_universities[]" value="{{ $university->name }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="university_locations[]" value="{{ $university->location }}">
                                                </td>
                                                <td>
                                                    @if (!empty($university->image))
                                                        <img src="{{ asset_cdn($university->image) }}" class="img-responsive">
                                                    @endif
                                                    <input type="hidden" name="university_images_old[]" value="{{ $university->image }}">
                                                    <input type="file" class="form-control" name="university_images[]" accept=".jpg,.jpeg,.png,.ico,.svg" value="{{ $university->image }}">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name="university_sorts[]" value="{{ $university->sort }}">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger remove-university">Remove</button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="university">
                                                <td>
                                                    <input type="text" class="form-control" name="landing_page_universities[]" value="">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="university_locations[]" value="">
                                                </td>
                                                <td>
                                                    <input type="file" class="form-control" name="university_images[]" accept=".jpg,.jpeg,.png,.ico,.svg">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name="university_sorts[]" value="">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger remove-university">Remove</button>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-primary pull-right add-new-university">Add New University</button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="footer_content">Footer description #1</label>
                                <textarea class="form-control richTextBox" name="footer_content" placeholder="Footer description #1" id="footer_content">@if(isset($dataTypeContent->footer_content)){{ old('footer_content', $dataTypeContent->footer_content) }}@else{{old('footer_content')}}@endif</textarea>
                            </div>

                            <div class="form-group">
                                <label for="footer_note">Footer description #2</label>
                                <textarea class="form-control richTextBox" name="footer_note" placeholder="Footer description #2" id="footer_note">@if(isset($dataTypeContent->footer_note)){{ old('footer_note', $dataTypeContent->footer_note) }}@else{{old('footer_note')}}@endif</textarea>
                            </div>

                            <div class="form-group">
                                <label for="is_content_ready">Content Ready?</label>
                                <select class="form-control select2" name="is_content_ready" id="is_content_ready">
                                    @foreach(['Not Ready', 'Ready'] as $key => $value)
                                        <option value="{{ $key }}" {{ (isset($dataTypeContent->is_content_ready) && $dataTypeContent->is_content_ready == $key) ? 'selected' : '' }}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary save">Save</button>
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
            
            //Init datepicker for date fields if data-datepicker attribute defined
            //or if browser does not handle date inputs
            $('.form-group input[type=date]').each(function (idx, elt) {
                if (elt.type != 'date' || elt.hasAttribute('data-datepicker')) {
                    elt.type = 'text';
                    $(elt).datetimepicker($(elt).data('datepicker'));
                }
            });

            $(document).on('click', '.remove-interest', function(e) {
                e.preventDefault();
                $(this).parents('.interest').remove();
            })

            $(document).on('click', '.add-new-interest', function(e) {
                var html = '<tr class="interest">';
                html += '<td>'+
                            '<input type="text" class="form-control" name="landing_page_interests[]" value="">' +
                        '</td>';
                html += '<td>'+
                            '<input type="number" class="form-control" name="interest_sorts[]" value="">' +
                        '</td>';
                html += '<td>'+
                            '<button type="button" class="btn btn-danger remove-interest">Remove</button>'+
                        '</td>';
                html += '</tr>';

                $('table.interests tbody').append(html);
            });

            $(document).on('click', '.remove-university', function(e) {
                e.preventDefault();
                $(this).parents('.university').remove();
            })

            $(document).on('click', '.add-new-university', function(e) {
                var html = '<tr class="university">';
                html += '<td>' +
                            '<input type="text" class="form-control" name="landing_page_universities[]" value="">' +
                        '</td>';
                html += '<td>' +
                            '<input type="text" class="form-control" name="university_locations[]" value="">' +
                        '</td>';
                html += '<td>'+
                            '<input type="file" class="form-control" name="university_images[]" accept=".jpg,.jpeg,.png,.ico,.svg">' +
                        '</td>';
                html += '<td>'+
                            '<input type="number" class="form-control" name="university_sorts[]" value="">' +
                        '</td>';
                html += '<td>'+
                            '<button type="button" class="btn btn-danger remove-university">Remove</button>'+
                        '</td>';
                html += '</tr>';

                $('table.universities tbody').append(html);
            });
        });
    </script>
@stop
