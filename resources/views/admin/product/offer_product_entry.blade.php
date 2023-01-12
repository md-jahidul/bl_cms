@extends('layouts.admin')
@section('title', 'Offers Product Entry')
@section('card_name', 'Offers Product Entry')
@section('breadcrumb')
    <li class="breadcrumb-item active">Offers Product Entry Panel</li>
@endsection
@section('action')
    <table>
        <tr>
            <!-- Getting the redis reset key available for 12:00 AM to 3:59 AM -->
            {{-- @if(in_array(\Carbon\Carbon::now()->format('H'), ["00", "01", "02", "03"]))
                <td>
                    <form method="post" action="{{route('mybl.product.redis')}}"
                          onsubmit="return confirm('WARNING!!! This will reset the redis keys for available products. Do this only if you are aware of the impact. Sure to continue?')">
                        {{csrf_field()}}
                        <button class="btn btn-danger" type="submit">
                            <i class="la la-adjust"></i>
                            Reset Redis Key
                        </button>
                    </form>
                </td>
                <td> |</td>
            @endif --}}

            <td>
                <div class="dropdown">
                    <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="la la-plus"></i>Add Product
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a href="{{route("product.create", strtolower('prepaid'))}}" class="dropdown-item">
                            Prepaid
                        </a>
                        <a href="{{route("product.create", strtolower('postpaid'))}}" class="dropdown-item">
                            Postpaid
                        </a>
                    </div>
                </div>
            </td>

            <td>
                <form method="post" action="{{route('offers.product.download')}}">
                    {{csrf_field()}}

                    <button type="submit" class="btn btn-info"><i class="la la-download"></i>Export Current
                        Products
                    </button>
                </form>
            </td>
        </tr>
    </table>

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
                                    <label for="message">Upload Product List</label>
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
                    @include('admin.product.offer_product_list')
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
                    url: '{{ route('offers.product.save')}}',
                    type: 'POST',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (result) {
                        if (result.success) {
                            swal.fire({
                                title: 'Product Upload Successfully!',
                                type: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });

                            $('#offer_product_list').DataTable().ajax.reload();

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
                            title: 'Failed to upload Products',
                            type: 'error',
                        });
                    }
                });

            });
        });


    </script>
@endpush


