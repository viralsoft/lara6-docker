@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="row">
    <div class="col col-md-6">
        <div class="form-group">
            {!! Form::label('date', __('virals-inventory::labels.export.date')) !!}
            {!! Form::date('date', old('date') ?? @$export->date, ['class' => 'form-control', 'id' => "date"]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('warehouse_id', __('virals-inventory::labels.export.warehouse_name')) !!}
            {!! Form::select('warehouse_id', $warehouse, old('warehouse_id') ?? @$export->warehouse_id, ['class' => 'form-control', 'id' => "warehouse"]) !!}
        </div>
    </div>
    <div class="col col-md-6">
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
                        <select class="form-control product" name="product_id[]">
                            <option value="">Select</option>
                            @if(isset($products))
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" @if((old('product_id') ?? @$import->product_id) == $product->id) selected @endif>{{ $product->name }}</option>
                                @endforeach
                            @endif
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
    </div>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ __('virals-inventory::messages.submit') }}</button>
    <a href="{{ route('admin.exports.index') }}" class="btn btn-default">{{ __('virals-inventory::messages.cancel') }}</a>
</div>

<script src="{{ asset('vendor/virals/assets/js/jquery-3.4.1.min.js') }}"></script>
<link href="{{ asset('vendor/virals/assets/css/select2.min.css') }}" />
<script src="{{ asset('vendor/virals/assets/js/select2.min.js') }}"></script>

<script>
    $(document).ready(function () {
        var productUnit = null;
        var add_button = $(".add_field_button"); //Add button ID
        var html = '<tr><td>' + '<select class="form-control product" required="required" name="product_id[]">' +
            '<option value="" selected="selected">Select</option>';
        $.each(productUnit, function (key, value) {
            html += '<option value="' + value.id +  '">' + value.name +  '</option>'
        })
        html += '</select> </td><td>' + '<div class="input-group"><span class="input-group-addon">Unit</span>' + '<input class="form-control" placeholder="" min="0" step="0.1" required="required" name="quantity[]" type="number">' + '</div>' + '</td><td><a class="remove-item"><i class="fa fa-trash"></i></a></td></tr>'
        $(add_button).click(function (e) { //on add input button click
            e.preventDefault();
            var product = $('.product');
            $('#tbody').append(html);
            $('.remove-item').on("click", function (e) { //user click on remove text
                $($(this).closest('tr')).remove();
                return false;
            });
        });
        var product = $('.product');
        addInputProduct();
        $('#warehouse').change(function (e) {
            addInputProduct();
        });
        function addInputProduct() {
            var value = $('#warehouse').val();
            $.ajax({
                url: '{{ route('api.products.getByWarehouse') }}',
                type: 'GET',
                dataType: 'json',
                data: { warehouse_id: value},
                success: function(data){
                    var viewOption = ``;
                    data.data.forEach(element => {
                        viewOption += '<option value="' + element.id + '">' + element.name + '</option>';
                    });
                    product.html(viewOption);
                    productUnit = data.data;
                    html = '<tr><td>' + '<select class="form-control product" required="required" name="product_id[]">';
                    html += viewOption + '</select> </td><td>' + '<div class="input-group"><span class="input-group-addon">Unit</span>' + '<input class="form-control" placeholder="" min="0" step="0.1" required="required" name="quantity[]" type="number">' + '</div>' + '</td><td><a class="remove-item"><i class="fa fa-trash"></i></a></td></tr>'
                    $('#tbody').empty();
                    $('#tbody').append(html);
                }
            })
        }

    })
</script>
