@extends('layouts.master-layout')

@section('main-content')

    
    
    <div class="container-fluid py-5">
    <div class="card">
        <div class="card-header">
            <h5 class="float-left"><b>Digital Service list</b></h5>
            <a href="{{route('digital_service.create')}}" role="button" class="btn btn-primary float-right">Add Digital Service</a>
        </div>
        <div class="card-body">
            <table id="digital_service_data" class="display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr>
                            <td>{{$service->id}}</td>
                            <td><img height="50" width="100" src="{{asset('stora'.$service->image)}}" alt="" srcset=""></td>
                            <td>{{$service->title}}</td>
                            <td>{{$service->price}}</td>
                            <td>
                                <a href="{{route('digital_service.edit',$service->id)}}" role="button" class="btn btn-outline-info border-0"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                                <a href="{{route('digital_service.show',$service->id)}}" role="button" class="btn btn-outline-success border-0"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                <a href="" onclick="showDelete('{{$service->id}}','{{$service->title}}')" id="delete_btn" data-toggle="modal" role="button" data-placement="right" title="Delete" role="button" class="border-0 btn btn-outline-danger"><i class="fas fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    
    </div>
    




    
<div class="modal fade" id="danger" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header bg-danger text-light">
                <h1><i class="glyphicon glyphicon-thumbs-up"></i>Delete</h1>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            
            <form id="deleteForm" action="" method="post">
                @csrf
                @method('delete')
                <div class="modal-body">
                    <p id="modal-text" class="text-center font-weight-bold "></p>
                    <input name="id" id="deleteID" type="hidden" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-info pull-left" data-dismiss="modal">Close</button>
                    <button type="Submit" class="btn btn-outline-danger pull-left">Delete</button>
                </div>
            </form>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Modal -->

     
@stop
@push('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
@endpush
@push('scripts')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready( function () {
            $('#digital_service_data').DataTable();
        } );

        function showDelete(id,name){

        //to clear the url if its not given delete query will show bug when url is in edit 
        var uri = window.location.toString();
        if (uri.indexOf("digital_service/")) {
            var clean_uri = uri.substring(0, uri.indexOf("digital_service/"));
            window.history.replaceState({}, document.title, clean_uri);
        }
        //to clear the url if its not given delete query will show bug when url is in edit 

        $('#danger').modal("show");
        $("#modal-text").html("Are you sure you want to Move this Tag <srtong class='text-danger'>( "+ name +" )</srtong> to the trash ?");
        $('#deleteForm').attr('action', 'digital_service/'+id)
        $('#deleteID').attr('value',id)
    }




    </script>
@endpush
