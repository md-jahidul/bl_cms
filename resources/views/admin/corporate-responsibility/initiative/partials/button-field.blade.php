<div class="form-group col-md-4 {{ $errors->has('apply_btn_en') ? ' error' : '' }}">
    <label for="apply_btn_en">Apply Button (English)</label>
    <input type="text" name="multiple_attributes[apply_btn_en]"  class="form-control" placeholder="Enter company name bangla"
           value="{{ isset($multipleItem['apply_btn_en']) ? $multipleItem['apply_btn_en'] : '' }}">
    <div class="help-block"></div>
    @if ($errors->has('apply_btn_en'))
        <div class="help-block">  {{ $errors->first('apply_btn_en') }}</div>
    @endif
</div>

<div class="form-group col-md-4 {{ $errors->has('apply_btn_bn') ? ' error' : '' }}">
    <label for="apply_btn_bn" >Apply Button (Bangla)</label>
    <input type="text" name="multiple_attributes[apply_btn_bn]"  class="form-control" placeholder="Enter company name bangla"
           value="{{ isset($multipleItem['apply_btn_bn']) ? $multipleItem['apply_btn_bn'] : '' }}">
    <div class="help-block"></div>
    @if ($errors->has('apply_btn_bn'))
        <div class="help-block">  {{ $errors->first('apply_btn_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-4 {{ $errors->has('apply_btn_url') ? ' error' : '' }}">
    <label for="apply_btn_url" >URL</label>
    <input type="text" name="multiple_attributes[apply_btn_url]"  class="form-control" placeholder="Enter url"
           value="{{ isset($multipleItem['apply_btn_url']) ? $multipleItem['apply_btn_url'] : '' }}">
    <small class="text-info">Ex: corporate-responsibility/application/{tab name}</small>
    <div class="help-block"></div>
    @if ($errors->has('apply_btn_url'))
        <div class="help-block">  {{ $errors->first('apply_btn_url') }}</div>
    @endif
</div>

<div class="form-group col-md-4 {{ $errors->has('faq_btn_en') ? ' error' : '' }}">
    <label for="faq_btn_en">FAQ Button (English)</label>
    <input type="text" name="multiple_attributes[faq_btn_en]"  class="form-control" placeholder="Enter company name bangla"
           value="{{ isset($multipleItem['faq_btn_en']) ? $multipleItem['faq_btn_en'] : '' }}">
    <div class="help-block"></div>
    @if ($errors->has('faq_btn_en'))
        <div class="help-block">  {{ $errors->first('faq_btn_en') }}</div>
    @endif
</div>

<div class="form-group col-md-4 {{ $errors->has('faq_btn_bn') ? ' error' : '' }}">
    <label for="faq_btn_bn" >FAQ Button (Bangla)</label>
    <input type="text" name="multiple_attributes[faq_btn_bn]"  class="form-control" placeholder="Enter company name bangla"
           value="{{ isset($multipleItem['faq_btn_bn']) ? $multipleItem['faq_btn_bn'] : '' }}">
    <div class="help-block"></div>
    @if ($errors->has('faq_btn_bn'))
        <div class="help-block">  {{ $errors->first('faq_btn_bn') }}</div>
    @endif
</div>

{{--{{ dd($multipleItem) }}--}}

{{--@php--}}
{{--if(isset($multipleItem['faq_key'])) {--}}
{{--        function checkFAQCat() use ($multipleItem['faq_key']){--}}
{{--        $faqKey = $multipleItem['faq_key'];--}}
{{--        if ($faqKey == "cr_digigeek_meetup"){--}}
{{--            return true;--}}
{{--        }elseif ($faqKey == "cr_it_incubator"){--}}
{{--            return true;--}}
{{--        }elseif ($faqKey == "cr_national_hackathon"){--}}
{{--            return true;--}}
{{--        }--}}
{{--        return false;--}}
{{--    }--}}
{{--}--}}
{{--@endphp--}}

<div class="form-group col-md-4 {{ $errors->has('faq_btn_url') ? ' error' : '' }}">
    <label for="faq_btn_url" >Select FAQ Category</label>
    <select class="form-control" name="multiple_attributes[faq_key]">
        <option value="">---Select Type----</option>
        <option value="cr_digigeek_meetup" {{ isset($multipleItem['faq_key']) && $multipleItem['faq_key'] ==  "cr_digigeek_meetup" ? 'selected' : '' }}>CR Digigeek meetup</option>
        <option value="cr_it_incubator" {{ isset($multipleItem['faq_key']) && $multipleItem['faq_key'] ==  "cr_it_incubator" ? 'selected' : '' }}>CR IT incubator</option>
        <option value="cr_national_hackathon" {{ isset($multipleItem['faq_key']) && $multipleItem['faq_key'] ==  "cr_national_hackathon" ? 'selected' : '' }}>CR National Hackathon</option>
    </select>
    <div class="help-block"></div>
    @if ($errors->has('faq_btn_url'))
        <div class="help-block">  {{ $errors->first('faq_btn_url') }}</div>
    @endif
</div>
