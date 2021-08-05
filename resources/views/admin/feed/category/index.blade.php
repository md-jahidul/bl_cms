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
                            <th>Status</th>
                            <th>Deep Link</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                        @foreach ($categories as $index => $category)

{{--                            {{ dd($category->dynamicLinks->link) }}--}}
                            <tr data-index="{{ $category->id }}" data-position="{{ $category->ordering }}">
                                <td><i class="icon-cursor-move icons"></i></td>
                                <td>{{$category->id}}</td>
                                <td>{{ $category->parent ? $category->parent->title : ''}}</td>
                                <td>{{$category->title}}</td>
                                <td>{{$category->slug}}</td>
                                <td>{{$category->status == 1 ? 'Active' : 'Inactive'}}</td>
                                <td class="deep-link-section-{{ $category->id }}">
                                    @if(isset($category->dynamicLinks))
                                        <button class="btn-sm btn-outline-default copy-deeplink cursor-pointer" type="button"
                                                data-toggle="tooltip" data-placement="button"
                                                data-value="{{ $category->dynamicLinks->link }}"
                                                title="Copy to Clipboard">Copy</button>
                                    @else
                                        <button class="btn-sm btn-icon btn-outline-success cursor-pointer create_deep_link remove-{{ $category->id }}"
                                                title="Click for deep link" data-value="{{ $category->slug }}"
                                                data-id="{{ $category->id }}">
                                            <i  class="la icon-link remove-{{ $category->id }}" data-id="{{ $category->id }}"></i>
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    <a role="button" title="Edit Feed Category"
                                       href="{{route('feeds.categories.edit',$category->id)}}"
                                       class="btn-pancil btn btn-outline-primary">
                                        <i class="la la-pencil"></i>
                                    </a>

                                    <button data-id="{{$category->id}}" title="Delete Feed Category" class="btn btn-outline-danger delete" onclick=""><i class="la la-trash"></i></button>
                                    <form id="delete-form-{{$category->id}}" action="{{route('feeds.categories.destroy',$category->id)}}" method="POST"
                                          style="display: none;">
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
    <script src="{{ asset('js/custom-js/deep-link.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.10/clipboard.min.js"></script>

    <script>
        let auto_save_url = "{{ route('feeds.categories.update_position') }}";
        let deep_link_create_url = "{{ url('feed-deeplink/create?') }}category=";

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
