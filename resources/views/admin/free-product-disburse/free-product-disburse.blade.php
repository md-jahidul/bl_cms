@extends('layouts.admin')
@section('title', 'Free Product Disburse')
@section('card_name', 'Free Product Disburse')
@section('breadcrumb')
    <li class="breadcrumb-item active">Free Product Disburse file Upload</li>
@endsection
@section('content')

    <section>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-10">
                    </div>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">

                    <form class="form" method="POST"  id="uploadFreeProductDisburse" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="message">Upload File for Free Product Disburse</label> <a href="{{ asset('sample-format/free_product_disburse_format.xlsx')}}" class="text-info ml-2">Download Sample Format</a></br>
                            <input type="file" class="dropify" name="free_product_disburse_file" data-height="80"
                                   data-allowed-file-extensions="xlsx" required/>
                        </div>
                        <div class="col-md-12" >
                            <div class="form-group float-right" style="margin-top:15px;">
                                <button class="btn btn-success" style="width:100%;padding:7.5px 12px" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>

@endsection




@push('style')
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
    <style>

        .multiselect-container{
            width: 250px;
        }
        .multiselect-container > li > a > label {
            padding: 3px 5px 3px 10px;
        }
    </style>
@endpush
@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>


    <script>
        $(function () {
            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Excel File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                }
            });

            /* file handled  */
            $('#uploadFreeProductDisburse').submit(function (e) {
                e.preventDefault();

                swal.fire({
                    title: 'File Uploading.Please Wait ...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    onOpen: () => {
                        swal.showLoading();
                    }
                });

                let formData = new FormData($(this)[0]);

                $.ajax({
                    url: '{{ route('free-product-disburse.save')}}',
                    type: 'POST',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (result) {

                        if (result.success) {
                            swal.fire({
                                title: 'File Upload Successfully!',
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
                            title: 'Failed to upload File',
                            type: 'error',
                        });
                    }
                });

            });
        });

    </script>
@endpush


