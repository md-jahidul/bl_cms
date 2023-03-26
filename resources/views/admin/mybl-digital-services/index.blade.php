@extends('layouts.admin')
@section('title', 'Digital Services')
@section('card_name', 'Digital Services')

@section('action')
    <a href="{{route('digital-service.create')}}" class="btn btn-primary round btn-glow px-2"><i class="la la-plus"></i>
        Create Service
    </a>
@endsection

@section('content')
    <section>
        <div class="card col-sm-12">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="menu-title">Service List</h4>
                    <table class="table table-striped table-bordered"
                           role="grid" aria-describedby="Example1_info">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Header Title En</th>
                            <th>Body Title En</th>
                            <th>Component For</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($digitalServices as $key => $service)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $service->header_title_en }}</td>
                                    <td>{{ $service->body_title_bn }}</td>
                                    <td>{{ $service->component_for }}</td>
                                    <td>{{ $service->status ? 'Active':'Inactive' }}</td>
                                    <td>
                                        <a href="{{ route('digital-service.edit', $service->id) }}" role="button"
                                           class="btn btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                        <a href="#"
                                           class="border-0 btn btn-outline-danger delete delete_btn" data-id="{{ $service->id }}" title="Delete the section">
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

@push('style')
@endpush
@push('page-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.10/clipboard.min.js"></script>
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
                            url: "{{ url('digital-service/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('digital-service') }}"
                                }
                            }
                        })
                    }
                })
            })
        })
    </script>
@endpush
