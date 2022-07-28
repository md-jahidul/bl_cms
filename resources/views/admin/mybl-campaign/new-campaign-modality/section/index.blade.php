@extends('layouts.admin')
@section('title', 'MyBl Campaign Section')
@section('card_name', 'MyBl Campaign Section')

@section('action')
    <a href="{{route('mybl-campaign-section.create')}}" class="btn btn-primary round btn-glow px-2"><i class="la la-plus"></i>
        Create New Section
    </a>
@endsection

@section('content')
    <section>
        <div class="card col-sm-12">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="menu-title">Category List</h4>
                    <table class="table table-striped table-bordered"
                           role="grid" aria-describedby="Example1_info" style="cursor:move;">
                        <thead>
                        <tr>
                            <th><i class="icon-cursor-move icons"></i></th>
                            <th>Section Title En</th>
                            <th>Section Title Bn</th>
                            <th>Status</th>
                            <th>Deep Link</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                            @foreach ($sections as $section)
                                <tr data-index="{{ $section->id }}" data-position="{{ $section->display_order }}">
                                    <td class="pt-1" width="3%"><i class="icon-cursor-move icons"></i></td>
                                    <td>{{ $section->title_en }}</td>
                                    <td>{{ $section->title_bn }}</td>
                                    <td>{{ $section->status ? 'Active':'Inactive' }}</td>
                                    <td class="deep-link-section-{{ $section->id }}">
                                        @if(isset($section->dynamicLinks))
                                            <button class="btn-sm btn-outline-default copy-deeplink cursor-pointer" type="button"
                                                    data-toggle="tooltip" data-placement="button"
                                                    data-value="{{ $section->dynamicLinks->link }}"
                                                    title="Copy to Clipboard">Copy</button>
                                        @else
                                            <button class="btn-sm btn-outline-success cursor-pointer create_deep_link"
                                                    data-value="{{ $section->slug }}"
                                                    data-id="{{ $section->id }}"
                                                    title="Click for deep link">
                                                <i class="la icon-link"></i>
                                            </button>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('mybl-campaign-section.edit', $section->id) }}" role="button"
                                           class="btn btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                        <a href="#"
                                           class="border-0 btn btn-outline-danger delete delete_btn" data-id="{{ $section->id }}" title="Delete the section">
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
        var auto_save_url = "{{ url('mybl-campaign-section/sort-auto-save') }}";
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
                            url: "{{ url('mybl-campaign-section/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('mybl-campaign-section') }}"
                                }
                            }
                        })
                    }
                })
            })
        })
    </script>
@endpush
