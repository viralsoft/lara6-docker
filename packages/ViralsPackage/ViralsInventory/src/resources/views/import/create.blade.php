@extends('layouts.app')

@section('content')
    @php
        $label = @$import ? __('virals-inventory::labels.import_update') : __('virals-inventory::labels.import_create');
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
                    {!! Form::label('manager_id', __('virals-inventory::labels.import_field.product_id')) !!}
                    {!! Form::select('product_id', $data['product'], old('product_id') ?? @$import->product_id, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('warehouse_id', __('virals-inventory::labels.import_field.warehouse_id')) !!}
                    {!! Form::select('warehouse_id', $data['warehouse'], old('warehouse_id') ?? @$import->warehouse_id, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('vendor_id', __('virals-inventory::labels.import_field.vendor_id')) !!}
                    {!! Form::select('vendor_id', $data['vendor'], old('vendor_id') ?? @$import->vendor_id, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('quantity', __('virals-inventory::labels.import_field.quantity')) !!}
                    {!! Form::text('quantity', old('quantity') ?? @$import->quantity , ['class' => 'form-control', 'placeholder' => __('virals-inventory::labels.import_field.quantity')]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('date', __('virals-inventory::labels.import_field.quantity')) !!}
                    {!! Form::text('date', old('date')  ?? @$import->date , ['class' => 'form-control', 'placeholder' => __('virals-inventory::labels.import_field.quantity')]) !!}
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </section>
@endsection
