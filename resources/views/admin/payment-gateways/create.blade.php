@extends('layouts.admin')
@section('title', 'PGW Gateways')
@section('card_name', 'PGW Gateways')

@section('content')
    <div class="card mb-0 px-1" style="box-shadow:none;">
        <div class="card-content">
            <div class="card-body">
                <form class="form" method="POST" action="{{route('payment-gateways.store')}}"  enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    <div class="form-body">
                        <h4 class="form-section"><i class="la la-key"></i>Add PGW Gateway</h4>
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
                                            <option value="301" @if(isset($pgwGateways_info) && $pgwGateways_info->gateway_id == 301) selected @endif>SSL</option>
                                            <option value="211" @if(isset($pgwGateways_info) && $pgwGateways_info->gateway_id == 211) selected @endif>bKash One Tap</option>
                                            <option value="601" @if(isset($pgwGateways_info) && $pgwGateways_info->gateway_id == 601) selected @endif>PortPOS</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
{{--                            <div class="col-md-4">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="required">Payment Gateway Type :--}}
{{--                                    </label>--}}
{{--                                    <div class="controls">--}}
{{--                                        <input type='text' class="form-control" name="type" id="type"--}}
{{--                                               value="@if(isset($pgwGateways_info)){{$pgwGateways_info->type}}@endif"--}}
{{--                                               placeholder="Please Enter Payment Gateway Type" required />--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="required">Currency :
                                    </label>
                                    <div class="controls">
                                        <input type='text' class="form-control" name="currency" id="currency"
                                               value="@if(isset($pgwGateways_info)){{$pgwGateways_info->currency}}@else BDT @endif"
                                               placeholder="Please Enter Currency" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="required">Payment Gateway Status :
                                    </label>
                                    <div class="controls">
                                        <select name="status" id="select" required class="form-control">
                                            <option value="1"
                                                    @if(isset($pgwGateways_info) && $pgwGateways_info->status == 1) selected @endif
                                            >Active</option>
                                            <option value="0" @if(isset($pgwGateways_info) && $pgwGateways_info->status == 0) selected @endif>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Web Logo URL:
                                    </label>
                                    <div class="controls">
                                        <input type="file"
                                               id="logo_web"
                                               name="logo_web"
                                               class="dropify"
                                               data-allowed-file-extensions='["jpg", "jpeg", "png"]'
                                               data-default-file="{{ isset($pgwGateways_info->logo_web) ? asset($pgwGateways_info->logo_web) : ""}}"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label >Mobile Logo URL :
                                    </label>
                                    <div class="controls">
                                        <input type="file"
                                               id="logo_mobile"
                                               name="logo_mobile"
                                               class="dropify"
                                               data-allowed-file-extensions='["jpg", "jpeg", "png"]'
                                               data-default-file="{{ isset($pgwGateways_info->logo_mobile) ? asset($pgwGateways_info->logo_mobile) : ""}}"
                                        />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Mobile Logo V2 :
                                    </label>
                                    <div class="controls">
                                        <input type="file"
                                               id="logo_mobile_v2"
                                               name="logo_mobile_v2"
                                               class="dropify"
                                               data-allowed-file-extensions='["jpg", "jpeg", "png"]'
                                               data-default-file="{{ isset($pgwGateways_info->logo_mobile_v2) ? asset($pgwGateways_info->logo_mobile_v2) : ""}}"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('android_version_code') ? ' error' : '' }}">
                                <label for="title" class="required">Android Version Code</label>
                                <input type="text" name="android_version_code"  class="form-control" placeholder="Enter Version Code"
                                       required data-validation-required-message="Enter Version Code">
                                <div class="help-block"></div>
                                <span class="text-info"><strong><i class="la la-info-circle"></i></strong> Version code should be Hyphen-separated value. Example: 10-99</span>
                                <div class="help-block"></div>
                                @if ($errors->has('android_version_code'))
                                    <div class="help-block">  {{ $errors->first('android_version_code') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('ios_version_code') ? ' error' : '' }}">
                                <label for="title" class="required">iOS Version Code</label>
                                <input type="text" name="ios_version_code"  class="form-control" placeholder="Enter Version Code"
                                       required data-validation-required-message="Enter Version Code">
                                <div class="help-block"></div>
                                <span class="text-info"><strong><i class="la la-info-circle"></i></strong> Version code should be Hyphen-separated value. Example: 10-99</span>
                                <div class="help-block"></div>
                                @if ($errors->has('ios_version_code'))
                                    <div class="help-block">  {{ $errors->first('ios_version_code') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('percentage_of_user') ? ' error' : '' }}">
                                <label for="title">Percentage Of User</label>
                                <input type="number" name="percentage_of_user"  class="form-control" placeholder="Enter Percentage Of User">
                                @if ($errors->has('percentage_of_user'))
                                    <div class="help-block">  {{ $errors->first('percentage_of_user') }}</div>
                                @endif
                            </div>
                            <!-- <div class="col-md-3">
                            <div class="form-group">
                                <label class="required">Payment Gateway Status :
                                </label>
                                <div class="controls">
                                    <input type="checkbox" name="status" value="1" id="status" @if(isset($pgwGateways_info) && $pgwGateways_info->status == 1) checked @endif >
                                </div>
                            </div>
                        </div> -->
                            <div class="col-md-10"></div>
                            <div class="col-md-2 " style="float: right;">
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
@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <style></style>
@endpush
@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
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

        $('.dropify').dropify({
            messages: {
                'default': 'Browse for an Icon to upload',
                'replace': 'Click to replace',
                'remove': 'Remove',
                'error': 'Choose correct Icon file'
            },
            error: {
                'imageFormat': 'The image ratio must be 1:1.'
            }
        });

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
