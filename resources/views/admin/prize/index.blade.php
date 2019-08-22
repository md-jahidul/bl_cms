@extends('layouts.master-layout')

@section('main-content')

    
    
    <div class="container-fluid pt-4">
    <div class="card">
        <div class="card-header">
            <h5 class="float-left"><b>Prize List</b></h5>
            <a href="{{route('prize.create')}}" role="button" class="btn btn-primary float-right"><i class="fa fa-plus"></i> Create Prize</a>
        </div>
        <div class="card-body">
            <table id="prize_data" class="display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Campaign</th>
                        <th>Product</th>
                        <th>Position</th>
                        <th>Reword</th>
                        <th>Validity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prizes as $prize)
                       
                        <tr>
                            <td>{{$prize->id}}</td>
                            <td>{{$prize->title}}</td>
                            <td>{{$prize->campaign->title}}</td>
                            <td>{{$prize->product_id}}</td>
                            <td>{{$prize->position}}</td>
                            <td>{{$prize->reword}}</td>
                            <td>{{$prize->validity}}</td>
                            <td>
                                <a href="{{route('prize.edit',$prize->id)}}" role="button" class="btn btn-outline-info border-0"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                                <a href="{{route('prize.show',$prize->id)}}" role="button" class="btn btn-outline-success border-0"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                <a href="" onclick="showDelete('{{$prize->id}}','{{$prize->title}}')" id="delete_btn" data-toggle="modal" role="button" data-placement="right" title="Delete" role="button" class="border-0 btn btn-outline-danger"><i class="fas fa-trash" aria-hidden="true"></i></a>
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
            $('#prize_data').DataTable();
        } );

        function showDelete(id,name){

        //to clear the url if its not given delete query will show bug when url is in edit 
        var uri = window.location.toString();
        if (uri.indexOf("prize/")) {
            var clean_uri = uri.substring(0, uri.indexOf("prize/"));
            window.history.replaceState({}, document.title, clean_uri);
        }
        //to clear the url if its not given delete query will show bug when url is in edit 

        $('#danger').modal("show");
        $("#modal-text").html("Are you sure you want to Move this Tag <srtong class='text-danger'>( "+ name +" )</srtong> to the trash ?");
        $('#deleteForm').attr('action', 'prize/'+id)
        $('#deleteID').attr('value',id)
    }




    </script>
@endpush
