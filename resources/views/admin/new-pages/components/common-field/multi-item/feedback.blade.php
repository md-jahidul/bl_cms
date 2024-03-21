@php
      $fieldFeedbackEn = "";
      $fieldFeedbackBn = "";
      $fieldFeedbackId = "";

      $fieldNameEn = "";
      $fieldNameBn = "";
      $fieldNameId = "";

      $fieldDesignationEn = "";
      $fieldDesignationBn = "";
      $fieldDesignationId = "";

      $fieldInstituteEn = "";
      $fieldInstituteBn = "";
      $fieldInstituteId = "";

      $fieldName = "";
      $fieldNameGroup = "";
      $imageId = "";

      $isTab = "";

      if (isset($is_tab) && $is_tab) {
          $fieldFeedbackEn .= "componentData[$key][tab_items][$tabIndex][feedback][value_en]";
          $fieldFeedbackBn .= "componentData[$key][tab_items][$tabIndex][feedback][value_bn]";
          $fieldFeedbackId .= "componentData[$key][tab_items][$tabIndex][feedback][id]";

          $fieldNameEn .= "componentData[$key][tab_items][$tabIndex][name][value_en]";
          $fieldNameBn .= "componentData[$key][tab_items][$tabIndex][name][value_bn]";
          $fieldNameId .= "componentData[$key][tab_items][$tabIndex][name][id]";

          $fieldDesignationEn .= "componentData[$key][tab_items][$tabIndex][designation][value_en]";
          $fieldDesignationBn .= "componentData[$key][tab_items][$tabIndex][designation][value_bn]";
          $fieldDesignationId .= "componentData[$key][tab_items][$tabIndex][designation][id]";

          $fieldInstituteEn .= "componentData[$key][tab_items][$tabIndex][institute][value_en]";
          $fieldInstituteBn .= "componentData[$key][tab_items][$tabIndex][institute][value_bn]";
          $fieldInstituteId .= "componentData[$key][tab_items][$tabIndex][institute][id]";

          $fieldName .= "componentData[$key][tab_items][$tabIndex][image][value_en]";
          $fieldNameGroup .= "componentData[$key][tab_items][$tabIndex][image][group]";
          $imageId .= "componentData[$key][tab_items][$tabIndex][image][id]";

          $isTab .= '<input type="hidden" name="componentData[' . $key .  '][title][is_tab]" value="1">';
      }else {
          $fieldFeedbackEn .=   "componentData[$key][feedback][value_en]";
          $fieldFeedbackBn .=   "componentData[$key][feedback][value_bn]";
          $fieldNameEn .=       "componentData[$key][name][value_en]";
          $fieldNameBn .=       "componentData[$key][name][value_bn]";
          $fieldDesignationEn.= "componentData[$key][designation][value_en]";
          $fieldDesignationBn.= "componentData[$key][designation][value_bn]";
          $fieldInstituteEn .=  "componentData[$key][institute][value_en]";
          $fieldInstituteBn .=  "componentData[$key][institute][value_bn]";

          $fieldName .= "componentData[$key][image][value_en]";
          $fieldNameGroup .= "componentData[$key][image][group]";
          $imageId .= "componentData[$key][image][id]";
      }

 @endphp


<div class="form-group col-md-6">
    <label for="title_en">Feedback En</label>
    <textarea type="text" rows="3" name="{{ $fieldFeedbackEn }}" class="form-control">{{ $data['feedback']['value_en'] ?? '' }}</textarea>
    <input type="hidden" name="{{ $fieldFeedbackId }}" value="{{ isset($data['feedback']['id']) ? $data['feedback']['id'] : '' }}">
    {!! $isTab !!}
</div>

<div class="form-group col-md-6">
    <label for="title_en">Feedback Bn</label>
    <textarea type="text" rows="3" name="{{ $fieldFeedbackBn }}" class="form-control">{{ $data['feedback']['value_bn'] ?? '' }}</textarea>
    <input type="hidden" name="{{ $fieldFeedbackId }}" value="{{ isset($data['feedback']['id']) ? $data['feedback']['id'] : '' }}">
</div>

<div class="form-group col-md-6">
    <label for="title_en">Name En</label>
    <input type="text" name="{{ $fieldNameEn }}" class="form-control" value="{{ $data['name']['value_en'] ?? '' }}">
    <input type="hidden" name="{{ $fieldNameId }}" value="{{ isset($data['name']['id']) ? $data['name']['id'] : '' }}">
</div>
<div class="form-group col-md-6">
    <label for="title_en">Name Bn</label>
    <input type="text" name="{{ $fieldNameBn }}" class="form-control" value="{{ $data['name']['value_bn'] ?? '' }}">
    <input type="hidden" name="{{ $fieldNameId }}" value="{{ isset($data['name']['id']) ? $data['name']['id'] : '' }}">
</div>

<div class="form-group col-md-6">
    <label for="title_en">Designation En</label>
    <input type="text" name="{{ $fieldDesignationEn }}" class="form-control" value="{{ $data['designation']['value_en'] ?? '' }}">
    <input type="hidden" name="{{ $fieldDesignationId }}" value="{{ isset($data['designation']['id']) ? $data['designation']['id'] : '' }}">
</div>
<div class="form-group col-md-6">
    <label for="title_en">Designation Bn</label>
    <input type="text" name="{{ $fieldDesignationBn }}" class="form-control" value="{{ $data['designation']['value_bn'] ?? '' }}">
    <input type="hidden" name="{{ $fieldDesignationId }}" value="{{ isset($data['designation']['id']) ? $data['designation']['id'] : '' }}">
</div>
<div class="form-group col-md-6">
    <label for="title_en">Institute En</label>
    <input type="text" name="{{ $fieldInstituteEn }}" class="form-control" value="{{ $data['institute']['value_en'] ?? '' }}">
    <input type="hidden" name="{{ $fieldInstituteId }}" value="{{ isset($data['institute']['id']) ? $data['institute']['id'] : '' }}">
</div>
<div class="form-group col-md-6">
    <label for="title_en">Institute Bn</label>
    <input type="text" name="{{ $fieldInstituteBn }}" class="form-control" value="{{ $data['institute']['value_bn'] ?? '' }}">
    <input type="hidden" name="{{ $fieldInstituteId }}" value="{{ isset($data['institute']['id']) ? $data['institute']['id'] : '' }}">
</div>

<div class="col-md-12 col-xs-12 ">
    <div class="form-group">
        <label for="message">Image</label>
        <input type="hidden" name="{{ $fieldName }}" value="{{ isset($data['image']['value_en']) ? $data['image']['value_en'] : '' }}">
        <input type="file" class="dropify" name="{{$fieldName}}" data-height="80"
               data-default-file="{{ isset($data['image']['value_en']) ? config('filesystems.file_base_url') . $data['image']['value_en'] : '' }}"/>
        <input type="hidden" name="{{ $fieldNameGroup }}" value="{{ $key + 1 }}">
        <input type="hidden" name="{{ $imageId }}" value="{{ isset($data['image']['id']) ? $data['image']['id'] : '' }}">
        <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
        <div class="help-block"></div>
    </div>
</div>
