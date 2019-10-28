@extends('layouts.admin')
@section('title', 'Config Item List')
@section('card_name', 'Config Item List')
{{--@section('breadcrumb')--}}
{{--    <li class="breadcrumb-item active">Config Item List</li>--}}
{{--@endsection--}}
{{--@section('action')--}}
{{--@endsection--}}
@section('content')
    <div class="row justify-content-md-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="striped-row-layout-card-center"><i class="la la-gears"></i> Settings Page</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                </div>
                <hr class="mb-0">
                <div class="card-content collpase show">
                    <div class="card-body">
                        <form role="form" action="{{ url('config/update') }}" method="POST" class="form form-horizontal striped-rows" novalidate enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-body">

{{--                                        <div class="form-group row profile-pic">--}}
{{--                                            <label class="col-md-3 label-control pt-3"  for="row"></label>--}}
{{--                                            <div class="pb-0">--}}
{{--                                                <input type="file" name="site_logo" class="input-logo pl-2" style="display: none" placeholder="Enter logo alt text">--}}
{{--                                                <a href="#" class="close-edit text-danger" style="display: none"><i class="la la-close" aria-hidden="true"></i></a>--}}
{{--                                            </div>--}}
{{--                                            <div class="edit pt-3 pb-0">--}}
{{--                                                <a href="#" class="edit-btn"><i class="la la-pencil" title="Change Logo" aria-hidden="true"></i></a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

                                <div class="form-group row {{ $errors->has('') ? ' error' : '' }}">
                                    <label class="col-md-3 label-control" for="row">Name</label>
                                    <div class="col-md-9">
                                        <strong>Demo</strong>
                                        <div class="help-block"></div>
                                        @if ($errors->has('price_tk'))
                                            <div class="help-block">{{ $errors->first('price_tk') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row {{ $errors->has('') ? ' error' : '' }}">
                                    <label class="col-md-3 label-control" for="row">Name</label>
                                    <div class="col-md-9">
                                        <strong>Demo</strong>
                                        <div class="help-block"></div>
                                        @if ($errors->has('price_tk'))
                                            <div class="help-block">{{ $errors->first('price_tk') }}</div>
                                        @endif
                                    </div>
                                </div>



                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="eventRegInput5"></label>
                                <div class="col-md-9 pt-0 pb-0">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> Save Changes
                                    </button>
                                    <a href="{{ url('/home') }}" class="btn btn-warning">
                                        <i class="la la-arrow-circle-left"></i> Cancel
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop


{{--<style>--}}
{{--    .profile-pic {--}}
{{--        position: relative;--}}
{{--        display: inline-block;--}}
{{--    }--}}
{{--    .profile-pic:hover .edit {--}}
{{--        display: block;--}}
{{--    }--}}
{{--    .edit {--}}
{{--        display: none;--}}
{{--    }--}}
{{--</style>--}}

@push('page-js')

@endpush





