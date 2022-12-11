@extends('layouts.admin')
@section('title', 'PGW Gateways')
@section('card_name', 'PGW Gateways')
{{--@section('breadcrumb')
    <li class="breadcrumb-item active">PGW Gateway List</li>
@endsection--}}

@section('content')
<div class="card mb-0 px-1" style="box-shadow:none;">
    <div class="card-content">
        <div class="card-body">
            <form class="form" method="POST" action="@if(isset($pgwGateways_info)) {{route('pgw-gateway.update',$pgwGateways_info->id)}} @else {{route('pgw-gateway.store')}} @endif" novalidate>
                @csrf
                @if(isset($pgwGateways_info))
                    @method('put')
                @else
                    @method('post')
                @endif
                <div class="form-body">
                    <h4 class="form-section"><i class="la la-key"></i> @if(isset($pgwGateways_info)) Edit @else Add @endif PGW Gateway</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="required">Payment Gateway :
                                </label>
                                <div class="controls">
                                    <select name="gateway_id" id="select" required class="form-control">
                                    <option value="">Select Payment Gateway</option>
                                    <option value="201" 
                                    @if(isset($pgwGateways_info) && $pgwGateways_info->gateway_id == 201) selected @endif
                                    >bKash</option>
                                    <option value="101" @if(isset($pgwGateways_info) && $pgwGateways_info->gateway_id == 101) selected @endif>Visa/Master</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="required">Currency :
                                </label>
                                <div class="controls">
                                <input type='text' class="form-control" name="currency" id="currency"
                                    value="@if(isset($pgwGateways_info)){{$pgwGateways_info->currency}}@else BDT @endif" 
                                    placeholder="Please Enter Currency" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="required">Web Logo URL:
                                </label>
                                <div class="controls">
                                <input type='text' class="form-control" name="logo_web" id="logo_web"
                                    value="@if(isset($pgwGateways_info)){{$pgwGateways_info->logo_web}}@endif" 
                                     placeholder="Please Enter Web Logo URL" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="required">Mobile Logo URL :
                                </label>
                                <div class="controls">
                                <input type='text' class="form-control" name="logo_mobile" id="logo_mobile" 
                                    value="@if(isset($pgwGateways_info)){{$pgwGateways_info->logo_mobile}}@endif" 
                                    placeholder="Please Enter Mobile Logo URL" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="required">Payment Gateway Status :
                                </label>
                                <div class="controls">
                                    <input type="checkbox" name="status" value="1" id="status" @if(isset($pgwGateways_info) && $pgwGateways_info->status == 1) checked @endif >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group" style="margin-top:26px">
                                <button style="width:100%;height:100%" class="btn btn-outline-success my-2 my-sm-0" style="padding:7px 10px;width:100%" type="submit"> @if(isset($pgwGateways_info)) Update @else Submit @endif </button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<section>
    <div class="card card-info mt-0" style="box-shadow: 0px 0px">
        <div class="card-content">
            <div class="card-body card-dashboard">
                <table class="table table-striped table-bordered alt-pagination no-footer dataTable" id="Example1" role="grid" aria-describedby="Example1_info" style="">
                    <thead>
                    <tr>
                        <th width="10%">id</th>
                        <th width="50%">Gateway Name</th>
                        <th width="10%">Gateway Type</th>
                        <th width="10%">Gateway Status</th>
                        <th width="30%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($pgwGateways as $pgwGateway)
                            <tr>
                                <td width="10%">{{$pgwGateway->id}}</td>
                                <td width="50%">{{$pgwGateway->gateway_name}}</td>
                                <td width="10%">{{$pgwGateway->type}}</td>
                                <td width="10%">{{($pgwGateway->status) ? 'Active' : 'Inactive'}}</td>
                                <td width="30%">
                                    <div class="btn-group" role="group">
                                        <a role="button" data-toggle="tooltip" data-original-title="Edit Slider Information" data-placement="left" href="{{route('pgw-gateway.edit',$pgwGateway->id)}}" class="btn-pancil btn btn-outline-success" >
                                            <i class="la la-pencil"></i>
                                        </a>
                                        <button data-id="{{$pgwGateway->id}}" data-toggle="tooltip" data-original-title="Delete Slider" data-placement="right" class="btn btn-outline-danger delete" onclick=""><i class="la la-trash"></i></button>
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
                            url: "{{ url('pgw-gateway/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your Pgw-gateway has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('pgw-gateway/') }}"
                                }
                            }
                        })
                    }
                })
            })
        })




        $(document).ready(function () {
            $('#Example1').DataTable({
                dom: 'Bfrtip',
                buttons: [],
                paging: true,
                searching: true,
                "bDestroy": true,
                "pageLength": 10
            });
        });

    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
    <script>

    </script>
@endpush
