@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ __('virals-inventory::labels.imports') }}
            <small>{{ __('virals-inventory::labels.imports_show') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-home"></i>{{ __('virals-inventory::messages.home') }}</a></li>
            <li class="active">{{ __('virals-inventory::labels.imports_show') }}</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ __('virals-inventory::labels.imports_show') }}</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>{{ __('virals-inventory::labels.imports_field.warehouse_id') }}</th>
                                    <td>{{ @$import->warehouse->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('virals-inventory::labels.imports_field.vendor_id') }}</th>
                                    <td>{{ @$import->vendor->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('virals-inventory::labels.imports_field.date') }}</th>
                                    <td>{{ date('d/m/Y H:i:s', strtotime($import->date)) }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('virals-inventory::labels.updated_by') }}</th>
                                    <td>{{ @$import->updatedBy->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('virals-inventory::labels.imports_field.pdf') }}</th>
                                    <td><a href="{{ route('admin.imports.pdf', $import->id) }}" class="btn btn-danger pull-left">{{ __('virals-inventory::labels.imports_field.export') }}</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ __('virals-inventory::labels.product') }}</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-hover table-striped table-bordered">
                            <thead class="bg-primary">
                            <tr>
                                <th>{{ __('virals-inventory::messages.index') }}</th>
                                <th>{{ __('virals-inventory::labels.product_field.name') }}</th>
                                <th>{{ __('virals-inventory::labels.imports_field.quantity') }}</th>
                                <th>{{ __('virals-inventory::labels.product_field.sku') }}</th>
                                <th>{{ __('virals-inventory::labels.product_field.unit_id') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($import->products()->count() > 0)
                                @foreach($import->products as $key => $product)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ @$product->pivot->quantity }}</td>
                                        <td>{{ $product->sku }}</td>
                                        <td>{{ @$product->unit->name }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr><td colspan="5" class="text-center">{{ __('virals-inventory::messages.no_result') }}</td></tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer">
                        <div class="form-group">
                            <a href="{{ route('admin.imports.index') }}" class="btn btn-default pull-right">{{ __('virals-inventory::messages.cancel') }}</a>
                            <a href="{{ route('admin.imports.pdf', $import->id) }}" class="btn btn-danger pull-left">{{ __('virals-inventory::labels.imports_field.pdf') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection