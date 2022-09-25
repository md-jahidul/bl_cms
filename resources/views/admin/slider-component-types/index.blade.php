@extends('layouts.admin')
@section('title', 'Slider Component Type')
@section('card_name', 'Slider Component Type')

@section('action')
{{--    <a href="{{route('slider-component-types.create')}}" class="btn btn-primary round btn-glow px-2"><i class="la la-plus"></i>--}}
{{--        Create New Type--}}
{{--    </a>--}}
@endsection

@section('content')
    <section>
        <div class="card col-sm-12">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="menu-title">Component Type List</h4>
                    <table class="table table-bordered dataTable" id="Example1">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliderComponentTypes as $section)
                                <tr>
                                    <td>{{ $section->id }}</td>
                                    <td>{{ $section->name }}</td>
                                    <td>{{ $section->slug }}</td>
                                    <td>
                                        @if($section->id > 18)
                                            <a href="{{ route('mybl-campaign-section.edit', $section->id) }}" role="button"
                                               class="btn btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                            <a href="#"
                                               class="border-0 btn btn-outline-danger delete delete_btn" data-id="{{ $section->id }}" title="Delete the section">
                                                <i class="la la-trash"></i>
                                            </a>
                                        @else
                                            <div class="help-block text-danger">
                                                <strong>* You can't edit or delete this Type</strong>
                                            </div>

                                        @endif
                                    </div>
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
    <script src="{{ asset('js/custom-js/deep-link.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.10/clipboard.min.js"></script>
    <script>
        $(function () {
            $('#Example1').DataTable({
                dom: 'Bfrtip',
                buttons: [],
                "pageLength": 10,
                paging: true,
                searching: true,
                "bDestroy": true,
            });

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
                            url: "{{ url('slider-component-types/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('slider-component-types') }}"
                                }
                            }
                        })
                    }
                })
            })
        })
    </script>
@endpush
