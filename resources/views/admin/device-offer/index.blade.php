@extends('layouts.admin')
@section('title', 'Device Offer')
@section('card_name', 'Device Offer')

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
                        <form class="form" method="POST"  id="uploadDeviceOffer" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12 col-xs-12">
                                <div class="form-group">
                                    <label for="message">Upload Device Offer List</label>
                                    <a href="{{ asset('sample-format/Device-Offer.xlsx')}}" class="badge badge-info ml-2">Download Sample Format</a></br>
                                    <input type="file" class="dropify" name="offer_file" data-height="80"
                                           data-allowed-file-extensions="xlsx" required/>
                                </div>
                                
                                <div class="form-group text-center">
                                    <button class="btn btn-info" type="submit">Upload</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
                @include('admin.device-offer.partials.offer_list')
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
    $('.dropify').dropify({
        messages: {
            'default': 'Browse for an Excel File to upload',
            'replace': 'Click to replace',
            'remove': 'Remove',
            'error': 'Choose correct file format'
        }
    });

    /* file handled  */
    $('#uploadDeviceOffer').submit(function (e) {
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
            url: '{{ route("device.offer.excel.save")}}',
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            success: function (result) {
                if (result.success) {
                    swal.fire({
                        title: 'Device offer excel is uploaded successfully!',
                        type: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });

                    $('#device_offer_list').DataTable().ajax.reload();

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
                    title: 'Failed to upload device offer excel',
                    type: 'error',
                });
            }
        });

    });
});

</script>
@endpush


