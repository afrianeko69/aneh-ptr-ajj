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
                    @php
                        $products = [];
                            $all_products = App\Product::select(['name', 'id'])->get();
                    @endphp
                    @if(isset($dataTypeContent->id))
                        {{ method_field("PUT") }}
                        @php
                            $products = $dataTypeContent->products()->get();
                        @endphp
                    @endif

                    <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-body">
                            <div class="form-group">
                                <label for="name">Bundle Name</label>
                                <input type="text" class="form-control" name="name"
                                       placeholder="Bundle Name" id="name"
                                       value="@if(isset($dataTypeContent->name)){{ old('name', $dataTypeContent->name) }}@else{{old('name')}}@endif">
                            </div>

                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" class="form-control" name="price"
                                       placeholder="Price" id="price"
                                       value="@if(isset($dataTypeContent->price)){{ old('price', $dataTypeContent->price) }}@else{{old('price')}}@endif">
                            </div>

                            <div class="form-group">
                                <label for="start_at">Bundle Start At</label>
                                <input type="text" class="form-control datepicker" name="start_at"
                                       placeholder="Bundle Start At" id="start_at"
                                       value="@if(!empty($dataTypeContent->start_at)){{ old('start_at', $dataTypeContent->start_at->format('m/d/Y g:i A')) }}@else{{old('start_at')}}@endif">
                            </div>

                            <div class="form-group">
                                <label for="end_at">Bundle End At</label>
                                <input type="text" class="form-control datepicker" name="end_at"
                                       placeholder="Bundle End At" id="end_at"
                                       value="@if(!empty($dataTypeContent->end_at)){{ old('end_at', $dataTypeContent->end_at->format('m/d/Y g:i A')) }}@else{{old('end_at')}}@endif">
                            </div>

                            <div class="form-group">
                                <span name="products">
                                    <label for="products">Products</label>
                                <table class="table table-responsive products" id="products">
                                    <thead>
                                    <th width="30%">Product</th>
                                    <th width="20%">Sort</th>
                                    <th>Action</th>
                                    </thead>
                                    <tbody>
                                    @forelse($products as $key => $test)
                                        <tr class="product">
                                            <td>
                                                <span name="products.{{ $key + 1 }}">
                                                    <select class="form-control select2" name="products[]">
                                                        @foreach($all_products as $product)
                                                            @if($product->id == $test->id)
                                                                <option value="{{ $product->id }}" selected>{{ $product->name }}</option>
                                                            @else
                                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </span>
                                            </td>
                                            <td>
                                                <span name="product_sort.{{ $key + 1 }}"><input type="number" name="product_sort[]" class="form-control Product_counts" value="{{ $test->pivot->sort }}"></span>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger remove-product">Remove</button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="product">
                                            <td>
                                                <span name="products.0">
                                                    <select class="form-control select2" name="products[]">
                                                    <option value="">Select Product</option>
                                                        @foreach($all_products as $test)
                                                            <option value="{{ $test->id }}">{{ $test->name }}</option>
                                                        @endforeach
                                                </select>
                                                </span>
                                            </td>
                                            <td>
                                                <span name="product_sort.0"><input type="number" name="product_sort[]" class="form-control Product_counts"></span>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger remove-product">Remove</button>
                                            </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                    </span>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-primary pull-right add-new-product">Add New Product</button>
                                </div>
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
            var count = $('.product_counts').length - 1;
            var products = <?php echo json_encode($all_products); ?>;

            $(document).on('click', '.remove-product', function(e) {
                e.preventDefault();
                $(this).parents('.product').remove();
            });

            $(document).on('click', '.add-new-product', function(e) {
                count = count + 1;
                var html = '<tr class="product">'+
                    '<td>'+
                    '<span name="products.' + count + '"><select class="form-control select2" name="products[]">'+
                    '<option value="">Select Product</option>';
                $.each(products, function(key, value) {
                    html += '<option value="'+ value.id +'">'+ value.name +'</option>';
                });
                html += '</select></span>'+
                    '</td>'+
                    '<td>'+
                    '<span name="product_sort.' + count + '"><input type="number" name="product_sort[]" class="form-control">'+
                    '</td>'+
                    '<td>'+
                    '<button type="button" class="btn btn-danger remove-product">Remove</button>'+
                    '</td>'+
                    '</tr>';

                $('table.products tbody').append(html);
                $('table.products tbody tr.product select').select2();
            });
        });
    </script>
@stop
