@extends('layouts.admin')
@section('title', 'Business Internet Packages')
@section('card_name', 'Internet Packages')
@section('action')
<a href="{{ url('business-internet-create') }}" class="btn btn-primary round btn-glow px-2"><i class="la la-plus"></i>
    Add Package
</a>
<a href="{{ url('business-internet/search-data-sync') }}" class="btn btn-blue-grey  round btn-glow px-2"><i class="la la-refresh"></i>
    Sync Search
</a>
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
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <form class="form" method="POST"  id="uploadInternetPackage" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12 col-xs-12">
                                <div class="form-group">
                                    <label for="message">Upload Internet Package List</label>
                                    <a href="{{ asset('sample-format/business-internet-product.xlsx')}}" class="badge badge-info ml-2">Download Sample Format</a></br>
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
                @include('admin.business.partials.internet_package_list')
            </div>
        </div>
    </div>
</section>

@endsection




@push('style')
<link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
@endpush
@push('page-js')
<script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>


<script>
$(function () {


            //success and error msg
<?php
if (Session::has('sussess')) {
    ?>
            swal.fire({
                title: "{{ Session::get('sussess') }}",
                type: 'success',
                timer: 2000,
                showConfirmButton: false
            });
    <?php
}
if (Session::has('error')) {
    ?>

            swal.fire({
                title: "{{ Session::get('error') }}",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });

<?php } ?>

    $('.dropify').dropify({
        messages: {
            'default': 'Browse for an Excel File to upload',
            'replace': 'Click to replace',
            'remove': 'Remove',
            'error': 'Choose correct file format'
        }
    });

    /* file handled  */
    $('#uploadInternetPackage').submit(function (e) {
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
            url: '{{ route("business.internet.excel.save")}}',
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            success: function (result) {
                if (result.success) {
                    swal.fire({
                        title: 'Internet package excel is uploaded successfully!',
                        type: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });

                    $('#internet_package_list').DataTable().ajax.reload();

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
                    title: 'Failed to upload internet package excel',
                    type: 'error',
                });
            }
        });

    });
});

</script>
@endpush


