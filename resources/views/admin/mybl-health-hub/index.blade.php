@extends('layouts.admin')
@section('title', 'Health Hub List')
@section('card_name', 'Health Hub')
@section('breadcrumb')
    <li class="breadcrumb-item">Health Hub List</li>
@endsection
@section('action')
    <a href="{{ route('health-hub.analytics') }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-bar-chart-o"></i>
        Health Hub Analytic
    </a>
    <a href="{{ route('health-hub.create') }}" class="btn btn-success  round btn-glow px-2"><i class="la la-plus"></i>Add New Item
    </a>
@endsection
@section('content')
    <section>
        <div class="card col-sm-12">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="row">
                        <div class="col-md-7">
                            <h4 class="menu-title mb-2"><strong>Health Hub Item List</strong></h4>
                        </div>
                        <div class="col-md-5">
                            <a href="{{ route('health-hub-deeplink.analytic') }}" class="btn-sm btn-dark  round btn-glow px-2"><i class="la la-bar-chart-o"></i> Health Hub Source Analytic
                            </a>

                        </div>
                    </div>


                    @if(count($healthHubItems) == !0)
                    <table class="table table-striped table-bordered"
                           role="grid" aria-describedby="Example1_info" style="cursor:move;">
                        <thead>
                        <tr>
                            <th width="3%"><i class="icon-cursor-move icons"></i></th>
                            <th width="5%">Icon</th>
                            <th>Item Name En</th>
                            <th>Item Name Bn</th>
                            <th>Destination</th>
{{--                            @if($parentMenu->type == "service")--}}
{{--                                <th>Deep Link</th>--}}
{{--                            @endif--}}
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                            @foreach($healthHubItems as $data)
                                <tr data-index="{{ $data->id }}" data-position="{{ $data->display_order }}">
                                    <td class="pt-1"><i class="icon-cursor-move icons"></i></td>
                                    <td>
                                        <img src="{{ asset($data->icon) }}" alt="Icon Image" width="45" height="45">
                                    </td>
                                    <td class="pt-1">
                                        {{ $data->title_en  }} {!! $data->status == 0 ? '<span class="text-danger"> ( Inactive )</span> <br>' : '' !!}
                                    </td>
                                    <td class="pt-1">{{ $data->title_bn  }}</td>
                                    <td class="pt-1">{{ $data->component_identifier  }}</td>
                                    <td class="action">
                                        <a href="{{ route('health-hub.edit', $data->id) }}" role="button"
                                           class="btn btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                        <a href="#" remove="{{ route('healthHubItem.destroy', $data->id) }}"
                                           class="border-0 btn btn-outline-danger delete_btn" data-id="{{ $data->id }}" title="Delete the user">
                                            <i class="la la-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        <div class="text-center mt-5">
                            <spen>No data available in table</spen>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

@stop

@push('page-css')
    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">
@endpush

@push('page-js')
    <script src="{{ asset('js/custom-js/deep-link.js') }}" type="text/javascript"></script>
    <script>
        var auto_save_url = "{{ url('health-hub-auto-save') }}";
    </script>
@endpush


