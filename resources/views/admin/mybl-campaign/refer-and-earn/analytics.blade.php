@extends('layouts.admin')
@section('title', 'Refer And Earn Analytics')
@section('card_name', 'Refer And Earn Analytics')
@section('breadcrumb')
    <li class="breadcrumb-item active">List</li>
@endsection

@section('action')
    <a href="{{ route('mybl-refer-and-earn.index') }}" class="btn btn-blue-grey  btn-glow px-2"><i class="la la-arrow-left"></i>
        Back to Campaign
    </a>
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
                            <th>Total Referrer</th>
                            <th>Total Referee</th>
                            <th>Successfully Redeemed</th>
                            <th>Total Claimed</th>
                            <th>Total Invited</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($analytics as $data)
                            @php
                                $total_invited = $data->total_referees - ($data->total_claimed + $data->total_success);
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->campaign_title}}</td>
                                <td>{{ $data->total_referrers}}</td>
                                <td>{{ $data->total_referees}}</td>
                                <td>{{ $data->total_success}}</td>
                                <td>{{ $data->total_claimed }}</td>
                                <td>{{ $total_invited }}</td>
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
