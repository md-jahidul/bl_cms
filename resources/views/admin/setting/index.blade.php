@extends('layouts.admin')
@section('title', 'Settings')
@section('card_name', 'Settings')
{{--@section('breadcrumb')
    <li class="breadcrumb-item active">Settings List</li>
@endsection--}}

@section('content')
<div class="card mb-0 px-1" style="box-shadow:none;">
    <div class="card-content">
        <div class="card-body">
            <form class="form" method="POST" action="@if(isset($setting_info)) {{route('setting.update',$setting_info->id)}} @else {{route('setting.store')}} @endif" novalidate>
                @csrf
                @if(isset($setting_info))
                    @method('put')
                @else
                    @method('post')
                @endif
                <div class="form-body">
                    <h4 class="form-section"><i class="la la-key"></i>Add Settings</h4>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                    <label class="required">Settings key :
                                    </label>
                                    <div class="controls">
                                      <select name="setting_key_id" id="select" required class="form-control">
                                        <option value="">Select Settings Key</option>
                                        @foreach ($keys as $key)
                                            <option @if(isset($setting_info)) @if($setting_info->setting_key_id == $key->id) selected @endif @endif value="{{$key->id}}">{{$key->title}}</option>
                                        @endforeach
                                      </select>
                                    </div>

                                  </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="limit" class="required">Limit:</label>
                                <input
                                type="number"
                                required
                                maxlength="5"
                                data-validation-maxlength-message = "Limit can never be more then 5 digits"
                                data-validation-required-message="Limit is required"
                                @if(isset($setting_info)) value="{{$setting_info->limit}}"@else value="{{ old("limit") ? old("limit") : '' }}" @endif style="width:100%;height:100%" min="0" type="number" id="limit" class="form-control @error('limit') is-invalid @enderror" placeholder="Set Limit" name="limit">
                                <div class="help-block"> <small class="text-info">limit can never be more then 5 digits</small></div>
                                <small class="text-danger"> @error('limit') {{ $message }} @enderror </small>

                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group" style="margin-top:26px">
                                <button style="width:100%;height:100%" class="btn btn-outline-success my-2 my-sm-0" style="padding:7px 10px;width:100%" type="submit">Submit</button>
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
                        <th width="50%">Tittle</th>
                        <th width="10%">Limit</th>
                        <th width="30%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($settings as $setting)
                            <tr>
                                <td width="10%">{{$setting->id}}</td>
                                <td width="50%">{{$setting->settingsKey->title}}</td>
                                <td width="10%">{{$setting->limit}}</td>
                                <td width="30%">
                                    <div class="btn-group" role="group">
                                        <a role="button" data-toggle="tooltip" data-original-title="Edit Slider Information" data-placement="left" href="{{route('setting.edit',$setting->id)}}" class="btn-pancil btn btn-outline-success" >
                                            <i class="la la-pencil"></i>
                                        </a>
                                        <button data-id="{{$setting->id}}" data-toggle="tooltip" data-original-title="Delete Slider" data-placement="right" class="btn btn-outline-danger delete" onclick=""><i class="la la-trash"></i></button>
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
                            url: "{{ url('setting/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your Settings has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('setting/') }}"
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
