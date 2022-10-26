@extends('layouts.admin')
@section('title', 'Content Deeplink List')
@section('card_name', 'Content Deeplink')
@section('breadcrumb')
    <li class="breadcrumb-item active">Content & Course Deeplink List</li>
@endsection

@section('content_header')
    <h1 class="content-header-title mb-0 d-inline-block">
        Content Deeplink List
    </h1>
@endsection

@section('content')
    <!-- /sNavigation Rail add form -->
    <section>
        <form
            action="  {{route('content-deeplink.store')}}  "
            method="post" enctype="multipart/form-data">
            @csrf
            @method('post')
            <div class="container-fluid">
                <div class="row px-1 pt-1">
                    <h4 class="form-section col-md-12">
                        @if(isset($contentDeeplinkItem))
                            Update
                        @else
                            Create
                        @endif
                    </h4>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="eventInput3">Category</label>
                            <select name="category_name" class="form-control">
                                <option value="games" >Games</option>
                                <option value="musics">Musics</option>
                                <option value="courses">Courses</option>
                            </select>
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <label for="category_name" class="required">Category Name:</label>--}}
{{--                            <input required--}}
{{--                                   type="text" name="category_name" class="form-control @error('title_en') is-invalid @enderror"--}}
{{--                                   id="category_name" placeholder="Enter Category Name">--}}
{{--                            <small class="text-danger"> @error('category_name') {{ $message }} @enderror </small>--}}
{{--                        </div>--}}
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="detail_id" class="required">ID :</label>
                            <input
                                   type="text" name="detail_id" class="form-control @error('detail_id') is-invalid @enderror"
                                   id="detail_id" placeholder="Enter Valid ID">
                            <small class="text-danger"> @error('detail_id') {{ $message }} @enderror </small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label></label>
                        <small class="text-danger"> @error('other_info') {{ $message }} @enderror </small>
                            <button type="submit" id="submitForm" style="width:100%" class="btn btn-success">Add New</button>
                    </div>
                </div>
            </div>
        </form>

        <div class="card col-sm-12">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="menu-title">Course Deeplink List</h4>
                    <table class="table table-striped table-bordered" id="Example1"
                           role="grid" aria-describedby="Example1_info">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category Name</th>
                            <th>ID</th>
                            <th>Slug</th>
                            <th>Dynamic Link</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($contentDeeplinkItem as $key => $item)
                            <tr>
                                <td> {{ ++$key }}</td>
                                <td>{{ $item->category_name }}</td>
                                <td>{{ $item->detail_id }}</td>
                                <td>{{ $item->slug }}</td>
                                <td class="deep-link-section-{{ $item->id }}">
                                    @if(isset($item->dynamicLinks))
                                        <button class="btn-sm btn-outline-default copy-deeplink cursor-pointer" type="button"
                                                data-toggle="tooltip" data-placement="button"
                                                data-value="{{ $item->dynamicLinks->link }}"
                                                title="Copy to Clipboard">Copy</button>
                                    @else
                                        <button class="btn-sm btn-outline-success cursor-pointer create_deep_link"
                                                data-value="{{ $item->slug }}"
                                                data-id="{{ $item->id }}"
                                                title="Click for deep link">
                                            <i class="la icon-link"></i>
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    <a href="#"
                                       class="border-0 btn btn-outline-danger delete delete_btn" data-id="{{ $item->id }}" title="Delete the section">
                                        <i class="la la-trash"></i>
                                    </a>
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

@push('page-css')
    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">
@endpush

@push('style')
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush
@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js"
            type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js"
            type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script src="{{ asset('js/custom-js/deep-link.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.10/clipboard.min.js"></script>
    <script>
        let deep_link_create_url = "{{ url('content-deeplink/create?') }}category=";
    </script>
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
                            url: "{{ url('content-deeplink/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('content-deeplink') }}"
                                }
                            }
                        })
                    }
                })
            })
        })
        $('#Example1').DataTable({
            buttons: [],
            paging: true,
            searching: true,
            "bDestroy": true,
        });
    </script>
@endpush
