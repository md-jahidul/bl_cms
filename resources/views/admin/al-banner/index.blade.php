@extends('layouts.admin')
@section('title', 'AL Banner List')
@section('card_name', 'AL Banner List')
@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{ url('al-banner') }}"> AL Banner List</a></li>
@endsection
@section('action')
    <a href="{{route('al-banner.create')}}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Create AL Banner
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>AL Banner</strong></h4>
                    <table class="table table-striped table-bordered zero-configuration" role="grid">
                        <thead>
                            <tr>
                                <td width="3%">#</td>
                                <th width="25%">Title</th>
                                <th width="25%">Section Type</th>
                                <th class="text-center" width="12%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($banners as $banner)
                                <tr>
                                    <td >{{ $loop->iteration }}</td>
                                    <td >{{ $banner->title_en }}</td>
                                    <td >{{ $banner->section_type }}</td>
                                    <td width="12%" class="text-center">
                                        <a href="{{ url("al-banner/$banner->id/edit") }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                        {{-- <a href="#" remove="{{ url("al-banner/destroy/$banner->id") }}" class="border-0 btn-sm btn-outline-danger delete delete_btn" data-id="{{ $banner->id }}" title="Delete">
                                            <i class="la la-trash"></i>
                                        </a> --}}
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

@endpush

@push('page-js')
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
                            url: "{{ url('al-banner/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('al-banner') }}"
                                }
                            }
                        })
                    }
                })
            })
        })
    </script>
@endpush





