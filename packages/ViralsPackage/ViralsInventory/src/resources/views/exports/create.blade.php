@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ __('virals-inventory::labels.export.index') }}
            <small>{{ __('virals-inventory::labels.export.create') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-home"></i>{{ __('virals-inventory::messages.home') }}</a></li>
            <li class="active">{{ __('virals-inventory::labels.export.create') }}</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ __('virals-inventory::labels.export.create') }}</h3>
                    </div>
                </div>
                {!! Form::open(['url' =>[route('admin.exports.store') ] , 'method'=> 'POST','files' => true]) !!}
                    @include('virals-inventory::exports.fields')
                {!! Form::close() !!}
            </div>
        </div>
    </section>
@endsection
