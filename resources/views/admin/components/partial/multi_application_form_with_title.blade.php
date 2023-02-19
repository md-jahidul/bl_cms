
<div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
    <label for="title_en" class="required1">
        Title (English)
    </label>
    <input type="text" name="title_en"  class="form-control section_name" placeholder="Enter title"
           value="{{ old("title_en") ? old("title_en") : $component->title_en ?? null }}">
    <div class="help-block"></div>
    @if ($errors->has('title_en'))
        <div class="help-block">  {{ $errors->first('title_en') }}</div>
    @endif
</div>


 <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
     <label for="title_bn" class="required1">
         Title (Bangla)
     </label>
     <input type="text" name="title_bn"  class="form-control section_name" placeholder="Enter title"
            value="{{ old("title_bn") ? old("title_bn") : $component->title_bn ?? null }}">
     <div class="help-block"></div>
     @if ($errors->has('title_bn'))
         <div class="help-block">  {{ $errors->first('title_bn') }}</div>
     @endif
 </div>


<slot id="" data-offer-type="" class="">
    @include('admin.components.partial.multi_file_section', $component->multiple_attributes ?? [])
</slot>