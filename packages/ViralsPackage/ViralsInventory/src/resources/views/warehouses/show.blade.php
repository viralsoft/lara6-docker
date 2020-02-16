@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ __('virals-inventory::labels.warehouse') }}
            <small>{{ __('virals-inventory::labels.warehouse_show') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-home"></i>{{ __('virals-inventory::messages.home') }}</a></li>
            <li class="active">{{ __('virals-inventory::labels.warehouse_show') }}</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ __('virals-inventory::labels.warehouse_show') }}</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>{{ __('virals-inventory::labels.warehouse_name') }}</th>
                                    <td>{{ @$warehouse->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('virals-inventory::labels.warehouse_address') }}</th>
                                    <td>{{ @$warehouse->address }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('virals-inventory::labels.store_name') }}</th>
                                    <td>{{ @$warehouse->store->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('virals-inventory::labels.created_by') }}</th>
                                    <td>{{ @$warehouse->createdBy->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('virals-inventory::labels.updated_by') }}</th>
                                    <td>{{ @$warehouse->updatedBy->name }}</td>
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
                                <th>{{ __('virals-inventory::labels.product_field.sku') }}</th>
                                <th>{{ __('virals-inventory::labels.product_field.unit_id') }}</th>
                                <th>{{ __('virals-inventory::labels.imports_field.quantity') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($warehouse->products()->count() > 0)
                                @foreach($warehouse->products as $key => $product)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->sku }}</td>
                                        <td>{{ @$product->unit->name }}</td>
                                        <td>{{ @$product->pivot->quantity }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr><td colspan="5" class="text-center">{{ __('virals-inventory::messages.no_result') }}</td></tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ __('virals-inventory::labels.product_history') }}</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-hover table-striped table-bordered">
                            <thead class="bg-primary">
                            <tr>
                                <th>{{ __('virals-inventory::messages.index') }}</th>
                                <th>{{ __('virals-inventory::labels.vendor.index') }}</th>
                                <th>{{ __('virals-inventory::labels.imports_field.date') }}</th>
                                <th>{{ __('virals-inventory::messages.action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($warehouse->imports()->count() > 0)
                                @foreach($warehouse->imports as $key => $import)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ @$import->vendor->name }}</td>
                                        <td>{{ $import->date }}</td>
                                        <td>
                                            <a href="{{ route('admin.imports.show', $import->id) }}"
                                               class="btn btn-xs btn-info"><i
                                                        class="fa fa-search"></i></a>
                                            <a class="btn btn-xs btn-danger delete_warehouse"
                                               data-url=""><i class="fa fa-download"></i></a>
                                        </td>
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
                            <a href="{{ route('admin.warehouses.edit', $warehouse->id) }}" class="btn btn-default pull-left">{{ __('virals-inventory::messages.edit') }}</a>
                            <a href="{{ route('admin.warehouses.index') }}" class="btn btn-default pull-right">{{ __('virals-inventory::messages.cancel') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection