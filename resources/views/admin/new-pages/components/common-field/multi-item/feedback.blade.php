@php
      $fieldFeedbackEn = "";
      $fieldFeedbackBn = "";
      $fieldNameEn = "";
      $fieldNameBn = "";
      $fieldDesignationEn = "";
      $fieldDesignationBn = "";
      $fieldInstituteEn = "";
      $fieldInstituteBn = "";
      $tabFeedback = "";
      $tabName = "";
      $tabDesignation = "";
      $tabInstitute = "";
      $fieldImage = "";

      if (isset($is_tabl)) {
//          $fieldFeedbackEn .= "componentData[$key][tab_items][${tabIndex}][feedback][value_en]";
//          $fieldFeedbackBn .= "componentData[$key][tab_items][${tabIndex}][feedback][value_bn]";
//          $fieldNameEn .= "componentData[$key][tab_items][${tabIndex}][name][value_bn]";
//          $fieldNameBn .= "componentData[$key][tab_items][${tabIndex}][name][value_bn]";
//          $fieldDesignationEn .= "componentData[$key][tab_items][${tabIndex}][designation][value_bn]";
//          $fieldDesignationBn .= "componentData[$key][tab_items][${tabIndex}][designation][value_bn]";
//          $fieldInstituteEn .= "componentData[$key][tab_items][${tabIndex}][institute][value_bn]";
//          $fieldInstituteBn .= "componentData[$key][tab_items][${tabIndex}][institute][value_bn]";
//          $tabFeedback .= "<input type="hidden" name="componentData[$key][feedback][is_tab]" value="1">";
//          $tabName .= "<input type="hidden" name="componentData[$key][name][is_tab]" value="1">";
//          $tabDesignation .= "<input type="hidden" name="componentData[$key][designation][is_tab]" value="1">";
//          $tabInstitute .= "<input type="hidden" name="componentData[$key][institute][is_tab]" value="1">";
      }else {
          $fieldFeedbackEn .=   "componentData[$key][feedback][value_en]";
          $fieldFeedbackBn .=   "componentData[$key][feedback][value_bn]";
          $fieldNameEn .=       "componentData[$key][name][value_en]";
          $fieldNameBn .=       "componentData[$key][name][value_bn]";
          $fieldDesignationEn.= "componentData[$key][designation][value_en]";
          $fieldDesignationBn.= "componentData[$key][designation][value_bn]";
          $fieldInstituteEn .=  "componentData[$key][institute][value_en]";
          $fieldInstituteBn .=  "componentData[$key][institute][value_bn]";
          $fieldImage .=        "componentData[$key][image][value_en]";
      }

 @endphp


<div class="form-group col-md-6">
    <label for="title_en">Feedback En</label>

    <textarea type="text" rows="3" name="{{ $fieldFeedbackEn }}" class="form-control">{{ $data['feedback']['value_en'] ?? '' }}</textarea>
</div>

<div class="form-group col-md-6">
    <label for="title_en">Feedback Bn</label>
    <textarea type="text" rows="3" name="{{ $fieldFeedbackBn }}" class="form-control">{{ $data['feedback']['value_bn'] ?? '' }}</textarea>
</div>

<div class="form-group col-md-6">
    <label for="title_en">Name En</label>

    <input type="text" name="{{ $fieldNameEn }}" class="form-control" value="{{ $data['name']['value_en'] ?? '' }}">
</div>
<div class="form-group col-md-6">
    <label for="title_en">Name Bn</label>
    <input type="text" name="{{ $fieldNameBn }}" class="form-control" value="{{ $data['name']['value_bn'] ?? '' }}">
</div>

<div class="form-group col-md-6">
    <label for="title_en">Designation En</label>
{{--    {{ $tabDesignation }}--}}
    <input type="text" name="{{ $fieldDesignationEn }}" class="form-control" value="{{ $data['designation']['value_en'] ?? '' }}">
</div>
<div class="form-group col-md-6">
    <label for="title_en">Designation Bn</label>
    <input type="text" name="{{ $fieldDesignationBn }}" class="form-control" value="{{ $data['designation']['value_bn'] ?? '' }}">
</div>
<div class="form-group col-md-6">
    <label for="title_en">Institute En</label>
{{--    {{ $tabInstitute }}--}}
    <input type="text" name="{{ $fieldInstituteEn }}" class="form-control" value="{{ $data['institute']['value_en'] ?? '' }}">
</div>
<div class="form-group col-md-6">
    <label for="title_en">Institute Bn</label>
    <input type="text" name="{{ $fieldInstituteBn }}" class="form-control" value="{{ $data['institute']['value_bn'] ?? '' }}">
    <input type="hidden" name="componentData[{{$key}}][image][id]" value="{{ isset($data['image']['id']) ? $data['image']['id'] : '' }}">
</div>

<div class="col-md-12 col-xs-12 ">
    <div class="form-group">
        <label for="message">Image</label>
        <input type="hidden" name="{{ $fieldImage }}"
               value="{{ isset($data['image']['value_en']) ? $data['image']['value_en'] : '' }}">
        <input type="file" class="dropify" name="componentData[{{$key}}][image][value_en]" data-height="80"
               data-default-file="{{ isset($data['image']['value_en']) ? config('filesystems.file_base_url') . $data['image']['value_en'] : '' }}"/>
        <input type="hidden" name="componentData[{{$key}}][image][group]" value="{{ $key + 1 }}">
        <input type="hidden" name="componentData[{{$key}}][image][id]" value="{{ isset($data['image']['id']) ? $data['image']['id'] : '' }}">
        <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
        <div class="help-block"></div>
    </div>
</div>
