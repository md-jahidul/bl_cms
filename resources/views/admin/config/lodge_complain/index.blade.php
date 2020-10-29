@extends('layouts.admin')
@section('title', 'Lodge a complain Settings')
@section('card_name', 'Lodge a complain Configuration')

@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" id="save_form" action="{{route('store_lodge_complaints')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="content-header-right col-md-12">
                                    <div class="dropdown float-md-right">
                                        <button type="submit" class="btn btn-primary btn-sm pull-right" id="save_btn">
                                            Update
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-content">
                                                <div class="card-body">

                                                    <div class="row skin skin-square">
                                                        <div class="col-md-6">
                                                            <div class="form-group ">
                                                                <input type="checkbox"
                                                                       id="is_enable"
                                                                       name="is_enable"
                                                                       value="true"
                                                                       @if(isset($settings->is_enable)) @if($settings->is_enable) checked @endif @endif/>
                                                                <label for="is_enable">Show Lodge a complain </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets')}}/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets')}}/vendors/css/forms/icheck/custom.css">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets')}}/css/plugins/forms/checkboxes-radios.css">
@endpush

@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/forms/checkbox-radio.js" type="text/javascript"></script>

@endpush









