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