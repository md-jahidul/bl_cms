@extends('layouts.admin')
@section('title', 'Notification V2')
@section('card_name', 'Notification V2')
@section('breadcrumb')
    <li class="breadcrumb-item active">Notification V2</li>
@endsection

@section('content')
<div class="card mb-0 px-1" style="box-shadow:none;">
    <div class="card-content">
        <div class="card-body">
            <form novalidate class="form" method="post" action="{{route('notification-v2.update',$notification['_id'])}}"  enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="form-body">
                    <h4 class="form-section"><i class="la la-key"></i>
                        Edit Notification V2
                    </h4>
                    <div class="row">
                        <div class="col-md-4">
                            <input type="hidden" name="id" value="{{$notification['_id']}}">
                            <div class="form-group">
                                <label for="title" class="required">Title :</label>
                                <input name="title"
                                       required
                                       maxlength="100"
                                       data-validation-required-message="Title is required"
                                       data-validation-maxlength-message = "Title can not be more then 100 Characters"

                                style="height:100%" type="text" value="@if(old('title')) {{old('title')}} @else {{$notification['title']}} @endif" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Enter title..">
                                <div class="help-block">
                                    <small class="text-info"> Title can not be more then 100 Characters</small><br>
                                </div>
                                <small class="text-danger"> @error('title') {{ $message }} @enderror </small>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="category_id" class="required">
                                    Category :
                                </label>
                                <div class="controls">
                                    <select name="category_id" id="category_id" required class="form-control @error('category_id') is-invalid @enderror">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option @if(old("category_id")) {{ (old("category_id") == $category['_id'] ? "selected":"") }}  @elseif($category['_id'] == $notification['notification_category']['_id']['$oid']) selected  @endif value="{{$category['_id']}}" {{ (old("category_id") == $category['_id'] ? "selected":"") }}>{{$category['name']}}</option>
                                    @endforeach
                                    </select>
                                    <div class="help-block"></div>
                                    <small class="text-danger"> @error('category_id') {{ $message }} @enderror </small>
                                </div>
                            </div>
                        </div>
{{--                        @php $date = $notification->starts_at .'-'. $notification->expires_at; @endphp--}}
{{--                        <input name="display_period" type="hidden" value="{{$date}}">--}}
{{--                       --}}
{{--                        <div class="col-md-4">--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="start_date" class="required">Time Period</label>--}}
{{--                                <div class='input-group'>--}}
{{--                                    <input type='text'--}}
{{--                                           class="form-control datetime"--}}
{{--                                value="{{$date}}"--}}
{{--                                           name="display_period"--}}
{{--                                           id="display_period"/>--}}
{{--                                    @if($errors->has('display_period'))--}}
{{--                                        <p class="text-left">--}}
{{--                                            <small class="danger text-muted">{{ $errors->first('display_period') }}</small>--}}
{{--                                        </p>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        {{-- <div class="col-md-4">

                            <div class="form-group">
                                <label for="cta_name" class="required">
                                    CTA Name:
                                </label>
                                <div class="controls">
                                    <select name="cta_name" id="cta_name" required class="form-control">
                                    <option value="">Select CTA name</option>
                                    <option value="yes" @if($notification->cta_name=='yes') selected @endif>Yes</option>
                                    <option value="no" @if($notification->cta_name=='no') selected @endif>No</option>
                                    <option value="buy_now" @if($notification->cta_name=='buy_now') selected @endif>Buy Now</option>
                                    </select>
                                    <div class="help-block"></div>
                                    <small class="text-danger"> @error('cta_name') {{ $message }} @enderror </small>
                                </div>
                            </div>
                        </div> --}}

                        {{-- <div class="col-md-4">
                            <div class="form-group">
                                <label for="cta_action" class="required">
                                    CTA Action :
                                </label>
                                <div class="controls">
                                    <select name="cta_action" id="cta_action" required class="form-control">
                                    <option value="">Select CTA type</option>
                                    <option value="direct_purchase" @if($notification->cta_action=='direct_purchase') selected @endif>Direct purchase</option>
                                    <option value="internal_link" @if($notification->cta_action=='internal_link') selected @endif>Internal Link</option>
                                    </select>
                                    <div class="help-block"></div>
                                    <small class="text-danger"> @error('cta_action') {{ $message }} @enderror </small>
                                </div>
                            </div>
                        </div> --}}

                        {{-- <div class="col-md-4">
                            <div class="form-group">
                                <label for="category_id" class="required">
                                    Notification type :
                                </label>
                                <div class="controls">
                                    <select name="notification_type" id="notification_type" required class="form-control">
                                    <option value="">Select notification type</option>
                                    <option value="individual" @if($notification->notification_type=='individual') selected @endif>Individual</option>
                                    <option value="bulk" @if($notification->notification_type=='bulk') selected @endif>Bulk</option>
                                    </select>
                                    <div class="help-block"></div>
                                    <small class="text-danger"> @error('notification_type') {{ $message }} @enderror </small>
                                </div>
                            </div>
                        </div> --}}

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="device_type" class="required">
                                    Target OS :
                                </label>
                                <div class="controls">
                                    <select name="device_type" id="device_type" class="form-control" required>
                                    {{-- <option value="">Select Devices</option> --}}
                                    <option value="all" @if($notification['device_type'] == 'all') selected @endif>All</option>
                                    <option value="ios" @if($notification['device_type'] == 'ios') selected @endif>IOS</option>
                                    <option value="android" @if($notification['device_type'] == 'android') selected @endif>Android</option>
                                    </select>
                                    <div class="help-block" ></div>
                                    <small class="text-danger"> @error('device_type') {{ $message }} @enderror </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="customer_type" class="required">
                                    Customer type :
                                </label>
                                <div class="controls">
                                    <select name="customer_type" id="customer_type" required class="form-control">
                                    <option value="">Select Customer Type</option>
                                    <option value="all" @if($notification['customer_type'] == 'all') selected @endif>All</option>
                                    <option value="prepaid" @if($notification['customer_type'] == 'prepaid') selected @endif>Prepaid</option>
                                    <option value="postpaid" @if($notification['customer_type'] == 'postpaid') selected @endif>Postpaid</option>
                                    </select>
                                    <div class="help-block"></div>
                                    <small class="text-danger"> @error('customer_type') {{ $message }} @enderror </small>
                                </div>
                            </div>
                        </div>

{{-- ================================================= --}}


                        <div class="col-md-4" id="action_div">
                            @php
                                $actionList = Helper::navigationActionList();
                            @endphp

                            <div class="form-group">
                                <label class="required">Navigate Action :</label>
                                <select name="navigate_action" class="browser-default custom-select"
                                        id="navigate_action" required>
                                    <option value="">Select Action</option>
                                    @foreach ($actionList as $key => $value)
                                        <option
                                            @if(isset($notification['navigate_action']) && $notification['navigate_action'] == $key)
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
                            @if(isset($notification))
                                @if(!empty($notification->external_url))
                                    <div class="form-group other-info-div">
                                        <label id="lavel_id">Redirect URL</label>
                                        <input type="text" name="external_url" class="form-control" required
                                    value="{{$notification->external_url}}">
                                        <div class="help-block"></div>
                                    </div>
                                @endif
                            @endif
                        </div>

{{-- ========================================================= --}}
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="image" class="required">Upload image :</label>
                                @if (isset($notification))
                                    <input type="file"
                                         id="image"
                                         name="image"
                                         class="dropify"
                                         data-default-file="{{ asset($notification['image']) }}"
                                        />
                                @else
                                    <input type="file"
                                        id="image"
                                        name="image"
                                        class="dropify"
                                        />
                                @endif

                                <div class="help-block">
                                    <small class="text-danger"> @error('image') {{ $message }} @enderror </small>
                                    {{-- <small class="text-info"> Shortcut icon should be in 1:1 aspect ratio</small> --}}
                                </div>
                                <small id="massage"></small>
                            </div>
                        </div>
                            <div class="col-md-7">
                            <div class="form-group">
                                <label for="body" class="required">Body :</label>
                                <textarea
                                required
                                data-validation-required-message="body is required"
                                class="form-control @error('body') is-invalid @enderror" placeholder="Enter body description....." id="body" name="body" rows="10">@if(old('body')){{old('body')}} @else {{$notification['body']}}@endif</textarea>
                                <div class="help-block"></div>
                                <small class="text-danger"> @error('body') {{ $message }} @enderror </small>
                            </div>
                            </div>



                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success round px-2">
                                <i class="la la-check-square-o"></i> Submit
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection


@push('style')
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/plugins/pickers/daterange/daterange.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <style></style>
@endpush
@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/daterange/daterangepicker.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
      $(function () {
            var new_start_date;
            var date;
            // Date & Time
            date = new Date();
            date.setDate(date.getDate());
            new_start_date = new Date('{{$notification['starts_at']}}');

            $('.datetime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 1,
                minDate: (new_start_date < date) ? new_start_date : date,
                locale: {
                    format: 'YYYY/MM/DD h:mm A'
                }
            });

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
                            url: "{{ url('setting/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('setting/') }}"
                                }
                            }
                        })
                    }
                })
            })
        })


        function initiateDropify(selector) {
                $(selector).dropify({
                    messages: {
                        'default': 'Browse for an Image to upload',
                        'replace': 'Click to replace',
                        'remove': 'Remove',
                        'error': 'Choose correct Image file'
                    }
                });
            }

        $(document).ready(function () {
            $("#lavel_id").empty();
            $('#lavel_id').html($('#navigate_action').find("option:selected").text());
            initiateDropify('.dropify');
            $('#Example1').DataTable({
                dom: 'Bfrtip',
                buttons: [],
                paging: true,
                searching: true,
                "bDestroy": true,
            });
        });

        var dial_content = "";
            var redirect_content = "";
            var purchase_content = "";
            var url_html;
            var product_html;
            var parse_data;
            let dial_html, other_attributes = '';
            var js_data ="<?php echo $notification['navigate_action']; ?>"; //<?php echo isset($search_content) ? json_encode($search_content->other_contents) : null; ?>;

            if (js_data) {
                other_attributes =js_data; //JSON.parse(js_data);
                if (other_attributes) {
                    type =js_data; //other_attributes.type;
                    if(type == 'dial'){
                        dial_content = js_data; //other_attributes.content;
                    }else if(type == 'url'){
                        redirect_content =js_data; // other_attributes.content;
                    }else{
                        purchase_content =js_data; /// other_attributes.content;
                    }
                }
            }
            // add dial number
            dial_html = ` <div class="form-group other-info-div">
                                        <label>Dial Number</label>
                                        <input type="text" name="external_url" class="form-control" value="${dial_content}" placeholder="Enter Valid Number" required>
                                        <div class="help-block"></div>
                                    </div>`;

            url_html = ` <div class="form-group other-info-div">
                                        <label>Redirect External URL</label>
                                        <input type="text" name="external_url" class="form-control" value="${redirect_content}" placeholder="Enter Valid URL" required>
                                        <div class="help-block"></div>
                                    </div>`;

            product_html = ` <div class="form-group other-info-div">
                                        <label>Select a product</label>
                                        <select class="product-list form-control" name="external_url">
                                            <option value="${purchase_content}" selected="selected">${purchase_content}</option>
                                         </select>
                                        <div class="help-block"></div>
                                    </div>`;
        $('#navigate_action').on('change', function () {
                let action = $(this).val();
                if (action == 'DIAL') {
                    $("#append_div").html(dial_html);
                }else if(action == 'URL') {
                    $("#append_div").html(url_html);
                } else if (action == 'PURCHASE') {
                    $("#append_div").html(product_html);
                    $(".product-list").select2({
                        placeholder: "Select a product",
                        ajax: {
                            url: "{{ route('myblslider.active-products') }}",
                            processResults: function (data) {
                                // Transforms the top-level key of the response object from 'items' to 'results'
                                return {
                                    results: data
                                };
                            }
                        }
                    });
                }  else {
                    $(".other-info-div").remove();
                }
            });
    </script>
@endpush
