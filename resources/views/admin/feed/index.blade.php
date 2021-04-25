@extends('layouts.admin')
@section('title', 'Feed')
@section('card_name', 'Feed')
@section('breadcrumb')
    <li class="breadcrumb-item active">Feed List</li>
@endsection

@section('action')
    <a href="{{route('feeds.create')}}" class="btn btn-primary round btn-glow px-2"><i
            class="la la-plus"></i>
        Create Feed
    </a>
@endsection

@section('content')

    <section>
        <div class="card card-info mt-0" style="box-shadow: 0px 0px">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered zero-configuration"
                           role="grid" style="">
                        <thead>
                            <tr>
                                <th width="3%">#</th>
                                <th>Type</th>
                                <th>Category</th>
                                <th>Title</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Feed Seen</th>
                                <th width="12%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($feeds as $feed)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$feed->type}}</td>
                                <td>{{(isset($feed->category->title)?$feed->category->title:'')}}</td>
                                <td>{{(isset($feed->title)?$feed->title:'')}} {!! $feed->status == 0 ? '<span class="danger pl-1"><strong> ( Inactive )</strong></span>' : '' !!}</td>
                                <td>{{$feed->start_date}}</td>
                                <td>{{$feed->end_date}}</td>
                                <td>{{$feed->view_count}}</td>
                                <td>
                                    <a href="{{ route('feeds.edit',$feed->id) }}" role="button" class="btn-sm btn-outline-cyan border-0"><i class="la la-pencil" aria-hidden="true"></i></a>

                                    <button data-id="{{$feed->id}}" title="Delete Feed" class="btn-sm btn-outline-danger border-0 delete" onclick="">
                                        <i class="la la-trash"></i>
                                    </button>
                                    <form id="delete-form-{{$feed->id}}"
                                          action="{{route('feeds.destroy',$feed->id)}}"
                                          method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
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
    <link rel="stylesheet" type="text/css"
          href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
@endpush
@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js"
            type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js"
            type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            // $('#Example1').DataTable({
            //     buttons: [],
            //     paging: true,
            //     searching: true,
            //     "bDestroy": true,
            // });

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
                        event.preventDefault();
                        document.getElementById(`delete-form-${id}`).submit();
                    }
                })
            })
        });

    </script>
@endpush
