@extends('layouts.admin')
@section('title', 'Agent')
@section('card_name', 'Agent')
@section('breadcrumb')
    <li class="breadcrumb-item active">Agent deeplink List</li>
@endsection
@section('action')
    <a href="{{ url('deeplink/agent/list') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Agent List </a>
@endsection
@section('content')
    <section>
        <div class="card card-info mt-0" style="box-shadow: 0px 0px">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <form novalidate class="form row" action="{{route('agent.deeplink.store')}}" method="POST">
                        @csrf
                        @method('post')
                        <div class="form-group col-12 mb-2 file-repeater">
                            <input value="{{$agentId}}"  type="hidden" name="agent_id">
                            <div class="row mb-1">
                                <div class="form-group col-md-4 mb-2">
                                    <label for="parent" class="required">Deeplink Type:</label>
                                    <select id="parent" name="deeplink_type" class="browser-default custom-select" required>
                                        <option value="">--None--</option>
                                        @foreach ($deeplinkTypeList as $key=>$type)
                                            <option value="{{ $key }}">
                                                {{ $type}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group col-md-6 mb-2">
                                    <label for="product_code" class="required productCode">Product Code:</label>
                                    <input id="product_code" type="text" class="productCode form-control" placeholder="Product Code" name="product_code">
                                    <small class="text-danger"> @error('product_code') {{ $message }} @enderror </small>
                                    <div class="help-block"></div>
                                </div>

                                <div class="form-group col-md-2 mb-2">
                                    <button style="float: right" type="submit" id="submitForm"
                                            class="btn btn-success round px-2 mt-1">
                                        <i class="la la-check-square-o"></i> Generate
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="card card-info mt-0" style="box-shadow: 0px 0px">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard table-responsive">
                    <table class="table table-striped table-bordered " id="Example1" role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="10%">Product code</th>
                            <th width="10%">Deeplink</th>
                            <th width="10%">Type</th>
                            <th width="7%">Total</th>
                            <th width="7%">Buy</th>
                            <th width="7%">Failure</th>
                            <th width="7%">Cancel</th>
                            <th width="5%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($deeplinkList as $key=>$info)
                        <tr>
                            <td width="5%">{{$key+1}}</td>
                            <td width="10%">{{$info->product_code}}</td>
                            <td width="10%">{{$info->deep_link}}</td>
                            <td width="10%"><b>{{strtoupper($info->deeplink_type)}}</b></td>
                            <td width="7%">{{$info->total_buy+$info->total_cancel+$info->buy_attempt}}</td>
                            <td width="7%">{{$info->total_buy}}</td>
                            <td width="7%">{{$info->total_cancel}}</td>
                            <td width="7%">{{$info->buy_attempt}}</td>
                            <td width="7%">
                                <a href="{{route('agent.deeplink.item.delete',[$info->agent_id,$info->id])}}" class="btn btn-sm btn-outline-danger  mr-1" onclick="return showDelete({{$info->id}})">
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
        $(document).ready(function () {
            $('.custom-select').on('change', function (){
                if(this.value=='signup'){
                    $('.productCode').removeClass("required");
                    $('input[name=product_code]').prop('required',false);
                    $('#product_code').attr("disabled", "disabled");
                }else{
                    $('#product_code').prop('required',true);
                    $("#product_code").attr('disabled', false);
                    $('.productCode').addClass("required");
                }
            });

            $('#Example1').DataTable({
                dom: 'Bfrtip',
                buttons: [],
                paging: true,
                searching: false,
                "bDestroy": true,
                "pageLength": 10,
                // "order": [[ 0, "desc" ]],
                orderable:false
            });
        });
        function showDelete(id){
            var result = confirm("You won't be delete this?");
            if (result) {
                return true;
            }else {
                return false;
            }
        }
    </script>
@endpush

