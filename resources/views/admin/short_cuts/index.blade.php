@extends('layouts.admin')
@section('title', 'Shortcuts List')
@section('card_name', 'Shortcuts')
@section('breadcrumb')
    <li class="breadcrumb-item active">Shortcuts List</li>
@endsection

@section('content_header')
    <h1 class="content-header-title mb-0 d-inline-block">
        Shortcuts List
    </h1>
@endsection

@section('content')
    <!-- /short cut add form -->
    <section>
        <form
            action=" @if(isset($short_cut_info)) {{route('short_cuts.update',$short_cut_info->id)}} @else {{route('short_cuts.store')}} @endif "
            method="post" enctype="multipart/form-data">

            @csrf
            @if(isset($short_cut_info)) @method('put') @else @method('post') @endif
            <div class="container-fluid">
                <div class="row px-1 pt-1 bg-white">
                    <h4 class="form-section col-md-12">
                        @if(isset($short_cut_info))
                            Update Shortcuts
                        @else
                            Create Shortcuts
                        @endif
                    </h4>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="customer_type" class="required">Customer Type</label>
                            <select required class="form-control" value="" name="customer_type" id="customer_type">
                                <option
                                    @if(isset($short_cut_info)) @if($short_cut_info->customer_type == "ALL") selected
                                    @endif @endif value="ALL">All
                                </option>
                                <option
                                    @if(isset($short_cut_info)) @if($short_cut_info->customer_type== "PREPAID") selected
                                    @endif @endif value="PREPAID">Prepaid
                                </option>
                                <option
                                    @if(isset($short_cut_info)) @if($short_cut_info->customer_type== "POSTPAID") selected
                                    @endif @endif value="POSTPAID">Postpaid
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title" class="required">Title English:</label>
                            <input required
                                   value="@if(isset($short_cut_info)){{$short_cut_info->title}} @elseif(old("title")) {{old("title")}} @endif"
                                   type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                   id="title" placeholder="Enter Shorcut Name in English..">
                            <div class="help-block">
                                <small class="text-info"> Title can not be more then 50 Characters</small>
                            </div>
                            <input type="hidden" value="@if(isset($short_cut_info)) yes @else no @endif"
                                   name="value_exist">
                            @if(isset($short_cut_info))
                                <input type="hidden" value="{{$short_cut_info->id}}" name="id">
                            @endif
                            <small class="text-danger"> @error('title') {{ $message }} @enderror </small>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title" class="required">Title Bangla :</label>
                            <input required
                                   value="@if(isset($short_cut_info)){{$short_cut_info->title_bn}} @elseif(old("title_bn")) {{old("title_bn")}} @endif"
                                   type="text" name="title_bn" class="form-control @error('title_bn') is-invalid @enderror"
                                   id="title_bn" placeholder="Enter Shorcut Name in Bangla..">
                            <div class="help-block">
                                <small class="text-info"> Title can not be more then 50 Characters</small>
                            </div>
                            <small class="text-danger"> @error('title_bn') {{ $message }} @enderror </small>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="default">Default :</label>
                            <select required class="form-control" value="" name="is_default" id="default">
                                <option @if(isset($short_cut_info)) @if($short_cut_info->is_default==0) selected
                                        @endif @endif value="0">Not Default
                                </option>
                                <option @if(isset($short_cut_info)) @if($short_cut_info->is_default==1) selected
                                        @endif @endif value="1">Default
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="image" class="required">Upload Icon :</label>
                            @if (isset($short_cut_info))
                                <input type="file"
                                       id="icon"
                                       class="dropify"
                                       name="icon"
                                       data-height="70"
                                       data-allowed-formats="square"
                                       data-allowed-file-extensions="png"
                                       data-default-file="{{ asset($short_cut_info->icon) }}"
                                />
                            @else
                                <input type="file" required
                                       id="icon"
                                       name="icon"
                                       class="dropify"
                                       data-allowed-formats="square"
                                       data-allowed-file-extensions="png"
                                       data-height="70"/>
                            @endif
                            <div class="help-block">
                                <small class="text-danger"> @error('icon') {{ $message }} @enderror </small>
                                <small class="text-info"> Shortcut icon should be in 1:1 aspect ratio</small>
                            </div>
                            <small id="massage"></small>
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
                                        @if(isset($short_cut_info->component_identifier) && $short_cut_info->component_identifier == $key)
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
                        <label for="title" class="">Android Version Code</label>
                        <input type="text" name="android_version_code"  class="form-control" placeholder="Enter Version Code" value="@if(isset($short_cut_info)){{$short_cut_info->android_version_code}} @elseif(old("android_version_code")) {{old("android_version_code")}} @endif">
                        <div class="help-block"></div>
                        <span class="text-info"><strong><i class="la la-info-circle"></i></strong> Version code should be Hyphen-separated value. Example: 10-99</span>
                        <div class="help-block"></div>
                        @if ($errors->has('android_version_code'))
                            <div class="help-block">  {{ $errors->first('android_version_code') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4 {{ $errors->has('ios_version_code') ? ' error' : '' }}">
                        <label for="title" class="">iOS Version Code</label>
                        <input type="text" name="ios_version_code"  class="form-control" placeholder="Enter Version Code" value="@if(isset($short_cut_info)){{$short_cut_info->ios_version_code}} @elseif(old("ios_version_code")) {{old("ios_version_code")}} @endif">
                        <div class="help-block"></div>
                        <span class="text-info"><strong><i class="la la-info-circle"></i></strong> Version code should be Hyphen-separated value. Example: 10-99</span>
                        <div class="help-block"></div>
                        @if ($errors->has('ios_version_code'))
                            <div class="help-block">  {{ $errors->first('ios_version_code') }}</div>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="is_highlight">Is Highlight :</label>
                            <select required class="form-control" value="" name="is_highlight" id="is_highlight">
                                <option @if(isset($short_cut_info)) @if($short_cut_info->is_highlight==0) selected
                                        @endif @endif value="0">Inactive
                                </option>
                                <option @if(isset($short_cut_info)) @if($short_cut_info->is_highlight==1) selected
                                        @endif @endif value="1">Active
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="deeplink" >Deeplink :</label>
                            <input
                                   value="@if(isset($short_cut_info)){{$short_cut_info->deeplink}} @elseif(old("deeplink")) {{old("deeplink")}} @endif"
                                   type="text" name="deeplink" class="form-control @error('deeplink') is-invalid @enderror"
                                   id="title_bn" placeholder="Enter Deeplink..">
                            <small class="text-danger"> @error('deeplink') {{ $message }} @enderror </small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <small class="text-danger"> @error('other_info') {{ $message }} @enderror </small>
                        @if(isset($short_cut_info))
                            <button type="submit" id="submitForm" style="width:100%" class="btn btn-info">Update
                                Shortcut
                            </button>
                        @else
                            <button type="submit" id="submitForm" style="width:100%" class="btn btn-info">Add Shortcut
                            </button>
                        @endif
                    </div>

                    <div id="append_div" class="col-md-4">
                        @if(isset($short_cut_info))
                            @if($info = json_decode($short_cut_info->other_info))
                                {{--{{ dd( @if($json_decode($short_cut_info->other_info)) @endif }}--}}
                                <div class="form-group other-info-div">
                                    <label>@if($short_cut_info->component_identifier == "DIAL") Dial Number @else
                                            Redirect
                                            URL @endif </label>
                                    <input type="text" name="other_info" class="form-control" required
                                           value="@if($info) {{$info->content}} @endif">
                                    <div class="help-block"></div>
                                </div>
                            @endif
                        @endif
                    </div>


                </div>
            </div>
        </form>

        <div class="card card-info mt-0" style="box-shadow: 0px 0px">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered alt-pagination no-footer dataTable" id="Example1"
                           role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th width='5%'><i class="icon-cursor-move icons"></i></th>
                            <th>Title</th>
                            <th>Navigate Action</th>
                            <th> Icon</th>
                            <th>Is Default</th>
                            <th>Customer Type</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                        @foreach ($short_cuts as $short_cut)
                            <tr data-index="{{ $short_cut->id }}" data-position="{{ $short_cut->display_order }}">
                                <td width="5%"><i class="icon-cursor-move icons"></i></td>
                                <td>{{$short_cut->title}}</td>
                                <td>
                                    {{ isset($actionList [$short_cut->component_identifier])?$actionList [$short_cut->component_identifier] : '' }}
                                </td>
                                <td><img style="height:20px;width:20px" src="{{asset($short_cut->icon)}}"
                                         alt="" srcset=""></td>
                                <td width="10%">
                                    @if($short_cut->is_default==1) Default @else Not Default @endif
                                </td>
                                <td width="10%">
                                    {{ $short_cut->customer_type }}
                                </td>
                                <td>
                                    <div class="form-group">
                                        <div class="btn-group" role="group">
                                            <a type="button"
                                               title="Edit"
                                               href="{{route('short_cuts.edit',$short_cut->id)}}"
                                               class="btn btn-icon btn-outline-primary">
                                                <i class="la la-pencil"></i>
                                            </a>
                                            <button type="button"
                                                    title="Delete"
                                                    data-id="{{$short_cut->id}}"
                                                    class="btn btn-icon btn-outline-danger delete">
                                                <i class="la la-remove"></i>
                                            </button>
                                        </div>
                                    </div>
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

@section('content_right_side_bar')
    <h1>
        info
    </h1>
@endsection


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

        var auto_save_url = "{{ url('shortcuts-sortable') }}";

        $(function () {
           var content = "";
            var url_html;
            var parse_data;
            let dial_html, other_info = '';
            var js_data = `<?php echo isset($short_cut_info) ? $short_cut_info->other_info : null; ?>`;

            //console.log(js_data);

            if (js_data) {
                parse_data = JSON.parse(js_data);
                content = parse_data.content;
            }

            $('.delete').click(function () {
                var id = $(this).attr('data-id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    html: jQuery('.delete_btn').html(),
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "{{ url('shortcuts/destroy') }}/" + id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)

                                function redirect() {
                                    window.location.href = "{{ url('shortcuts/') }}"
                                }
                            }
                        })
                    }
                })
            })
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
        });


        $(document).ready(function () {
            $('#Example1').DataTable({
                dom: 'Bfrtip',
                buttons: [],
                "pageLength": 10,
                paging: true,
                searching: true,
                "bDestroy": true,
            });

            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Icon to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct Icon file'
                },
                error: {
                    'imageFormat': 'The image ratio must be 1:1.'
                }
            });
        });

    </script>
@endpush
