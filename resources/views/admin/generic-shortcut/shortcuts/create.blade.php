@extends('layouts.admin')
@section('title', 'Shortcuts List')
@section('card_name', 'Shortcuts')
@section('breadcrumb')
    <li class="breadcrumb-item active">Create New Shortcut</li>
@endsection

@section('content_header')
    <h1 class="content-header-title mb-0 d-inline-block">
        Create New Shortcut
    </h1>
@endsection

@section('action')
    
    <a href="@if(isset($shortcut)) {{ route('generic-shortcut', $shortcut->generic_shortcut_master_id) }} 
        @else {{ route('generic-shortcut', $masterShortcutID) }} @endif" class="btn btn-info btn-glow px-2">
        Go Back
    </a>
@endsection

@section('content')
    <!-- /short cut add form -->
    <section>
        <form
            action=" @if(isset($shortcut)) {{ route('generic-shortcut.update', $shortcut->id)}} @else {{route('generic-shortcut.store')}} @endif"
            method="post" enctype="multipart/form-data" novalidate class="form" id="slider-form">

            @csrf
            @if(isset($shortcut)) @method('put') @else @method('post') @endif

            <div class="container-fluid">
                <div class="row px-1 pt-1 bg-white">
                    <h4 class="form-section col-md-12">
                        @if(isset($shortcut))
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
                                    @if(isset($shortcut)) @if($shortcut->customer_type == "ALL") selected
                                    @endif @endif value="ALL">All
                                </option>
                                <option
                                    @if(isset($shortcut)) @if($shortcut->customer_type== "PREPAID") selected
                                    @endif @endif value="PREPAID">Prepaid
                                </option>
                                <option
                                    @if(isset($shortcut)) @if($shortcut->customer_type== "POSTPAID") selected
                                    @endif @endif value="POSTPAID">Postpaid
                                </option>
                            </select>
                        </div>
                    </div>

                    <input type="hidden" name="generic_shortcut_master_id"
                           value="@if(isset($shortcut)) {{ $shortcut->generic_shortcut_master_id }}
                                  @else {{ $masterShortcutID }} @endif">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title_en" class="required">Title EN:</label>
                            <input required
                                   value="@if(isset($shortcut)){{$shortcut->title_en}} @elseif(old("title_en")) {{old("title_en")}} @endif"
                                   type="text" name="title_en" class="form-control @error('title_en') is-invalid @enderror"
                                   id="title_en" placeholder="Enter Shortcut Name in English..">
                            <small class="text-danger"> @error('title_en') {{ $message }} @enderror </small>
                            <div class="help-block"></div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title_bn" class="required">Title BN :</label>
                            <input required
                                   value="@if(isset($shortcut)){{$shortcut->title_bn}} @elseif(old("title_bn")) {{old("title_bn")}} @endif"
                                   type="text" name="title_bn" class="form-control @error('title_bn') is-invalid @enderror"
                                   id="title_bn" placeholder="Enter Shortcut Name in Bangla..">
                            <small class="text-danger"> @error('title_bn') {{ $message }} @enderror </small>
                            <div class="help-block"></div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="default">Default :</label>
                            <select required class="form-control" value="" name="is_default" id="default">
                                <option @if(isset($shortcut)) @if($shortcut->is_default==0) selected
                                        @endif @endif value="0">Not Default
                                </option>
                                <option @if(isset($shortcut)) @if($shortcut->is_default==1) selected
                                        @endif @endif value="1">Default
                                </option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="image" class="required">Upload Icon :</label>
                            @if (isset($shortcut))
                                <input type="file"
                                       id="icon"
                                       class="dropify"
                                       name="icon"
                                       data-height="70"
                                       data-allowed-formats="square"
                                       data-allowed-file-extensions="png"
                                       data-default-file="{{ asset($shortcut->icon) }}"
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

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="deep_link" class="required">Deep Link:</label>
                            <input required
                                   value="@if(isset($shortcut)){{$shortcut->deep_link}} @elseif(old("deep_link")) {{old("deep_link")}} @endif"
                                   type="text" name="deep_link" class="form-control @error('deep_link') is-invalid @enderror"
                                   id="deep_link" placeholder="Enter Deep Link URL..">
                            <small class="text-danger"> @error('deep_link') {{ $message }} @enderror </small>
                            <div class="help-block"></div>
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
                                        @if(isset($shortcut->component_identifier) && $shortcut->component_identifier == $key)
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

                    <div id="append_div" class="col-md-4">
                        @if(isset($shortcut))
                            @if($info = json_decode($shortcut->other_info))
                                {{--{{ dd( @if($json_decode($shortcut->other_info)) @endif }}--}}
                                <div class="form-group other-info-div">
                                    <label>@if($shortcut->component_identifier == "DIAL") Dial Number @else
                                            Redirect
                                            URL @endif </label>
                                    <input type="text" name="other_info" class="form-control" required
                                           value="@if($info) {{$info->content}} @endif">
                                    <div class="help-block"></div>
                                </div>
                            @endif
                        @endif
                    </div>

                   <div class="col-md-12">
                       <div class="form-actions">
                           <button type="submit" class="btn btn-success round px-2">
                               <i class="la la-check-square-o"></i> Submit
                           </button>
                       </div>
                   </div>
                </div>
            </div>
        </form>
    </section>

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
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

    <script>

        var auto_save_url = "{{ url('shortcuts-sortable') }}";

        $(function () {
            $("#slider-form").validate();
           var content = "";
            var url_html;
            var parse_data;
            let dial_html, other_info = '';
            var js_data = `<?php echo isset($shortcut) ? $shortcut->other_info : null; ?>`;

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
                            url: "{{ url('generic-shortcut/delete') }}/" + id,
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
