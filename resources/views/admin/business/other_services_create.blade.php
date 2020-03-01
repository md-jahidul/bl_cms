@extends('layouts.admin')
@section('title', 'Create Business Service')
@section('card_name', 'Create B. Solution, IOT & Others')
@section('breadcrumb')
<li class="breadcrumb-item active"> <a href="{{ url('business-other-services') }}"> Service List</a></li>
<li class="breadcrumb-item active"> Create</li>
@endsection
@section('action')
<a href="{{ url('business-other-services') }}" class="btn btn-sm btn-grey-blue"><i class="la la-angle-double-left"></i>Back</a>
@endsection
@section('content')
<section>

    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">

                <form method="POST" action="{{ route('business.other.save')}}" class="form home_news_form" enctype="multipart/form-data">
                    <div class="row">

                        <div class="col-md-4 col-xs-12">

                            @csrf

                            <div class="form-group">
                                <label> Select Category <span class="text-danger">*</span></label>
                                <select class="form-control" required="required" name="type">
                                    <option value="">Select Category</option>
                                    <option value="business-solution">Business Solution</option>
                                    <option value="iot">IOT</option>
                                    <option value="others">Others</option>
                                </select>
                            </div>

                            <div class="form-group">

                                <label for="Package Name"> Name (EN)<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required name="name_en" placeholder="Package Name English">
                                <br>
                                <label for="Package Name"> Name (BN)<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required name="name_bn" placeholder="Package Name Bangla">

                            </div>

                            <div class="form-group">
                                <label for="Banner Photo">Banner Photo <span class="text-danger">*</span></label>
                                <input type="file" required class="dropify_package" name="banner_photo" data-height="70"
                                       data-allowed-file-extensions='["jpg", "jpeg", "png"]'>

                                <label>Alt Text</label>
                                <input type="text" class="form-control"  name="alt_text" placeholder="Alt Text">

                            </div>

                            <div class="form-group">
                                <label for="Banner Photo">Sliding Speed (Seconds)</label>

                                <input type="text" class="form-control" name="sliding_speed" value="1">

                            </div>




                        </div>
                        <div class="col-md-4 col-xs-12">

                            <div class="form-group">
                                <label for="Icon">Icon <span class="text-danger">*</span></label>
                                <input type="file" class="dropify_package" required name="icon" data-height="70"
                                       data-allowed-file-extensions='["jpg", "jpeg", "png"]'>

                            </div>

                            <div class="form-group">

                                <label for="Short Details">Short Details (EN)<span class="text-danger">*</span></label>
                                <textarea type="text" name="short_details_en" required class="form-control"></textarea>

                                <br>

                                <label for="Short Details">Short Details (BN)<span class="text-danger">*</span></label>
                                <textarea type="text" name="short_details_bn" required class="form-control"></textarea>

                            </div>



                        </div>


                        <div class="col-md-4 col-xs-12">

                            <div class="form-group">
                                <label for="Details">Offer Details (EN)</label>
                                <textarea type="text" name="offer_details_en" class="form-control textarea_details"></textarea>

                                <br>

                                <label for="Details">Offer Details (BN)</label>
                                <textarea type="text" name="offer_details_bn" class="form-control textarea_details"></textarea>

                            </div>


                        </div>
                        <div class="col-md-12 col-xs-12">

                            <div class="form-group ">
                                <label>Features</label>
                                <div class="row">

                                    @foreach($features as $feature)
                                    <div class="col-md-4">
                                        <label>
                                            <input type="checkbox" name="feature[{{$feature->id}}]" class="custom-input">
                                            @if($feature->icon_url != "")
                                            <img src="{{ config('filesystems.file_base_url') . $feature->icon_url }}" alt="Feature Icon" width="30px" />
                                            @endif
                                            {{$feature->title}}
                                        </label>

                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            
                        </div>
                        
                        
                         <div class="col-md-12 col-xs-12">
                            
                             <div class="form-group ">
                                <h4>Select Related Solution (You may also like)</h4>
                                <hr>
                                <div class="row">

                                    @foreach($services as $s)
                                    <div class="col-md-3 col-xs-12">
                                        <label class="text-bold-600 cursor-pointer">
                                            <input type="checkbox" name="realated[{{$s->id}}]">
                                            {{$s->name}}
                                        </label>

                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            
                             <div class="form-group text-right">
                                <button class="btn btn-sm btn-info" type="submit">Save</button>
                            </div>
                            
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>






</section>


@stop

@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">
<link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">

@endpush
@push('page-js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>

<script>
$(function () {

    //success and error msg
<?php
if (Session::has('sussess')) {
    ?>
        swal.fire({
            title: "{{ Session::get('sussess') }}",
            type: 'success',
            timer: 2000,
            showConfirmButton: false
        });
    <?php
}
if (Session::has('error')) {
    ?>

        swal.fire({
            title: "{{ Session::get('error') }}",
            type: 'error',
            timer: 2000,
            showConfirmButton: false
        });

<?php } ?>

    //show dropify for package photo
    $('.dropify_package').dropify({
        messages: {
            'default': 'Browse for photo',
            'replace': 'Click to replace',
            'remove': 'Remove',
            'error': 'Choose correct file format'
        }
    });


    //text editor for package details
    $("textarea.textarea_details").summernote({
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            // ['table', ['table']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['view', ['codeview']]
        ],
        height: 170
    });

});


</script>
@endpush




