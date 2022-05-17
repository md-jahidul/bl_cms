@extends('layouts.admin')
@section('title', 'Health Hub New Journey')
@section('card_name', 'Health Hub New Journey')

@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <h5 class="menu-title"><strong>Dashboard</strong></h5>
                        <hr>
                        <form role="form"
                              action="{{ route('health-hub-feature-dashboard.store') }}"
                              method="POST"
                              class="form"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="title" class="required">Title English</label>
                                        <input class="form-control"
                                               name="title_en"
                                               id="title_en"
                                               value="{{ isset($data->title_en) ? $data->title_en : old("title_en") }}"
                                               required>
                                        @if($errors->has('title_en'))
                                            <p class="text-left">
                                                <small class="danger text-muted">{{ $errors->first('title_en') }}</small>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="title" class="required">Title Bangla</label>
                                        <input class="form-control"
                                               name="title_bn"
                                               id="title_bn"
                                               value="{{ isset($data->title_bn) ? $data->title_bn : old("title_bn") }}"
                                               required>
                                        @if($errors->has('title_bn'))
                                            <p class="text-left">
                                                <small class="danger text-muted">{{ $errors->first('title_bn') }}</small>
                                            </p>
                                        @endif
                                    </div>
                                <div class="col-md-6" id="content_div">
                                    <div class="form-group">
                                        <label class="required">Home Banner</label>
                                        <input type="file"
                                               name="home_banner"
                                               data-max-file-size="2M"
                                               data-allowed-file-extensions="jpeg png jpg"
                                               @if(isset($data->home_banner))
                                                data-default-file="{{ url('storage/' .$data->home_banner) }}"
                                               @else
                                                required
                                               @endif
                                               class="dropify"/>
                                    </div>
                                    @if($errors->has('content_div'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('content_div') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="col-md-6" id="content_div">
                                    <div class="form-group">
                                        <label class="required">Landing Page Image</label>
                                        <input type="file"
                                               name="landing_page_banner"
                                               data-allowed-file-extensions="jpeg png jpg"
                                               @if(isset($data->landing_page_banner))
                                                data-default-file="{{ url('storage/' .$data->landing_page_banner) }}"
                                               @else
                                               @endif
                                               data-allowed-file-extensions="png jpg jpeg gif"
                                               class="dropify"/>
                                    </div>
                                    <div class="help-block"></div>
                                    @if($errors->has('content_div'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('content_div') }}</small>
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <h5 class="menu-title"><strong>Services</strong></h5>
                            <hr>
                            <table class="table table-striped table-bordered dataTable" id="Example1">
                                <thead>

                                </thead>
                                <tbody>
                                @foreach ($services as $key => $service)
                                    <tr>
                                        <td width='10%'>{{ ++$key }}</td>
                                        <td width='10%'>{{ $service->title_en }}</td>
                                        <td 
                                            width='10%'><img style="height:50px;width:100px" src="{{asset($service->logo)}}" alt="Service Logo" srcset="">
                                            @if (isset($service->health_hub_dashboard_id))
                                                <a href="#"
                                                    class="border-0 btn btn-outline-danger float-right delete_service_btn delete_service" data-id="{{ $service->id }}" title="Remove Service">
                                                    <i class="la la-trash"></i>
                                                </a>
                                            @else 
                                                <a href="#"
                                                    class="btn-sm btn-success cursor-pointer  float-right add_service add_service_btn" data-id="{{ $service->id }}" title="Add Service">
                                                    <i class="la la-plus"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <h5 class="menu-title"><strong>Packages</strong></h5>
                            <hr>
                            <table class="table table-striped table-bordered dataTable" id="Example1">
                                <thead>
                                </thead>
                                <tbody>
                                @foreach ($packages as $key => $package)
                                    <tr>
                                        <td width='10%'>{{ ++$key }}</td>
                                        <td width='10%'>{{ $package->title_en }}</td>
                                        <td 
                                            width='10%'><img style="height:50px;width:100px" src="{{asset($package->logo)}}" alt="Package Logo" srcset="">
                                            @if (isset($package->health_hub_dashboard_id))
                                                <a href="#"
                                                    class="border-0 btn btn-outline-danger float-right delete_package_btn delete_package" data-id="{{ $package->id }}" title="Remove Package">
                                                    <i class="la la-trash"></i>
                                                </a>
                                            @else 
                                                <a href="#"
                                                    class="btn-sm btn-success cursor-pointer  float-right add_package add_package_btn" data-id="{{ $package->id }}" title="Add Package">
                                                    <i class="la la-plus"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success mt-2">
                                    <i class="ft-save"></i> Save
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/weekday-picker.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/plugins/pickers/daterange/daterange.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush

@push('page-js')
    <script src="{{ asset('app-assets/js/recurring-schedule/recurring.js')}}"></script>
    <script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/daterange/daterangepicker.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    {{--    <script src="{{ asset('app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js')}}"></script>--}}
    {{--    <script src="{{ asset('js/custom-js/start-end.js')}}"></script>--}}
    <script>

        $(function () {
            $('.delete_service').click(function () {
                var id = $(this).attr('data-id');
                console.log(id);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    html: jQuery('.delete_service_btn').html(),
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Remove it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "{{ url('health-hub-feature-service/delete-dashboard-id') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Removed!',
                                    'Your Service has been removed from the Dashboard.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('health-hub-feature-dashboard') }}"
                                }
                            }
                        })
                    }
                })
            });
            $('.delete_package').click(function () {
                var id = $(this).attr('data-id');
                console.log(id);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    html: jQuery('.delete_package_btn').html(),
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Remove it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "{{ url('health-hub-feature-package/delete-dashboard-id') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Removed!',
                                    'Your Package has been removed from the Dashboard.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('health-hub-feature-dashboard') }}"
                                }
                            }
                        })
                    }
                })
            });
            $('.add_service').click(function () {
                var id = $(this).attr('data-id');
                console.log(id);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    html: jQuery('.add_service_btn').html(),
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Add it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "{{ url('health-hub-feature-service/update-dashboard-id') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Added!',
                                    'Your Service has been added to the Dashboard.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('health-hub-feature-dashboard') }}"
                                }
                            }
                        })
                    }
                })
            });
            $('.add_package').click(function () {
                var id = $(this).attr('data-id');
                console.log(id);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    html: jQuery('.add_package_btn').html(),
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Add it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "{{ url('health-hub-feature-package/update-dashboard-id') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Added!',
                                    'Your Package has been added to the Dashboard.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('health-hub-feature-dashboard') }}"
                                }
                            }
                        })
                    }
                })
            });
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

            function initiateSummernote(selector) {
                $(selector).summernote({
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['table', ['table']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['view', ['fullscreen']]
                    ],
                    height: 300
                });
            }

            function initiateImage() {
                let html = `<div class="form-group">
                                 <label class="required">Image</label>
                                 <input type="file"
                                               required
                                               name="content_data"
                                               data-max-file-size="2M"
                                               data-allowed-formats="portrait square"
                                               data-allowed-file-extensions="jpeg png jpg"
                                               class="dropify"/>
                              </div>`;
                $("#content_div").html(html);
                initiateDropify('.dropify');
            }

            function initiatePurchaseImage() {
                let html = `<div class="form-group">
                                 <label class="required">Image</label>
                                 <input type="file"
                                               required
                                               name="content_data"
                                               data-allowed-formats="portrait square landscape"
                                               data-max-file-size="2M"
                                               data-allowed-file-extensions="jpeg png jpg"
                                               class="dropify"/>
                              </div>`;
                $("#content_div").html(html);
                initiateDropify('.dropify');
            }

            function initiateTextEditor() {
                let html = `<div class="form-group">
                                    <label for="html_content" class="required">Content</label>
                                    <textarea id="html_content" name="content_data" required></textarea>
                             </div>`;
                $("#content_div").html(html);

                initiateSummernote('#html_content');
            }
            initiateDropify('.dropify');
        })
    </script>
@endpush







