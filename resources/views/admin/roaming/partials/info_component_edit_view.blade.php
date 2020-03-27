<?php $position = 1; ?>

@foreach($components as $com)



@if($com->component_type == 'photo')

<?php
$photoEn = json_decode($com->body_text_en);
$photoBn = json_decode($com->body_text_bn);
?>

<div class="form-group row bg-light p-2 mr-1 mt-1">
    <input type="hidden" name="component_position[{{$com->position}}]">

    <div class="col-md-8 col-xs-12">
        <h5 class="font-weight-bold">Photo Component</h5>
        <hr>
        <div class="row">

            <div class="col-md-6 col-xs-12">
                <label>Headline (EN) 
                    <span class="text-danger">*</span>
                </label>
                <input type="text" required class="form-control" name="headline_en[{{$com->position}}]"  value="{{$photoEn->headline_en}}">
            </div>
            <div class="col-md-6 col-xs-12">
                <label class="display-block">Headline (BN) <span class="text-danger">*</span>
                    <a href="javascript:;" class="pull-right text-danger remove_component"><i class="la la-close"></i></a>
                </label>
                <input type="text" required class="form-control" name="headline_bn[{{$com->position}}]"  value="{{$photoBn->headline_bn}}">

            </div>

            <div class="col-md-3 col-xs-12">
                <label>Photo 1 <span class="text-danger">*</span></label>

                <img src="{{ config('filesystems.file_base_url') . $photoEn->photos[0] }}" alt="Banner Photo" width="100%" />

                <input type="file" class="dropify" name="photo_one[{{$com->position}}]" required data-height="70"
                       data-allowed-file-extensions='["jpg", "jpeg", "png"]'>

                <label>Alt Text</label>
                <input type="text" class="form-control" name="alt_one[{{$com->position}}]" value="{{$photoBn->alt_text[0]}}" placeholder="Alt Text">

            </div>

            <div class="col-md-3 col-xs-12">
                <label>Photo 2</label>

                <img src="{{ config('filesystems.file_base_url') . $photoEn->photos[1] }}" alt="Banner Photo" width="100%" />

                <input type="file" class="dropify" name="photo_two[{{$com->position}}]" data-height="70"
                       data-allowed-file-extensions='["jpg", "jpeg", "png"]'>

                <label>Alt Text</label>
                <input type="text" class="form-control" name="alt_two[{{$com->position}}]" value="{{$photoBn->alt_text[1]}}" placeholder="Alt Text">
            </div>

            <div class="col-md-3 col-xs-12">
                <label>Photo 3</label>

                <img src="{{ config('filesystems.file_base_url') . $photoEn->photos[2] }}" alt=" Photo" width="100%" />

                <input type="file" class="dropify" name="photo_three[{{$com->position}}]" data-height="70"
                       data-allowed-file-extensions='["jpg", "jpeg", "png"]'>
                <label>Alt Text</label>
                <input type="text" class="form-control" name="alt_three[{{$com->position}}]" value="{{$photoBn->alt_text[2]}}" placeholder="Alt Text">
            </div>

            <div class="col-md-3 col-xs-12">
                <label>Photo 4</label>

                <img src="{{ config('filesystems.file_base_url') . $photoEn->photos[3] }}" alt=" Photo" width="100%" />

                <input type="file" class="dropify" name="photo_four[{{$com->position}}]" data-height="70"
                       data-allowed-file-extensions='["jpg", "jpeg", "png"]'>

                <label>Alt Text</label>
                <input type="text" class="form-control" name="alt_four[{{$com->position}}]" value="{{$photoBn->alt_text[3]}}" placeholder="Alt Text">
            </div>



        </div>
    </div>
    <div class="col-md-4 col-xs-12">
        <h6 class="font-weight-bold">Sample/Instruction (Text Component)</h6>
        <a href="{{asset('app-assets/images/roaming/info_photo_component.png')}}" target="_blank">
            <img style="border: 1px solid #ddd;" src="{{asset('app-assets/images/roaming/info_photo_component.png')}}" width="100%">
        </a>

    </div>


</div>

@endif


@if($com->component_type == 'text')

<?php
$textEn = json_decode($com->body_text_en);
$textBn = json_decode($com->body_text_bn);
?>

<div class="form-group row bg-light p-2 mr-1 mt-1">
    <input type="hidden" name="component_position[{{$com->position}}]">

    <div class="col-md-8 col-xs-12">
        <h5 class="font-weight-bold">Text Component</h5>
        <hr>
        <div class="row">

            <div class="col-md-6 col-xs-12">
                <label>Headline (EN) 
                    <span class="text-danger">*</span>
                </label>
                <input type="text" required class="form-control" value="{{$textEn->headline_en}}" name="headline_en[{{$com->position}}]">
            </div>
            <div class="col-md-6 col-xs-12">
                <label class="display-block">Headline (BN) <span class="text-danger">*</span>
                    <a href="javascript:;" class="pull-right text-danger remove_component"><i class="la la-close"></i></a>
                </label>
                <input type="text" required class="form-control"  value="{{$textBn->headline_bn}}"  name="headline_bn[{{$com->position}}]">

            </div>

            <div class="col-md-6 col-xs-12">
                <label>Text (EN)</label>
                <textarea class="form-control details_editor_edit" name="textarea_en[{{$com->position}}]">{{$textEn->text_en}}</textarea>
            </div>
            <div class="col-md-6 col-xs-12">
                <label>Text (BN)</label>
                <textarea class="form-control details_editor_edit" name="textarea_bn[{{$com->position}}]">{{$textBn->text_bn}}</textarea>
            </div>


        </div>
    </div>
    <div class="col-md-4 col-xs-12">
        <h6 class="font-weight-bold">Sample/Instruction (Text Component)</h6>
        <a href="{{asset('app-assets/images/roaming/offer_text_component.png')}}" target="_blank">
            <img style="border: 1px solid #ddd;" src="{{asset('app-assets/images/roaming/offer_text_component.png')}}" width="100%">
        </a>

    </div>


</div>

@endif


@if($com->component_type == 'table')

<div class="form-group row bg-light p-2 mr-1 mt-1">
    <input type="hidden" name="component_position[{{$com->position}}]">

    <div class="col-md-10 col-xs-12">
        <h5 class="font-weight-bold">Table Component
            <a href="javascript:;" class="pull-right text-danger remove_component"><i class="la la-close"></i></a>
        </h5>
        <hr>


        <div class="row table_wrap">
            <?php
            $tableEn = json_decode($com->body_text_en);
            $tableBn = json_decode($com->body_text_bn);

            $width = 100 / count($tableEn->head_en);
            ?>
            <div class="col-md-12 col-xs-12">
                <h6>Table Head (EN):</h6>

                @foreach($tableEn->head_en as $k => $head)
                <input type="text" placeholder="Head (EN) {{$k+1}}" name="head_en[{{$com->position}}][]" value="{{$head}}" width="{{$width}}%">
                @endforeach
                <hr>

            </div>

            <div class="col-md-12 col-xs-12">
                <h6>Table Columns (EN):</h6>

                @foreach($tableEn->rows_en as $k => $rows)

                @foreach($rows as $cols)
                <input type="text" value="{{$cols}}" name="col_en[{{$com->position}}][{{$k}}][]" width="{{$width}}%">
                @endforeach
                <br>

                @endforeach

            </div>


            <div class="col-md-12 col-xs-12">
                <h6><hr>Table Head (BN):</h6>

                @foreach($tableBn->head_bn as $k => $head)
                <input type="text" placeholder="Head (EN) {{$k+1}}" name="head_bn[{{$com->position}}][]" value="{{$head}}" width="{{$width}}%">
                @endforeach

                <hr>
            </div>

            <div class="col-md-12 col-xs-12">
                <h6>Table Columns (BN):</h6>

                @foreach($tableBn->rows_bn as $k => $rows)

                @foreach($rows as $cols)
                <input type="text" value="{{$cols}}" name="col_bn[{{$com->position}}][{{$k}}][]" width="{{$width}}%">
                @endforeach
                <br>

                @endforeach

            </div>

        </div>


    </div>
    <div class="col-md-2 col-xs-12">
        <h6 class="font-weight-bold">Sample/Instruction (List Component)</h6>
        <img style="border: 1px solid #ddd;" src="{{asset('app-assets/images/roaming/offer_table_component.png')}}" width="100%">

    </div>


</div>

@endif



@endforeach

@push('page-js')

<script>
    $(function () {



        //show dropify for  photo
        $('.dropify').dropify({
            messages: {
                'default': 'Browse for photo',
                'replace': 'Click to replace',
                'remove': 'Remove',
                'error': 'Choose correct file format'
            }
        });


    });


</script>

@endpush