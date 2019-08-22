@extends('layouts.master-layout')

@section('main-content')

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    
    <div class="container-fluid pt-4">
    <div class="card">
        <div class="card-header">
            @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
            @endif
            @if(session()->has('delete'))
                <div class="alert alert-danger">
                    {{ session()->get('delete') }}
                </div>
            @endif
        </div>
        <div class="card-body">
            <form action="{{ isset($tag) ? route('tag.update',$tag->id):route('tag.store')}}" method="post">
                @csrf
                @if(isset($tag))
                    @method('PUT')
                @endif
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            @php
                             $tag_name = isset($tag) ? $tag->title : null;
                            @endphp
                            <label for="tag">tag</label>
                            <input type="tag" value="{{$tag_name}}" name="title" class="form-control" id="tag" placeholder="Enter Tag..">
                        </div>

                    </div>
                   
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary" style="margin-top:35px">
                            @if(isset($tag))
                                Update Tag
                                @else                        
                                Add Tag
                            @endif
                        </button>

                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5><b>Tag List</b></h5>

        </div>
        <div class="card-body">
            <table id="tag_data" class="display">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Tag</th>
                        <th>Slug</th>
                        <th>Count</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $key=>$tag)
                        @php(++$key)
                        <tr>
                            <td>{{ $key }}</td>
                            <td>{{$tag->title}}</td>
                            <td>{{$tag->slug}}</td>
                            <td>{{$tag->campaigns->count()}}</td>
                            <td>
                                <a href="{{route('tag.edit',$tag->id)}}" role="button" class="btn btn-outline-info border-0"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                                <a href="{{route('tag.show',$tag->id)}}" role="button" class="btn btn-outline-success border-0"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                {{-- <a href="{{route('campaign.destroy',$campaign->id)}}" role="button" class="btn btn-primary">Delete</a> --}}
                                <a href="" onclick="showDelete('{{$tag->id}}','{{$tag->title}}')" id="delete_btn" data-toggle="modal" role="button" data-placement="right" title="Delete" class="border-0 btn btn-outline-danger"><i class="fas fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

    {{--User Create Modal--}}
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{--{{ isset($tag) ? route('tag.update',$tag->id):route('tag.store')}}--}}" method="post">
                    @csrf
                    @if(isset($tag))
                        @method('PUT')
                    @endif
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                @php
                                    $tag_name = isset($tag) ? $tag->title : null;
                                @endphp
                                <label for="tag">tag</label>
                                <input type="tag" value="{{$tag_name}}" name="title" class="form-control" id="tag" placeholder="Enter Tag..">
                            </div>

                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary" style="margin-top:35px">
                                @if(isset($tag))
                                    Update Tag
                                @else
                                    Add Tag
                                @endif
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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
            $('#tag_data').DataTable();
        } );

        function showDelete(id,name){

        //to clear the url if its not given delete query will show bug when url is in edit 
        var uri = window.location.toString();
        if (uri.indexOf("tag/")) {
            var clean_uri = uri.substring(0, uri.indexOf("tag/"));
            window.history.replaceState({}, document.title, clean_uri);
        }
        //to clear the url if its not given delete query will show bug when url is in edit 

        $('#danger').modal("show");
        $("#modal-text").html("Are you sure you want to Move this Tag <srtong class='text-danger'>( "+ name +" )</srtong> to the trash ?");
        $('#deleteForm').attr('action', 'tag/'+id)
        $('#deleteID').attr('value',id)
    }

    </script>
@endpush
