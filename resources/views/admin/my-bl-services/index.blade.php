@extends('layouts.admin')
@section('title', 'Services')
@section('card_name', 'Services List')
@section('breadcrumb')
    <li class="breadcrumb-item active">Services List</li>
@endsection
@section('action')
    <a href="{{route('my-bl-services.create')}}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Create Services
    </a>
@endsection
@section('content')
    <section>

        <div class="card card-info mt-0" style="box-shadow: 0 0">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered"
                           role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th width="10%">ID</th>
                            <th width="40%">Tittle</th>
                            <th width="20%">Status</th>
                            <th width="30%">Action</th>
                        </tr>
                        </thead>
                        <tbody id="sortable-new">
                            @foreach ($services as $service)
                                <tr data-index="{{ $service->id }}" data-position="{{ $service->sequence }}">
                                    <td width="10%">{{$service->id}}</td>
                                    <td width="20%">{{$service->title_en}}</td>
                                    <td width="20%">{{$service->status==1?'Active':'Inactive'}}</td>
                                    <td width="30%">
                                        <div class="row justify-content-md-center no-gutters">
                                            <div class="col-md-3">
                                                <a role="button" title="Edit" href="{{route('my-bl-services.edit',$service->id)}}" class="btn-pancil btn btn-outline-success" >
                                                    <i class="la la-pencil"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-3">
                                                <a role="button" title="View child items" href="{{route('my-bl-services.items.index',$service->id)}}"
                                                   class=" btn btn-outline-success">
                                                    <i class="la la-picture-o"></i>
                                                </a>

                                            </div>
                                            <div class="col-md-3">
                                                <a href="#" remove="{{ url("my-bl-services/destroy/$service->id") }}" class="btn btn-outline-danger delete_btn" data-id="{{ $service->id }}" title="Delete">
                                                    <i class="la la-trash"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr></tr>
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
    <script>

        let auto_save_url = "{{ url('myblService-addService/update-position') }}";

        $(document).ready(function () {
            $(document).on('click', '.del', function (e) {
                e.preventDefault();

                let id = $(this).data('id');
                console.log(id);

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
                    console.log(result);
                    if (result.value) {
                        console.log("#del_form_" + id)
                        $("#del_form_" + id).submit();
                    }
                })
            })

        });

    </script>
@endpush
