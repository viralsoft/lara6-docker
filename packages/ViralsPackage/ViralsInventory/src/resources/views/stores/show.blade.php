@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ __('virals-inventory::labels.store') }}
            <small>{{ __('virals-inventory::labels.store_show') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-home"></i>{{ __('virals-inventory::messages.home') }}</a></li>
            <li class="active">{{ __('virals-inventory::labels.store_show') }}</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ __('virals-inventory::labels.store_show') }}</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>{{ __('virals-inventory::labels.store_name') }}</th>
                                    <td>{{ @$store->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('virals-inventory::labels.store_address') }}</th>
                                    <td>{{ @$store->address }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('virals-inventory::labels.store_manager') }}</th>
                                    <td>{{ @$store->manager->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('virals-inventory::labels.store_description') }}</th>
                                    <td>{{ @$store->descriptions }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('virals-inventory::labels.created_by') }}</th>
                                    <td>{{ @$store->createdBy->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('virals-inventory::labels.updated_by') }}</th>
                                    <td>{{ @$store->updatedBy->name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer">
                        <div class="form-group">
                            <a href="{{ route('admin.stores.edit', $store->id) }}" class="btn btn-default pull-left">{{ __('virals-inventory::messages.edit') }}</a>
                            <a href="{{ route('admin.stores.index') }}" class="btn btn-default pull-right">{{ __('virals-inventory::messages.cancel') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ __('virals-inventory::labels.warehouse') }}</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered">
                            <thead class="bg-primary">
                            <tr>
                            <tr>
                                <th>{{ __('virals-inventory::messages.index') }}</th>
                                <th>{{ __('virals-inventory::labels.warehouse_name') }}</th>
                                <th>{{ __('virals-inventory::labels.warehouse_address') }}</th>
                                <th>{{ __('virals-inventory::messages.action') }}</th>
                            </tr>
                            </tr>
                            </thead>
                            <tbody>
                            @if($store->warehouses()->count() > 0)
                                @foreach($store->warehouses as $key => $warehouse)
                                    <tr>
                                        <td>{{ @($key + 1) }}</td>
                                        <td>{{ @$warehouse->name }}</td>
                                        <td>{{ @$warehouse->address }}</td>
                                        <td>
                                            <a href="{{ route('admin.warehouses.show', $warehouse->id) }}" target="_blank"
                                               class="btn btn-xs btn-info"><i
                                                        class="fa fa-search"></i></a>
                                        </td>
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
                        <h3 class="box-title">{{ __('virals-inventory::labels.product') }}</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-hover table-striped table-bordered">
                            <thead class="bg-primary">
                            <tr>
                                <th>{{ __('virals-inventory::messages.index') }}</th>
                                <th>{{ __('virals-inventory::labels.product_field.name') }}</th>
                                <th>{{ __('virals-inventory::labels.product_field.sku') }}</th>
                                <th>{{ __('virals-inventory::labels.imports_field.quantity') }}</th>
                                <th>{{ __('virals-inventory::labels.product_field.unit_id') }}</th>
                                <th>{{ __('virals-inventory::labels.warehouse') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($store->warehouses()->count() > 0)
                                @foreach($store->warehouses as $warehouse)
                                    @if($warehouse->products()->count() > 0)
                                        @foreach($warehouse->products as $key => $product)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->sku }}</td>
                                                <td>{{ @$product->pivot->quantity }}</td>
                                                <td>{{ @$product->unit->name }}</td>
                                                <td>{{ @$warehouse->name }}</td>
                                            </tr>
                                        @endforeach
                                        @else
                                        <tr><td colspan="5" class="text-center">{{ __('virals-inventory::messages.no_result') }}</td></tr>
                                    @endif
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection