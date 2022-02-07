@extends('layouts.admin')
@section('title', 'Flash Hour')
@section('card_name', 'Flash Hour')
@section('breadcrumb')
    <li class="breadcrumb-item active">Campaign List</li>
@endsection

@section('action')
{{--    @if(!$flashHourCampaigns->count())--}}
        <a href="{{route('flash-hour-campaign.create')}}" class="btn btn-primary round btn-glow px-2"><i
                class="la la-plus"></i>
            Create Campaign
        </a>
{{--    @endif--}}
@endsection

@section('content')
    <section>
        <div class="card card-info mt-0" style="box-shadow: 0px 0px">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered alt-pagination no-footer dataTable" id="Example1"
                           role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Campaign Title</th>
                            <th>User Type</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Report</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($flashHourCampaigns as $data)
                            <tr class="{{ ($data->checkCampaignExpire()) ? "tr-bg" : "" }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->title }}{!! $data->status == 0 ? '<span class="danger pl-1"><strong> ( Inactive )</strong></span>' : '' !!}
                                {!! $data->checkCampaignExpire() ? '<spam class="text-warning "> (Campaign is expired)</strong></span>' : '' !!}</td>
                                <td>{{ str_replace('_', ' ', ucwords($data->campaign_user_type)) }}</td>
                                <td>{{ $data->start_date }}</td>
                                <td>{{ $data->end_date }}</td>
                                <td>
                                    <a href="{{ route('flash-hour-analytic.report', $data->id) }}" role="button"
                                       class="btn btn-outline-secondary"> Analytic Report</a>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('flash-hour-campaign.edit', [$data->id]) }}" role="button"
                                       class="btn-sm btn-outline-info border-0">
                                        <i class="la la-pencil" disabled="disabled" aria-hidden="true"></i>
                                    </a>

                                    @if(!$data->checkCampaignExpire())
                                        <a href="#" remove="{{ url("flash-hour-campaign/destroy/$data->id") }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $data->id }}" title="Delete">
                                            <i class="la la-trash"></i>
                                        </a>
{{--                                    @else--}}
{{--                                        <span class="text-danger">Campaign Expired</span>--}}
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

@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
    <style>
        table.dataTable tbody td {
            max-height: 40px;
        }

        .tr-bg{
            background-color: rgba(225, 227, 219, 0.96) !important;
        }
    </style>
@endpush
@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js"
            type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js"
            type="text/javascript"></script>
    <script>
        $(document).ready(function () {



            $('#Example1').DataTable({
                buttons: [],
                paging: true,
                searching: true,
                "bDestroy": true,
            });

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
                        event.preventDefault();
                        document.getElementById(`delete-form-${id}`).submit();
                    }
                })
            })
        });

    </script>
@endpush
