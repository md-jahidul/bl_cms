@extends('layouts.admin')
@section('title', 'Products')

@section('card_name', "Products Entry")

@section('action')
{{--    <a href="" class="btn btn-info btn-glow px-2">
        Product List
    </a>--}}
@endsection

@section('content')
    <section>
        <div class="card card-info mb-0" style="padding-left:10px">
            <div class="card-content">
                <div class="card-body">
                    <form class="form" action="{{ route('mybl.product.store') }}" method="POST">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="product_code">Product Code</label>
                                        <select name="product_code" id="product_code" class="form-control" required>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!--      Selected Product Basic Info  -->
                            <div class="row" id="core_info_div">
                            </div>

                            <div class="row" id="extra_info_div">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category">Product Category</label>
                                        <select name="category_id" id="category" class="form-control" required>
                                            <option value=""> Select Product category</option>
                                            @foreach($product_types as $val)
                                            <option value="{{ $val->id }}"> {{ $val->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_tag">Product Tag</label>
                                        <input type="text" name="product_tag" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="product_description">Product Description</label>
                                        <textarea type="text" rows="4" name="product_description"
                                                  class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="pull-right mb-1">
                                <button type="submit" class="btn btn-info btn-sm">
                                    <i class="ft-save"></i> Save
                                </button>
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
    <link rel="stylesheet" href="{{asset('plugins')}}/select2/css/select2.css">
@endpush
@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('plugins')}}/select2/js/select2.full.min.js"></script>
    <script>
        let selected_product_code = null;
        $(function () {
            $("#product_code").select2({
                placeholder: "Enter Product Code",
                minimumInputLength: 1,
                delay: 250, // wait 250 milliseconds before triggering the request
                ajax: {
                    url: '{{route('product.data')}}',
                    dataType: 'json'
                },
            });

            let getProductDetails = function (param) {
                return $.ajax({
                    url: '{{route('product.details.info')}}',
                    method: 'get',
                    data: param
                });
            }

            $('#product_code').on('change', function (e) {
                let selected_product = $(this).val()
                Swal.fire({
                    title: 'Loading Product Info',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                });

                swal.showLoading();
                let callGetProductDetails = getProductDetails(new function () {
                    this._token = '{{csrf_token()}}';
                    this.product_code = selected_product;
                })

                callGetProductDetails.done(function (data) {
                    loadBasicInfo(data);
                    swal.close();


                }).fail(function (jqXHR, textStatus, errorThrown) {
                    let errorResponse = jqXHR.responseJSON;
                    swal.close();
                    Swal.fire(
                        'Error!',
                        errorResponse.errors,
                        'error',
                    );
                });
            });

            function loadBasicInfo(info) {
                let $container = `<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="commercial_name_en">Commercial Name -En</label>
                                        <input type="text" readonly name="commercial_name_en" class="form-control" value="` + info.commercial_name_en + `">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="commercial_name_bn">Commercial Name -Bn</label>
                                        <input type="text" readonly name="commercial_name_bn" class="form-control" value="` + info.commercial_name_bn + `">
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="content_type">Content Type</label>
                                        <input type="text" readonly name="content_type" class="form-control" value="` + info.content_type.toUpperCase() + `">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="family_name">Family Type</label>
                                        <input type="text" readonly name="family_name" class="form-control" value="` + info.family_name.toUpperCase()+ `">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="internet_volume_mb">Internet Volume (MB)</label>
                                        <input type="text" readonly name="internet_volume_mb" class="form-control" value="` + formatVolume(info.internet_volume_mb) + `">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sms_volume">SMS Volume</label>
                                        <input type="text" readonly name="sms_volume" class="form-control" value="` + formatVolume(info.sms_volume) + `">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="minute_volume">Minutes Volume</label>
                                        <input type="text" readonly name="minute_volume" class="form-control" value="` + formatVolume(info.minute_volume) + `">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="validity">Validity</label>
                                        <input type="text" readonly name="validity" class="form-control" value="` + info.validity + " "+ info.validity_unit.toUpperCase() + `">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">Price (In Tk.)</label>
                                        <input type="text" readonly name="price" class="form-control" value="` + info.mrp_price + `">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="activation_ussd">Activation USSD</label>
                                        <input type="text" readonly name="activation_ussd" class="form-control" value="` + info.activation_ussd + `">
                                    </div>
                                </div>`;

                $("#core_info_div").html($container);

            }

            function formatVolume(volume) {
                return (volume ? volume : 0);
            }
        })

    </script>
@endpush
