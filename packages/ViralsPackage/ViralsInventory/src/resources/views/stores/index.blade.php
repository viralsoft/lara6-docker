@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ __('virals-inventory::labels.store') }}
            <small>{{ __('virals-inventory::messages.list') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-home"></i>{{ __('virals-inventory::messages.home') }}</a></li>
            <li class="active">{{ __('virals-inventory::labels.store_list') }}</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row form-group">
                    <div class="col-sm-12 pull-right">
                        <a href="{{ route('admin.stores.create') }}" class="btn btn-success"><i class="fa fa-edit"></i>
                            {{ __('virals-inventory::labels.store_create') }}</a>
                    </div>
                </div>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ __('virals-inventory::labels.store_list') }}</h3>
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
                        <tr>
                            <th>{{ __('virals-inventory::messages.index') }}</th>
                            <th>{{ __('virals-inventory::labels.store_name') }}</th>
                            <th>{{ __('virals-inventory::labels.store_address') }}</th>
                            <th>{{ __('virals-inventory::labels.store_manager') }}</th>
                            <th>{{ __('virals-inventory::labels.store_description') }}</th>
                            <th>{{ __('virals-inventory::messages.action') }}</th>
                        </tr>
                        </tr>
                        </thead>
                        <tbody>
                        @if($stores->count() > 0)
                            @foreach($stores as $key => $store)
                                <tr>
                                    <td>{{ @($key + 1) }}</td>
                                    <td>{{ @$store->name }}</td>
                                    <td>{{ @$store->address }}</td>
                                    <td>{{ @$store->manager->name }}</td>
                                    <td>{{ @$store->descriptions }}</td>
                                    <td>
                                        <a href="{{ route('admin.stores.show', $store->id) }}"
                                           class="btn btn-xs btn-info"><i
                                                    class="fa fa-search"></i></a>
                                        <a href="{{ route('admin.stores.edit', $store->id) }}"
                                           class="btn btn-xs btn-primary"><i
                                                    class="fa fa-pencil"></i></a>
                                        <a class="btn btn-xs btn-danger delete_store"
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
                            <span class="record-total">{{ __('virals-inventory::messages.show') }} {{ $stores->count() }} / {{ $stores->total() }} {{ __('virals-inventory::messages.result') }}</span>
                        </div>
                        <div class="col-sm-6">
                            <div class="pagination-panel pull-right">
                                {{ $stores->appends(request()->input())->links() }}
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
        $(document).on('click', 'a.delete_store', function (e) {
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
