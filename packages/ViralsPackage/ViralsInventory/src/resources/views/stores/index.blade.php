@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        </div>
    </div>

    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-display1">
                    </i>
                </div>
                <div>STORE
                    <div class="page-title-subheading">Store Management.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('admin.stores.create') }}" type="button" class="btn btn-lg btn-info">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-plus-circle"></i>
                        </span>
                        Add new
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body"><h5 class="card-title">Store List</h5>
                    <div class="table-responsive">
                        <table class="mb-0 table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Manager</th>
                                <th>Warehouse</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Store 1</td>
                                <td>68 Nguyễn Cơ Thạch</td>
                                <td>Nguyễn Duy Long</td>
                                <td>Kho 1, Kho 2</td>
                                <td>
                                    <a href="" class="btn btn-xs btn-primary"><i class="pe-7s-more"></i></a>
                                    <a href="" class="btn btn-xs btn-info"><i class="pe-7s-pen"></i></a>
                                    <form method="POST" action="" accept-charset="UTF-8" style="display: inline-block;" onsubmit="return confirm('Are you sure?');"><input name="_method" type="hidden" value="DELETE">
                                        @csrf
                                        <button type="submit" class="btn btn-sx btn-danger"><i class="pe-7s-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Store 1</td>
                                <td>68 Nguyễn Cơ Thạch</td>
                                <td>Nguyễn Duy Long</td>
                                <td>Kho 1, Kho 2</td>
                                <td>
                                    <a href="" class="btn btn-xs btn-primary"><i class="pe-7s-more"></i></a>
                                    <a href="" class="btn btn-xs btn-info"><i class="pe-7s-pen"></i></a>
                                    <form method="POST" action="" accept-charset="UTF-8" style="display: inline-block;" onsubmit="return confirm('Are you sure?');"><input name="_method" type="hidden" value="DELETE">
                                        @csrf
                                        <button type="submit" class="btn btn-sx btn-danger"><i class="pe-7s-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Store 1</td>
                                <td>68 Nguyễn Cơ Thạch</td>
                                <td>Nguyễn Duy Long</td>
                                <td>Kho 1, Kho 2</td>
                                <td>
                                    <a href="" class="btn btn-xs btn-primary"><i class="pe-7s-more"></i></a>
                                    <a href="" class="btn btn-xs btn-info"><i class="pe-7s-pen"></i></a>
                                    <form method="POST" action="" accept-charset="UTF-8" style="display: inline-block;" onsubmit="return confirm('Are you sure?');"><input name="_method" type="hidden" value="DELETE">
                                        @csrf
                                        <button type="submit" class="btn btn-sx btn-danger"><i class="pe-7s-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">4</th>
                                <td>Store 1</td>
                                <td>68 Nguyễn Cơ Thạch</td>
                                <td>Nguyễn Duy Long</td>
                                <td>Kho 1, Kho 2</td>
                                <td>
                                    <a href="" class="btn btn-xs btn-primary"><i class="pe-7s-more"></i></a>
                                    <a href="" class="btn btn-xs btn-info"><i class="pe-7s-pen"></i></a>
                                    <form method="POST" action="" accept-charset="UTF-8" style="display: inline-block;" onsubmit="return confirm('Are you sure?');"><input name="_method" type="hidden" value="DELETE">
                                        @csrf
                                        <button type="submit" class="btn btn-sx btn-danger"><i class="pe-7s-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection