@extends('layouts.admin')
@section('title', 'Sitemap Generator')
@section('card_name', 'Sitemap Generator')

@section('content')
<section>

    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th width="25%">Action</th>
                        <th width="25%">File Name</th>
                        <th width="25%">Last Updated At</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="25%"><button id="generateSitemapFile" class="btn btn-primary">Generate Sitemap</button></td>
                            <td>
                                <a target="_blank" href="{{ config('filesystems.file_base_url') . "sitemap/sitemap.xml" }}"> sitemap.xml </a>
                            </td>
                            <td id="last_updated_at"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@stop

@push('style')
<link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
<link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">

@endpush
@push('page-js')
<script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>


<script>
    $(function () {
        $('#generateSitemapFile').click(function (e) {
            e.preventDefault();
            swal.fire({
                title: 'File Generating. Please Wait ...',
                allowEscapeKey: false,
                allowOutsideClick: false,
                onOpen: () => {
                    swal.showLoading();
                }
            });

            $.ajax({
                url: '{{ url('generate-sitemap') }}',
                type: 'GET',
                cache: false,
                contentType: false,
                processData: false,
                success: function (result) {

                    if (result.status) {
                        $('#last_updated_at').html(result.updated_at)
                        swal.fire({
                            title: result.message,
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        swal.close();
                        swal.fire({
                            title: result.message,
                            type: 'error',
                        });
                    }
                },
                error: function (data) {
                    swal.fire({
                        title: 'Failed to File Generate',
                        type: 'error',
                    });
                }
            });
        });
    });
</script>
@endpush




