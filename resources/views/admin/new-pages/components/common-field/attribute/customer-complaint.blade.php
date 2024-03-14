<div class="form-group col-md-6">
    <label for="complaint_closed_no">Complaint Closed No (%)</label>
    <input type="text" name="attribute[complaint_closed_no][en]"  class="form-control" placeholder="Enter Complaint Closed No (%)"
           value="{{ $component->attribute['complaint_closed_no']['en'] ?? '' }}" id="complaint_closed_no">
    <div class="help-block"></div>
</div>

<div class="form-group col-md-6">
    <label for="unreached_customer_no" >Unreached Customer No (%)</label>
    <input type="text" name="attribute[unreached_customer_no][bn]"  class="form-control" placeholder="Enter Unreached Customer No (%)"
           value="{{ $component->attribute['unreached_customer_no']['bn'] ?? '' }}" id="unreached_customer_no">
    <div class="help-block"></div>
</div>

<div class="form-group col-md-6">
    <label for="complaint_closed_title_en">Complaint Closed Title (English)</label>
    <input type="text" name="attribute[complaint_closed_title][en]"  class="form-control" placeholder="Enter Complaint Closed Title (English)"
           value="{{ $component->attribute['complaint_closed_title']['en'] ?? '' }}" id="complaint_closed_title_en">
    <div class="help-block"></div>
</div>
<div class="form-group col-md-6">
    <label for="complaint_closed_title_bn">Complaint Closed Title (Bangla)</label>
    <input type="text" name="attribute[complaint_closed_title][bn]"  class="form-control" placeholder="Enter Complaint Closed Title (Bangla)"
           value="{{ $component->attribute['complaint_closed_title']['bn'] ?? '' }}" id="complaint_closed_title_bn">
    <div class="help-block"></div>
</div>

<div class="form-group col-md-6">
    <label for="unreached_customer_title_en">Unreached Customer Title (English)</label>
    <input type="text" name="attribute[unreached_customer_title][en]"  class="form-control" placeholder="Enter Unreached Customer Title (English)"
           value="{{ $component->attribute['unreached_customer_title']['en'] ?? '' }}" id="unreached_customer_title_en">
    <div class="help-block"></div>
</div>
<div class="form-group col-md-6">
    <label for="unreached_customer_title_bn">Unreached Customer Title (Bangla)</label>
    <input type="text" name="attribute[unreached_customer_title][bn]"  class="form-control" placeholder="Enter Unreached Customer Title (Bangla)"
           value="{{ $component->attribute['unreached_customer_title']['bn'] ?? '' }}" id="unreached_customer_title_bn">
    <div class="help-block"></div>
</div>

