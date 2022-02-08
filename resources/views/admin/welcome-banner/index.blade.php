`@extends('layouts.admin')
@section('title', 'Welcome Banner')
@section('card_name', 'Welcome Banner List')
@section('action')
    <a href="{{route('welcome-banner.create')}}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Create Welcome Banner
    </a>
@endsection

@section('content')
    <section>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-10">
                        <h1 class="card-title pl-1">Welcome Banner List ( <small class="text-info">Draggable and auto
                                save items </small>)</h1>
                    </div>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered alt-pagination no-footer dataTable"
                           id="Example1" role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tbody id="sortable-banner" class="cursor-move">
                        @if(count($welcome_banners))
                            @foreach ($welcome_banners as $key=>$item)
                                <tr>
                                    <td width="2%"><i class="icon-cursor-move icons"></i></td>
                                    <td class="d-none banner_id">{{$item->id}}</td>
                                    <td width='20%'>{{$item->title_en}}</td>
                                    <td width='20%'>{{$item->description_en}}</td>
                                    <td width='10%'><img style="height:50px;width:100px"
                                                         src="{{asset($item->banner_img)}}" alt="" srcset=""></td>
                                    <td width='30%'>
                                        <div class="row justify-content-md-center no-gutters">
                                            <div class="col-md-3">
                                                <a role="button" href="{{route('welcome-banner.edit',$item->id)}}"
                                                   class="btn btn-outline-success">
                                                    <i class="la la-pencil"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-3">
                                                <button data-id="{{$item->id}}" class="btn btn-outline-danger delete"
                                                        onclick=""><i class="la la-trash"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr><td>No Data Found...</td></tr>
                        @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </section>

    <!-- /.card -->



@endsection

@section('content_right_side_bar')
    <h1>
        List
    </h1>
@endsection


@push('style')
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">
    <style></style>
@endpush
@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
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
                            url: "{{ url('welcome-banner') }}/" + id,
                            type: "DELETE",
                            data: {
                                'id': id,
                                '_token': '{{ csrf_token() }}',
                            },
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 1000)

                                function redirect() {
                                    window.location.href = "{{ url('welcome-banner/') }}"
                                }
                            }
                        })
                    }
                })
            })
        })

        $(document).ready(function () {
            $('#sortable-banner').sortable({
                update: function () {
                    var banner_ids = [];
                    console.log($('#banner_id'));
                    $.each($('.banner_id'), function(){
                        banner_ids.push($(this).text());
                    });
                    console.log(banner_ids);

                    $.ajax({
                        url: "{{ url('welcome-banner/set-order') }}",
                        type: "POST",
                        data: {
                            'banner_ids': banner_ids,
                            '_token': '{{ csrf_token() }}',
                        },
                        success: function (res) {
                            console.log(res);
                        }
                    })
                }
            })
        });

    </script>
@endpush`