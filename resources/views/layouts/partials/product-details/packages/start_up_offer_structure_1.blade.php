<div class="form-group col-md-6 {{ $errors->has('details_en') ? ' error' : '' }}">
    <label for="details_en" >Details (English)</label>
    <textarea type="text" name="details_en"  class="form-control" placeholder="Enter details in English" id="details">{{ $productDetail->product_details->details_en }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('details_en'))
        <div class="help-block">{{ $errors->first('details_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('details_bn') ? ' error' : '' }}">
    <label for="details_bn">Details (Bangla)</label>
    <textarea type="text" name="details_bn"  class="form-control" placeholder="Enter details in Bangla" id="details"
              id="details">{{ $productDetail->product_details->details_bn }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('details_bn'))
        <div class="help-block">{{ $errors->first('details_bn') }}</div>
    @endif
</div>







<div class="form-group col-md-6 {{ $errors->has('ft_recharge_title_en') ? ' error' : '' }}">
    <label for="ft_recharge_title_en" >First-time Recharge Title (English)</label>
    <input type="text" name="other_attributes[ft_recharge_title_en]"
           value="{{ !empty($otherAttributes['ft_recharge_title_en']) ? $otherAttributes['ft_recharge_title_en'] : '' }}"
           class="form-control" placeholder="Enter details of first-time recharge in English" id="details">
    <div class="help-block"></div>
    @if ($errors->has('ft_recharge_title_en'))
        <div class="help-block">{{ $errors->first('ft_recharge_title_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('ft_recharge_title_bn') ? ' error' : '' }}">
    <label for="ft_recharge_title_bn" >First-time Recharge Title (Bangla)</label>
    <input type="text" name="other_attributes[ft_recharge_title_bn]"  class="form-control" placeholder="Enter first-time recharge title in English"
           value="{{ !empty($otherAttributes['ft_recharge_title_bn']) ? $otherAttributes['ft_recharge_title_bn'] : '' }}" >
    <div class="help-block"></div>
    @if ($errors->has('ft_recharge_title_bn'))
        <div class="help-block">{{ $errors->first('ft_recharge_title_bn') }}</div>
    @endif
</div>
<div class="form-group col-md-6 {{ $errors->has('ft_recharge_detail_en') ? ' error' : '' }}">
    <label for="ft_recharge_detail_en" >Details of First-time Recharge (English)</label>
    <textarea type="text" name="other_attributes[ft_recharge_detail_en]"  class="form-control" placeholder="Enter of first-time recharge title in Bangla"
              id="details">{{ !empty($otherAttributes['ft_recharge_detail_en']) ? $otherAttributes['ft_recharge_detail_en'] : '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('ft_recharge_detail_en'))
        <div class="help-block">{{ $errors->first('ft_recharge_detail_en') }}</div>
    @endif
</div>
<div class="form-group col-md-6 {{ $errors->has('ft_recharge_detail_bn') ? ' error' : '' }}">
    <label for="ft_recharge_detail_bn" >Details of First-time Recharge (Bangla)</label>
    <textarea type="text" name="other_attributes[ft_recharge_detail_bn]"  class="form-control" placeholder="Enter details of first-time recharge in Bangla"
              id="details">{{ !empty($otherAttributes['ft_recharge_detail_bn']) ? $otherAttributes['ft_recharge_detail_bn'] : '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('ft_recharge_detail_bn'))
        <div class="help-block">{{ $errors->first('ft_recharge_detail_bn') }}</div>
    @endif
</div>



<div class="form-group col-md-6 {{ $errors->has('one_gb_title_en') ? ' error' : '' }}">
    <label for="one_gb_title_en" >Details of 1GB Every Month Title (English)</label>
    <input type="text" name="other_attributes[one_gb_title_en]"  class="form-control" placeholder="Enter details of first-time recharge in English"
           value="{{ !empty($otherAttributes['one_gb_title_en']) ? $otherAttributes['one_gb_title_en'] : '' }}">
    <div class="help-block"></div>
    @if ($errors->has('one_gb_title_en'))
        <div class="help-block">{{ $errors->first('one_gb_title_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('one_gb_title_bn') ? ' error' : '' }}">
    <label for="one_gb_title_bn" >Details of 1GB Every Month Title (Bangla)</label>
    <input type="text" name="other_attributes[one_gb_title_bn]"  class="form-control" placeholder="Enter first-time recharge title in English"
           value="{{ !empty($otherAttributes['one_gb_title_bn']) ? $otherAttributes['one_gb_title_bn'] : '' }}">
    <div class="help-block"></div>
    @if ($errors->has('one_gb_title_bn'))
        <div class="help-block">{{ $errors->first('one_gb_title_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('one_gb_detail_en') ? ' error' : '' }}">
    <label for="offer_details_en" >Details of 1GB Every Month (English)</label>
    <textarea type="text" name="other_attributes[one_gb_detail_en]"  class="form-control"
              placeholder="Enter details of 1GB every month"
              id="details">{{ !empty($otherAttributes['one_gb_detail_en']) ? $otherAttributes['one_gb_detail_en'] : '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('one_gb_detail_en'))
        <div class="help-block">{{ $errors->first('one_gb_detail_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('one_gb_detail_bn') ? ' error' : '' }}">
    <label for="one_gb_detail_bn" >Details of 1GB Every Month (Bangla)</label>
    <textarea type="text" name="other_attributes[one_gb_detail_bn]"  class="form-control" placeholder="Enter offer details in english"
               id="details">{{ !empty($otherAttributes['one_gb_detail_bn']) ? $otherAttributes['one_gb_detail_bn'] : '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('one_gb_detail_bn'))
        <div class="help-block">{{ $errors->first('one_gb_detail_bn') }}</div>
    @endif
</div>



<div class="form-group col-md-6 {{ $errors->has('sim_activation_title_en') ? ' error' : '' }}">
    <label for="sim_activation_title_en" >SIM Activation Bonus Title (English)</label>
    <input type="text" name="other_attributes[sim_activation_title_en]"  class="form-control" placeholder="Enter first-time recharge title in English"
           value="{{ !empty($otherAttributes['sim_activation_title_en']) ? $otherAttributes['sim_activation_title_en'] : '' }}">
    <div class="help-block"></div>
    @if ($errors->has('sim_activation_title_en'))
        <div class="help-block">{{ $errors->first('sim_activation_title_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('sim_activation_title_bn') ? ' error' : '' }}">
    <label for="sim_activation_title_bn" >SIM Activation Bonus Title (Bangla)</label>
    <input type="text" name="other_attributes[sim_activation_title_bn]"  class="form-control" placeholder="Enter details of first-time recharge in English"
           value="{{ !empty($otherAttributes['sim_activation_title_bn']) ? $otherAttributes['sim_activation_title_bn'] : '' }}">
    <div class="help-block"></div>
    @if ($errors->has('sim_activation_title_bn'))
        <div class="help-block">{{ $errors->first('sim_activation_title_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('sim_activation_bonus_en') ? ' error' : '' }}">
    <label for="offer_details_en" >SIM Activation Bonus (English)</label>
    <textarea type="text" name="other_attributes[sim_activation_bonus_en]"  class="form-control"
              placeholder="Enter details of 1GB every month"
              id="details">{{ !empty($otherAttributes['sim_activation_bonus_en']) ? $otherAttributes['sim_activation_bonus_en'] : '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('sim_activation_bonus_en'))
        <div class="help-block">{{ $errors->first('sim_activation_bonus_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('sim_activation_bonus_en') ? ' error' : '' }}">
    <label for="offer_details_en" >SIM Activation Bonus (Bangla)</label>
    <textarea type="text" name="other_attributes[sim_activation_bonus_en]"  class="form-control"
              placeholder="Enter details of 1GB every month"
              id="details">{{ !empty($otherAttributes['sim_activation_bonus_en']) ? $otherAttributes['sim_activation_bonus_en'] : '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('sim_activation_bonus_en'))
        <div class="help-block">{{ $errors->first('sim_activation_bonus_en') }}</div>
    @endif
</div>



<div class="form-group col-md-6 {{ $errors->has('extra_validity_details_en') ? ' error' : '' }}">
    <label for="extra_validity_details_en" >Extra validity offers Details (English)</label>
    <textarea type="text" name="other_attributes[extra_validity_details_en]"  class="form-control" placeholder="Enter offer details in english"
               id="details">{{ !empty($otherAttributes['extra_validity_details_en']) ? $otherAttributes['extra_validity_details_en'] : '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('extra_validity_details_en'))
        <div class="help-block">{{ $errors->first('extra_validity_details_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('offer_details_bn') ? ' error' : '' }}">
    <label for="offer_details_bn" >Extra validity offers Details (Bangla)</label>
    <textarea type="text" name="other_attributes[extra_validity_details_bn]"  class="form-control" placeholder="Enter offer details in english"
               id="details">{{ !empty($otherAttributes['extra_validity_details_bn']) ? $otherAttributes['extra_validity_details_bn'] : '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('offer_details_bn'))
        <div class="help-block">{{ $errors->first('offer_details_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('offer_details_title_en') ? ' error' : '' }}">
    <label for="offer_details_title_en" >Offer Details Title (English)</label>
    <input type="text" name="other_attributes[offer_details_title_en]"  class="form-control" placeholder="Enter first-time recharge title in English"
           value="{{ !empty($otherAttributes['offer_details_title_en']) ? $otherAttributes['offer_details_title_en'] : '' }}">
    <div class="help-block"></div>
    @if ($errors->has('offer_details_title_en'))
        <div class="help-block">{{ $errors->first('offer_details_title_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('offer_details_title_bn') ? ' error' : '' }}">
    <label for="offer_details_title_bn" >Offer Details Title (Bangla)</label>
    <input type="text" name="other_attributes[offer_details_title_bn]"  class="form-control" placeholder="Enter details of first-time recharge in English"
           value="{{ !empty($otherAttributes['offer_details_title_bn']) ? $otherAttributes['offer_details_title_bn'] : '' }}">
    <div class="help-block"></div>
    @if ($errors->has('offer_details_title_bn'))
        <div class="help-block">{{ $errors->first('offer_details_title_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('offer_details_en') ? ' error' : '' }}">
    <label for="offer_details_en" >Offers Details (English)</label>
    <textarea type="text" name="offer_details_en"  class="form-control" placeholder="Enter offer details in english"
              id="details">{{ !empty($productDetail->product_details->offer_details_en) ? $productDetail->product_details->offer_details_en : '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('offer_details_en'))
        <div class="help-block">{{ $errors->first('offer_details_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('offer_details_bn') ? ' error' : '' }}">
    <label for="offer_details_bn" >Offers Details (Bangla)</label>
    <textarea type="text" name="offer_details_bn"  class="form-control" placeholder="Enter offer details in english"
              id="details">{{ !empty($productDetail->product_details->offer_details_bn) ? $productDetail->product_details->offer_details_bn : '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('offer_details_bn'))
        <div class="help-block">{{ $errors->first('offer_details_bn') }}</div>
    @endif
</div>



