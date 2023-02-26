@extends('layouts.admin')
@section('title', 'Amar Offer')
@section('card_name', 'Amar Offer')
@section('breadcrumb')
    <li class="breadcrumb-item active">Amar Offer List</li>
@endsection
@section('action')
    <a href="{{route('amarOffer.create')}}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Create Amar Offer
    </a>
@endsection
@section('content')

    <section>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-10">
                        <h1 class="card-title pl-1">Amar Offer List</h1>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-bordered">
                <thead>
                <tr width="100%">
                    <th width="25%" class="text-center">Amar Offer Incident</th>
                    <td class="action">
                        @if(!$amarOfferIncident)
                            <a href="{{ route("amar-offer-incident.status.update") }}" data-value="enable  {{ "Amar Offer Incident" }}"
                               class="btn btn-danger border-0 change_status" title="Click to enable">Disabled</a>
                        @else
                            <a href="{{ route("amar-offer-incident.status.update") }}" data-value="disable {{ "Amar Offer Incident" }}"
                               class="btn btn-success border-0 change_status" title="Click to disable">Enabled</a>
                        @endif
                    </td>
                </tr>
                <tr width="100%">
                    <th width="25%" class="text-center">Amar Offer 2.0 Incident </th>
                    <td class="action">
                        @if(!$amarOfferIncidentV2)
                            <a href="{{ route("amar-offer2-incident.status.update") }}" data-value="enable  {{ "Amar Offer 2.0 Incident" }}"
                               class="btn btn-danger border-0 change_status" title="Click to enable">Disabled</a>
                        @else
                            <a href="{{ route("amar-offer2-incident.status.update") }}" data-value="disable {{ "Amar Offer 2.0 Incident" }}"
                               class="btn btn-success border-0 change_status" title="Click to disable">Enabled</a>
                        @endif
                    </td>
                </tr>
                </thead>
            </table>
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered alt-pagination no-footer dataTable"
                           id="Example1" role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th width="10%">ID</th>
                            <th width="30%">Name</th>
                            <th width="20%">Product Code</th>
                            <th width="10%">Price</th>
                            <th width="10%">Validity</th>
                            <th width="10%">Validity Unit</th>
                            <th width="10%">Status</th>
                            <th width="20%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($amarOffers as $amarOffer)
                            <tr>
                                <td width="10%">{{$amarOffer->id}}</td>
                                <td width="30%">{{$amarOffer->name}}</td>
                                <td width="20%">{{$amarOffer->product_code}}</td>
                                <td width="10%">{{$amarOffer->price}}</td>
                                <td width="10%">{{$amarOffer->validity}}</td>
                                <td width="10%">{{$amarOffer->validity_unit}}</td>
                                <td width="10%">{{$amarOffer->status == 1 ? "Active" : "Inactive"}}</td>
                                <td width="20%">
                                    <div class="btn-group" role="group">
                                        {{--                                        <a role="button" href="{{route('amarOffer.show',$amarOffer->id)}}" class="btn btn-outline-info">--}}
                                        {{--                                            <i class="la la-info"></i>--}}
                                        {{--                                        </a>--}}
                                        <a role="button" href="{{route('amarOffer.edit',$amarOffer->id)}}" class="btn btn-outline-success">
                                            <i class="la la-pencil"></i>
                                        </a>
                                        <button data-id="{{$amarOffer->id}}" class="btn btn-outline-danger delete" onclick=""><i class="la la-trash"></i></button>
                                    </div>

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
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
    <style></style>
@endpush
@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js" type="text/javascript"></script>
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
                            url: "{{ url('amarOffer/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('amarOffer/') }}"
                                }
                            }
                        })
                    }
                })
            })
        })
        $('.change_status').click(function (event) {
            event.preventDefault()
            let status = $(this).attr('data-value');
            let url = $(this).attr('href');
            var confirmPopupParams = {
                title: 'Are you sure?',
                text: "You want to " + status,
                type: 'warning',
                // html: jQuery().html(),
                showCancelButton: true,
                confirmButtonColor: '#77ba6a',
                cancelButtonColor: '#a9afa9',
                confirmButtonText: 'Yes'
            };

            var successPopupParams = {
                title: 'Updated!',
                text: 'Amar Offer Incident Status Changed Successfully',
                type: 'success'
            }

            Swal.fire(confirmPopupParams).then((result) => {
                if (result.value) {
                    Swal.fire(successPopupParams);
                    setTimeout(function(){
                        window.location.replace(url)
                    }, 2000)
                }
            })
        });
        $(document).ready(function () {
            $('#Example1').DataTable({
                //dom: 'Bfrtip',
                buttons: [],
                paging: true,
                searching: true,
                "pageLength": 10,
                "bDestroy": true,
                "order": [[ 0, "desc" ]]
            });
        });
    </script>
@endpush
