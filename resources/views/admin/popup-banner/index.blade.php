@extends('layouts.admin')
@section('title', 'MyBl Popup Banner')
@section('card_name', 'MyBl Popup Banner')

@section('action')
    <a href="{{route('popup-banner.create')}}" class="btn btn-primary round btn-glow px-2"><i class="la la-plus"></i>
        Create New Banner
    </a>
@endsection

@section('content')
    <section>
        <div class="card col-sm-12">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="menu-title">Banner List</h4>
                    <table class="table table-striped table-bordered"
                           role="grid" aria-describedby="Example1_info" style="cursor:move;">
                        <thead>
                        <tr>
                            <th><i class="icon-cursor-move icons"></i></th>
                            <th>Banner</th>
                            <th>Status</th>
                            <th>Deep Link</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                            @foreach ($banners as $banner)
                                <tr data-index="{{ $banner->id }}" data-position="{{ $banner->display_order }}">
                                    <td class="pt-1" width="3%"><i class="icon-cursor-move icons"></i></td>
                                    <td><img src="{{ url('storage/' . $banner->banner) }}" alt="Girl in a jacket" width="150" height="40"></td>
                                    <td>{{ $banner->status ? 'Active':'Inactive' }}</td>
                                    <td>
                                        <button class="btn-sm btn-outline-default copy-deeplink cursor-pointer" type="button"
                                            data-toggle="tooltip" data-placement="button"
                                            data-value="{{ $banner->deeplink }}"
                                            title="Copy to Clipboard" target="_blank"><i class="la icon-link"></i>
                                            Copy
                                        </button>
                                    </td>
                                    <td>
                                        <a href="{{ route('popup-banner.edit', $banner->id) }}" role="button"
                                           class="btn btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                        <a href="#"
                                           class="border-0 btn btn-outline-danger delete delete_btn" data-id="{{ $banner->id }}" title="Delete the section">
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
    <script src="{{ asset('js/custom-js/deep-link.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.10/clipboard.min.js"></script>
    <script>
        var auto_save_url = "{{ url('popup-banner-sort-auto-save') }}";
        let deep_link_create_url = "{{ url('mybl-campaign-section-deeplink/create?') }}category=";
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
                            url: "{{url('popup-banner/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('popup-banner') }}"
                                }
                            }
                        })
                    }
                })
            })
        })
    </script>
@endpush
