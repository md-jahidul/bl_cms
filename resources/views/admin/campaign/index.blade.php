@extends('layouts.master-layout')

@section('main-content')

    
    
    <div class="container-fluid pt-4">
    <div class="card">
        <div class="card-header">
            <h5 class="float-left"><b>Campaign list</b></h5>
            <a href="{{route('campaign.create')}}" role="button" class="btn btn-primary float-right">Create Page</a>
        </div>
        <div class="card-body">
            <table id="campaign_data" class="display">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Title</th>
                        <th>Tag</th>
                        <th>Start to End Date</th>
                        <th>Prize</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($campaigns as $campaign)
                        <tr>
                            <td>{{$campaign->id}}</td>
                            <td>{{$campaign->title}}</td>
                            <td>
                                @foreach ($campaign->tags as $tag)
                                    {{$tag->title}}
                                @endforeach
                            </td>
                            <td>{{$campaign->start_date}} To {{$campaign->end_date}}</td>
                            <td>{{$campaign->prizes->count()}}</td>
                            <td>
                                <a href="{{route('campaign.edit',$campaign->id)}}" role="button" class="btn btn-outline-info border-0"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                                <a href="{{route('campaign.show',$campaign->id)}}" role="button" class="btn btn-outline-success border-0"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                {{-- <a href="{{route('campaign.destroy',$campaign->id)}}" role="button" class="btn btn-primary">Delete</a> --}}
                                <a href="" onclick="showDelete('{{$campaign->id}}','{{$campaign->title}}')" id="delete_btn" data-toggle="modal" role="button" data-placement="right" title="Delete" role="button" class="border-0 btn btn-outline-danger"><i class="fas fa-trash" aria-hidden="true"></i></a>
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
            $('#campaign_data').DataTable();
        } );

        function showDelete(id,name){

        //to clear the url if its not given delete query will show bug when url is in edit 
        var uri = window.location.toString();
        if (uri.indexOf("campaign/")) {
            var clean_uri = uri.substring(0, uri.indexOf("campaign/"));
            window.history.replaceState({}, document.title, clean_uri);
        }
        //to clear the url if its not given delete query will show bug when url is in edit 

        $('#danger').modal("show");
        $("#modal-text").html("Are you sure you want to Move this Tag <srtong class='text-danger'>( "+ name +" )</srtong> to the trash ?");
        $('#deleteForm').attr('action', 'campaign/'+id)
        $('#deleteID').attr('value',id)
    }


    </script>
@endpush
