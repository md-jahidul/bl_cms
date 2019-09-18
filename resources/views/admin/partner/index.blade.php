@extends('layouts.admin')
@section('title', 'Partner List')
@section('card_name', 'Partner List')
@section('breadcrumb')
    <li class="breadcrumb-item active">Partner List</li>
@endsection
@section('action')
    <a href="{{ url('partners/create') }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add Partner
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered alt-pagination no-footer dataTable"
                           id="Example1" role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Company Name</th>
                            <th>CEO Name</th>
{{--                            <th>Company Logo</th>--}}
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Address</th>
                            <th>Website</th>
                            <th>Services</th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($partners as $key=>$partner)
                            <tr>
                                <td class="pt-2">{{ ++$key }}</td>
                                <td class="pt-2">{{ $partner->company_name }}</td>
                                <td class="pt-2">{{ $partner->ceo_name }}</td>
{{--                                <td><img src="{{ asset('images/partners-logo/'. $partner->company_logo) }}" height="50" width="50"></td>--}}
                                <td class="pt-2">{{ $partner->email }}</td>
                                <td class="pt-2">{{ $partner->mobile }}</td>
                                <td class="pt-2">{{ $partner->address }}</td>
                                <td class="pt-2">{{ $partner->website }}</td>
                                <td class="pt-2">{{ $partner->services }}</td>
                                <td class="action" width="8%">
                                    <a href="{{ url("partners/$partner->id/edit") }}" role="button" class="btn btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                    <a href="#" remove="{{ url("partner/destroy/$partner->id") }}" class="border-0 btn btn-outline-danger delete_btn" data-id="{{ $partner->id }}" title="Delete the user">
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
    </script>
@endpush
