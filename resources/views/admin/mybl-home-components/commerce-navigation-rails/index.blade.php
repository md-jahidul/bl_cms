@extends('layouts.admin')
@section('title', 'Commerce Navigation Rail List')
@section('card_name', 'Commerce Navigation Rail')
@section('breadcrumb')
    <li class="breadcrumb-item active">Commerce Navigation Rail List</li>
@endsection

@section('content_header')
    <h1 class="content-header-title mb-0 d-inline-block">
        Commerce Navigation Rail List
    </h1>
@endsection

@section('content')
    <!-- /sNavigation Rail add form -->
    <section>
        <form
            action=" @if(isset($navigationMenu)) {{route('commerce-navigation-rail.update',$navigationMenu->id)}} @else {{route('commerce-navigation-rail.store')}} @endif "
            method="post" enctype="multipart/form-data">
            @csrf
            @if(isset($navigationMenu)) @method('put') @else @method('post') @endif
            <div class="container-fluid">
                <div class="row px-1 pt-1">
                    <h4 class="form-section col-md-12">
                        @if(isset($navigationMenu))
                            Update
                        @else
                            Create
                        @endif
                    </h4>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="customer_type" class="required">Customer Type</label>
                            <select required class="form-control" value="" name="customer_type" id="customer_type">
                                <option
                                    @if(isset($navigationMenu)) @if($navigationMenu->customer_type == "all") selected
                                    @endif @endif value="all">All
                                </option>
                                <option
                                    @if(isset($navigationMenu)) @if($navigationMenu->customer_type== "prepaid") selected
                                    @endif @endif value="prepaid">Prepaid
                                </option>
                                <option
                                    @if(isset($navigationMenu)) @if($navigationMenu->customer_type== "postpaid") selected
                                    @endif @endif value="postpaid">Postpaid
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title_en" class="required">Title English:</label>
                            <input required
                                   value="@if(isset($navigationMenu)){{$navigationMenu->title_en}} @elseif(old("title_en")) {{old("title_en")}} @endif"
                                   type="text" name="title_en" class="form-control @error('title_en') is-invalid @enderror"
                                   id="title_en" placeholder="Enter Shorcut Name in English..">
                            <div class="help-block">
                                <small class="text-info"> Title can not be more then 50 Characters</small>
                            </div>
                            @if(isset($navigationMenu))
                                <input type="hidden" value="{{$navigationMenu->id}}" name="id">
                            @endif
                            <small class="text-danger"> @error('title_en') {{ $message }} @enderror </small>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title_bn" class="required">Title Bangla :</label>
                            <input required
                                   value="@if(isset($navigationMenu)){{$navigationMenu->title_bn}} @elseif(old("title_bn")) {{old("title_bn")}} @endif"
                                   type="text" name="title_bn" class="form-control @error('title_bn') is-invalid @enderror"
                                   id="title_bn" placeholder="Enter Shorcut Name in Bangla..">
                            <div class="help-block">
                                <small class="text-info"> Title can not be more then 50 Characters</small>
                            </div>
                            <small class="text-danger"> @error('title_bn') {{ $message }} @enderror </small>
                        </div>
                    </div>

                    <div class="col-md-4" id="action_div">
                        @php
                            $actionList = Helper::navigationActionList();
                        @endphp

                        <div class="form-group">
                            <label>Navigate Action </label>
                            <select name="component_identifier" class="browser-default custom-select"
                                    id="navigate_action" required>
                                <option value="">Select Action</option>
                                @foreach ($actionList as $key => $value)
                                    <option
                                        @if(isset($navigationMenu->component_identifier) && $navigationMenu->component_identifier == $key)
                                        selected
                                        @endif
                                        value="{{ $key }}">
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="help-block"></div>
                        </div>
                    </div>

                    <div class="form-group col-md-4 {{ $errors->has('android_version_code') ? ' error' : '' }}">
                        <label for="title" class="required">Android Version Code</label>
                        <input type="text" name="android_version_code"  class="form-control" placeholder="Enter Version Code"
                                required data-validation-required-message="Enter Version Code" value="@if(isset($navigationMenu)){{$navigationMenu->android_version_code}} @elseif(old("android_version_code")) {{old("android_version_code")}} @endif">
                        <div class="help-block"></div>
                        <span class="text-info"><strong><i class="la la-info-circle"></i></strong> Version code should be Hyphen-separated value. Example: 10-99</span>
                        <div class="help-block"></div>
                        @if ($errors->has('android_version_code'))
                            <div class="help-block">  {{ $errors->first('android_version_code') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 {{ $errors->has('ios_version_code') ? ' error' : '' }}">
                        <label for="title" class="required">iOS Version Code</label>
                        <input type="text" name="ios_version_code"  class="form-control" placeholder="Enter Version Code"
                                required data-validation-required-message="Enter Version Code" value="@if(isset($navigationMenu)){{$navigationMenu->ios_version_code}} @elseif(old("ios_version_code")) {{old("ios_version_code")}} @endif">
                        <div class="help-block"></div>
                        <span class="text-info"><strong><i class="la la-info-circle"></i></strong> Version code should be Hyphen-separated value. Example: 10-99</span>
                        <div class="help-block"></div>
                        @if ($errors->has('ios_version_code'))
                            <div class="help-block">  {{ $errors->first('ios_version_code') }}</div>
                        @endif
                    </div>

                    <div class="col-md-3">
                        <label></label>
                        <div class="form-group mt-2">
                            <label for="title" class="required mr-1">Status:</label>
                            <input type="radio" name="status" value="1" id="input-radio-15"
                                {{ !isset($navigationMenu) ? 'checked' : $navigationMenu->status == 1 ? 'checked' : '' }}>
                            <label for="input-radio-15" class="mr-1">Active</label>
                            <input type="radio" name="status" value="0" id="input-radio-16"
                                {{ isset($navigationMenu) && $navigationMenu->status == 0 ? 'checked' : '' }}>
                            <label for="input-radio-16">Inactive</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label></label>
                        <small class="text-danger"> @error('other_info') {{ $message }} @enderror </small>
                        @if(isset($navigationMenu))
                            <button type="submit" id="submitForm" style="width:100%" class="btn btn-info">Update</button>
                        @else
                            <button type="submit" id="submitForm" style="width:100%" class="btn btn-success">Add New</button>
                        @endif
                    </div>
                </div>
            </div>
        </form>

        <div class="card card-info mt-2">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <h4 class="menu-title mb-2">Navigation Menu List  ( <small class="text-info">Draggable and auto save items </small>)</h4>
                    <table class="table table-striped table-bordered" role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th width='5%'><i class="icon-cursor-move icons"></i></th>
                            <th>Title</th>
                            <th>Navigate Action</th>
                            <th>Customer Type</th>
                            <th class="float-right">Action</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                        @foreach ($navigationMenus as $data)
                            <tr data-index="{{ $data->id }}" data-position="{{ $data->display_order }}">
                                <td width="5%"><i class="icon-cursor-move icons"></i></td>
                                <td>{{ $data->title_en }}
                                    {!! $data->status == 0 ? '<span class="inactive"> ( Inactive )</span>' : '' !!}</td>
                                <td>
                                    {{ isset($actionList [$data->component_identifier])?$actionList [$data->component_identifier] : '' }}
                                </td>
                                <td width="10%">
                                    {{ $data->customer_type }}
                                </td>
                                <td class="action">
                                    <a href="{{ route('commerce-navigation-rail.edit', $data->id) }}" role="button"
                                       class="btn btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                    <a href="#" remove="{{ route('commerce-navigation-rail.destroy', $data->id) }}"
                                       class="border-0 btn btn-outline-danger delete_btn" data-id="{{ $data->id }}" title="Delete the user">
                                        <i class="la la-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('page-css')
    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">
@endpush

@push('style')
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush
@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js"
            type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js"
            type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        var auto_save_url = "{{ url(route('commerce-navigation-rail.sort')) }}";

        $(function () {
           var content = "";
            var url_html;
            var parse_data;
            let dial_html, other_info = '';
            var js_data = `<?php echo isset($navigationMenu) ? $navigationMenu->other_info : null; ?>`;

            if (js_data) {
                parse_data = JSON.parse(js_data);
                content = parse_data.content;
            }

            // add dial number
            dial_html = ` <div class="form-group other-info-div">
                                        <label>Dial Number</label>
                                        <input type="text" name="other_info" class="form-control" value="${content}" placeholder="Enter Valid Number" required>
                                        <div class="help-block"></div>
                                    </div>`;

            url_html = ` <div class="form-group other-info-div">
                                        <label>Redirect External URL</label>
                                        <input type="text" name="other_info" class="form-control" value="${content}" placeholder="Enter Valid URL" required>
                                        <div class="help-block"></div>
                                    </div>`;


            $('#navigate_action').on('change', function () {
                let action = $(this).val();
                if (action == 'DIAL') {
                    $("#append_div").html(dial_html);
                } else if (action == 'URL') {
                    $("#append_div").html(url_html);
                } else {
                    $(".other-info-div").remove();
                }
            })

            $("#navigate_action").select2()
        });
    </script>
@endpush
