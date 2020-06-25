@extends('layouts.admin')
@section('title', 'App & Service')
@section('card_name', 'App & Service')
@section('breadcrumb')
    <li class="breadcrumb-item active">App & Service Tabs List</li>
@endsection
@section('action')
{{--    <a href="--}}{{--{{ $parent_id == 0 ? url('menu/create') : url("menu/$parent_id/child-menu/create") }}--}}{{--" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>--}}
{{--        Create Tab --}}
{{--    </a>--}}
@endsection
@section('content')


<section id="dom">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Tab List</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body card-dashboard">

                    <table class="table table-striped table-bordered dom-jQuery-events">
                        <thead>
                        <tr>
                            <td width="3%">#</td>
                            <th width="25%">Title English</th>
                            <th width="25%">Title Bangla</th>
                            <th width="25%">Banner Image</th>
                            <th class="">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tabList as $item)
                            <tr>
                                <td width="3%">{{ $loop->iteration }}</td>
                                <td>{{ $item->name_en }} {!! $item->status == 0 ? '<span class="danger pl-1"><strong> ( Inactive )</strong></span>' : '' !!}</td>
                                <td>{{ $item->name_bn }}</td>
                                <td>
                                    @if($item->banner_image_url)
                                        <img src="{{ config('filesystems.file_base_url') . $item->banner_image_url }}" height="60" width="60">
                                    @endif
                                </td>
                                <td width="12%" class="text-center">
                                    <a href="{{ url("app-service/tabs/$item->id/edit") }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
{{--                                    <a href="#" remove="{{ url("app-service/tabs/destroy/$item->id") }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $item->id }}" title="Delete">--}}
{{--                                        <i class="la la-trash"></i>--}}
{{--                                    </a>--}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
@stop
