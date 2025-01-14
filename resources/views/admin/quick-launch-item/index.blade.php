@extends('layouts.admin')
@section('title', 'Quick Launch List')
@section('card_name', "Quick Launch $type List")
@section('breadcrumb')
@endsection
@section('action')
    <a href="{{ url("quick-launch/$type/create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add Quick Launch {{ ucfirst($type) }}
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <td width="3%"><i class="icon-cursor-move icons"></i></td>
                            <th width="3%" class="text-center">Image</th>
                            <th>Title</th>
                            <th>Link</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                        @foreach ($quickLaunchItems as $key=>$quickLaunchItem)
                            <tr data-index="{{ $quickLaunchItem->id }}" data-position="{{ $quickLaunchItem->display_order }}">
                                <td width="3%"><i class="icon-cursor-move icons"></i></td>
                                <td width="6%" class="text-center"><img src="{{ config('filesystems.file_base_url') . $quickLaunchItem->image_url }}" alt="image" height="30" width="30"></td>
                                <td width="20%">{{$quickLaunchItem->title_en}} {!! $quickLaunchItem->status == 0 ? '<span class="inactive"> ( Inactive )</span>' : '' !!}</td>
                                <td>{{$quickLaunchItem->link}}</td>
                                <td class="action" width="8%">
                                    <a href="{{ url("quick-launch/$type/$quickLaunchItem->id/edit") }}" role="button" class="btn btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                    @if($quickLaunchItem->slug != "customer_care")
                                        <a href="#" remove="{{ url("quick-launch/$type/destroy/$quickLaunchItem->id") }}" class="border-0 btn btn-outline-danger delete_btn" data-id="{{ $quickLaunchItem->id }}" title="Delete the user">
                                            <i class="la la-trash"></i>
                                        </a>
                                    @else
                                        <a href="#" class="border-0 btn btn-outline-danger delete_btn disabled"><i class="la la-trash"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>

@stop

@push('page-css')
    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">
    <style>
        #sortable tr td{
            padding-top: 0 !important;
            padding-bottom: 0 !important;
        }
    </style>
@endpush

@push('page-js')
    <script>
        var auto_save_url = "{{ url('quick-launch-sortable') }}";
    </script>
@endpush




