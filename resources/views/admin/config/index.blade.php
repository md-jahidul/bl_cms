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
                        <form action="{{ url('config/update') }}" method="POST" class="form form-horizontal striped-rows" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-body">
                                @foreach($configs as $key =>$config)
                                    @php($title = ucfirst(str_replace('_', ' ', $config->key )))

                                    @if($config->key == "site_logo")
                                        <div class="form-group row profile-pic">
                                            <label class="col-md-3 label-control pt-3"  for="row">{{ $title }}</label>
                                            <div class="pb-0">
                                                <img src="{{ $config->value }}" height="60" width="50">
                                                    <input type="file" name="site_logo" class="input-logo pl-2" style="display: none">
                                                    <a href="#" class="close-edit text-danger" style="display: none"><i class="la la-close" aria-hidden="true"></i></a>
                                            </div>
                                            <div class="edit pt-3 pb-0">
                                                <a href="#" class="edit-btn"><i class="la la-pencil" title="Change Logo" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    @else
                                        <div class="form-group row {{ $errors->has($config->key) ? ' error' : '' }}">
                                            <label class="col-md-3 label-control" for="row{{$key}}">{{ $title }}</label>
                                            <div class="col-md-9">
                                                <input type="text" id="row{{$key}}" class="form-control" value="{{ $config->value }}" placeholder="name" name="{{ $config->key }}">
                                                @if ($errors->has($config->key))
                                                    <div class="help-block">  {{ $errors->first($config->key) }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif

                                @endforeach
                            </div>
                            <hr>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="eventRegInput5"></label>
                                    <div class="col-md-9 pt-0 pb-0">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> Save Change
                                        </button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop


<style>
    .profile-pic {
        position: relative;
        display: inline-block;
    }
    .profile-pic:hover .edit {
        display: block;
    }
    .edit {
        display: none;
    }
</style>

@push('page-js')
    <script>
        $(document).ready(function () {
            $('#Example1').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copy', className: 'copyButton',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'excel', className: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'pdf', className: 'pdf', "charset": "utf-8",
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'print', className: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                ],
                paging: true,
                searching: true,
                "bDestroy": true,
            });
        });

        (function () {
            $(".edit-btn").on('click', function () {
                $('.edit-btn').hide();
                $('.input-logo').show();
                $('.close-edit').show();
            });
            $(".close-edit").on('click', function () {
                $('.edit-btn').show();
                $('.input-logo').hide();
                $('.close-edit').hide();
            })
        })()
    </script>
@endpush





