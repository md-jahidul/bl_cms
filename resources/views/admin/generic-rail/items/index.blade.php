@extends('layouts.admin')
@section('title', 'Items')

@section('action')
    <a href="{{route('generic-rail.items.create',$railId)}}" class="btn btn-info btn-glow px-2">
        Add Item
    </a>
    <a href="{{route('generic-rail.index')}}" class="btn btn-primary btn-glow px-2">
        Items list
    </a>
@endsection

@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
{{--                    <h4 class="pb-1"><strong>{{ ucwords($slider->title." ". "slider images") }}</strong>--}}
                    </h4>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <td width="3%"><i class="icon-cursor-move icons"></i></td>
                            <th width="5%">ID</th>
                            <th>Image</th>
                            <th width="15%">Title</th>
                            <th width="10%">Type</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody id="sortable-new">
                        @foreach($railItems as $index=>$item)
                            <tr data-index="{{ $item->id }}" data-position="{{ $item->sequence }}">
                                <td width="3%"><i class="icon-cursor-move icons"></i></td>
                                <td>{{ $item->id }}</td>
                                <td><img class="" src="{{ asset($item->icon) }}" alt="Item Image"
                                         height="100" width="200"/></td>
                                <td>{{ $item->title_en }}</td>
                                <td>{{ $item->user_type }}</td>
                                <td class="action">
                                    <div class="row justify-content-md-center no-gutters">
                                        <div class="col-md-3">
                                            <a role="button" title="Edit" href="{{route('generic-rail-items.edit', $item->id)}}" class="btn-pancil btn btn-outline-success" >
                                                <i class="la la-pencil"></i>
                                            </a>
                                        </div>

                                        <div class="col-md-3">
                                            <a href="#" remove="{{ url("generic-rail-item/destroy/$item->id") }}" class="btn btn-outline-danger delete_btn" data-id="{{ $railId }}" title="Delete">
                                                <i class="la la-trash"></i>
                                            </a>
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
@stop

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

        let auto_save_url = "{{ url('generic-rail-item/update-position') }}";

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
                        event.preventDefault();
                        document.getElementById(`delete-form-${id}`).submit();
                    }
                })
            })
        })

        $(document).ready(function () {
            $('#Example1').DataTable({
                //dom: 'Bfrtip',
                buttons: [],
                paging: true,
                searching: true,
                "bDestroy": true,
                "pageLength": 10,
            });
        });

    </script>
@endpush





