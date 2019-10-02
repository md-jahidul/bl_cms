@extends('layouts.admin')
@section('title', 'Slider')
@section('card_name', $slider_information->title." Slider")
@section('breadcrumb')
    <li class="breadcrumb-item active">Edit Image Info</li>
@endsection
@section('action')
    <a href="{{route('myblslider.images.create',$slider_information->id)}}" class="btn btn-info btn-glow px-2">
        Add Image
    </a>
    <a href="{{route('myblslider.index')}}" class="btn btn-primary btn-glow px-2">
        Slider list
    </a>
@endsection

@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>{{ ucwords($slider_information->title." ". "slider images") }}</strong>
                    </h4>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <td width="3%"><i class="icon-cursor-move icons"></i></td>
                            <th>Image</th>
                            <th width="25%">Title</th>
                            <th width="25%">Alt Text</th>
                            <th width="25%">Status</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                        @foreach($slider_information->sliderImages as $index=>$slider_image)
                            <tr data-index="{{ $slider_image->id }}" data-position="{{ $slider_image->sequence }}">
                                <td width="3%"><i class="icon-cursor-move icons"></i></td>
                                <td><img class="" src="{{ asset($slider_image->image_url) }}" alt="Slider Image"
                                         height="100" width="200"/></td>
                                <td>{{ $slider_image->title }}</td>
                                <td>{{ $slider_image->alt_text }}</td>
                                <td>
                                    @if($slider_image->is_active == "1")
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">InActive</span>
                                    @endif
                                </td>
                                <td class="action">
                                    <form action="{{route('myblslider.images.destroy',$slider_image->id)}}"
                                          id="del_form"
                                          method="post">
                                        @csrf
                                        @method('delete')
                                        <a href="{{route('myblslider.images.edit', $slider_image->id )}}"
                                           role="button" class="btn btn-outline-info border-0"><i class="la la-pencil"
                                                                                                  aria-hidden="true"></i></a>
                                        <a href="#"
                                           role="button" class="btn btn-outline-danger border-0 del"><i
                                                class="la la-remove"
                                                aria-hidden="true"></i></a>
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

@stop

@push('page-css')
    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">
    <style>
        #sortable tr td {
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
    </style>
@endpush

@push('page-js')
    <script>

        let auto_save_url = "{{ url('myblsliderImage/addImage/update-position') }}";

        $(document).ready(function () {
            $(document).on('click', '.del', function (e) {
                e.preventDefault();

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
                        $("#del_form").submit();
                    }
                })
            })

        });

    </script>
@endpush





