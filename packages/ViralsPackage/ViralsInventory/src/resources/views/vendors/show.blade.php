@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ __('virals-inventory::labels.vendor.index') }}
            <small>{{ __('virals-inventory::labels.vendor.show') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-home"></i>{{ __('virals-inventory::messages.home') }}</a></li>
            <li class="active">{{ __('virals-inventory::labels.vendor.show') }}</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ __('virals-inventory::labels.vendor.show') }}</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>{{ __('virals-inventory::labels.vendor.name') }}</th>
                                    <td>{{ @$vendor->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('virals-inventory::labels.vendor.email') }}</th>
                                    <td>{{ @$vendor->email }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('virals-inventory::labels.vendor.phone') }}</th>
                                    <td>{{ @$vendor->phone }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('virals-inventory::labels.vendor.address') }}</th>
                                    <td>{{ @$vendor->address }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('virals-inventory::labels.vendor.description') }}</th>
                                    <td>{{ @$vendor->descriptions }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('virals-inventory::labels.vendor.city') }}</th>
                                    <td>{{ @$vendor->city }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('virals-inventory::labels.vendor.zip') }}</th>
                                    <td>{{ @$vendor->zip }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('virals-inventory::labels.vendor.fax') }}</th>
                                    <td>{{ @$vendor->fax }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('virals-inventory::labels.vendor.poc_email') }}</th>
                                    <td>{{ @$vendor->poc_email }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('virals-inventory::labels.vendor.poc_name') }}</th>
                                    <td>{{ @$vendor->poc_name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('virals-inventory::labels.vendor.poc_phone') }}</th>
                                    <td>{{ @$vendor->poc_phone }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('virals-inventory::labels.created_by') }}</th>
                                    <td>{{ @$vendor->createdBy->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('virals-inventory::labels.updated_by') }}</th>
                                    <td>{{ @$vendor->updatedBy->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('virals-inventory::labels.created_at') }}</th>
                                    <td>{{ @$vendor->created_at }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('virals-inventory::labels.updated_at') }}</th>
                                    <td>{{ @$vendor->updated_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer">
                        <div class="form-group">
                            <a href="{{ route('admin.vendors.edit', $vendor->id) }}" class="btn btn-primary">{{ __('virals-inventory::messages.edit') }}</a>
                            <a href="{{ route('admin.vendors.index') }}" class="btn btn-default">{{ __('virals-inventory::messages.cancel') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
