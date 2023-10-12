@extends('layouts.admin')
@section('title', 'Settings')
@section('card_name', 'Global Settings')

@section('content')
    <div class="container">
        <h1>Settings</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('global-settings.create') }}" class="btn btn-success">Create New Setting</a>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input type="text" id="keyFilter" class="form-control"
                                       placeholder="Filter by Key Name">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" onclick="filterMedia()">
                                        Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>


                <table class="table" id="Example1">
                    <thead>
                    <tr>
                        <th>Setting Key</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($settings as $setting)
                        <tr>
                            <td>{{ $setting->settings_key }}</td>
                            <td>
                                <a href="{{ route('global-settings.edit', $setting) }}" class="btn btn-warning">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    {{ $settings->links() }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            </div>
        </div>
    </div>
@endsection
@push('style')
    <link rel="stylesheet" href="{{ asset('plugins') }}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/vendors/css/tables/datatable/datatables.min.css">
@endpush
@push('page-js')
    <script src="{{ asset('plugins') }}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{ asset('app-assets') }}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{ asset('app-assets') }}/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="{{ asset('app-assets') }}/js/scripts/tables/datatables/datatable-advanced.js" type="text/javascript"></script>
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
                            url: "{{ url('setting/destroy') }}/" + id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your Settings has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('setting/') }}"
                                }
                            }
                        })
                    }
                })
            })
        })

        $(document).ready(function () {
            // Initialize DataTable with filter settings
            var dataTable = $('#Example1').DataTable({
                dom: 'Bfrtip',
                buttons: [],
                paging: true,
                searching: false,
                "bDestroy": true,
                "pageLength": 10
            });

            // Apply filter to table when the filter input changes
            $('#filterSettingsKey').on('input', function () {
                var filterValue = $(this).val();
                dataTable.search(filterValue).draw();
            });
        });
        function filterMedia() {
            var keyFilter = document.getElementById('keyFilter').value;
            window.location.href = "<?php echo e(route('global-settings.index')); ?>?key=" + keyFilter;
        }
    </script>
@endpush
