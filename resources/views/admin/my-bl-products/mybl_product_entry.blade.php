@extends('layouts.admin')
@section('title', 'MyBl Product Entry')
@section('card_name', 'MyBl Product Entry')
@section('breadcrumb')
    <li class="breadcrumb-item active">MyBl Product Entry Panel</li>
@endsection
@section('action')
    <table>
        <tr>
            <!--  Redis reset schedule button -->
            <td>
                <a class="btn btn-danger" href="{{route('redis-reset-schedules.index')}}">
                    <i class="la la-adjust"></i>
                    Redis Reset Schedule
                </a>
            </td>
            <td> |</td>

            <td>
                <form method="post" id="download-form" action="{{route('mybl.product.download')}}">
                    {{csrf_field()}}

                    <a href="{{route('mybl.product.create')}}" class="btn btn-info">
                        <i class="la la-save"></i>
                        Create Product
                    </a>
                    <button type="submit" class="btn btn-info"><i class="la la-download"></i>Export Current
                        Products
                    </button>

                    <button type="submit" name="filtered_btn" value="clicked" class="btn btn-success"><i class="la la-download"></i>Export Filtered
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
                    @include('admin.my-bl-products.partials.product_list')
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
            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Excel File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                }
            });

            $('#download-form').submit(function (e) {
                // e.preventDefault()
                let sim_type = $("#sim_type").val()
                let product_codes = $("#product_code_filter").val()
                let content_type = $("#content_type").val()
                let show_in_home = $("#show_in_home").val()
                let pinned_products = $("#pinned_products").val()

                let filterInput =
                    `<input name='sim_type' value='${sim_type}' type='hidden'>` +
                    `<input name='product_codes' value='${product_codes}' type='hidden'>` +
                    `<input name='content_type' value='${content_type}' type='hidden'>` +
                    `<input name='show_in_home' value='${show_in_home}' type='hidden'>` +
                    `<input name='pinned_products' value='${pinned_products}' type='hidden'>`;

                $(this).append(filterInput)
            })

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
                    url: '{{ route('mybl.core-product.save')}}',
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

                            $('#product_list').DataTable().ajax.reload();

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


