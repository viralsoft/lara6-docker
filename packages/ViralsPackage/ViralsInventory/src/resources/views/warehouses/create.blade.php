@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ __('virals-inventory::labels.warehouse') }}
            <small>{{ __('virals-inventory::labels.warehouse_create') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-home"></i>{{ __('virals-inventory::messages.home') }}</a></li>
            <li class="active">{{ __('virals-inventory::labels.warehouse_create') }}</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ __('virals-inventory::labels.warehouse_create') }}</h3>
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
                {!! Form::open(['url' =>[route('admin.warehouses.store') ] , 'method'=> 'POST','files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('name', __('virals-inventory::labels.warehouse_name')) !!}
                    {!! Form::text('name', old('name') , ['class' => 'form-control', 'placeholder' => __('virals-inventory::labels.warehouse_name')]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('address', __('virals-inventory::labels.warehouse_address')) !!}
                    {!! Form::textarea('address', old('address') , ['rows' => 3, 'class' => 'form-control', 'placeholder' => __('virals-inventory::labels.warehouse_address')]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('store_id', __('virals-inventory::labels.store_name')) !!}
                    {!! Form::select('store_id', $stores, old('store_id'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-default">{{ __('virals-inventory::messages.submit') }}</button>
                    <a href="{{ route('admin.warehouses.index') }}" class="btn btn-default pull-right">{{ __('virals-inventory::messages.cancel') }}</a>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </section>
@endsection