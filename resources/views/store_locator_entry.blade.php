@extends('layouts.admin')
@section('title', 'Store Location Entry')
@section('card_name', 'Store Loaction Entry')
@section('breadcrumb')
    <li class="breadcrumb-item active">Store Location Entry Panel</li>
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
                <div class="col-md-8 col-xs-12 pull-right mb-2">
                    <a href="#" class="btn btn-danger all_locator_delete float-right">Delete All</a>
                </div>

                <div class="card-body card-dashboard">
                    <form class="form" method="POST"  id="uploadProduct" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="message">Upload Product List</label> <a href="{{ asset('sample-format/store_locations.xlsx')}}" class="text-info ml-2">Download Sample Format</a></br>
                            <input type="file" class="dropify" name="store_file" data-height="80"
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
                    url: '{{ route('store-locations.save')}}',
                    type: 'POST',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (result) {

                        if (result.success) {
                            swal.fire({
                                title: 'Stores Upload Successfully!',
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
                            title: 'Failed to upload Stores',
                            type: 'error',
                        });
                    }
                });
            });

            //delete all Store Locator
            $('.all_locator_delete').on('click', function (e) {
                e.preventDefault();
                var deleteUrl = "{{ URL('store-locations-delete-all') }}";
                var cnfrm = confirm("Do you want to delete all data?");
                if (cnfrm) {
                    $.ajax({
                        url: deleteUrl,
                        cache: false,
                        type: "GET",
                        success: function (result) {
                            console.log(result)
                            if (result.success == 1) {
                                swal.fire({
                                    title: 'All store locations are deleted!',
                                    type: 'success',
                                    timer: 3000,
                                    showConfirmButton: false
                                });

                                // $('#device_offer_list').DataTable().ajax.reload();

                            } else {
                                swal.close();
                                swal.fire({
                                    title: result.message,
                                    timer: 3000,
                                    type: 'error',
                                });
                            }

                        },
                        error: function (data) {
                            swal.fire({
                                title: 'Delete process failed!',
                                type: 'error',
                            });
                        }
                    });
                }
                e.preventDefault();
            });
        });
    </script>
@endpush


