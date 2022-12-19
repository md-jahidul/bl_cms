@extends('layouts.admin')
@section('title', 'Explore C List')
@section('card_name', 'Explore C List')
@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{ url('explore-c') }}"> Explore C List</a></li>
@endsection
@section('action')
    <a href="{{route('explore-c.create')}}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add Explore C
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>Explore C</strong></h4>
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                        <tr>
                            <td width="3%">#</td>
                            <th width="25%">Title En</th>
                            <th width="25%">Display Order</th>
                            <th width="25%">Start Date</th>
                            <th width="25%">End Date</th>
                            <th width="25%">Status</th>
                            <th class="">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($exploreCs as $exploreC)
                                @php $path = 'partner-offers-home'; @endphp
                                <tr data-index="{{ $exploreC->id }}" data-position="{{ $exploreC->display_order }}">
                                    <td width="3%">{{ $loop->iteration }}</td>
                                    <td >{{ $exploreC->title_en }}</td>
                                    <td >{{ $exploreC->display_order }}</td>
                                    <td >{{ $exploreC->start_date }}</td>
                                    <td >{{ $exploreC->end_date }}</td>
                                    <td >{{ \App\Models\ExploreC::EXPLORE_C_STATUS_ENUM[$exploreC->status]  }}</td>
                                    <td width="12%" class="text-center">
                                        <a href="{{ url("explore-c/$exploreC->id/edit") }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                        <a href="#" remove="{{ url("explore-c/destroy/$exploreC->id") }}" class="border-0 btn-sm btn-outline-danger delete delete_btn" data-id="{{ $exploreC->id }}" title="Delete">
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
    {{--    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">--}}
    <style>
        #sortable tr td{
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
    </style>
@endpush

@push('page-js')
    <script>
    $(function () {
            $('.delete').click(function () {
                var id = $(this).attr('data-id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    html: jQuery('.delete_btn').html(),
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "{{ url('explore-c/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('explore-c') }}"
                                }
                            }
                        })
                    }
                })
            })
        })
    </script>
@endpush





