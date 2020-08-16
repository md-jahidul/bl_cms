@extends('layouts.admin')
@section('title', 'Feed Category')
@section('card_name', 'Feed Category')
@section('breadcrumb')
    <li class="breadcrumb-item active">Feed Category List</li>
@endsection

@section('action')
    <a href="{{route('feeds.categories.create')}}" class="btn btn-primary round btn-glow px-2"><i
            class="la la-plus"></i>
        Create Category
    </a>
@endsection

@section('content')

    <section>
        <div class="card card-info mt-0" style="box-shadow: 0px 0px">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th><i class="icon-cursor-move icons"></i></th>
                            <th>ID</th>
                            <th>Parent</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                        @foreach ($categories as $index => $category)
                            <tr data-index="{{ $category->id }}" data-position="{{ $category->ordering }}">
                                <td><i class="icon-cursor-move icons"></i></td>
                                <td>{{$category->id}}</td>
                                <td>{{ $category->parent ? $category->parent->title : ''}}</td>
                                <td>{{$category->title}}</td>
                                <td>{{$category->slug}}</td>
                                <td>{{$category->status == 1 ? 'Active' : 'Inactive'}}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-2 m-1">
                                            <a role="button" title="Edit Feed Category"
                                               href="{{route('feeds.categories.edit',$category->id)}}"
                                               class="btn-pancil btn btn-outline-success">
                                                <i class="la la-pencil"></i>
                                            </a>
                                        </div>
                                        <div class="col-md-2 m-1">
                                            <button data-id="{{$category->id}}" title="Delete Feed Category" class="btn btn-outline-danger delete" onclick=""><i class="la la-trash"></i></button>
                                            <form id="delete-form-{{$category->id}}" action="{{route('feeds.categories.destroy',$category->id)}}" method="POST"
                                                  style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
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
    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">
    <style>
        #sortable tr td {
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
    </style>
@endpush
@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script>
        let auto_save_url = "{{ route('feeds.categories.update_position') }}";

        $(document).ready(function () {

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
