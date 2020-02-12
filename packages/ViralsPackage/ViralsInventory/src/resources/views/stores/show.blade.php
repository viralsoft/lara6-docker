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
        </div>
    </section>
@endsection