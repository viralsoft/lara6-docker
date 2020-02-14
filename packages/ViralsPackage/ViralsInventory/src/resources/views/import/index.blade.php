@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ __('virals-inventory::labels.import') }}
            <small>{{ __('virals-inventory::messages.list') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-home"></i>{{ __('virals-inventory::messages.home') }}</a></li>
            <li class="active">{{ __('virals-inventory::labels.import_list') }}</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row form-group">
                    <div class="col-sm-12 pull-right">
                        <a href="{{ route('admin.imports.create') }}" class="btn btn-success"><i class="fa fa-edit"></i>
                            {{ __('virals-inventory::labels.import_create') }}</a>
                    </div>
                </div>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ __('virals-inventory::labels.import_list') }}</h3>
                    </div>
                </div>
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered">
                        <thead class="bg-primary">
                        <tr>
                            <th>{{ __('virals-inventory::labels.import_field.product_id') }}</th>
                            <th>{{ __('virals-inventory::labels.import_field.warehouse_id') }}</th>
                            <th>{{ __('virals-inventory::labels.import_field.vendor_id') }}</th>
                            <th>{{ __('virals-inventory::labels.import_field.quantity') }}</th>
                            <th>{{ __('virals-inventory::labels.import_field.date') }}</th>
                            <th>{{ __('virals-inventory::messages.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($stores->count() > 0)
                            @foreach($imports as $key => $import)
                                <tr>
                                    <td>{{ @$import->product->name }}</td>
                                    <td>{{ @$import->warehouse->name }}</td>
                                    <td>{{ @$import->vendor->name }}</td>
                                    <td>{{ $import->quantity }}</td>
                                    <td>{{ $import->date }}</td>
                                    <td>
                                        <a href="{{ route('admin.imports.show', $import->id) }}"
                                           class="btn btn-xs btn-info"><i
                                                class="fa fa-search"></i></a>
                                        <a href="{{ route('admin.imports.edit', $import->id) }}"
                                           class="btn btn-xs btn-primary"><i
                                                class="fa fa-pencil"></i></a>
                                        <a class="btn btn-xs btn-danger delete_import"
                                           data-url=""><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr><td colspan="5" class="text-center">{{ __('virals-inventory::messages.no_result') }}</td></tr>
                        @endif
                        </tbody>
                    </table>
                    <div class="row mbm">
                        <div class="col-sm-6">
                            <span class="record-total">{{ __('virals-inventory::messages.show') }} {{ $imports->count() }} / {{ $imports->total() }} {{ __('virals-inventory::messages.result') }}</span>
                        </div>
                        <div class="col-sm-6">
                            <div class="pagination-panel pull-right">
                                {{ $imports->appends(request()->input())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        var request = false;
        $(document).on('click', 'a.delete_import', function (e) {
            if (!confirm('{{ __('virals-inventory::messages.delete_message') }}')) {
                e.preventDefault();
            } else {
                $.ajax({
                    url: $(this).attr('data-url'),
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "_method": "DELETE"
                    },
                    success: function (response) {
                        location.reload()
                    }
                })
            }

        });
    </script>
@endsection
