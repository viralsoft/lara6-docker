@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ __('virals-inventory::labels.store') }}
            <small>{{ __('virals-inventory::labels.store_update') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-home"></i>{{ __('virals-inventory::messages.home') }}</a></li>
            <li class="active">{{ __('virals-inventory::labels.store_update') }}</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ __('virals-inventory::labels.store_update') }}</h3>
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
                {!! Form::open(['url' =>[route('admin.stores.update', $store->id) ] , 'method'=> 'POST','files' => true]) !!}
                @method('PUT')
                <div class="form-group">
                    {!! Form::label('name', __('virals-inventory::labels.store_name')) !!}
                    {!! Form::text('name', old('name') ?? $store->name , ['class' => 'form-control', 'placeholder' => __('virals-inventory::labels.store_name')]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('address', __('virals-inventory::labels.store_address')) !!}
                    {!! Form::textarea('address', old('address') ?? $store->address , ['rows' => 3, 'class' => 'form-control', 'placeholder' => __('virals-inventory::labels.store_address')]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('descriptions', __('virals-inventory::labels.store_description')) !!}
                    {!! Form::textarea('descriptions', old('descriptions') ?? $store->descriptions , ['rows' => 10, 'class' => 'form-control', 'placeholder' => __('virals-inventory::labels.store_description')]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('manager', __('virals-inventory::labels.store_manager')) !!}
                    {!! Form::select('manager_id', $users, old('manager_id') ?? $store->manager_id, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-default">{{ __('virals-inventory::messages.submit') }}</button>
                    <a href="{{ route('admin.stores.index') }}" class="btn btn-default pull-right">{{ __('virals-inventory::messages.cancel') }}</a>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </section>
@endsection