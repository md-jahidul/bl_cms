@extends('layouts.admin')
@php $type = ucfirst($type)  @endphp
@section('title', "$type Offer Edit")
@section('card_name', "$type Offer Edit")
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('product.list', $type) }}"> {{ $type }} List</a></li>
    {{--    <li class="breadcrumb-item active"> <a href="{{ route('partner-offer', [$parentId, $partnerName]) }}"> Partner Offer List</a></li>--}}
    <li class="breadcrumb-item active"> {{ $type }} Offer Edit</li>
@endsection
@section('action')
    <a href="#" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h5 class="menu-title"><strong>Product Details Page</strong></h5><hr>
                    <div class="card-body card-dashboard">
                        <form role="form" id="product_form" action="{{ route('product.details-update', [strtolower($type), $productDetail->id] ) }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row">
                                <input type="hidden" name="product_details_id" value="{{ $productDetail->product_details->id }}">
                                <div class="form-group col-md-6 {{ $errors->has('name_en') ? ' error' : '' }}">
                                    <label for="name_en" class="">Offer Name</label>
                                    <input type="text" name="name_en"  class="form-control" placeholder="Enter offer name english" readonly
                                           value="{{ $productDetail->name_en }}" required data-validation-required-message="Enter offer name english">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name_en'))
                                        <div class="help-block">{{ $errors->first('name_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="ussd">USSD Code English</label>
                                    <input type="text" name="ussd"  class="form-control" placeholder="Enter offer ussd english" maxlength="25" readonly
                                           value="{{ $productDetail->ussd_en }}">
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('balance_check') ? ' error' : '' }}">
                                    <label for="balance_check" class="required">Balance Check</label>
                                    <input type="text" name="balance_check"  class="form-control" placeholder="Enter offer name bangla"
                                           required data-validation-required-message="Enter offer name bangla"
                                           value="{{ old("balance_check") ? old("balance_check") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('balance_check'))
                                        <div class="help-block">{{ $errors->first('balance_check') }}</div>
                                    @endif
                                </div>



                                <div class="form-group select-role col-md-6 mb-0 {{ $errors->has('role_id') ? ' error' : '' }}">
                                    <label for="role_id" class="required">Related Product</label>
                                    <div class="role-select">
                                        <select class="select2 form-control" multiple="multiple" name="related_product_id[]">
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}">{{$product->name_en}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="help-block"></div>
                                    @if ($errors->has('role_id'))
                                        <div class="help-block">  {{ $errors->first('role_id') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-12 {{ $errors->has('balance_check') ? ' error' : '' }}">
                                    <label for="balance_check" class="required">Details</label>
                                    <textarea type="text" name="balance_check"  class="form-control" placeholder="Enter offer name bangla"
                                           required data-validation-required-message="Enter offer name bangla" id="details"
                                              value="{{ old("balance_check") ? old("balance_check") : '' }}"></textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('balance_check'))
                                        <div class="help-block">{{ $errors->first('balance_check') }}</div>
                                    @endif
                                </div>

                                <div class="form-actions col-md-12">
                                    <div class="pull-right">
                                        <button type="submit" id="save" class="btn btn-primary"><i
                                                    class="la la-check-square-o"></i> Update
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop


<style>
    form .select-role.validate input:focus, form .select-role.issue input:focus, form .select-role.validate input{
        border-color: unset;
        -webkit-box-shadow: unset;
        -moz-box-shadow: unset;
        box-shadow: unset;
        border-width: 0;
        color : unset;
    }
</style>

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">
@endpush
@push('page-js')
    <script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>
    <script>
        $(function () {
            $("textarea#details").summernote({
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['table', ['table']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['fullscreen']]
                ],
                height:300
            })
        })
    </script>
@endpush






