@extends('layouts.admin')
@section('title', 'Universities')
@section('card_name', 'Universities')
@section('breadcrumb')
    <li class="breadcrumb-item ">University List</li>
@endsection
@section('action')
{{--    <a href="{{ url("university/create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>--}}
{{--        Add University--}}
{{--    </a>--}}
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content">
                <div class="card-body mt-1">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <form class="form" method="POST"  id="uploadUniversities" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="message">Upload University Excel File</label>
                                        <a href="{{ asset('sample-format/universities.xlsx')}}" class="badge badge-info ml-2">Download Sample Format</a></br>
                                        <input type="file" class="dropify" name="package_file" data-height="80"
                                               data-allowed-file-extensions='["xlsx", "xls"]' required/>
                                    </div>
                                    <div class="form-group text-center">
                                        <button class="btn btn-info" type="submit">Upload</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="card">
            <div class="card-header pb-0">
                <h4 class="pull-left"><strong>University List</strong></h4>
                <h4 class="pull-right">
{{--                    <a href="{{ url('university/all-destroy') }}" class="btn btn-danger">Delete All</a>--}}
                    <a href="javascript:;" class="btn btn-danger all_universities_delete">Delete All</a>
                </h4>
            </div>
            <div class="card-content">
                <div class="card-body pt-0">
                    @include('admin.university.partials.table-list')
                </div>
            </div>
        </div>
    </section>
@stop

@push('page-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <style>
        #sortable tr td{
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
    </style>
@endpush

@push('page-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        $('.dropify').dropify({
            messages: {
                'default': 'Browse for an Excel File to upload',
                'replace': 'Click to replace',
                'remove': 'Remove',
                'error': 'Choose correct file format'
            }
        });

        $(function () {
            /* file handled  */
            $('#uploadUniversities').submit(function (e) {
                e.preventDefault();

                swal.fire({
                    title: 'Data Uploading.Please Wait ...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    onOpen: () => {
                        swal.showLoading();
                    }
                });

                let formData = new FormData($(this)[0]);

                $.ajax({
                    url: '{{ route("university.uploader")}}',
                    type: 'POST',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (result) {
                        if (result.success) {
                            swal.fire({
                                title: 'University excel is uploaded successfully!',
                                type: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });

                            $('#university_list').DataTable().ajax.reload();

                        } else {
                            swal.close();
                            swal.fire({
                                title: result.message,
                                type: 'error',
                            });
                        }
                        $(".dropify-clear").trigger("click");

                    },
                    error: function (data) {
                        swal.fire({
                            title: 'Failed to upload roaming operator excel',
                            type: 'error',
                        });
                    }
                });

            });
        })
    </script>
@endpush





