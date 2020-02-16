@extends('layouts.app')

@section('content')
    @php
        $label = @$import ? __('virals-inventory::labels.imports_update') : __('virals-inventory::labels.imports_create');
        $route = @$import ? route('admin.imports.update', $import->id) : route('admin.imports.store');
    @endphp
    <section class="content-header">
        <h1>
            {{ __('virals-inventory::labels.store') }}
            <small>{{ $label }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-home"></i>{{ $label }}</a></li>
            <li class="active">{{ $label }}</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ $label }}</h3>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {!! Form::open(['url' =>[$route ] , 'method'=> 'POST','files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('warehouse_id', __('virals-inventory::labels.imports_field.warehouse_id')) !!}
                    {!! Form::select('warehouse_id', $warehouses, old('warehouse_id') ?? @$import->warehouse_id, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('vendor_id', __('virals-inventory::labels.imports_field.vendor_id')) !!}
                    {!! Form::select('vendor_id', $vendors, old('vendor_id') ?? @$import->vendor_id, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('date', __('virals-inventory::labels.imports_field.date')) !!}
                    {!! Form::input('dateTime-local', 'date', old('date')  ?? @$import->date , ['class' => 'form-control datetime', 'placeholder' => __('virals-inventory::labels.imports_field.date')]) !!}
                </div>
                <div id="do-items">
                    <table id="do-items-table" class="table table-bordered table-striped ">
                        <thead>
                        <tr>
                            <th>{{ __('virals-inventory::labels.product') }}</th>
                            <th>{{ __('virals-inventory::labels.imports_field.quantity') }}</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody id="tbody">
                        <tr>
                            <td>
                                <select class="form-control products" name="product_id[]">
                                    <option value="">Select</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" @if((old('product_id') ?? @$import->product_id) == $product->id) selected @endif>{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">Unit</span>
                                    <input class="form-control" placeholder="" min="0" step="0.1" required="required" name="quantity[]" type="number">
                                </div>
                            </td>
                            <td>

                                <a href="#" class="remove-item"><i class="fa fa-trash"></i></a>


                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <button class="add_field_button btn btn-primary">{{ __('virals-inventory::labels.product_add') }}</button>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default">{{ __('virals-inventory::messages.submit') }}</button>
                    <a href="{{ route('admin.imports.index') }}" class="btn btn-default pull-right">{{ __('virals-inventory::messages.cancel') }}</a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>

        $(document).ready(function () {
            $('.singleDatePicker').datetimepicker({
                sideBySide: true,
                format: 'YYYY-MM-DD HH:mm:ss'
            });

            var add_button = $(".add_field_button"); //Add button ID
            var productUnit = {!! $products !!};
            var html = '<tr><td>' + '<select class="form-control products" required="required" name="product_id[]">' +
                '<option value="" selected="selected">Select</option>';
            $.each(productUnit, function (key, value) {
                html += '<option value="' + value.id +  '">' + value.name +  '</option>'
            })
                html += '</select> </td><td>' + '<div class="input-group"><span class="input-group-addon">Unit</span>' + '<input class="form-control" placeholder="" min="0" step="0.1" required="required" name="quantity[]" type="number">' + '</div>' + '</td><td><a class="remove-item"><i class="fa fa-trash"></i></a></td></tr>'

            $(add_button).click(function (e) { //on add input button click
                e.preventDefault();

                $('#tbody').append(html);
                $('.remove-item').on("click", function (e) { //user click on remove text
                    $($(this).closest('tr')).remove();
                    return false;
                });
            });

            $('.remove-item').on("click", function (e) { //user click on remove text
                $($(this).closest('tr')).remove();
                return false;
            });

            $(document).on('change', 'select.products', function () {
                var self = $(this);
                data = $(this).val();

                $.each(productUnit, function (key, value) {
                    if (value.id === parseInt(data)) {
                        $('span.input-group-addon', self.parent().parent()).text(value.unit.name);
                    }
                })
            });

        });

    </script>
@endsection