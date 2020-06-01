@extends('layouts.admin')
@section('title', 'Najat Contents Settings')
@section('card_name', 'Najat Contents Configuration')

@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{route('mybl.settings.najat.store')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="content-header-right col-md-12">
                                    <div class="dropdown float-md-right">
                                        <button type="submit" class="btn btn-primary btn-sm pull-right">
                                            Update
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group ">
                                                                <input type="checkbox"
                                                                       class="switchery"
                                                                       data-color="primary"
                                                                       name="is_enable"
                                                                       value="true"
                                                                       @if(isset($settings->is_enable)) @if($settings->is_enable) checked @endif @endif/>
                                                                <label for="switcheryColor" class="card-title ml-1">Show Najat Content</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group ">
                                                                <input type="checkbox"
                                                                       class="switchery"
                                                                       data-color="primary"
                                                                       name="show_in_home"
                                                                       value="true"
                                                                       @if(isset($settings->show_in_home)) @if($settings->show_in_home) checked @endif @endif
                                                                       />
                                                                <label for="switcheryColor" class="card-title ml-1">Show in Home</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group ">
                                                                <input type="checkbox"
                                                                       name="show_banner"
                                                                       class="switchery"
                                                                       data-color="primary"
                                                                       value="true"
                                                                       @if(isset($settings->show_banner)) @if($settings->show_banner) checked @endif @endif
                                                                       />
                                                                <label for="switcheryColor" class="card-title ml-1">Show Banner</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="checkbox"
                                                                       class="switchery"
                                                                       name="show_namaj_time"
                                                                       data-color="primary"
                                                                       value="true"
                                                                       @if(isset($settings->show_namaj_time)) @if($settings->show_namaj_time) checked @endif @endif/>
                                                                <label for="switcheryColor" class="card-title ml-1">Show Namaj Time</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="checkbox"
                                                                       class="switchery"
                                                                       data-color="primary"
                                                                       name="show_iftar_sehri_time"
                                                                       value="true"
                                                                       @if(isset($settings->show_iftar_sehri_time)) @if($settings->show_iftar_sehri_time) checked @endif @endif
                                                                       />
                                                                <label for="switcheryColor" class="card-title ml-1">Show Iftar/sehri Time</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group ">
                                                                <input type="checkbox"
                                                                       class="switchery"
                                                                       data-color="primary"
                                                                       name="show_download_link"
                                                                       value="true"
                                                                       @if(isset($settings->show_download_link)) @if($settings->show_download_link) checked @endif @endif/>
                                                                <label for="switcheryColor" class="card-title ml-1">Show App Download Link</label>
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
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets')}}/vendors/css/forms/toggle/switchery.min.css">
@endpush









