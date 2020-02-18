<html lang="en">

<head>
    <style>
        body {
            font-family: DejaVu Sans;
        }
        #table_style, #table_style td, #table_style th {
            border: 1px solid black;
        }
        .background-color-fill, #table_style th {
            background: #F39C12;
            text-transform: uppercase;
            font-weight: bold;
            color: #fff;
        }
        #table_style {
            text-align: center;
        }
        .small-text {
            font-size: 12px;
        }
        .text-right {
            text-align: right;
        }
        .title-order {
            font-size: 36px;
            color: #F39C12;
            text-transform: uppercase;
            text-align: right;
        }
        footer { position: fixed; bottom: -70px; left: 0px; right: 0px; height: 70px; text-align: center; vertical-align: middle;
            border-top:dotted 1px #000000; padding-top: 15px  }
    </style>
</head>

<body>
<table style="width:100%; margin-top: 20px">
    <tr>
        <th style="color: #F39C12;  text-transform: uppercase;" width="300px">{{$import->warehouse->store->name}}</th>
        <th ></th>
        <th></th>
        <th class="title-order" width="400px">Purchase Order</th>
    </tr>
    <tr>
        <td  class="small-text"  width="300px">Store Address: {{$import->warehouse->store->address}}</td>
        <td></td>
        <td></td>
        <td  class="small-text text-right" width="400px">Date: {{$import->date}}</td>
    </tr>
    <tr>
        <td  class="small-text"  width="300px">Phone: 01233039904 </td>
        <td></td>
        <td></td>
        <td  class="small-text text-right" width="400px">PO number: 123456</td>
    </tr>
    <tr>
        <td  class="small-text" width="300px">Email: 01233039904@gmail.com </td>
        <td></td>
        <td></td>
        <td  class="small-text text-right" width="400px"></td>
    </tr>
</table>

<table style="width:100%; margin-top: 20px">
    <tr>
        <th class="background-color-fill" width="300px">Vendor </th>
        <th></th>
        <th></th>
        <th  class="background-color-fill" width="250px">Ship To</th>
    </tr>
    <tr>
        <td  class="small-text"  width="300px">Company Name: {{$import->vendor->name}}</td>
        <td></td>
        <td></td>
        <td  class="small-text"  width="300px">Warehouse Name: {{$import->warehouse->name}}</td>
    </tr>
    <tr>
        <td  class="small-text"  width="300px">Address: {{$import->vendor->address}}</td>
        <td></td>
        <td></td>
        <td  class="small-text"  width="250px">Warehouse Address: {{$import->warehouse->address}} </td>
    </tr>
    <tr>
        <td  class="small-text"  width="300px">City: {{$import->vendor->city}}</td>
        <td></td>
        <td></td>
        <td  class="small-text"  width="250px">Store Name: {{$import->warehouse->store->name}} </td>
    </tr>
    <tr>
        <td  class="small-text"  width="300px">Fax: {{$import->vendor->fax}} </td>
        <td></td>
        <td></td>
        <td class="small-text" width="250px">Store Address: {{$import->warehouse->store->address}} </td>
    </tr>
    <tr>
        <td  class="small-text"  width="300px">Email: {{$import->vendor->email}} </td>
        <td></td>
        <td></td>
        <td  class="small-text"  width="250px"></td>
    </tr>
</table>

<table style="width:100%; margin-top: 20px; border-collapse: collapse;" id="table_style">
    <tr>
        <th>{{ __('virals-inventory::messages.index') }}</th>
        <th>{{ __('virals-inventory::labels.product_field.sku') }}</th>
        <th>{{ __('virals-inventory::labels.product_field.name') }}</th>
        <th>{{ __('virals-inventory::labels.imports_field.quantity') }}</th>
        <th>{{ __('virals-inventory::labels.product_field.unit_id') }}</th>
    </tr>
    @foreach($import->products as $key => $product)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $product->sku }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ @$product->pivot->quantity }}</td>
            <td>{{ @$product->unit->name }}</td>
        </tr>
    @endforeach


</table>

<footer class="small-text">
    If you have have any question about this PO <br/>
    please contact ( Name: {{$import->vendor->name}}, Email: {{$import->vendor->email}}, Phone:{{$import->vendor->phone}} )

</footer>

</body>
</html>