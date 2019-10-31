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
    <a href="{{ route('product.list', $type) }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h5 class="menu-title"><strong>{{ $type }} Offer Edit</strong></h5><hr>
                    <div class="card-body card-dashboard">
                        <form role="form" id="product_form" action="{{ route('product.update', [strtolower($type), $product->id] ) }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('name_en') ? ' error' : '' }}">
                                    <label for="name_en" class="required">Offer Name</label>
                                    <input type="text" name="name_en"  class="form-control" placeholder="Enter offer name english"
                                           value="{{ $product->name_en }}" required data-validation-required-message="Enter offer name english">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name_en'))
                                        <div class="help-block">{{ $errors->first('name_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('name_bn') ? ' error' : '' }}">
                                    <label for="name_bn" class="required">Offer Name Bangla</label>
                                    <input type="text" name="name_bn"  class="form-control" placeholder="Enter offer name bangla"
                                           required data-validation-required-message="Enter offer name bangla"
                                           value="{{ $product->name_bn }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name_bn'))
                                        <div class="help-block">{{ $errors->first('name_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="ussd">USSD Code English</label>
                                    <input type="text" name="ussd"  class="form-control" placeholder="Enter offer ussd english" maxlength="25"
                                           value="{{ $product->ussd_en }}">
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('ussd_bn') ? ' error' : '' }}">
                                    <label for="ussd_bn">USSD Code Bangla</label>
                                    <input type="text" name="ussd_bn"  class="form-control" placeholder="Enter offer ussd bangla" maxlength="25"
                                           value="{{ $product->ussd_bn }}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="price_tk">Offer Price</label>
                                    <input type="number" name="price_tk"  class="form-control" placeholder="Enter offer price" maxlength="8"
                                           value="{{ $product->price_tk }}">
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('offer_category_id') ? ' error' : '' }}">
                                    <label for="offer_category_id" class="required">Offer Type</label>
                                    <select class="form-control" name="offer_category_id" id="offer_type"
                                            required data-validation-required-message="Please select offer">
                                        <option value="">---Select Offer Type---</option>
                                        @foreach($offersType as $offer)
                                            <option value="{{ $offer->id }}" {{ ($offer->id == $product->offer_category_id ) ? 'selected' : '' }}>{{ $offer->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="help-block"></div>
                                    @if ($errors->has('offer_category_id'))
                                        <div class="help-block">  {{ $errors->first('offer_category_id') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="row {{ $product->offer_category_id == 1 ? '' : 'd-none' }}" id="internet" data-offer-type="internet">
                                @include('layouts.partials.products.internet')
                            </div>
                            <div class="row {{ $product->offer_category_id == 2 ? '' : 'd-none' }}" id="voice" data-offer-type="voice">
                                @include('layouts.partials.products.voice')
                            </div>
                            <div class="row {{ $product->offer_category_id == 3 ? '' : 'd-none' }}" id="bundles" data-offer-type="bundles">
                                @include('layouts.partials.products.bundle')
                            </div>
                            <div class="row {{ $product->offer_category_id == 4 ? '' : 'd-none' }}" id="packages" data-offer-type="packages">
                                @include('layouts.partials.products.packages')
                            </div>
                            <div class="row {{ $product->offer_category_id == 6 ? '' : 'd-none' }}" id="startup" data-offer-type="startup">
                                @include('layouts.partials.products.startup')
                            </div>

                            <div class="row">
{{--                                <div class="form-group col-md-6 ">--}}
{{--                                    <label for="bonus">Bonus</label>--}}
{{--                                    <input type="text" name="bonus"  class="form-control" placeholder="Enter bonus" value="{{ $product->name }}">--}}
{{--                                </div>--}}

{{--                                <div class="form-group col-md-6 {{ $errors->has('point') ? ' error' : '' }}">--}}
{{--                                    <label for="point">Point</label>--}}
{{--                                    <input type="number" name="point"  class="form-control" placeholder="Enter point"--}}
{{--                                           value="{{ $product->point }}">--}}
{{--                                </div>--}}

                                <div class="form-group col-md-6">
                                    <label for="tag_category_id">Tag</label>
                                    <select class="form-control" name="tag_category_id">
                                        <option value="">---Select Tag---</option>
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}" {{ ($tag->id == $product->tag_category_id ) ? 'selected' : '' }}>{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label></label>
                                    <div class="form-group pt-1" id="show_in_home">
                                        <label for="show_in_home" class="mr-1">Show In Home:</label>
                                        <input type="checkbox" name="show_in_home" value="1" {{ ($product->show_in_home == 1) ? 'checked' : '' }}>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title" class="mr-1">Recharge</label>
                                        <input type="radio" name="is_recharge" value="1" id="yes" {{ ($product->status == 1) ? 'checked' : '' }}>
                                        <label for="yes" class="mr-1">Yes</label>
                                        <input type="radio" name="is_recharge" value="0" id="no" {{ ($product->is_recharge == 0) ? 'checked' : '' }}>
                                        <label for="no">No</label>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title" class="mr-1">Status:</label>

                                        <input type="radio" name="status" value="1" id="active" {{ ($product->status == 1) ? 'checked' : '' }}>
                                        <label for="active" class="mr-1">Active</label>

                                        <input type="radio" name="status" value="0" id="inactive" {{ ($product->status == 0) ? 'checked' : '' }}>
                                        <label for="inactive">Inactive</label>
                                    </div>
                                </div>


                                <div class="form-actions col-md-12">
                                    <div class="pull-right">
                                        <button type="submit" id="update" class="btn btn-primary"><i
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

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
@endpush
@push('page-js')
    <script type="text/javascript">
        $(function () {

            var $offerType = $('#offer_type');

            function domMupulate(selectedItemName, action='hide'){
                let options =  $offerType.find('option');
                let optionTextArr = $.map(options ,function(option) {
                    if( option.value !== '' &&  option.text.toLowerCase() !== selectedItemName ) { return  '#' + option.text.toLowerCase();  }
                });

                let otherElements = optionTextArr.join(',');

                if(action == 'hide'){
                    $(otherElements).hide();
                    $('#' + selectedItemName).removeClass('d-none')
                        .show()
                        .find('input').each(function(){
                        $(this).val('');
                    });
                }else{
                    $(otherElements).remove();
                }
            }

            $offerType.change(function () {
                let showInHome = $('#show_in_home');
                let optionText =  $(this).find('option:selected').text();  //    $("#offer_type option:selected").text();
                (optionText.toLowerCase() == 'startup' ? showInHome.hide() : showInHome.show())
                domMupulate(optionText.toLowerCase());

            });

            $('#update').on('click',function(e){
                e.preventDefault();
                let optionText = $offerType.find('option:selected').text();
                domMupulate( optionText.toLowerCase(),'remove');
                $("#product_form").submit();
            });
        })
    </script>
@endpush







