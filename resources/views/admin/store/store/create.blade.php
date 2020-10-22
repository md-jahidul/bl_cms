@php
    function match($id, $multiItems){
        foreach ($multiItems as $item){
           if($item->id == $id){
              return true;
           }
         }
        return false;
     }
@endphp

@extends('layouts.admin')
@section('title', 'Store')
@section('card_name', 'Store')
@section('breadcrumb')
    <li class="breadcrumb-item active">Store</li>
@endsection

{{--@foreach ($store->apps as $app)

    {{ $app->id}}
    {{ $app->pivot->store_id}}
    {{ $app->pivot->app_id}}
@endforeach

@php(dd($store->apps))--}}

@section('content')
    <div class="card mb-0 px-1" style="box-shadow:none;">
        <div class="card-content">
            <div class="card-body">
                <form novalidate class="form"
                      action="@if(isset($store)) {{route('myblStore.update',$store->id)}} @else {{route('myblStore.store')}} @endif"
                      method="post" enctype="multipart/form-data">
                    @csrf
                    @if(isset($store)) @method('put') @else @method('post') @endif


                    <div class="form-body">
                        <h4 class="form-section col-md-12">
                            @if(isset($store))
                                Update Store
                            @else
                                Create Store
                            @endif
                        </h4>

                        <div class="row">
                            <div class="col-md-4">
                                <input type="hidden" name="id" value="@if(isset($store)){{$store->id}} @elseif(old("id")) {{old("id")}} @endif">
                                <div class="form-group">
                                    <label for="title" class="required">Title:</label>
                                    <input name="title"
                                           required
                                           maxlength="100"
                                           data-validation-required-message="Title is required"
                                           data-validation-maxlength-message="Title can not be more then 100 Characters"

                                           style="height:100%" type="text" value="@if(isset($store)){{$store->title}} @elseif(old("title")) {{old("title")}} @endif"
                                           class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Enter title..">
                                    <div class="help-block">
                                        {{--<small class="text-info"> Title can not be more then 100 Characters</small><br>--}}
                                    </div>
                                    <small class="text-danger"> @error('title') {{ $message }} @enderror </small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="title">Sub Title:</label>
                                    <input value="@if(isset($store)){{$store->sub_title}} @elseif(old("sub_title")) {{old("sub_title")}} @endif"
                                           type="text" name="sub_title" class="form-control @error('type') is-invalid @enderror"
                                           id="type" placeholder="Enter sub_title">
                                    <div class="help-block">
                                        {{--<small class="text-info"> Sub Title can not be more then 100 Characters</small><br>--}}
                                    </div>
                                    <small class="text-danger"> @error('sub_title') {{ $message }} @enderror </small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="title" >High lighted Text:</label>
                                    <input value="@if(isset($store)){{$store->highlight_text}} @elseif(old("highlight_text")) {{old("highlight_text")}} @endif"
                                           type="text" name="highlight_text" class="form-control @error('type') is-invalid @enderror"
                                           id="type" placeholder="Enter highlight_text..">
                                    <div class="help-block"></div>
                                    <small class="text-danger"> @error('highlight_text') {{ $message }} @enderror </small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="category_id" class="required">
                                        Category :
                                    </label>
                                    <div class="controls">
                                        <select required name="category_id" id="category_id"  class="category_select form-control">
                                            <option value="">Select Category</option>

                                            @foreach ($categories as $category)
                                                @if(strtolower($category->name_en) == "all")
                                                    @continue
                                                @endif

                                                @if($category->id == 2)
                                                    @continue
                                                @endif

                                                <option @if(old("category_id")) {{ (old("category_id") == $category->id ? "selected":"") }}
                                                        @elseif(isset($store) && ($category->id == $store->category_id)) selected  @endif
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
                                    <label for="category_id"> Sub Category :</label>
                                    <div class="controls">
                                        <select name="sub_category_id" id="sub_category_id" class="sub_category_select form-control">

                                            @if(isset($store))
                                                <option value="0">Select Sub Category</option>

                                                @foreach($subCategories as $subCategory)
                                                    <option  value="{{ $subCategory->id }}" {{ ($subCategory->id == $store->sub_category_id ) ? 'selected' : '' }}>{{ $subCategory->name_en }}</option>
                                                @endforeach

                                            @endif

                                        </select>
                                        <div class="help-block"></div>
                                        <small class="text-danger"> @error('category_id') {{ $message }} @enderror </small>
                                    </div>
                                </div>
                            </div>

                           {{-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="category_id">
                                        Sub Category :
                                    </label>
                                    <div class="controls">
                                        <select name="sub_category_id" id="sub_category_id" class=" sub_category_select form-control @error('sub_category_id') is-invalid @enderror">
                                            <option value="0">Select SubCategory</option>
                                            @foreach ($subCategories as $subCategory)
                                                <option @if(old("category_id")) {{ (old("category_id") == $subCategory->id ? "selected":"0") }}
                                                        @elseif(isset($store) && ($subCategory->id == $store->sub_category_id)) selected  @endif
                                                value="{{$subCategory->id}}" {{ (old("category_id") == $subCategory->id ? "selected":"0") }}>{{$subCategory->name_en}}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block"></div>
                                        <small class="text-danger"> @error('category_id') {{ $message }} @enderror </small>
                                    </div>
                                </div>
                            </div>--}}

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="type" class="required">Store Type:</label>
                                    <select required class="form-control" value="" name="type" id="type">

                                        <option value="">Select Type</option>
                                        <option @if(isset($store)) @if($store->type=="app") selected
                                                @endif @endif value="app">App
                                        </option>
                                        <option @if(isset($store)) @if($store->type=='promotional') selected
                                                @endif @endif value="promotional">Promotional
                                        </option>
                                        <option @if(isset($store)) @if($store->type=='subcategory') selected
                                                @endif @endif value="subcategory">SubCategory
                                        </option>

                                    </select>
                                    <div class="help-block"></div>
                                    <small class="text-danger"> @error('type') {{ $message }} @enderror </small>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="app_id" class="required">
                                        App :
                                    </label>

                                    <div class="controls">

                                        <select required name="app_id[]" id="app_id[]" multiple="multiple" class="app_select form-control @error('app_id') is-invalid @enderror">
                                            <option value="">Select App</option>

                                            @foreach ($apps as $app)

                                                @if(isset($store))
                                                    <option  {{ match($app->id, $store->apps) ? 'selected' : '' }}
                                                             value="{{$app->id}}">  {{$app->title}}
                                                    </option>
                                                @else
                                                    <option value="{{$app->id}}">  {{$app->title}} </option>
                                                @endif



                                            @endforeach
                                        </select>
                                        <div class="help-block"></div>
                                        <small class="text-danger"> @error('app_id') {{ $message }} @enderror </small>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="title" class="required">Button Text:</label>
                                    <input required
                                           value="@if(isset($store)){{$store->btn_text}} @elseif(old("btn_text")) {{old("btn_text")}} @endif"
                                           type="text" name="btn_text" class="form-control @error('btn_text') is-invalid @enderror"
                                           id="btn_text" placeholder="Enter Button Text">
                                    <div class="help-block">
                                    </div>
                                    <small class="text-danger"> @error('btn_text') {{ $message }} @enderror </small>
                                </div>
                            </div> --}}

                            {{-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="title" class="required">Button Action Type:</label>
                                    <select required class="form-control" value="" name="btn_action_type" id="btn_action_type">
                                        <option @if(isset($store)) @if($store->is_default=='url') selected
                                                @endif @endif value="url">URL
                                        </option>
                                        <option @if(isset($store)) @if($store->is_default=="navigation") selected
                                                @endif @endif value="navigation">Navigation
                                        </option>
                                    </select>
                                    <div class="help-block">
                                    </div>
                                    <small class="text-danger"> @error('btn_action_type') {{ $message }} @enderror </small>
                                </div>
                            </div> --}}

                            {{-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="title">Button Action (iOS):</label>
                                    <input value="@if(isset($store)){{$store->btn_action_ios}} @elseif(old("btn_action_ios")) {{old("btn_action_ios")}} @endif"
                                           type="text" name="btn_action_ios" class="form-control @error('btn_action_ios') is-invalid @enderror"
                                           id="btn_action_ios" placeholder="Enter Button Text">
                                    <div class="help-block">
                                    </div>
                                    <small class="text-danger"> @error('btn_action_ios') {{ $message }} @enderror </small>
                                </div>
                            </div> --}}

                            {{-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="title">Button Action (Android):</label>
                                    <input value="@if(isset($store)){{$store->btn_action_android}} @elseif(old("btn_action_android")) {{old("btn_action_android")}} @endif"
                                           type="text" name="btn_action_android" class="form-control @error('btn_action_android') is-invalid @enderror"
                                           id="btn_action_android" placeholder="Enter Button Text">
                                    <div class="help-block">
                                    </div>
                                    <small class="text-danger"> @error('btn_action_android') {{ $message }} @enderror </small>
                                </div>
                            </div> --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="title">Video:</label>
                                    <input
                                           value="@if(isset($store)){{$store->video_link}} @elseif(old("video_link")) {{old("video_link")}} @endif"
                                           type="text" name="video_link" class="form-control @error('video_link') is-invalid @enderror"
                                           id="video_link" placeholder="Enter video link">
                                    <div class="help-block"></div>
                                    <small class="text-danger"> @error('video_link') {{ $message }} @enderror </small>
                                </div>
                            </div>

                            <div class="col-md-4">

                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="icon">Upload Icon :</label>
                                    @if (isset($store))
                                        <input type="file"
                                               id="icon"
                                               class="dropify_icon"
                                               name="icon"
                                               data-height="70"
                                               data-allowed-formats="square"
                                               data-allowed-file-extensions="png"
                                               data-default-file="{{ asset($store->icon) }}"
                                        />
                                    @else
                                        <input type="file"
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
                                    <label for="image">Upload Image :</label>
                                    @if (isset($store))
                                        <input type="file"
                                               id="image_url"
                                               class="dropify_image"
                                               name="image_url"
                                               data-height="70"
                                               data-default-file="{{ asset($store->image_url) }}"
                                        />
                                    @else
                                        <input type="file"
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
                                    <label for="is_active">Active Status:</label>
                                    <select value="" class="form-control" id="is_active" name="is_active">
                                        <option value="1"
                                                @if(isset($store)) @if($store->is_active == "1") selected @endif @endif>
                                            Active
                                        </option>
                                        <option value="0"
                                                @if(isset($store)) @if($store->is_active == "0") selected @endif @endif>
                                            InActive
                                        </option>
                                    </select>
                                </div>
                            </div>

{{--                            <div class="col-md-4">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="title" >Rating:</label>--}}
{{--                                    <input--}}
{{--                                           value="@if(isset($store)){{$store->ratings}} @elseif(old("ratings")) {{old("ratings")}} @endif"--}}
{{--                                           type="text" name="ratings" class="form-control @error('ratings') is-invalid @enderror"--}}
{{--                                           id="ratings" placeholder="Enter Shorcut Name in Bangla..">--}}
{{--                                    <div class="help-block">--}}
{{--                                    </div>--}}
{{--                                    <small class="text-danger"> @error('ratings') {{ $message }} @enderror </small>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-md-4">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="title">Total Rating:</label>--}}
{{--                                    <input--}}
{{--                                           value="@if(isset($store)){{$store->total_ratings}} @elseif(old("total_ratings")) {{old("total_ratings")}} @endif"--}}
{{--                                           type="text" name="total_ratings" class="form-control @error('total_ratings') is-invalid @enderror"--}}
{{--                                           id="total_ratings" placeholder="Enter Shorcut Name in Bangla..">--}}
{{--                                    <div class="help-block">--}}
{{--                                    </div>--}}
{{--                                    <small class="text-danger"> @error('total_ratings') {{ $message }} @enderror </small>--}}
{{--                                </div>--}}
{{--                            </div>--}}


                           {{-- <div class="col-md-8">
                                <div class="form-group">
                                    <label for="title">Description:</label>
                                    <textarea
                                        class="form-control @error('description') is-invalid @enderror"
                                        placeholder="Enter body description....." id="description" name="description" rows="3">
                                        @if(isset($store)){{$store->description}} @elseif(old("description")) {{old("description")}} @endif
                                    </textarea>
                                    <div class="help-block"></div>
                                    <small class="text-danger"> @error('description') {{ $message }} @enderror </small>
                                </div>
                            </div>--}}


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
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">

    <style>


    </style>

@endpush


@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>
    <script>

        $(function () {

            $('#category_id').change(function () {
                var categoryId = $(this).find('option:selected').val()
                var subCategory = $('#sub_category_id');
                $.ajax({
                    url: "{{ url('subStore/subcategory-find') }}" + '/' + categoryId,
                    success: function (data) {
                        subCategory.empty();
                        var option = '<option value="">---Select SubCategory---</option>';
                        $.map(data, function (item) {
                            option += '<option value="' + item.id + '">' + item.name_en + '</option>'
                        })
                        subCategory.append(option)
                    },
                });
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



      /*  $(document).ready(function() {
            $('.category_select').select2({
                placeholder: 'Select Category',
                width: '100%',
                border: '1px solid #e4e5e7',
            });
        });

        $('.category_select').on("select2:select", function (e) {
            var data = e.params.data.text;
            if(data=='all'){
                $(".category_select > option").prop("selected","selected");
                $(".category_select").trigger("change");
            }
        });*/

      /*  $(document).ready(function() {
            $('.sub_category_select').select2({
                placeholder: 'Select SubCategory',
                width: '100%',
                border: '1px solid #e4e5e7',
            });
        });

        $('.sub_category_select').on("select2:select", function (e) {
            var data = e.params.data.text;
            if(data=='all'){
                $(".sub_category_select > option").prop("selected","selected");
                $(".sub_category_select").trigger("change");
            }
        });*/


        $(document).ready(function() {
            $('.app_select').select2({
                placeholder: 'Select App',
                width: '100%',
                border: '1px solid #e4e5e7',
            });
        });

        $('.app_select').on("select2:select", function (e) {
            var data = e.params.data.text;
            if(data=='all'){
                $(".app_select > option").prop("selected","selected");
                $(".app_select").trigger("change");
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
