@extends('layouts.admin')
@section('title', 'Setting')
@section('card_name', 'Setting')
@section('breadcrumb')
    <li class="breadcrumb-item active">Setting</li>
@endsection

@section('content')
<div class="card mb-0 px-1" style="box-shadow:none;">        
    <div class="card-content">
        <div class="card-body">
            <form class="form" method="POST" action="@if(isset($setting_info)) {{route('setting.update',$setting_info->id)}} @else {{route('setting.store')}} @endif">
                @csrf
                @if(isset($setting_info)) 
                    @method('put')
                @else
                    @method('post')
                @endif
                <div class="form-body">
                    <h4 class="form-section">Setting Key</h4>
                    <div class="row">
                        <div class="col-md-5">
                           <label for="key">Key:</label>
                            <select name="setting_key_id" class="form-control" id="key">
                               @foreach ($keys as $key)
                                    <option @if(isset($setting_info)) @if($setting_info->setting_key_id == $key->id) selected @endif @endif value="{{$key->id}}">{{$key->title}}</option>
                               @endforeach
                            </select>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                 <label for="limit">Limit:</label>
                                <input @if(isset($setting_info)) value="{{$setting_info->limit}}" @endif style="width:100%;height:100%" min="0" type="number" id="limit" class="form-control" placeholder="Insert Title.." name="limit">
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
                        <th width="100">id</th>
                        <th>Tittle</th>
                        <th width="80">Limit</th>
                        <th width="280">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($settings as $setting)
                            <tr>
                                <td>{{$setting->id}}</td>
                                <td>{{$setting->settingsKey->title}}</td>
                                <td>{{$setting->limit}}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <a role="button" data-toggle="tooltip" data-original-title="Edit Slider Information" data-placement="left" href="{{route('setting.edit',$setting->id)}}" class="btn-pancil btn btn-outline-success" >
                                                <i class="la la-pencil"></i>
                                            </a>
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <button data-id="{{$setting->id}}" data-toggle="tooltip" data-original-title="Delete Slider" data-placement="right" class="btn btn-outline-danger delete" onclick=""><i class="la la-trash"></i></button>
                                        </div>
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
                                    'Your file has been deleted.',
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