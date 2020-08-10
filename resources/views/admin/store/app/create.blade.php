@extends('layouts.admin')
@section('title', 'App')
@section('card_name', 'App')
@section('breadcrumb')
    <li class="breadcrumb-item active">App</li>
@endsection

@section('content')
    <div class="card mb-0 px-1" style="box-shadow:none;">
        <div class="card-content">
            <div class="card-body">
                <form novalidate class="form"
                      action="@if(isset($appStore)){{route('appStore.update',$appStore->id)}} @else {{route('appStore.store')}} @endif"
                      method="post" enctype="multipart/form-data">
                    @csrf
                    @if(isset($appStore)) @method('put') @else @method('post') @endif


                    <div class="form-body">
                        <h4 class="form-section col-md-12">
                            @if(isset($appStore))
                                Update App
                            @else
                                Create App
                            @endif
                        </h4>

                        <div class="row">
                            <div class="col-md-4">
                                <input type="hidden" name="id" value="@if(isset($appStore)){{$appStore->id}} @elseif(old("id")) {{old("id")}} @endif">
                                <div class="form-group">
                                    <label for="title" class="required">Title:</label>
                                    <input name="title"
                                           required
                                           maxlength="100"
                                           data-validation-required-message="Title is required"
                                           data-validation-maxlength-message="Title can not be more then 100 Characters"

                                           style="height:100%" type="text" value="@if(isset($appStore)){{$appStore->title}} @elseif(old("title")) {{old("title")}} @endif"
                                           class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Enter title..">
                                    <div class="help-block">
                                        {{--<small class="text-info"> Title can not be more then 100 Characters</small><br>--}}
                                    </div>
                                    <small class="text-danger"> @error('title') {{ $message }} @enderror </small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="title" class="required">Sub Title:</label>
                                    <input required
                                           value="@if(isset($appStore)){{$appStore->sub_title}} @elseif(old("sub_title")) {{old("sub_title")}} @endif"
                                           type="text" name="sub_title" class="form-control @error('type') is-invalid @enderror"
                                           id="type" placeholder="Enter sub_title">
                                    <div class="help-block"></div>
                                    <small class="text-danger"> @error('sub_title') {{ $message }} @enderror </small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="store_id" class="required">
                                        Store :
                                    </label>
                                    <div class="controls">
                                        <select name="store_id" id="store_id" class="store_select form-control @error('store_id') is-invalid @enderror">
                                            <option value="">Select Store</option>
                                            @foreach ($stores as $store)
                                                <option @if(old("store_id")) {{ (old("store_id") == $store->id ? "selected":"") }}
                                                        @elseif(isset($appStore) && ($store->id == $appStore->store_id)) selected  @endif
                                                        value="{{$store->id}}" {{ (old("store_id") == $store->id ? "selected":"") }}>{{$store->title}}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block"></div>
                                        <small class="text-danger"> @error('store_id') {{ $message }} @enderror </small>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="category_id" class="required">
                                        Category :
                                    </label>
                                    <div class="controls">
                                        <select name="category_id" id="category_id"  class="form-control @error('category_id') is-invalid @enderror">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option @if(old("category_id")) {{ (old("category_id") == $category->id ? "selected":"") }}
                                                        @elseif(isset($appStore) && ($category->id == $appStore->category_id)) selected  @endif
                                                value="{{$category->id}}" {{ (old("category_id") == $category->id ? "selected":"") }}>{{$category->name_en}}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block"></div>
                                        <small class="text-danger"> @error('category_id') {{ $message }} @enderror </small>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="category_id">
                                        Sub Category :
                                    </label>
                                    <div class="controls">
                                        <select name="sub_category_id" id="sub_category_id" class="form-control @error('sub_category_id') is-invalid @enderror">
                                            <option value="">Select Sub Category</option>
                                            @foreach ($subCategories as $subCategory)
                                                <option @if(old("category_id")) {{ (old("category_id") == $subCategory->id ? "selected":"") }}
                                                        @elseif(isset($appStore) && ($subCategory->id == $appStore->category_id)) selected  @endif
                                                value="{{$subCategory->id}}" {{ (old("category_id") == $subCategory->id ? "selected":"") }}>{{$subCategory->name_en}}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block"></div>
                                        <small class="text-danger"> @error('category_id') {{ $message }} @enderror </small>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="title" class="required">Button Text:</label>
                                    <input required
                                           value="@if(isset($appStore)){{$appStore->btn_text}} @elseif(old("btn_text")) {{old("btn_text")}} @endif"
                                           type="text" name="btn_text" class="form-control @error('btn_text') is-invalid @enderror"
                                           id="btn_text" placeholder="Enter Button Text">
                                    <div class="help-block">
                                    </div>
                                    <small class="text-danger"> @error('btn_text') {{ $message }} @enderror </small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="title" class="required">Button Action Type:</label>
                                    <select required class="form-control" value="" name="btn_action_type" id="btn_action_type">
                                        <option @if(isset($appStore)) @if($appStore->is_default=='url') selected
                                                @endif @endif value="url">URL
                                        </option>
                                        <option @if(isset($appStore)) @if($appStore->is_default=="navigation") selected
                                                @endif @endif value="navigation">Navigation
                                        </option>
                                    </select>
                                    <div class="help-block">
                                    </div>
                                    <small class="text-danger"> @error('btn_action_type') {{ $message }} @enderror </small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="title" class="required">Button Action (iOS):</label>
                                    <input required
                                           value="@if(isset($appStore)){{$appStore->btn_action_ios}} @elseif(old("btn_action_ios")) {{old("btn_action_ios")}} @endif"
                                           type="text" name="btn_action_ios" class="form-control @error('btn_action_ios') is-invalid @enderror"
                                           id="btn_action_ios" placeholder="Enter Button Text">
                                    <div class="help-block">
                                    </div>
                                    <small class="text-danger"> @error('btn_action_ios') {{ $message }} @enderror </small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="title" class="required">Button Action (Android):</label>
                                    <input required
                                           value="@if(isset($appStore)){{$appStore->btn_action_ios}} @elseif(old("btn_action_ios")) {{old("btn_action_ios")}} @endif"
                                           type="text" name="btn_action_ios" class="form-control @error('btn_action_ios') is-invalid @enderror"
                                           id="btn_action_ios" placeholder="Enter Button Text">
                                    <div class="help-block">
                                    </div>
                                    <small class="text-danger"> @error('btn_action_ios') {{ $message }} @enderror </small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="icon">Upload Icon :</label>
                                    @if (isset($appStore))
                                        <input type="file"
                                               id="icon"
                                               class="dropify_icon"
                                               name="icon"
                                               data-height="70"
                                               data-allowed-formats="square"
                                               data-allowed-file-extensions="png"
                                               data-default-file="{{ asset($appStore->icon) }}"
                                        />
                                    @else
                                        <input type="file" required
                                               id="icon"
                                               name="icon"
                                               class="dropify_icon"
                                               data-allowed-formats="square"
                                               data-allowed-file-extensions="png"
                                               data-height="70"/>
                                    @endif
                                    <div class="help-block">
                                        <small class="text-danger"> @error('icon') {{ $message }} @enderror </small>
                                    </div>
                                    <small id="massage"></small>
                                </div>
                            </div>



                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="image" class="required">Upload Image :</label>
                                    @if (isset($appStore))
                                        <input type="file"
                                               id="image_url"
                                               class="dropify_image"
                                               name="image_url"
                                               data-height="70"
                                               data-default-file="{{ asset($appStore->image_url) }}"
                                        />
                                    @else
                                        <input type="file" required
                                               id="image_url"
                                               name="image_url"
                                               data-height="70"
                                               class="dropify_image"/>
                                    @endif
                                    <div class="help-block">
                                        <small class="text-danger"> @error('image_url'){{ $message }} @enderror </small>
                                    </div>
                                    <small id="massage"></small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ratings">Rating:</label>
                                    <input required
                                           value="@if(isset($appStore)){{$appStore->ratings}} @elseif(old("ratings")) {{old("ratings")}} @endif"
                                           type="text" name="ratings" class="form-control @error('ratings') is-invalid @enderror"
                                           id="ratings" placeholder="Enter Shorcut Name in Bangla..">
                                    <div class="help-block">
                                    </div>
                                    <small class="text-danger"> @error('ratings') {{ $message }} @enderror </small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="total_ratings">Total Rating:</label>
                                    <input required
                                           value="@if(isset($appStore)){{$appStore->total_ratings}} @elseif(old("total_ratings")) {{old("total_ratings")}} @endif"
                                           type="text" name="total_ratings" class="form-control @error('total_ratings') is-invalid @enderror"
                                           id="total_ratings" placeholder="Enter Shorcut Name in Bangla..">
                                    <div class="help-block">
                                    </div>
                                    <small class="text-danger"> @error('total_ratings') {{ $message }} @enderror </small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="title">Description:</label>
                                    <textarea
                                        class="form-control @error('description') is-invalid @enderror"
                                        placeholder="Enter body description....." id="description" name="description" rows="3">
                                        @if(isset($appStore)){{$appStore->description}} @elseif(old("description")) {{old("description")}} @endif
                                    </textarea>
                                    <div class="help-block"></div>
                                    <small class="text-danger"> @error('description') {{ $message }} @enderror </small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="is_active">Active Status:</label>
                                    <select value=""
                                            class="form-control" id="is_active"
                                            name="is_active">
                                        <option value="1"
                                                @if(isset($appStore)) @if($appStore->is_active == "1") selected @endif @endif>
                                            Active
                                        </option>
                                        <option value="0"
                                                @if(isset($appStore)) @if($appStore->is_active == "0") selected @endif @endif>
                                            InActive
                                        </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <button type="submit" style="float: right" class="btn btn-success round px-2">
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">





@endpush


@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>
    <script>

        $(function () {
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

        $(function () {
            $("textarea#description").summernote({
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['table', ['table']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['fullscreen']]
                ],
                height:100
            })
        })


        $(document).ready(function() {
            $('.store_select').select2({
                placeholder: 'Select Store',
                width: '100%',
                border: '1px solid #e4e5e7',
            });
        });

        $('.store_select').on("select2:select", function (e) {
            var data = e.params.data.text;
            if(data=='all'){
                $(".store_select > option").prop("selected","selected");
                $(".store_select").trigger("change");
            }
        });



        $(document).ready(function () {
            $('#Example1').DataTable({
                dom: 'Bfrtip',
                buttons: [],
                paging: true,
                searching: true,
                "bDestroy": true,
            });

            $('.dropify_icon').dropify({
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

            $('.dropify_image').dropify({
                messages: {
                    'default': 'Browse for an Image to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct Image file'
                },
                error: {
                    'imageFormat': 'The image must be valid format'
                }
            });
        });

    </script>
@endpush
