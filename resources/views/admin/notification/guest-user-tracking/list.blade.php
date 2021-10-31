@extends('layouts.admin')
@section('title', 'Guest User Tracking')
@section('card_name', 'Guest User Tracking')
@section('breadcrumb')
    <li class="breadcrumb-item active">Guest User List</li>
@endsection

@section('content')

    <section>
        <div class="card card-info mt-0" style="box-shadow: 0px 0px">
            <div class="card-content">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                        </div>
                    </div>
                </div>
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered dataTable" id="guest_user_datatable">
                        <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="12%">Name</th>
                            <th width="25%">Msisdn</th>
                            <th width="10%">Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($guestUsers as $user)
                            <tr>
                                <td width="5%"> {{ $user->id }} </td>
                                <td width="12%">{{ $user->name }} </td>
                                <td width="30%"> {{ $user->msisdn }}</td>
                                <td width="10%"> {{ $user->email }}</td>
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
            $('#guest_user_datatable').DataTable({
                //dom: 'Bfrtip',
                buttons: [],
                paging: true,
                searching: true,
                "bDestroy": true,
                "pageLength": 10,
                "order": [],
            });
        });
    </script>
@endpush
