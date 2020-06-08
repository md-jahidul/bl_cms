@extends('layouts.admin')
@section('title', 'Najat Contents Settings')
@section('card_name', 'Najat Contents Configuration')

@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" id="save_form" action="{{route('mybl.settings.najat.store')}}" method="POST">
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
                                                    <div class="row" style="display: none;" id="warning_div">
                                                        <div class="col-md-10">
                                                            <div class="alert bg-warning alert-dismissible mb-2" role="alert">
                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                                Show Najat Content is now unchecked and will be hide from app if you update with this settings!
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row skin skin-square">
                                                        <div class="col-md-6">
                                                            <div class="form-group ">
                                                                <input type="checkbox"
                                                                       id="is_enable"
                                                                       name="is_enable"
                                                                       value="true"
                                                                       @if(isset($settings->is_enable)) @if($settings->is_enable) checked @endif @endif/>
                                                                <label for="is_enable">Show Najat Content</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="checkbox"
                                                                       class="dependent_checkbox"
                                                                       id="show_in_home"
                                                                       name="show_in_home"
                                                                       value="true"
                                                                       @if(isset($settings->show_in_home)) @if($settings->show_in_home) checked @endif @endif
                                                                       />
                                                                <label for="show_in_home">Show in Home</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group ">
                                                                <input type="checkbox"
                                                                       class="dependent_checkbox"
                                                                       name="show_banner"
                                                                       id="show_banner"
                                                                       value="true"
                                                                       @if(isset($settings->show_banner)) @if($settings->show_banner) checked @endif @endif
                                                                       />
                                                                <label for="show_banner" >Show Banner</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="checkbox"
                                                                       class="dependent_checkbox"
                                                                       name="show_namaj_time"
                                                                       id="show_namaj_time"
                                                                       value="true"
                                                                       @if(isset($settings->show_namaj_time)) @if($settings->show_namaj_time) checked @endif @endif/>
                                                                <label for="show_namaj_time" >Show Namaj Time</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="checkbox"
                                                                       class="dependent_checkbox"
                                                                       id="show_iftar_sehri_time"
                                                                       name="show_iftar_sehri_time"
                                                                       value="true"
                                                                       @if(isset($settings->show_iftar_sehri_time)) @if($settings->show_iftar_sehri_time) checked @endif @endif
                                                                       />
                                                                <label for="show_iftar_sehri_time" >Show Iftar/sehri Time</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group ">
                                                                <input type="checkbox"
                                                                       class="dependent_checkbox"
                                                                       name="show_download_link"
                                                                       id="show_download_link"
                                                                       value="true"
                                                                       @if(isset($settings->show_download_link)) @if($settings->show_download_link) checked @endif @endif/>
                                                                <label for="show_download_link" >Show App Download Link</label>
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

    <script>
        $(document).ready(function() {
            $('#is_enable').on('ifChecked', function(event){
                $('.dependent_checkbox').iCheck('enable');

                $("#warning_div").hide();
            });

            $('#is_enable').on('ifUnchecked', function(event){
                $("#warning_div").show();

                $('.dependent_checkbox').iCheck('disable');
            });

            $(document).on('click', '#save_btn', function (e) {
                var $checked;
                e.preventDefault();

                if($('#is_enable').is(":checked")){
                    $checked = $('.dependent_checkbox:checked');
                    if($checked.length < 1){
                        Swal.fire(
                            'Error!',
                            'Please, choose minimum one content to show',
                            'error',
                        );

                        return;
                    }
                }

                $("#save_form").submit();

            })
        });
    </script>
@endpush









