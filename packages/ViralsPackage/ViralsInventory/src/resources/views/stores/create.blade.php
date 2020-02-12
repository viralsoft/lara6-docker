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
                    <i class="pe-7s-display1 icon-gradient bg-happy-itmeo">
                    </i>
                </div>
                <div>STORE
                    <div class="page-title-subheading">Create new store.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('admin.stores.index') }}" type="button" class="btn btn-lg btn-info">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="pe-7s-angle-left-circle"></i>
                        </span>
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body"><h5 class="card-title">Create Store</h5>
                    <form class="">
                        <div class="position-relative row form-group">
                            <label for="store_name" class="col-sm-2 col-form-label">Store Name</label>
                            <div class="col-sm-10">
                                <input name="name" id="store_name" type="text" class="form-control @error('name') is-invalid @enderror">
                            </div>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="position-relative row form-group">
                            <label for="address" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <input name="address" id="address" type="text" class="form-control @error('address') is-invalid @enderror">
                            </div>
                            @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="position-relative row form-group">
                            <label for="exampleSelect" class="col-sm-2 col-form-label">Manager</label>
                            <div class="col-sm-10">
                                <select name="user_id" id="exampleSelect" class="form-control  @error('address') is-invalid @enderror">

                                </select>
                            </div>
                            @if ($errors->has('user_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('user_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="position-relative row form-check">
                            <div class="col-sm-10 offset-sm-2">
                                <button class="btn btn-lg btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection