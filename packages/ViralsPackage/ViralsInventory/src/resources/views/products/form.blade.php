
@extends('layouts.app')

@section('content')
    @php
        $label = @$product ? __('virals-inventory::labels.product_update') : __('virals-inventory::labels.product_create');
        $route = @$product ? route('admin.products.update', $product->id) : route('admin.products.store');
    @endphp
    <section class="content-header">
        <h1>
            {{ __('virals-inventory::labels.product') }}
            <small>{{ $label }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-home"></i>{{ __('virals-inventory::messages.home') }}</a></li>
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
                {!! Form::open(['url' =>[ $route ] , 'method'=> @$product ? 'PUT' : 'POST', 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('name', __('virals-inventory::labels.product_field.name')) !!}
                    {!! Form::text('name', old('name') ?? @$product->name , ['class' => 'form-control', 'placeholder' => __('virals-inventory::labels.product_field.name')]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('sku', __('virals-inventory::labels.product_field.sku')) !!}
                    {!! Form::text('sku', old('sku') ?? @$product->sku , ['class' => 'form-control', 'placeholder' => __('virals-inventory::labels.product_field.sku')]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('unit_id', __('virals-inventory::labels.product_field.unit_id')) !!}
                    {!! Form::select('unit_id', $units, old('unit_id') ?? @$product->unit->name, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-default">{{ __('virals-inventory::messages.submit') }}</button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-default pull-right">{{ __('virals-inventory::messages.cancel') }}</a>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </section>
@endsection
