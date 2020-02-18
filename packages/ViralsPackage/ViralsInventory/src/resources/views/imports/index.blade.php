@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ __('virals-inventory::labels.imports') }}
            <small>{{ __('virals-inventory::messages.list') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-home"></i>{{ __('virals-inventory::messages.home') }}</a></li>
            <li class="active">{{ __('virals-inventory::labels.imports_list') }}</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row form-group">
                    <div class="col-sm-12 pull-right">
                        <a href="{{ route('admin.imports.create') }}" class="btn btn-success"><i class="fa fa-edit"></i>
                            {{ __('virals-inventory::labels.imports_create') }}</a>
                    </div>
                </div>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ __('virals-inventory::labels.imports_list') }}</h3>
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
                            <th>{{ __('virals-inventory::labels.imports_field.warehouse_id') }}</th>
                            <th>{{ __('virals-inventory::labels.imports_field.vendor_id') }}</th>
                            <th>{{ __('virals-inventory::labels.imports_field.date') }}</th>
                            <th>{{ __('virals-inventory::messages.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($imports->count() > 0)
                            @foreach($imports as $key => $import)
                                <tr>
                                    <td>{{ @$import->warehouse->name }}</td>
                                    <td>{{ @$import->vendor->name }}</td>
                                    <td>{{ $import->date }}</td>
                                    <td>
                                        <a href="{{ route('admin.imports.show', $import->id) }}"
                                           class="btn btn-xs btn-info"><i
                                                    class="fa fa-search"></i></a>
                                        <a href="{{ route('admin.imports.pdf', $import->id) }}" class="btn btn-xs btn-danger delete_warehouse"
                                           data-url=""><i class="fa fa-download"></i></a>
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
        $(document).on('click', 'a.delete_imports', function (e) {
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
