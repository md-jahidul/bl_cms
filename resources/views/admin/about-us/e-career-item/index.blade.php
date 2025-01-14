@extends('layouts.admin')
@section('title', 'About Career Item List')
@section('card_name', 'About Career')
@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{ route('about-career.index') }}"> About Career</a></li>
    <li class="breadcrumb-item "> About Career Item list</li>
@endsection
@section('action')
    <a href="{{ route('career-item.create', $careerId) }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add About Career Item
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>About Career Item List</strong></h4>
                    <table id="About_eCareer" class="table table-striped table-bordered zero-configuration">
                        <thead>
                        <tr>
                            <th width='5%'><i class="icon-cursor-move icons"></i></th>
                           {{-- <td width="3%">#</td>--}}
                            <th width="25%">Title</th>
                            <th class="">Description</th>
                            <th class="">Image</th>
                            <th class="">Action</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                            @foreach($aboutCareerItems as $item)
                                @php $path = 'partner-offers-home'; @endphp
                                <tr data-index="{{ $item->id }}" data-position="{{ $item->display_order }}">
                                    <td width="5%"><i class="icon-cursor-move icons"></i></td>
                                    {{--<td width="3%">{{ $loop->iteration }}</td>--}}
                                    <td>{{ $item->title_en }}</td>
                                    <td>{{ $item->description_en }}</td>
                                    <td><img src="{{ config('filesystems.file_base_url') . $item->image }}" height="50" width="70"></td>
                                    <td width="12%" class="text-center">
                                        <a href="{{ route('career-item.edit', [$careerId, $item->id])  }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                        <a href="#" remove="{{ url("about-career-item/$careerId/destroy/$item->id") }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $item->id }}" title="Delete">
                                            <i class="la la-trash"></i>
                                        </a>
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

        table.dataTable {
            border-spacing: 1px;
        }
    </style>
@endpush

@section('content_right_side_bar')
    <h1>
        List
    </h1>
@endsection


@push('page-js')
    <script>
        var auto_save_url = "{{ url('about-us-career-sortable') }}";
    </script>

    <script>

        $(document).ready(function () {
            $('#About_eCareer').DataTable({
                dom: 'Bfrtip',
                buttons: [],
                paging: true,
                searching: true,
                "pageLength": 10,
                "bDestroy": true,
            });
        });

    </script>
@endpush






