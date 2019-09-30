@extends('layouts.admin')
@section('title', 'Help Center')
@section('card_name', 'Help Center')
@section('breadcrumb')
    <li class="breadcrumb-item active">Help Center List</li>
@endsection
@section('action')
    <a href="{{route('helpCenter.create')}}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Create Help Center
    </a>
@endsection
@section('content')

    <section>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-10">

                        <h1 class="card-title pl-1">
                            <h4 class="form-section"><i class="la la-stethoscope"></i> Help Center List</h4>
                            <small class="text-success text-uppercase"><b>Drag the list to change the sequence</b></small>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered alt-pagination no-footer dataTable"
                           id="Example1" role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th width='10%'>Drag</th>
                            <th width='20%'>Title</th>
                            <th width='15%'>Redirect Link</th>
                            <th width='10%'>Sequence</th>
                            <th width='15%'>Icon</th>
                            <th width='30%'>Action</th>
                        </tr>
                        </thead>
                        <tbody id="list">
                        @foreach ($helpCenters as $helpCenter)

                            <tr style="cursor:all-scroll" data-position = "{{$helpCenter->sequence}}" data-index="{{$helpCenter->id}}">
                                <td width='10%'><i class="icon-cursor-move icons"></i></td>
                                <td width='20%'>{{$helpCenter->title}}</td>
                                <td width='15%'>{{$helpCenter->redirect_link}}</td>
                                <td width='10%'>{{$helpCenter->sequence}}</td>
                                <td width='15%'><img src="{{asset($helpCenter->icon)}}" style="height:50px;width:100px" alt=""></td>
                                <td width='30%'>
                                    <div class="row">
                                        <div class="col-md-2 mr-1">
                                            <a role="button" href="{{ route('helpCenter.edit',$helpCenter->id)}}" class="btn btn-outline-success">
                                                <i class="la la-pencil"></i>
                                            </a>
                                        </div>
                                        <div class="col-md-2">
                                            <button data-id="{{$helpCenter->id}}" class="btn btn-outline-danger delete" onclick=""><i class="la la-trash"></i></button>
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
                            url: "{{ url('helpCenter/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('helpCenter/') }}"
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
                "pageLength": 10,
                "bDestroy": true,
            });
        });

        // -------------------------------------------------
        // -------------------position----------------------
        // -------------------------------------------------
        $(document).ready( function() {
            $( "#list" ).sortable({
                update:function(event,ui){
                   $(this).children().each(function(index){
                       if($(this).attr('data-position')!=(index+1)){
                        $(this).attr('data-position',index+1).addClass('update');
                        console.log(index)
                       }
                   });
                   saveNewPosition();
                }
            });

           function saveNewPosition(){
               var position = [];
               $('.update').each(
                   function(){
                        position.push([$(this).attr('data-index'),$(this).attr('data-position')]);
                        //$this.removeClass('update');
                })
                console.log(position)
                $.ajax({
                    url:"{{url("help_Center/update-position")}}",
                    methoder:'get',
                    dataType:'text',
                    data:{
                        update:1,
                        positions:position
                    },
                    success:function (data){
                        if(data=="success"){
                            console.log("yes")
                            document.location.reload()
                        }
                        console.log(data)
                    }
                })
           }
           
        } );
        // -------------------------------------------------
        // -------------------position----------------------
        // -------------------------------------------------
    </script>
@endpush