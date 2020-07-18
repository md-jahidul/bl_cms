@extends('layouts.admin')
@section('title', 'Store')
@section('card_name', 'Store')
@section('breadcrumb')
    <li class="breadcrumb-item active">Store</li>
@endsection

@section('content')
<div class="card mb-0 px-1" style="box-shadow:none;">
    <div class="card-content">
        <div class="card-body">
            <form novalidate class="form"
                  action="@if(isset($store)) {{route('myblStore.update',$store->id)}} @else {{route('smyblStore.store')}} @endif" method="post" enctype="multipart/form-data">
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
                            <input type="hidden" name="id" value="{{$store->id}}">
                            <div class="form-group">
                                <label for="title" class="required">Title:</label>
                                <input name="title"
                                       required
                                       maxlength="100"
                                       data-validation-required-message="Title is required"
                                       data-validation-maxlength-message="Title can not be more then 100 Characters"

                                style="height:100%" type="text" value="@if(old('title')) {{old('title')}} @else {{$store->title}} @endif" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Enter title..">
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
                                        <option @if(old("category_id")) {{ (old("category_id") == $category->id ? "selected":"") }}
                                                @elseif($category->id == $store->category_id) selected  @endif
                                        value="{{$category->id}}" {{ (old("category_id") == $category->id ? "selected":"") }}>{{$category->name}}</option>
                                    @endforeach
                                    </select>
                                    <div class="help-block"></div>
                                    <small class="text-danger"> @error('category_id') {{ $message }} @enderror </small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="category_id" class="required">
                                   Sub Category :
                                </label>
                                <div class="controls">
                                    <select name="category_id" id="category_id" required class="form-control @error('category_id') is-invalid @enderror">
                                        <option value="">Select Sub Category</option>
                                        @foreach ($categories as $category)
                                            <option @if(old("category_id")) {{ (old("category_id") == $category->id ? "selected":"") }}  @elseif($category->id == $store->category_id) selected  @endif value="{{$category->id}}" {{ (old("category_id") == $category->id ? "selected":"") }}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="help-block"></div>
                                    <small class="text-danger"> @error('category_id') {{ $message }} @enderror </small>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="title" class="required">Store Type:</label>
                                <input required
                                       value="@if(isset($store)){{$store->type}} @elseif(old("type")) {{old("type")}} @endif"
                                       type="text" name="type" class="form-control @error('type') is-invalid @enderror"
                                       id="type" placeholder="Enter Shorcut Name in Bangla..">
                                <div class="help-block"></div>
                                <small class="text-danger"> @error('type') {{ $message }} @enderror </small>
                            </div>
                        </div>


                        <div class="col-md-4">
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
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="title" class="required">Button Action:</label>
                                <input required
                                       value="@if(isset($store)){{$store->btn_action}} @elseif(old("btn_action")) {{old("btn_action")}} @endif"
                                       type="text" name="btn_action" class="form-control @error('btn_action') is-invalid @enderror"
                                       id="btn_action" placeholder="Enter Button Action">
                                <div class="help-block">
                                </div>
                                <small class="text-danger"> @error('btn_action') {{ $message }} @enderror </small>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="title" class="required">Rating:</label>
                                <input required
                                       value="@if(isset($store)){{$store->ratings}} @elseif(old("ratings")) {{old("ratings")}} @endif"
                                       type="text" name="ratings" class="form-control @error('ratings') is-invalid @enderror"
                                       id="ratings" placeholder="Enter Shorcut Name in Bangla..">
                                <div class="help-block">
                                </div>
                                <small class="text-danger"> @error('ratings') {{ $message }} @enderror </small>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="title" class="required">Total Rating:</label>
                                <input required
                                       value="@if(isset($store)){{$store->total_ratings}} @elseif(old("total_ratings")) {{old("total_ratings")}} @endif"
                                       type="text" name="total_ratings" class="form-control @error('total_ratings') is-invalid @enderror"
                                       id="total_ratings" placeholder="Enter Shorcut Name in Bangla..">
                                <div class="help-block">
                                </div>
                                <small class="text-danger"> @error('total_ratings') {{ $message }} @enderror </small>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="image" class="required">Upload Image :</label>
                                @if (isset($store))
                                    <input type="file"
                                           id="image_url"
                                           class="dropify"
                                           name="image_url"
                                           data-height="70"
                                           data-allowed-formats="square"
                                           data-allowed-file-extensions="png"
                                           data-default-file="{{ asset($store->image_url) }}"
                                    />
                                @else
                                    <input type="file" required
                                           id="image_url"
                                           name="image_url"
                                           class="dropify"
                                           data-allowed-formats="square"
                                           data-allowed-file-extensions="png"
                                           data-height="70"/>
                                @endif
                                <div class="help-block">
                                    <small class="text-danger"> @error('image_url'){{ $message }} @enderror </small>
                                </div>
                                <small id="massage"></small>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="title" class="required">Video:</label>
                                <input required
                                       value="@if(isset($store)){{$store->video_link}} @elseif(old("video_link")) {{old("video_link")}} @endif"
                                       type="text" name="video_link" class="form-control @error('video_link') is-invalid @enderror"
                                       id="video_link" placeholder="Enter video link">
                                <div class="help-block"></div>
                                <small class="text-danger"> @error('video_link') {{ $message }} @enderror </small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title" class="required">Description:</label>
                                <textarea
                                    required
                                    data-validation-required-message="body is required"
                                    class="form-control @error('description') is-invalid @enderror"
                                    placeholder="Enter body description....." id="description" name="description" rows="3">@if(old('description')){{old('description')}} @else {{$store->description}}@endif</textarea>
                                <div class="help-block"></div>
                                <small class="text-danger"> @error('description') {{ $message }} @enderror </small>
                            </div>
                        </div>


                        <div class="col-md-12">

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
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
@endpush


@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
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




        $(document).ready(function () {
            $('#Example1').DataTable({
                dom: 'Bfrtip',
                buttons: [],
                paging: true,
                searching: true,
                "bDestroy": true,
            });
        });

    </script>
@endpush
