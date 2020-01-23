@extends('layouts.admin')
@section('title', 'Feed Category')
@section('card_name', 'Feed Category')
@section('action')
    <a href="" class="btn btn-info btn-glow px-2">
        Add Category
    </a>
@endsection

@section('content')
    <section>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <h4 class="pb-1"><strong>Feed Category List</strong>
                    </h4>
                   <div class="row justify-content-md-center">
                       <table class="table table-bordered">
                           <thead>
                           <tr>
                               <td></td>
                               <th>Title</th>
                               <th class="text-right">Action</th>
                           </tr>
                           </thead>
                           <tbody id="sortable">
                           @foreach($categories as $index=>$category)
                               <tr data-index="{{ $category->id }}" data-position="{{ $category->sort }}">
                                   <td width="3%"><i class="icon-cursor-move icons"></i></td>
                                   <td>{{ $category->title }}</td>
                                   <td class="action">
                                       {{--                                    <form action="{{route('myblslider.images.destroy',$slider_image->id)}}"
                                                                                 id="del_form_{{$slider_image->id}}"
                                                                                 method="post">
                                                                               @csrf
                                                                               @method('delete')
                                                                               <a href="{{route('myblslider.images.edit', $slider_image->id )}}"
                                                                                  role="button" class="btn btn-outline-info border-0"><i class="la la-pencil"
                                                                                                                                         aria-hidden="true"></i></a>
                                                                               <a href="#" data-id="{{ $slider_image->id }}"
                                                                                  role="button" class="btn btn-outline-danger border-0 del"><i
                                                                                       class="la la-remove"
                                                                                       aria-hidden="true"></i></a>
                                                                           </form>--}}
                                   </td>
                               </tr>
                           @endforeach
                           </tbody>
                       </table>
                   </div>
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

                let id = $(this).data('id');
                console.log(id);

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
                    console.log(result);
                    if (result.value) {
                        console.log("#del_form_" + id)
                        $("#del_form_" + id).submit();
                    }
                })
            })

        });

    </script>
@endpush





