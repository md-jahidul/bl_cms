@extends('layouts.admin')
@section('title', 'Al Categories Sync With Product')
@section('card_name', 'Al Categories Sync With Product')
@section('breadcrumb')
    <li class="breadcrumb-item active">Al Categories Sync With Product</li>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form" method="POST" id="uploadProduct" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="message">Upload Excel</label> <a href="{{ asset('sample-format/categories-sync-with-product.xlsx')}}" class="text-info ml-2">Download Sample Format</a></br>
                                    </div>
                                    <p class="text-left">
                                        <small class="warning text-muted">
                                            Please download the format and upload in a specific format.
                                        </small>
                                    </p>
                                    <input type="file" class="dropify" name="product_file" data-height="80"
                                           data-allowed-file-extensions="xlsx" required/>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group float-right" style="margin-top:15px;">
                                        <button class="btn btn-success" style="width:100%;padding:7.5px 12px"
                                                type="submit">Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
@endpush
@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>


    <script>
        $(function () {

            $

            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Excel File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                }
            });

            /* file handled  */
            $('#uploadProduct').submit(function (e) {
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
                    url: '{{ route('al-product-category-sync')}}',
                    type: 'POST',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (result) {
                        if (result.success) {
                            swal.fire({
                                title: 'Excel Upload Successfully!',
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
                        $(".dropify-clear").trigger("click");

                    },
                    error: function (data) {
                        swal.fire({
                            title: 'Failed to upload excel',
                            type: 'error',
                        });
                    }
                });

            });
        });


    </script>
@endpush


