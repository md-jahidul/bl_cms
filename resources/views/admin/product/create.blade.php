@extends('layouts.admin')
@section('title', "$type Offer Create")
@section('card_name', "$type Offer Create")
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('product.list', $type) }}"> {{ $type }} List</a></li>
    <li class="breadcrumb-item active"> {{ $type }} Offer Create</li>
@endsection
@section('action')
    <a href="{{ route('product.list', $type) }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h5 class="menu-title"><strong>{{ ucfirst($type) }} Offer Create</strong></h5><hr>
                    <div class="card-body card-dashboard">
                        <form id="product_form" role="form" action="{{ route('product.store', strtolower($type)) }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('name_en') ? ' error' : '' }}">
                                    <label for="name_en" class="required">Offer Name (English)</label>
                                    <input type="text" name="name_en"  class="form-control" placeholder="Enter offer name in English"
                                           required data-validation-required-message="Enter offer name english"
                                           value="{{ old("name_en") ? old("name_en") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name_en'))
                                        <div class="help-block">{{ $errors->first('name_en') }}</div>
                                    @endif
                                </div>


                                <div class="form-group col-md-6 {{ $errors->has('name_bn') ? ' error' : '' }}">
                                    <label for="name_bn" class="required">Offer Name (Bangla)</label>
                                    <input type="text" name="name_bn"  class="form-control" placeholder="Enter offer name in Bangla"
                                           required data-validation-required-message="Enter offer name bangla"
                                           value="{{ old("name_bn") ? old("name_bn") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name_bn'))
                                        <div class="help-block">{{ $errors->first('name_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="ussd_en">USSD Code (English)</label>
                                    <input type="text" name="ussd_en"  class="form-control" placeholder="Enter offer ussd code in English"
                                           value="{{ old("ussd_en") ? old("ussd_en") : '' }}">
                                    <div class="help-block"></div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="ussd_bn">USSD Code (Bangla)</label>
                                    <input type="text" name="ussd_bn"  class="form-control" placeholder="Enter offer ussd code in Bangla"
                                           value="{{ old("ussd_bn") ? old("ussd_bn") : '' }}">
                                </div>

                                <div class="form-group col-md-6 ">
                                    <label for="price_tk">Offer Price</label>
                                        <input type="text" name="price_tk"  class="form-control" placeholder="Enter offer price in taka" step="0.001"
                                           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
                                           value="{{ old("price_tk") ? old("price_tk") : '' }}">
                                    <div class="help-block"></div>
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('offer_category_id') ? ' error' : '' }}">
                                    <label for="offer_category_id" class="required">Offer Type</label>
                                    <select class="form-control required" name="offer_category_id" id="offer_type"
                                            required data-validation-required-message="Please select offer">
                                        <option value="">---Select Offer Type---</option>
                                        @foreach($offers as $offer)

                                            @if(strtolower($type) == 'postpaid' && $offer->id == 1 || $offer->id == 4 || $offer->id == 5)
                                                <option value="{{ $offer->id }}">{{ $offer->name }}</option>
                                            @elseif(strtolower($type) == 'prepaid')
                                                <option value="{{ $offer->id }}">{{ $offer->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="help-block"></div>
                                    @if ($errors->has('offer_category_id'))
                                        <div class="help-block">{{ $errors->first('offer_category_id') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="row" id="internet" data-offer-type="internet" style="display: none">
                                @include('layouts.partials.products.internet')
                            </div>
                            <div class="row" id="voice" data-offer-type="voice" style="display: none">
                                @include('layouts.partials.products.voice')
                            </div>
                            <div class="row" id="bundles" data-offer-type="bundles" style="display: none">
                                @include('layouts.partials.products.bundle')
                            </div>

                            <div class="row" id="packages" data-offer-type="packages" style="display: none">
                                @include('layouts.partials.products.packages')
                            </div>
                            <div class="row" id="startup" data-offer-type="startup" style="display: none">
                                @include('layouts.partials.products.startup')
                            </div>

                            <div class="row">
{{--                                <div class="form-group col-md-6">--}}
{{--                                    <label for="bonus">Bonus</label>--}}
{{--                                    <input type="text" name="bonus"  class="form-control" placeholder="Enter bonus"--}}
{{--                                           value="{{ old("bonus") ? old("bonus") : '' }}">--}}
{{--                                </div>--}}

{{--                                <div class="form-group col-md-6">--}}
{{--                                    <label for="point">Point</label>--}}
{{--                                    <input type="number" name="point"  class="form-control" placeholder="Enter point"--}}
{{--                                           value="{{ old("point") ? old("point") : '' }}">--}}
{{--                                </div>--}}


                                <div class="form-group col-md-6">
                                    <label for="tag_category_id">Tag</label>
                                    <select class="form-control" name="tag_category_id">
                                        <option>---Select Tag---</option>
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6" >
                                    <label></label>
                                    <div class="form-group pt-1" id="show_in_home">
                                        <label for="trending" class="mr-1">Trending Offer:</label>
                                        <input type="checkbox" name="show_in_home" value="1" id="trending">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title" class="mr-1">Recharge</label>
                                        <input type="radio" name="is_recharge" value="1" id="yes" checked>
                                        <label for="yes" class="mr-1">Yes</label>

                                        <input type="radio" name="is_recharge" value="0" id="no">
                                        <label for="no">No</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title" class="mr-1">Status:</label>
                                        <input type="radio" name="status" value="1" id="active" checked>
                                        <label for="active" class="mr-1">Active</label>

                                        <input type="radio" name="status" value="0" id="inactive">
                                        <label for="inactive">Inactive</label>
                                    </div>
                                </div>


                                <div class="form-actions col-md-12">
                                    <div class="pull-right">
                                        <button id="save" class="btn btn-primary"><i
                                                class="la la-check-square-o"></i> Save
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

            function domMupulate(selectedItemName, action='hide'){
                var options = $('#offer_type option');
                var optionTextArr = $.map(options ,function(option) {
                    if( option.value !== '' &&  option.text.toLowerCase() !== selectedItemName ) { return  '#' + option.text.toLowerCase();  }
                });
                var otherElements = optionTextArr.join(',');
                action == 'remove' ? $(otherElements).remove() : $(otherElements).hide();
                $('#' + selectedItemName).show();
            }

            $('#offer_type').change(function () {
                // let optionText = $(this).children("option:selected").text();
                let showInHome = $('#show_in_home');
                let optionText =$("#offer_type option:selected").text();
                (optionText.toLowerCase() == 'startup' ? showInHome.hide() : showInHome.show())

                domMupulate(optionText.toLowerCase());
            });

            $('#save').on('click',function(e){
                e.preventDefault();
                let optionText = $("#offer_type option:selected").text();
                domMupulate( optionText.toLowerCase(),'remove');
                $("#product_form").submit();
            });
        })
    </script>

@endpush


